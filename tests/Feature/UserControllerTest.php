<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @test
     * @return void
     */

    public function test_ユーザー新規登録()
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

    public function test_ユーザーログイン()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/');

        // 認証されていることを確認
        $this->assertTrue(Auth::check());

        // topページにリダイレクトし、ログアウトが表示される
        $response->assertStatus(200)
            ->assertViewIs('post.index')
            ->assertSee('ログアウト');

    }

    public function test_ユーザーログアウト()
    {
        $user = factory(User::class)->create();
    
        $this->actingAs($user);
    
        // 認証されていることを確認
        $this->assertTrue(Auth::check());
    
        // ログアウトを実行
        $response = $this->post('logout');
    
        // 認証されていない
        $this->assertFalse(Auth::check());
    
         // topページにリダイレクトする
        $response->assertRedirect('/');

    }

    public function test_ログイン後、マイページへ遷移()
    {
        $user = factory(User::class)->create([
            'name' => 'testuser',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('users.show', $user->id));

        $response->assertStatus(200)
            ->assertViewIs('user.show')
            ->assertSee('testuser');

    }

    public function test_ユーザーを削除()
    {

        $user = factory(User::class)->create();

        // DELETE リクエスト
        $response = $this
            ->actingAs($user);

        $response = $this->delete(route('users.destroy', $user->id));

        // ステータスコード 302
        $response->assertStatus(302);

        // `users` テーブルが0件になっている
        $this->assertEquals(0, User::count());

    }

}
