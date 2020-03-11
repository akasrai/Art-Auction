<?php

use Illuminate\Database\Seeder;

class RolesSellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_sellers')->insert([
            'role_id' => '4',
            'seller_id' => '1',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('role_sellers')->insert([
            'role_id' => '5',
            'seller_id' => '2',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('role_sellers')->insert([
            'role_id' => '6',
            'seller_id' => '3',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('role_sellers')->insert([
            'role_id' => '7',
            'seller_id' => '4',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
