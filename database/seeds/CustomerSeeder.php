<?php

use Illuminate\Database\Seeder;
use DateTime;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                'email' => 'cameron_diaz@mail.com',
                'first_name' => 'Cameron',
                'last_name' => 'Diaz',
                'gender' => 'female',
                'bonus' => '5',
                'created_at' => (new DateTime())->format(DateTime::ISO8601)
            ),
            array(
                'email' => 'brad_pit@mail.com',
                'first_name' => 'Brad',
                'last_name' => 'Pit',
                'gender' => 'male',
                'bonus' => '10',
                'created_at' => (new DateTime())->format(DateTime::ISO8601)
            ),
        );

        DB::table('customers')->insert($users);
    }
}
