<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class ReportView
 */
class ReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW reports_view
            AS
            SELECT  cr.`date`, 
                    cr.country, 
                    cr.unique_customers,
                    IFNULL(cr.number, 0) AS \'number_of_deposits\', 
                    IFNULL(cr.total, 0) AS \'total_amount_of_deposit\',
                    IFNULL(cr2.number,0) as `number_of_withdrawal`,
                    IFNULL(cr2.total,0) as `total_amount_of_withdrawal`
            from (SELECT * FROM customer_reports WHERE customer_reports.`type` = \'deposit\') as cr
            left join (SELECT * FROM customer_reports WHERE customer_reports.`type` = \'withdrawal\') as cr2
            ON (cr.`date` = cr2.`date` AND cr.`country` = cr2.`country`)
            ORDER BY cr.`date`DESC;
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW reports_view');
    }
}
