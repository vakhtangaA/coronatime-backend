<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Country;

class StatisticsController extends Controller
{
	public function allCountries()
	{
		$countries = Country::all();

		return response()->json($countries);
	}

	public function statisticsSum()
	{
		$country = new Country();

		$statistics = [
			'confirmed' => $country->sum('confirmed'),
			'deaths'    => $country->sum('deaths'),
			'recovered' => $country->sum('recovered'),
		];

		return response()->json($statistics);
	}
}
