<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'fname' => 'Akash',
            'lname' => 'Rai',
            'email' => 'akash1@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('admins')->insert([
            'fname' => 'Akash2',
            'lname' => 'Rai',
            'email' => 'akash2@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('admins')->insert([
            'fname' => 'Akash3',
            'lname' => 'Rai',
            'email' => 'akash3@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('admins')->insert([
            'fname' => 'Akash4',
            'lname' => 'Rai',
            'email' => 'akash4@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
