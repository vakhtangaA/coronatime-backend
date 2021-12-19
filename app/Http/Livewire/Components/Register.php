<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Register extends Component
{
	public $name;

	public $email;

	public $password;

	public $password_confirmation;

	public function rules()
	{
		return [
			'name'      => ['required', 'min:2', 'max:255', Rule::unique('users', 'name')],
			'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
			'password'  => ['required', 'min:6', 'max:255'],
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
			$this->addError('password_confirmation', 'The password confirmation does not match.');
		}
	}

	public function submit()
	{
		$validatedData = $this->validate();

		$user = User::create($validatedData);

		auth()->login($user);
		session()->flash('success', 'Your account has been created.');

		return redirect()->route('dashboard');
	}

	public function render()
	{
		return view('livewire.components.register')->layout('layout');
	}
}
