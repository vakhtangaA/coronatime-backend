<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Notifications\VerificationMail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;

class AuthorizationController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$recipients = [
			'giuna@redberry.ge',
			'tamo@redberry.ge',
			'vakhtang.chitauri@gmail.com',
			'vakhtangchitauri@redberry.ge',
		];

		$validatedData = $request->validated();

		if (in_array($validatedData['email'], $recipients))
		{
			$user = User::create($validatedData);

			auth()->login($user, $validatedData['remember']);

			$user->notify(new VerificationMail($user));

			if (Auth::check())
			{
				return response()->json(Auth::user());
			}
		}
		else
		{
			return response()->json([
				'status'  => 'error',
				'field'   => 'email',
				'message' => 'Provided email is not in recipients list',
			], 400);
		}
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

		return response()->json('Invalid Credentials', 400);
	}

	public function logout()
	{
		Auth::guard('web')->logout();
	}

	public function isLogged()
	{
		if (Auth::check())
		{
			return response()->json([
				'isLoggedIn' => true,
			]);
		}

		return response()->json([
			'isLoggedIn' => false,
		]);
	}

	public function forgotPassword(ForgotPasswordRequest $request)
	{
		$data = $request->validated();
		$status = Password::sendResetLink(['email' => $data['email']]);

		return $status === Password::RESET_LINK_SENT
			? response()->json('sent')
			: response()->json('error');
	}

	public function resetPassword(ResetPasswordRequest $request)
	{
		// $credentials = [
		// 	'email'                 => $this->email,
		// 	'password'              => $this->password,
		// 	'password_confirmation' => $this->password_confirmation,
		// 	'token'                 => $this->token,
		// ];

		$data = $request->validated();

		$status = Password::reset(
			$data,
			function ($user, $password) {
				$user->forceFill([
					'password' => $password,
				])->setRememberToken(Str::random(60));

				$user->save();

				// event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
		? response()->json('password reseted')
		: response()->json('error');
	}
}
