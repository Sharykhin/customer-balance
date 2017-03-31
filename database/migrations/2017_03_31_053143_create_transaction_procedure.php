<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
            DROP PROCEDURE IF EXISTS make_transaction;
            DELIMITER //
            CREATE PROCEDURE make_transaction(IN amount INT, IN currency VARCHAR(45), IN operation_type VARCHAR(45), IN customer_id INT)
             BEGIN
             DECLARE customer_balance DECIMAL(8,2);
             DECLARE customer_bonus DECIMAL(8,2);
             DECLARE transaction_id INT;
             DECLARE EXIT HANDLER FOR sqlexception
              BEGIN
                ROLLBACK;
                RESIGNAL;
             END;
             START TRANSACTION;
             SELECT cb.bonus,cb.balance INTO customer_bonus,customer_balance from customer_balances as cb WHERE customer_id = customer_id LIMIT 1 LOCK IN SHARE MODE;
             IF operation_type = 'withdrawal' AND amount > customer_balance THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'You can not widthraw more that you have on your balance';
             ELSEIF operation_type = 'withdrawal' AND amount < customer_balance THEN
                INSERT INTO transactions(`customer_id`, `type`, `amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES (customer_id, 'withdrawal', amount, currency, 'pending', NOW(), NOW());
                SET transaction_id = LAST_INSERT_ID();
                SET @new_balance = customer_balance - amount;
                UPDATE customer_balances SET balance = @new_balance, `updated_at`= NOW() WHERE customer_id = customer_id;
                UPDATE transactions SET status = 'complete' WHERE id = transaction_id;
             ELSEIF operation_type = 'deposit' THEN
                INSERT INTO transactions(`customer_id`, `type`, `amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES (customer_id, 'deposit', amount, currency, 'pending', NOW(), NOW());
                SET transaction_id = LAST_INSERT_ID();
                SELECT COUNT(transactions.id) INTO @total_transactions FROM transactions WHERE customer_id = customer_id AND `type` = 'deposit';
                SET @new_bonus = customer_bonus;
                IF (@total_transactions % 3) = 0 THEN
                  SELECT bonus_percent INTO @user_bonus_percent FROM customers WHERE id = customer_id;
                  SET @new_bonus = @new_bonus + (amount * @user_bonus_percent) / 100;
                END IF;
                SET @new_balance = customer_balance + amount;
                UPDATE customer_balances SET balance = @new_balance, bonus = @new_bonus, `updated_at`= NOW() WHERE customer_id = customer_id;
                UPDATE transactions SET status = 'complete' WHERE id = transaction_id;
             END IF;
             COMMIT;
             SELECT * FROM transactions WHERE id = transaction_id;
            END //
            DELIMITER ;
        ";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS make_transaction");
    }
}
