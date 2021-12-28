<?php

return [
	'unique'           => ':attribute უკვე არსებობს',
	'required'         => 'ველის შევსება სავალდებულოა',
	'email'            => ':attribute უნდა იყოს ვალიდური',
	'confirmed'        => ':attribute არ ემთხვევა',
	'min'              => [
		'numeric' => 'ველი უნდა შედგებოდეს მინიმუმ :min  სიმბოლოსგან',
		'string'  => 'ველი უნდა შედგებოდეს მინიმუმ :min სიმბოლოსგან',
	],
	'max'         => [
		'numeric' => 'ველი უნდა შედგებოდეს მაქსიმუმ :min  სიმბოლოსგან',
		'string'  => 'ველი უნდა შედგებოდეს მაქსიმუმ :min სიმბოლოსგან',
	],

	'attributes' => [
		'name'     => 'მომხმარებელი',
		'email'    => 'მეილი',
		'password' => 'პაროლი',
	],
];
