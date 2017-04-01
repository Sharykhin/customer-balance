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
                    cr.number AS \'number_of_deposits\', 
                    cr.total AS \'total_amount_of_deposit\',
                    cr2.number as `number_of_withdrawal`,
                    cr2.total as `total_amount_of_withdrawal`
            from (SELECT * FROM customer_reports WHERE customer_reports.`type` = \'deposit\') as cr
            inner join (SELECT * FROM customer_reports WHERE customer_reports.`type` = \'withdrawal\') as cr2
            ON (cr.`date` = cr2.`date` AND cr.`country` = cr2.`country`)
            ORDER BY cr.`date` DESC;
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
