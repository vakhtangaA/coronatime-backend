<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Notifications\VerificationMail;

class AuthorizationController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$validatedData = $request->validated();

		$user = User::create($validatedData);

		auth()->login($user, $validatedData['remember']);

		$user->notify(new VerificationMail($user));
	}

	public function login(LoginRequest $request)
	{
		$validatedData = $request->validated();

		if (filter_var($validatedData['name'], FILTER_VALIDATE_EMAIL))
		{
			Auth::attempt([
				'email'    => $validatedData['name'],
				'password' => $validatedData['password'], ]);
		}
		else
		{
			Auth::attempt([
				'name'     => $validatedData['name'],
				'password' => $validatedData['password'], ]);
		}

		if (Auth::check())
		{
			return response()->json(Auth::user());
		}

		return response()->json('Invalid Credentials');
	}
}
