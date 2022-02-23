<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Component
{
	public $password;

	public $password_confirmation;

	public $email;

	public $token;

	public function mount()
	{
		$this->email = request()->email;
		$this->token = request()->route()->parameters()['token'] ?? '';
	}

	public function rules()
	{
		return [
			'password'               => ['required', 'min:3', 'max:255'],
			'password_confirmation'  => ['required', 'min:3', 'max:255', 'same:password'],
		];
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function submit()
	{
		$credentials = [
			'email'                 => $this->email,
			'password'              => $this->password,
			'password_confirmation' => $this->password_confirmation,
			'token'                 => $this->token,
		];

		$status = Password::reset(
			$credentials,
			function ($user, $password) {
				$user->forceFill([
					'password' => $password,
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
		? redirect()->route('password.reseted', app()->getLocale())
		: back()->with('error', 'Password reset is not possible, please send password reset email again');
	}

	public function render()
	{
		return view('livewire.components.reset-password')->layout('layout');
	}
}
