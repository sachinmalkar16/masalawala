<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username' => 'sachin',
            'first_name' => 'Sachin',
            'last_name' => 'Malkar',
            'email' => 'sachinmalkar16@gmail.com',
            'email_verification' => '1',
            'mobile' => '9967247394',
            'mobile_verification' => '1',
            'gender' => 'M',
            'birthday' => date('Y-m-d H:i:s', strtotime('16/06/1982')),
            'premium' => '1',
            'system_verified' => '1',
            'role' => '1',
            'password' => bcrypt('ifz@123'),
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')

        ]);


        DB::table('users')->insert([
            'username' => 'shish',
            'first_name' => 'shish',
            'last_name' => 'j',
            'email' => 'sm_malkar@gmail.com',
            'email_verification' => '1',
            'mobile' => '9967247396',
            'mobile_verification' => '1',
            'gender' => 'M',
            'birthday' => date('Y-m-d H:i:s', strtotime('16/06/1982')),
            'premium' => '1',
            'system_verified' => '1',
            'role' => '1',
            'password' => bcrypt('ifz@123'),
            //'api_token'=> 'test2',

        ]);
       /* Model::unguard();

        DB::table('users')->delete();

        $users = array(
            ['name' => 'Ryan Chenkie', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret')],
            ['name' => 'Chris Sevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret')],
            ['name' => 'Holly Lloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret')],
            ['name' => 'Adnan Kukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();*/

    }
}
