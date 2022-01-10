<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Notification;
use App\Http\Livewire\Components\ForgotPassword;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordTest extends TestCase
{
	use RefreshDatabase;

	public function test_forgot_password_page_sends_mail_to_user_when_input_email_exists_in_database()
	{
		Notification::fake();

		$user = User::factory()->create([
			'email' => 'vakhtang.chitauri@gmail.com',
		]);

		$this->get(route('password.email', 'en'));

		$token = app('auth.password.broker')->createToken($user);

		Livewire::test(ForgotPassword::class)
		->set('email', 'vakhtang.chitauri@gmail.com')
		->call('submit')
		->assertHasNoErrors()
		->assertRedirect(route('passwordReset.notice', 'en'));

		$response = $this->get(route('passwordReset.notice', 'en'));

		$response->assertSee('We have sent you a password reset link');

		$notification = new PasswordResetNotification($token, $user->email);

		$notification->toMail($user);

		Notification::assertSentTo($user, PasswordResetNotification::class);
	}

	public function test_password_reset_notification_is_not_send_when_database_has_not_user_with_given_email_adress()
	{
		Notification::fake();

		$this->get(route('password.email', 'en'));

		Livewire::test(ForgotPassword::class)
			->set('email', 'vakhtangaa@gmail.com')
			->call('submit')
			->assertRedirect(route('password.email', 'en'));

		Notification::assertNothingSent();
	}
}
