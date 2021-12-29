<?php

namespace App\Http\Controllers;

use App\Models\Country;

class CountryController extends Controller
{
	public function index()
	{
		$country = new Country();

		$statistics = [
			'confirmed' => $country->sum('confirmed'),
			'deaths'    => $country->sum('deaths'),
			'recovered' => $country->sum('recovered'),
		];
		return view('dashboard', [
			'statistics' => $statistics,
		]);
	}
}
