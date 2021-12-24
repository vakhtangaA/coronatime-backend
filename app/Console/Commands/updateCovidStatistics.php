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
	protected $signature = 'command:updateCovidStatistics';

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

	public static function fetchCovidInfo(): array
	{
		$response = Http::get('https://devtest.ge/countries');

		$countries = $response->collect();

		$AllCountryInfo = [];
		$counter = 1;

		// retrieve covid statistics for all countries returned from above api and
		// collect them in $AllCountryInfo array,
		// also append name and country code to that info for updateDatabase method
		foreach ($countries as $key => $country)
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
					sleep($counter * 2);
					$counter++;

					if ($counter === 2)
					{
						$counter = 0;
						break;
					}
				}
				// sleep(1);
			}
			while (!$countryInfo->has('confirmed'));

			$countryInfo = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			])->collect();

			$countryNames = [
				'en' => $country['name']['en'],
				'ka' => $country['name']['ka'],
			];

			try
			{
				array_push($AllCountryInfo, [
					'name'        => $countryNames,
					'countryCode' => $countryInfo['code'],
					'confirmed'   => $countryInfo['confirmed'],
					'recovered'   => $countryInfo['recovered'],
					'critical'    => $countryInfo['critical'],
					'deaths'      => $countryInfo['deaths'],
				]);
			}
			catch (\Throwable $th)
			{
				//throw $th;
			}
		}

		return $AllCountryInfo;
	}

	protected function updateDatabase(): void
	{
		$countries = $this->fetchCovidInfo();

		foreach ($countries as $countryCovidInfo)
		{
			$country = Country::where('countryCode', '=', $countryCovidInfo['countryCode'])->first();

			if ($country)
			{
				$country->confirmed = $countryCovidInfo['confirmed'];
				$country->recovered = $countryCovidInfo['recovered'];
				$country->critical = $countryCovidInfo['critical'];
				$country->deaths = $countryCovidInfo['deaths'];
				$country->save();
			}
			else
			{
				Country::create([
					'name' => [
						'en' => $countryCovidInfo['name']['en'],
						'ka' => $countryCovidInfo['name']['ka'],
					],
					'countryCode' => $countryCovidInfo['countryCode'],
					'confirmed'   => $countryCovidInfo['confirmed'],
					'recovered'   => $countryCovidInfo['recovered'],
					'critical'    => $countryCovidInfo['critical'],
					'deaths'      => $countryCovidInfo['deaths'],
				]);
			}
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
