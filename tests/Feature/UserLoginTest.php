<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Rules\UserDoesNotExist;
use App\Http\Livewire\Components\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

	public function test_user_login_is_possible_when_user_provided_email_instead_of_name()
	{
		$user = User::factory()->create([
			'password' => 'password',
		]);

		Livewire::test(Login::class)
			->set('name', $user->email)
			->set('password', 'password')
			->call('submit');

		$this->assertAuthenticated();
		$this->assertAuthenticatedAs($user);
	}

	public function test_when_user_tries_to_login_and_is_unregistered_costum_rule_error_is_shown()
	{
		Livewire::test(Login::class)
			->set('name', 'admin@gmail.com')
			->set('password', 'password')
			->assertHasErrors(['name' => new UserDoesNotExist])
			->call('submit');
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
