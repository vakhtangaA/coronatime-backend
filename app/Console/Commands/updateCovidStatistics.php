<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class updateCovidStatistics extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'update:covid-statistics';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Retrieve covid statistics information every day and update database accordingly';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function fetchCovidInfo(): array
	{
		$response = Http::get('https://devtest.ge/countries');

		$countries = $response->collect();

		$AllCountryInfo = [];

		// retrieve covid statistics for all countries, returned from above api and
		// collect them in $AllCountryInfo array,
		// also append name and country code to that info for updateDatabase method
		foreach ($countries as $country)
		{
			$countryInfo = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			])->collect();

			sleep(2);

			array_push($AllCountryInfo, [
				'name'        => [
					'en' => $country['name']['en'],
					'ka' => $country['name']['ka'],
				],
				...$countryInfo,
			]);
		}

		return $AllCountryInfo;
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle(): void
	{
		$countries = $this->fetchCovidInfo();

		foreach ($countries as $countryCovidInfo)
		{
			Country::updateOrCreate(
				[
					'countryCode' => $countryCovidInfo['code'],
				],
				collect($countryCovidInfo)
					->only('name', 'confirmed', 'recovered', 'critical', 'deaths')
					->toArray()
			);
		}
	}
}
