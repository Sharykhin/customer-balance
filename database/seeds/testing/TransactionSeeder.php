<?php

namespace Seeds\Testing;

use Illuminate\Database\Seeder;
use DateTime;
use DB;

/**
 * Class TransactionSeeder
 */
class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'customer_id' => 1,
                'type' => 'deposit',
                'amount' => 50.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 1,
                'type' => 'deposit',
                'amount' => 45.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 1,
                'type' => 'deposit',
                'amount' => 100.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 1,
                'type' => 'withdrawal',
                'amount' => 10.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 2,
                'type' => 'deposit',
                'amount' => 350.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 2,
                'type' => 'withdrawal',
                'amount' => 150.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 3,
                'type' => 'deposit',
                'amount' => 80.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 3,
                'type' => 'deposit',
                'amount' => 80.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'customer_id' => 3,
                'type' => 'deposit',
                'amount' => 100.00,
                'currency' => 'USD',
                'status' => 'complete',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ];

        DB::table('transactions')->insert($transactions);
    }
}
