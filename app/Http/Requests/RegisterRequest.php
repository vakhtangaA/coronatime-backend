<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
			// 'name'      => ['required', 'min:3', 'max:255', Rule::unique('users', 'name'), Rule::unique('users', 'name')],
			// 'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
			// 'password'  => ['required', 'min:3', 'max:255', 'confirmed'],
			'name'          => ['required'],
			'email'         => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
			'password'      => ['required', 'min:3', 'max:255'],
			'remember'      => ['required'],
		];
	}
}
