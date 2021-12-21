<?php

namespace App\Http\Livewire\Components;

use App\Models\Country;
use Livewire\Component;

class ByCountry extends Component
{
	public $search;

	public function render()
	{
		$countries = Country::all();

		$countries = Country::where('name', 'like', '%' . $this->search . '%')
		->get()
		->when(
			request()->get('sort') === 'location-desc',
			function () use ($countries) {
				return $countries->sortByDesc('name');
			}
		)
		->when(
			request()->get('sort') === 'location-asc',
			function () use ($countries) {
				return $countries->sortBy('name');
			}
		)
		->when(
			request()->get('sort') === 'cases-desc',
			function () use ($countries) {
				return $countries->sortByDesc('confirmed');
			}
		)
		->when(
			request()->get('sort') === 'cases-asc',
			function () use ($countries) {
				return $countries->sortBy('confirmed');
			}
		)
		->when(
			request()->get('sort') === 'deaths-desc',
			function () use ($countries) {
				return $countries->sortByDesc('deaths');
			}
		)
		->when(
			request()->get('sort') === 'deaths-asc',
			function () use ($countries) {
				return $countries->sortBy('deaths');
			}
		)
		->when(
			request()->get('sort') === 'recovered-desc',
			function () use ($countries) {
				return $countries->sortByDesc('recovered');
			}
		)
		->when(
			request()->get('sort') === 'recovered-asc',
			function () use ($countries) {
				return $countries->sortBy('recovered');
			}
		)
		->when(
			request()->get('sort') === 'critical-desc',
			function () use ($countries) {
				return $countries->sortByDesc('critical');
			}
		)
		->when(
			request()->get('sort') === 'critical-asc',
			function () use ($countries) {
				return $countries->sortBy('critical');
			}
		);

		return view('livewire.components.by-country', [
			'countries' => $countries,
		])->layout('layout');
	}
}
