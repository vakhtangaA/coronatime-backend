<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryApiTest extends TestCase
{
	use RefreshDatabase;

	public function test_country_is_created_when_it_is_not_in_database()
	{
		$this->fakeHttp();

		$country = Country::where('countryCode', '=', 'UA')->first();

		$this->assertDatabaseMissing('countries', [
			'countryCode' => 'GE',
		]);
		$this->assertDatabaseCount('countries', 0);

		$this->artisan('update:covid-statistics')
			->assertSuccessful()
			->assertExitCode(0);

		$country = Country::where('countryCode', '=', 'UA')->first();

		$this->assertArrayHasKey('countryCode', $country->getAttributes());
		$this->assertDatabaseCount('countries', 3);
		$this->assertDatabaseHas('countries', [
			'countryCode' => 'UA',
		]);
	}
}
