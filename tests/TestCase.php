<?php

namespace Tests;

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	use CreatesApplication;

	protected function fakeHttp()
	{
		Http::fake([
			'https://devtest.ge/countries' => Http::response(
				json_decode(file_get_contents('tests/stubs/response_countries_200.json'), true),
				200
			),
		]);

		Http::fake([
			'https://devtest.ge/get-country-statistics' => Http::response(
				json_decode(file_get_contents('tests/stubs/response_individual_country_info_200.json'), true),
				200
			),
		]);
	}
}
