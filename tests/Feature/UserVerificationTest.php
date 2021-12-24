<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
// use App\Notifications\VerificationMail;
use App\Http\Livewire\Components\Register;
use App\Notifications\VerificationMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class UserVerificationTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_user_recieves_an_email_for_verification_when_registered()
	{
		Notification::fake();

		Notification::assertNothingSent();

		Livewire::test(Register::class)
			->set('name', 'admin')
			->set('email', 'vakhtang.chitauri@gmail.com')
			->set('password', '12345678')
			->set('password_confirmation', '12345678')
			->call('submit');

		$user = User::latest()->first();

		Notification::assertSentTo($user, VerificationMail::class);
	}

	public function test_user_verifies()
	{
		$notification = new VerificationMail();

		Livewire::test(Register::class)
			->set('name', 'admin')
			->set('email', 'vakhtang.chitauri@gmail.com')
			->set('password', '12345678')
			->set('password_confirmation', '12345678')
			->call('submit');

		$user = User::latest()->first();
		$uri = $notification->verificationUrl($user);

		$this->assertEquals(null, $user->email_verified_at);

		$this->actingAs($user)->get($uri);

		$this->assertNotEquals(null, $user->email_verified_at);
	}
}
