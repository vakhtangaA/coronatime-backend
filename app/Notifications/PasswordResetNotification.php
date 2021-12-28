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

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($url)
	{
		return (new MailMessage)
					->line('The introduction to the notification.')
					->action(Lang::get('Reset Password'), $url)
					->view('notifications.password', ['token' =>  $this->token, 'email' => $this->email])
					->line('Thank you for using our application!');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
		];
	}
}
