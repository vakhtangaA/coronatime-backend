<?php

namespace Tests\Feature;

use App\Console\Commands\updateCovidStatistics;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CountryApiTest extends TestCase
{
	use RefreshDatabase;

	public function test_countries_are_fetched_from_api()
	{
		$this->fakeHttp();

		$this->artisan('command:updateCovidStatistics')->assertExitCode(0);

		$countries = updateCovidStatistics::fetchCovidInfo();

		$this->assertIsIterable($countries);
		$this->assertCount(101, $countries);
	}

	public function test_country_is_created_when_it_is_not_in_database()
	{
		$this->fakeHttp();

		$country = Country::where('countryCode', '=', 'GE')->first();

		$this->assertDatabaseMissing('countries', [
			'countryCode' => 'GE',
		]);
		$this->assertDatabaseCount('countries', 0);

		$this->artisan('command:updateCovidStatistics')
			->assertSuccessful()
			->assertExitCode(0);

		$country = Country::where('countryCode', '=', 'GE')->first();

		$this->assertArrayHasKey('countryCode', $country->getAttributes());
		$this->assertDatabaseCount('countries', 1);
		$this->assertDatabaseHas('countries', [
			'countryCode' => 'GE',
		]);
	}

	// public function test_fetching_api_repeats_reuest_five_times_if_there_is_not_response()
	// {
	// 	Http::fake([
	// 		'https://devtest.ge/countries' => Http::response(
	// 			json_decode(file_get_contents('tests/stubs/response_countries_200.json'), true),
	// 			200
	// 		),
	// 	]);

	// 	Http::fake([
	// 		'https://devtest.ge/get-country-statistics' => Http::response(
	// 			json_decode(
	// 				'{}',
	// 				true
	// 			),
	// 			200
	// 		),
	// 	]);

	// 	$this->artisan('command:updateCovidStatistics')->assertExitCode(0);
	// }
}
