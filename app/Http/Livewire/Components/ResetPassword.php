<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
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
			'password'  => ['required', 'min:3', 'max:255', 'confirmed'],
		];
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);

		// register form validates input as user types,
		// everything works as expected, except password confirmation,
		// this validation error just shows after user submits,
		// so here i manually add that error and now user can see password_confirmation error during typing
		if ($propertyName === 'password_confirmation' && $this->password !== $this->password_confirmation)
		{
			if (app()->getLocale() === 'ka')
			{
				$this->addError('password_confirmation', 'პაროლები არ ემთხვევა ერთმანეთს');
			}
			else
			{
				$this->addError('password_confirmation', 'The password confirmation does not match.');
			}
		}
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
		? redirect()->route('passwordReseted', app()->getLocale())
		: back()->with('error', 'Password reset is not possible, please send password reset email again');
	}

	public function render()
	{
		return view('livewire.components.reset-password')->layout('layout');
	}
}
