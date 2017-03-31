<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW customer_view AS
                        SELECT c.id, c.email, c.first_name, c.last_name, c.gender, c.country, 
                                c.created_at, (cb.balance + cb.bonus) as balance, c.bonus
                        FROM customers AS c
                        INNER JOIN customer_balances as cb ON cb.customer_id = c.id
                        ORDER BY c.id ASC');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW customer_view");
    }
}
