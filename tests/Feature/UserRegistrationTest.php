<?php

namespace Tests\Feature;

use App\Http\Livewire\Components\Register;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_page_is_rendered()
	{
		$response = $this->get('/register');

		$response->assertStatus(200);
		$response->assertSee('Welcome to Coronatime');
	}

	public function test_authorized_user_can_not_see_register_page()
	{
		$user = User::factory()->create();
		$this->actingAs($user);

		$response = $this->get(route('register'));

		$response->assertDontSee('Welcome to Coronatime');
		$response->assertRedirect('/');
	}

	public function test_user_registration_is_possible_when_properties_is_set_correctly()
	{
		Livewire::test(Register::class)
			->set('name', 'admin')
			->set('email', 'vakho@gmail.com')
			->set('password', '12345678')
			->set('password_confirmation', '12345678')
			->call('submit');

		$this->assertTrue(User::where('name', '=', 'admin')->exists());
	}

	public function test_user_registration_is_not_possible_when_passwords_dont_match()
	{
		Livewire::test(Register::class)
			->set('name', 'admin')
			->set('email', 'fdagfa')
			->set('password', '12345678')
			->set('password_confirmation', '432546436')
			->call('submit')
			->assertHasErrors('password');
	}
}
