<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
	public function destroy()
	{
		auth()->logout();

		return redirect()->route('login', app()->getLocale())->with('success', 'Goodbye');
	}
}
