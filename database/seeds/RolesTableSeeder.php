<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Superadmin',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'name' => 'Editor',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'name' => 'Moderator',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
