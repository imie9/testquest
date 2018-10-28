<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        print("running CategoriesTableSeeder 4 times to make tree\n");
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
         $this->call(ItemsTableSeeder::class);
    }
}
