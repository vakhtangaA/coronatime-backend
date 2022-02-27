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

	public function handle(): void
	{
		$countries = Http::get('https://devtest.ge/countries')->collect();

		foreach ($countries as $country)
		{
			$countryStatistics = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			])->collect();

			// sleep(2);

			$info = collect($countryStatistics)
				->only('confirmed', 'recovered', 'critical', 'deaths')->toArray();

			Country::updateOrCreate(
				[
					'countryCode' => $country['code'],
				],
				[
					'name'        => $country['name'],
					...$info,
				]
			);
		}
	}
}
