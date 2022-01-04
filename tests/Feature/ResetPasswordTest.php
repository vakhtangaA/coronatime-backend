<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Components\Login;
use App\Http\Livewire\Components\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_can_reset_password()
	{
		$user = User::factory()->create([
			'email'    => 'vakhtang.chitauri@gmail.com',
			'password' => 'qwerty123',
		]);

		$token = app('auth.password.broker')->createToken($user);

		$response = $this->get(route('login', 'en'));

		$response->assertSee('Welcome back');

		Livewire::test(Login::class)
			->set('name', 'vakhtang.chitauri@gmail.com')
			->set('password', 'new-password')
			->call('submit');

		$this->assertGuest();

		$this->get(route('password.reset', ['language' => 'en', 'token' => $token]));

		Livewire::test(ResetPassword::class)
			->set('email', 'vakhtang.chitauri@gmail.com')
			->set('token', $token)
			->set('password', 'new-password')
			->set('password_confirmation', 'new-password')
			->call('submit');

		Livewire::test(Login::class)
			->set('name', 'vakhtang.chitauri@gmail.com')
			->set('password', 'new-password')
			->call('submit');

		$this->assertAuthenticated();
	}

	public function test_if_password_confirmation_works_correctly_on_reset_password_page()
	{
		$user = User::factory()->create([
			'email'    => 'vakhtang.chitauri@gmail.com',
			'password' => 'qwerty123',
		]);

		$token = app('auth.password.broker')->createToken($user);

		$this->get(route('password.reset', ['language' => 'en', 'token' => $token]));

		Livewire::test(ResetPassword::class)
			->set('email', 'vakhtang.chitauri@gmail.com')
			->set('token', $token)
			->set('password', 'new-password')
			->set('password_confirmation', 'old-password')
			->call('submit')
			->assertHasErrors();

		$this->get(route('password.reset', ['language' => 'ka', 'token' => $token]));

		Livewire::test(ResetPassword::class)
			->set('email', 'vakhtang.chitauri@gmail.com')
			->set('token', $token)
			->set('password', 'new-password')
			->set('password_confirmation', 'old-password')
			->call('submit')
			->assertHasErrors();
	}
}
