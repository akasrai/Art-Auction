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

        // FOR Seller
        DB::table('roles')->insert([
            'name' => 'CEO',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('roles')->insert([
            'name' => 'AreaManager',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('roles')->insert([
            'name' => 'Manager',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('roles')->insert([
            'name' => 'Clerk',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
