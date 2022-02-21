<?php

namespace App\Http\Requests;

use App\Rules\UserDoesNotExist;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if (request()->language)
		{
			app()->setLocale(request()->language);
		}

		return [
			'name'          => ['required', 'min:3', 'max:45',  new UserDoesNotExist],
			'password'      => ['required', 'min:3', 'max:45'],
			'remember'      => ['required'],
		];
	}
}
