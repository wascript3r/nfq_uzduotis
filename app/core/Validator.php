<?php
/**
 * Klasė, skirta patikrinti, ar kintamieji yra VALID
 */
class Validator {
	/**
	 * Patikrina, ar kintamasis yra tuščias
	 */
	public static function isEmpty($string) {
		if (is_null($string) || empty($string) || $string == "" || ltrim($string) != $string) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Patikrina, ar teisingas el. pašto formatas
	 */
	public static function isEmail($string) {
		if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Patikrina, ar kintamasis yra skaičius
	 */
	public static function isInt($string) {
		return is_int($string);
	}

	/**
	 * Patikrina, ar kintamasis yra data
	 */
	public static function isDate($date, $format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}
?>