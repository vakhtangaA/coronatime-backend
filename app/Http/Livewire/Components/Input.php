<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Input extends Component
{
	public $label;

	public $placeholder;

	public $identifier;

	public function render()
	{
		return view('livewire.components.input');
	}
}
