<?php

namespace Tests\Feature;

use App\Console\Commands\updateCovidStatistics;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryApiTest extends TestCase
{
	use RefreshDatabase;

	public function test_countries_are_fetched_from_api()
	{
		$this->fakeHttp();

		$this->artisan('command:updateCovidStatistics')->assertExitCode(0);

		$api = new updateCovidStatistics;

		$countries = $api->fetchCovidInfo();

		$this->assertIsIterable($countries);
		$this->assertCount(4, $countries);
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

	public function test_fetching_api_repeats_request_five_times_if_there_is_not_response()
	{
		$this->fakeHttpWithNoData();

		$this->artisan('command:updateCovidStatistics')->assertExitCode(1)->assertSuccessful();
	}
}
