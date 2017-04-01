<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCustomerReportView
 */
class CreateCustomerReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW customer_reports
            AS
            SELECT date_format(t.created_at,\'%Y-%m-%d\') as `date`, 
                    c.country, 
                    COUNT(DISTINCT t.customer_id) AS `unique_customers`,
                    t.`type`,
                    COUNT(t.`type`) as `number`,
                    SUM(t.`amount`) as `total`
                    FROM transactions AS t
            INNER JOIN customers AS c ON t.customer_id = c.id
            GROUP BY date_format(t.created_at,\'%Y-%m-%d\'), c.country, t.`type`
            ORDER BY `date` DESC;
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW customer_reports');
    }
}
