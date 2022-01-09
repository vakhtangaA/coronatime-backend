<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Components\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SessionTest extends TestCase
{
	use RefreshDatabase;

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

		$response = $this->actingAs($user)->post(route('logout', 'en'));

		$this->assertGuest();
	}
}
