<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
	public function index(EmailVerificationRequest $request)
	{
		$request->fulfill();

		auth()->logout();

		return redirect()->route('login')->with('success', 'Your account is verified, please sign in');
	}
}
