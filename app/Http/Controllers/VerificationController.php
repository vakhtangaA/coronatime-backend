<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
	public function index(EmailVerificationRequest $request)
	{
		$request->fulfill();

		return redirect()->route('account.verified-notice', app()->getLocale());
	}

	public function resend(Request $request)
	{
		$request->user()->sendEmailVerificationNotification();

		return back()->with('success', 'Verification link sent!');
	}

	public function notifyEmailSent()
	{
		return view('auth.mail-sent-feedback', ['button' => true, 'text' => 'We have sent you a confirmation email']);
	}

	public function notifyPasswordResetMailSent()
	{
		return view('auth.mail-sent-feedback', ['button' => false, 'text' => 'We have sent you a password reset link']);
	}

	public function accountIsConfirmed()
	{
		return view('auth.verified', ['text' => 'Your account is confirmed, you can sign in']);
	}

	public function passwordIsReseted()
	{
		return view('auth.verified', ['text' => 'Your password is changed, you can sign in']);
	}
}
