<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Components\Login;

class SessionTest extends TestCase
{
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_user_can_logout()
	{
		$user = User::factory()->create([
			'password' => 'password',
		]);

		Livewire::test(Login::class)
			->set('name', $user->name)
			->set('password', 'password')
			->call('submit');

		$this->assertAuthenticated();

		$response = $this->actingAs($user)->post(route('logout'));

		$this->assertGuest();
	}
}
