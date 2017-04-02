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
                'bonus' => 20,
                'balance' => 100,
                'customer_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
            array(
                'bonus' => 15,
                'balance' => 150,
                'customer_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
            array(
                'bonus' => 10,
                'balance' => 230,
                'customer_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
        );

        DB::table('customer_balances')->insert($balances);
    }
}
