<?php

namespace App\Http\Livewire\Components;

use App\Models\Country;
use Livewire\Component;

class ByCountry extends Component
{
	public $search;

	public $countries;

	public $filter = 'location-asc';

	protected $listeners = ['filterUpdated'];

	public function mount()
	{
		$this->countries = Country::all();
	}

	public function render()
	{
		$CI = $this;

		$this->countries = Country::where('name', 'like', '%' . $this->search . '%')
		->get()
		->when(
			$this->filter === 'location-desc',
			function () use ($CI) {
				return $CI->countries->sortByDesc('name');
			}
		)
		->when(
			$this->filter === 'location-asc',
			function () use ($CI) {
				return $CI->countries->sortBy('name');
			}
		)
		->when(
			$this->filter === 'cases-desc',
			function () use ($CI) {
				return $CI->countries->sortByDesc('confirmed');
			}
		)
		->when(
			$this->filter === 'cases-asc',
			function () use ($CI) {
				return $CI->countries->sortBy('confirmed');
			}
		)
		->when(
			$this->filter === 'deaths-desc',
			function () use ($CI) {
				return $CI->countries->sortByDesc('deaths');
			}
		)
		->when(
			$this->filter === 'deaths-asc',
			function () use ($CI) {
				return $CI->countries->sortBy('deaths');
			}
		)
		->when(
			$this->filter === 'recovered-desc',
			function () use ($CI) {
				return $CI->countries->sortByDesc('recovered');
			}
		)
		->when(
			$this->filter === 'recovered-asc',
			function () use ($CI) {
				return $CI->countries->sortBy('recovered');
			}
		)
		->when(
			$this->filter === 'critical-desc',
			function () use ($CI) {
				return $CI->countries->sortByDesc('critical');
			}
		)
		->when(
			$this->filter === 'critical-asc',
			function () use ($CI) {
				return $CI->countries->sortBy('critical');
			}
		);

		return view('livewire.components.by-country', [
			'countries' => $this->countries,
		])->layout('layout');
	}
}
