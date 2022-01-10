<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Components\Register;
use App\Notifications\VerificationMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class UserVerificationTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_recieves_an_email_for_verification_when_registered()
	{
		Notification::fake();

		Livewire::test(Register::class)
			->set('name', 'admin')
			->set('email', 'vakhtang.chitauri@gmail.com')
			->set('password', '12345678')
			->set('password_confirmation', '12345678')
			->call('submit')
			->assertRedirect(route('verification.notice', 'en'));

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

		$response = $this->get(route('account.verified.notice', 'en'));

		$response->assertSee('Your account is confirmed, you can sign in');

		$this->assertNotEquals(null, $user->email_verified_at);
	}

	public function test_user_can_resend_verification_mail()
	{
		$user = User::factory()->create();

		$user->email_verified_at = now();

		$response = $this->get(route('verification.notice', 'en'));

		$response->assertSee('SEND AGAIN');

		$this->assertGuest();

		$response = $this->actingAs($user)->post(route('verification.send', 'en'));

		$response->assertSessionHas('success', 'Verification link sent!');
	}
}
