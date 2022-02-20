<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use App\Notifications\VerificationMail;
use Livewire\Component;

class Register extends Component
{
	public $name;

	public $email;

	public $remember;

	public $password;

	public $password_confirmation;

	public function rules()
	{
		return [
			'name'                   => ['required', 'min:3', 'max:255', 'unique:users,name'],
			'email'                  => ['required', 'email', 'max:255', 'unique:users,email'],
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
		$validatedData = $this->validate();

		$user = User::create($validatedData);

		auth()->login($user, $this->remember);

		$user->notify(new VerificationMail($user));

		session()->flash('success', 'Your account has been created.');

		return redirect()->route('verification.notice', app()->getLocale());
	}

	public function render()
	{
		return view('livewire.components.register')->layout('layout');
	}
}
