<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
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

	protected function fetchCountries(): Collection
	{
		$response = Http::get('https://devtest.ge/countries');

		return $response->collect();
	}

	public function fetchCovidInfo(): array
	{
		$countries = $this->fetchCountries();

		$AllCountryInfo = [];
		$counter = 1;

		// retrieve covid statistics for all countries returned from above api and
		// collect them in $AllCountryInfo array,
		// also append name and country code to that info for updateDatabase method
		foreach ($countries as $country)
		{
			try
			{
				do
				{
					$countryInfo = Http::post('https://devtest.ge/get-country-statistics', [
						'code' => $country['code'],
					])->collect();

					// if api doesn't respond with country info,
					// code tries 5 times to retrieve info, on each iteration, sleep time is increased
					if (!$countryInfo->has('confirmed'))
					{
						sleep($counter * 5);
						$counter++;

						if ($counter === 6)
						{
							$counter = 0;
							break;
						}
					}
					sleep(1);
				}
				while (!$countryInfo->has('confirmed'));
			}
			catch (\Throwable $th)
			{
				info("Can't fetch country info from api");
				// throw $th;
			}

			try
			{
				array_push($AllCountryInfo, [
					'name'        => [
						'en' => $country['name']['en'],
						'ka' => $country['name']['ka'],
					],
					'countryCode' => $countryInfo['code'],
					'confirmed'   => $countryInfo['confirmed'],
					'recovered'   => $countryInfo['recovered'],
					'critical'    => $countryInfo['critical'],
					'deaths'      => $countryInfo['deaths'],
				]);
			}
			catch (\Throwable $th)
			{
				// throw $th;
			}
		}

		return $AllCountryInfo;
	}

	protected function updateDatabase(): void
	{
		$countries = $this->fetchCovidInfo();

		foreach ($countries as $countryCovidInfo)
		{
			Country::updateOrCreate(
				[
					'countryCode' => $countryCovidInfo['countryCode'],
				],
				[
					'name'        => $countryCovidInfo['name'],
					'confirmed'   => $countryCovidInfo['confirmed'],
					'recovered'   => $countryCovidInfo['recovered'],
					'critical'    => $countryCovidInfo['critical'],
					'deaths'      => $countryCovidInfo['deaths'],
				]
			);
		}
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle(): void
	{
		$this->updateDatabase();
	}
}
