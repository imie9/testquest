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
}
