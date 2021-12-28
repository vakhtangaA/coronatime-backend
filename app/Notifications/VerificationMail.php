<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerificationMail extends VerifyEmail
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	protected function buildMailMessage($url)
	{
		return (new MailMessage)
			->level('success')
			->subject(Lang::get('Verify Email Address'))
			->view('notifications.email')
			->action(Lang::get('Verify Email'), $url);
	}

	/**
	 * Get the verification URL for the given notifiable.
	 *
	 * @param mixed $notifiable
	 *
	 * @return string
	 */
	public function verificationUrl($notifiable)
	{
		if (static::$createUrlCallback)
		{
			return call_user_func(static::$createUrlCallback, $notifiable);
		}

		return URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id'          => $notifiable->getKey(),
				'hash'        => sha1($notifiable->getEmailForVerification()),
				'language'    => app()->getLocale(),
				'redirect_to' => route('verified', app()->getLocale()),
			]
		);
	}
}
