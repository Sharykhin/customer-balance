<?php

namespace Seeds\Local;

use Illuminate\Database\Seeder;
use DateTime;
use DB;

/**
 * Class CustomerSeeder
 */
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
                'bonus_percent' => 5,
                'country' => 'US',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
            array(
                'email' => 'brad_pit@mail.com',
                'first_name' => 'Brad',
                'last_name' => 'Pit',
                'gender' => 'male',
                'bonus_percent' => 10,
                'country' => 'US',
                'created_at' => new DateTime(),
                'updated_at' =>new DateTime()
            ),
            array(
                'email' => 'sergey@mail.com',
                'first_name' => 'Sergey',
                'last_name' => 'Sharykhin',
                'gender' => 'male',
                'bonus_percent' => 15,
                'country' => 'BY',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ),
        );

        DB::table('customers')->insert($users);
    }
}
