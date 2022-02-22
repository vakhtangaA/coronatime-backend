<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 *
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		$origin = $request->getHttpHost() == str_contains($request->getHttpHost(), 'localhost') ?
	  'http://localhost:3000' : 'https://coronatime.vakho.redberryinternship.ge';

		return $next($request)
			->header('Access-Control-Allow-Origin', $origin)
			->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
			->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type,X-Token-Auth, Authorization')
			->header('Access-Control-Allow-Credentials', 'true');
	}
}
