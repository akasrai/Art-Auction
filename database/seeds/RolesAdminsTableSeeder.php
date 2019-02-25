<?php

use Illuminate\Database\Seeder;

class RolesAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_admins')->insert([
            'role_id' => '1',
            'admin_id' => '1',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('role_admins')->insert([
            'role_id' => '2',
            'admin_id' => '2',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('role_admins')->insert([
            'role_id' => '3',
            'admin_id' => '3',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('role_admins')->insert([
            'role_id' => '4',
            'admin_id' => '4',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
