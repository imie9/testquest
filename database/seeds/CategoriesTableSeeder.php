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
        $categories = [
            ['id' => 1, 'name' => 'TV & Home Theather'],
            ['id' => 2, 'name' => 'Tablets & E-Readers'],
            ['id' => 3, 'name' => 'Computers', 'children' => [
                ['id' => 4, 'name' => 'Laptops', 'children' => [
                    ['id' => 5, 'name' => 'PC Laptops'],
                    ['id' => 6, 'name' => 'Macbooks (Air/Pro)']
                ]],
                ['id' => 7, 'name' => 'Desktops', 'children' => [
                    ['id' => 8, 'name' => 'Towers Only'],
                    ['id' => 10, 'name' => 'Desktop Packages'],
                    ['id' => 11, 'name' => 'All-in-One Computers'],
                    ['id' => 12, 'name' => 'Gaming Desktops']
                ]]
            ]],
            ['id' => 9, 'name' => 'Cell Phones']
        ];

        App\Models\Category::buildTree($categories);
    }
}
