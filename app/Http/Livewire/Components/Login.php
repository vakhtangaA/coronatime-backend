<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
	public $name;

	public $password;

	public function rules()
	{
		return [
			'name'      => ['required', 'min:3', 'max:255'],
			'password'  => ['required', 'min:3', 'max:255'],
		];
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function submit()
	{
		$validatedData = $this->validate();

		if (Auth::attempt($validatedData))
		{
			// Authentication passed...
			session()->flash('success', 'Your are now logged in');

			return redirect()->route('dashboard');
		}

		return redirect()->route('login')->with('error', 'Invalid Credentials');
	}

	public function render()
	{
		return view('livewire.components.login')->layout('layout');
	}
}
