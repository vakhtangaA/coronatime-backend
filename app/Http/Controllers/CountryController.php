<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$response = Http::post('https://devtest.ge/get-country-statistics', [
			'code' => 'GE',
		]);
		// return Http::dd()->get(
		// 	'https://devtest.ge/countries'
		// );

		return view('layout');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\StoreCountryRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCountryRequest $request)
	{
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Country $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Country $country)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Country $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Country $country)
	{
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\UpdateCountryRequest $request
	 * @param \App\Models\Country                     $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCountryRequest $request, Country $country)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Country $country
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Country $country)
	{
	}
}