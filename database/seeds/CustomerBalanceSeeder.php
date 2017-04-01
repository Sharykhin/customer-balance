<?php

use Illuminate\Database\Seeder;

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
                'bonus' => 0,
                'balance' => 0,
                'customer_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
            array(
                'bonus' => 0,
                'balance' => 0,
                'customer_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
            array(
                'bonus' => 0,
                'balance' => 0,
                'customer_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
        );

        DB::table('customer_balances')->insert($balances);
    }
}
