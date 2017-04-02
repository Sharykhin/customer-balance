<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(app()->environment() === 'local') {
            $this->call(\Seeds\Local\CustomerSeeder::class);
            $this->call(\Seeds\Local\CustomerBalanceSeeder::class);
        }

        if(app()->environment() === 'testing') {
            $this->call(\Seeds\Testing\CustomerSeeder::class);
            $this->call(\Seeds\Testing\CustomerBalanceSeeder::class);
        }

    }
}
