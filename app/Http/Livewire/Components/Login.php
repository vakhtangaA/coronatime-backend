<?php

namespace App\Http\Livewire\Components;

use App\Rules\UserDoesNotExist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
	public $name;

	public $password;

	public $remember;

	public function rules()
	{
		return [
			'name'      => ['required', 'min:3', 'max:255',  new UserDoesNotExist],
			'password'  => ['required', 'min:3', 'max:255'],
		];
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function submit()
	{
		$this->validate();

		if (filter_var($this->name, FILTER_VALIDATE_EMAIL))
		{
			Auth::attempt(['email' => $this->name, 'password' => $this->password]);
		}
		else
		{
			Auth::attempt(['name' => $this->name, 'password' => $this->password]);
		}

		if (Auth::check())
		{
			session()->flash('success', 'Your are now logged in');

			return redirect()->route('dashboard', app()->getLocale());
		}

		return redirect()->route('login', app()->getLocale())->with('error', 'Invalid Credentials');
	}

	public function render()
	{
		return view('livewire.components.login')->layout('layout');
	}
}
