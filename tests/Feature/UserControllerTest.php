<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @test
     * @return void
     */

    public function test_user_register()
    {
        $email = 'user@example.com';
        $this->post(route('register'), [
            'name' => 'user',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])
            ->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => $email]);
    }

    public function test_user_login()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs(User::find(2))
            ->get('/');

        $response->assertStatus(200)
            ->assertViewIs('post.index')
            ->assertSee('ログアウト');

    }

    public function test_move_user_show()
    {
        $user = factory(User::class)->create([
            'name' => 'testuser',
        ]);

        $response = $this
            ->actingAs(User::find(3))
            ->get(route('users.show', 3));

        $response->assertStatus(200)
            ->assertViewIs('user.show')
            ->assertSee('testuser');

    }

    public function test_user_destroy()
    {

        $user = factory(User::class)->create();

        // DELETE リクエスト
        $response = $this
            ->actingAs(User::find(4));

        $response = $this->delete(route('users.destroy', 4));

        // ステータスコード 302
        $response->assertStatus(302);

        // `users` テーブルが0件になっている
        $this->assertEquals(0, User::count());

    }

}
