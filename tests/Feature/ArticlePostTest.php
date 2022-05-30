<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Test\Feature\factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlePostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /** @test */
    public function user_index_article_test()
    {
    
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/article');

        $response->assertStatus(200);
    }

    public function user_can_store_article_test()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/article/store', [
            'title' => 'test',
            'content' => 'test',
            'image' => 'test',
            'users_id' => 'test',
            'categories_id' => 'test',
        ]);

        $response->assertStatus(200);
    }

    public function user_can_edit_article_test()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/article/edit/1');

        $response->assertStatus(200);
    }

    public function user_can_update_article_test()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/article/update/1', [
            'title' => 'test',
            'content' => 'test',
            'image' => 'test',
            'users_id' => 'test',
            'categories_id' => 'test',
        ]);

        $response->assertStatus(200);
    }

}
