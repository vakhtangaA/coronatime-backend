<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
	public function index(EmailVerificationRequest $request)
	{
		$request->fulfill();

		return redirect()->route('verified', app()->getLocale());
	}

	public function resend(Request $request)
	{
		$request->user()->sendEmailVerificationNotification();

		return back()->with('success', 'Verification link sent!');
	}

	public function afterVerification()
	{
		Auth::logout();

		return redirect()->route('login', app()->getLocale());
	}
}
