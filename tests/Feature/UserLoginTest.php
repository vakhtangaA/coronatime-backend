<?php

namespace Tests\Feature;

use App\Http\Livewire\Components\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_page_is_rendered()
	{
		$response = $this->get(route('login', 'en'));

		$response->assertSuccessful();
		$response->assertSee('Welcome back');
	}

	public function test_authorized_user_can_not_see_login_page()
	{
		$user = User::factory()->create();
		$this->actingAs($user);

		$response = $this->get(route('login', 'en'));

		$response->assertDontSee('Welcome back');
		$response->assertRedirect('/');
	}

	public function test_user_login_is_possible_when_credentials_is_set_correctly()
	{
		$user = User::factory()->create([
			'password' => 'password',
		]);

		Livewire::test(Login::class)
			->set('name', $user->name)
			->set('password', 'password')
			->call('submit');

		$this->assertAuthenticated();
		$this->assertAuthenticatedAs($user);
	}

	public function test_user_login_is_not_possible_when_credentials_is_not_set_correctly()
	{
		$user = User::factory()->create([
			'password' => 'password',
		]);

		Livewire::test(Login::class)
			->set('name', $user->name)
			->set('password', 'passwordaa')
			->call('submit')
			->assertRedirect(route('login', 'en'));
	}
}
