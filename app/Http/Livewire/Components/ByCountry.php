<?php

namespace App\Http\Livewire\Components;

use App\Models\Country;
use Livewire\Component;

class ByCountry extends Component
{
	public $search;

	public $countries;

	public $filter = 'name-asc';

	protected $queryString = ['filter', 'search'];

	public function mount()
	{
		$this->countries = Country::all();
	}

	public function render()
	{
		[$filterTerm, $orderDirection] = explode('-', $this->filter);

		$this->countries = Country::where('name', 'like', '%' . $this->search . '%')->orderBy($filterTerm, $orderDirection)->get();

		return view('livewire.components.by-country', [
			'countries' => $this->countries,
		])->layout('layout');
	}
}
