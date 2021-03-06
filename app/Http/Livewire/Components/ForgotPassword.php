<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
	public $email;

	public function rules()
	{
		return [
			'email'  => ['required', 'email'],
		];
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function submit()
	{
		$status = Password::sendResetLink(
			['email' => $this->email]
		);

		return $status === Password::RESET_LINK_SENT
			? redirect()->route('password.reset-notice', app()->getLocale())->with('success', 'Password reset email sent')
			: redirect()->route('password.email', app()->getLocale())->with('error', $status);
	}

	public function render()
	{
		return view('livewire.components.forgot-password')->layout('layout');
	}
}
