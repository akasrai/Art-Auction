<?php

use Illuminate\Database\Seeder;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sellers')->insert([
            'fname' => 'CEO',
            'lname' => '',
            'email' => 'ceo@mail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('sellers')->insert([
            'fname' => 'Admin',
            'lname' => '',
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('sellers')->insert([
            'fname' => 'Manager',
            'lname' => '',
            'email' => 'manager@mail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('sellers')->insert([
            'fname' => 'Clerk',
            'lname' => '',
            'email' => 'clerk@mail.com',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
