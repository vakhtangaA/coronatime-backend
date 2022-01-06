<?php

if (!function_exists('writeAsThousands'))
{
	function writeAsThousands($number, $delimiter = ',')
	{
		return number_format($number, 0, '', $delimiter);
	}
}
