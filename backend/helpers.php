<?php 

function allSetted($var, $array)
{
	if (is_array($array) || is_object($array)) {
		foreach ($array as $x) {
			if (!isset($var[$x])) {
				return false;
			}

			continue;
		}

		return true;
	}

	throw new Exception('Expected array');
}

function dd($var)
{
	die(var_dump($var));
}
