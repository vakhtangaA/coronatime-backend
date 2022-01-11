<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 *
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle($request, Closure $next, $redirectToRoute = null)
	{
		if ($request->user() && !$request->user()->hasVerifiedEmail())
		{
			return  Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice', 'en'));
		}

		return $next($request);
	}
}
