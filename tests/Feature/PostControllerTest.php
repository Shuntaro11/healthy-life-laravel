<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @test
     * @return void
     */

    public function test_レシピを投稿できる()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());

        $testImage = UploadedFile::fake()->image('test.jpg');

        $this->post(route('posts.store'), [
            'title' => 'テスト1',
            'image' => $testImage,
            'content' => 'テスト1',
        ])
            ->assertStatus(302);
        $this->assertDatabaseHas('posts', ['title' => 'テスト1']);
    }

    public function test_titleが無いとレシピを投稿できない()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());

        $testImage = UploadedFile::fake()->image('test.jpg');

        $this->post(route('posts.store'), [
            'title' => null,
            'image' => $testImage,
            'content' => 'テスト2',
        ])
            ->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['content' => 'テスト2']);
    }

    public function test_imageが無いとレシピを投稿できない()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());

        $testImage = UploadedFile::fake()->image('test.jpg');

        $this->post(route('posts.store'), [
            'title' => 'テスト3',
            'image' => null,
            'content' => 'テスト3',
        ])
            ->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['title' => 'テスト3']);
    }

    public function test_contentが無いとレシピを投稿できない()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());

        $testImage = UploadedFile::fake()->image('test.jpg');

        $this->post(route('posts.store'), [
            'title' => 'テスト4',
            'image' => $testImage,
            'content' => null,
        ])
            ->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['title' => 'テスト4']);
    }

}
