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
        $this->getJson('/category/tree')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'children'
                    ]
                ]
            ]);
    }

    /** @test */
    public function loadListOfCategoriesNoTree()
    {
        $this->getJson('/category/list')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'children'
                    ]
                ]
            ]);
    }

    /** @test */
    public function createCategoryWithNoParent()
    {
        $request = [
            'name' => str_random(10)
        ];

        $this->post('/category/create', $request)
            ->assertStatus(201);
    }

    /** @test */
    public function createCategoryWithParent()
    {
        $request = [
            'name' => str_random(10),
            'parent_id' => rand(1, 12)
        ];

        $this->post('/category/create', $request)
            ->assertStatus(201);

    }
}
