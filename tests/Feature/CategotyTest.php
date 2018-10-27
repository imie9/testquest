<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategotyTest extends TestCase
{
    /** @test */
    public function loadListOfCategories()
    {
        $this->getJson('/category/full-list')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'parent_id', 'children', 'lft', 'rgt',
                        'depth'
                    ]
                ]
            ]);
    }

    /** @test */
    public function loadListOfCategoriesNoTree()
    {
        $this->getJson('/category/full-list-not-tree')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'parent_id', 'lft', 'rgt',
                        'depth'
                    ]
                ]
            ]);
    }

    /** @test */
    public function createCategoryWithNoParent()
    {
        $request = [
            'name' => str_random(5)
        ];

        $this->post('/category/create', [$request])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'parent_id', 'children', 'lft', 'rgt',
                        'depth', 'success' => true
                    ]
                ]
            ]);
    }

    /** @test */
    public function createCategoryWithParent()
    {
        $request = [
            'name' => str_random(5),
            'parent_id' => rand(1, 12)
        ];

        $this->post('/category/create', [$request])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'parent_id', 'children', 'lft', 'rgt',
                        'depth', 'success' => true
                    ]
                ]
            ]);
    }
}
