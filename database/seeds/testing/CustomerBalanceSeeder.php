<?php

namespace Seeds\Testing;

use Illuminate\Database\Seeder;
use DateTime;
use DB;

/**
 * Class CustomerBalanceSeeder
 * @package Seeder\Testing
 */
class CustomerBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $balances = array(
            array(
                'bonus' => 5,
                'balance' => 185,
                'customer_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
            array(
                'bonus' => 0,
                'balance' => 200,
                'customer_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
            array(
                'bonus' => 10,
                'balance' => 260,
                'customer_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
        );

        DB::table('customer_balances')->insert($balances);
    }
}
