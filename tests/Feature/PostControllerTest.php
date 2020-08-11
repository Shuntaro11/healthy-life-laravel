<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     * @return void
     */
    
    public function test_top_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
        ->assertViewIs('post.index')
        ->assertSee('Healthy Lifeへようこそ！');
    }
}
