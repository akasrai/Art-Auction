<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
