<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemsTest extends TestCase
{

    /** @test */
    public function loadItemsForCategory()
    {
        $category_id = rand(1, 12);

        $request = [
            'id' => $category_id
        ];

        $this->post('/category/items-list', $request)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'description', 'image_url'
                    ]
                ]
            ]);
    }
}
