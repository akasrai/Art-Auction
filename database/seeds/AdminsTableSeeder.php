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
            'fname' => 'Superadmin',
            'lname' => '',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('admins')->insert([
            'fname' => 'Admin',
            'lname' => '',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('admins')->insert([
            'fname' => 'Editor',
            'lname' => '',
            'email' => 'admin3@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('admins')->insert([
            'fname' => 'Moderator',
            'lname' => '',
            'email' => 'admin4@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
