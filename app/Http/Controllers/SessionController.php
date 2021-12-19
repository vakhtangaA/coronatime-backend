<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
	public function destroy()
	{
		auth()->logout();

		return redirect()->route('dashboard')->with('success', 'Goodbye');
	}
}
