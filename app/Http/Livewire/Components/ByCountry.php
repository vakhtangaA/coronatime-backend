<?php

namespace App\Http\Livewire\Components;

use App\Models\Country;
use Livewire\Component;

class ByCountry extends Component
{
	public $countries;

	public function render()
	{
		$this->countries = Country::all();

		return view('livewire.components.by-country', [
			'countries' => $this->countries,
		]);
	}
}
