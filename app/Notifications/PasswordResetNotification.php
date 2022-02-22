<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetNotification extends Notification
{
	use Queueable;

	public $token;

	public $email;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($token, $email)
	{
		$this->token = $token;
		$this->email = $email;
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

	/*
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($url)
	{
		$spaUrl = config('app.front') . '/reset-password/' . $this->token . '?email=' . $this->email;
		return (new MailMessage)
					->action(Lang::get('Reset Password'), $url)
					->view('notifications.password', ['spaUrl' => $spaUrl]);
	}
}
