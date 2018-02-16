<?php
/**
 * Klasė, atsakinga už vartotojo redirectinimą
 */
class Redirect {
	/**
	 * Redirectina vartotoją
	 * @param string $path - linkas, į kurį redirectinti, pvz jeigu $path = 'home', redirectins į 'http://svetaine.lt/home'
	 */
	public static function to($path = '') {
		header('Location: ' . URL . $path);
		die();
	}

	public static function home() {
		header('Location: ' . URL . DEFAULT_PAGE);
		die();
	}
}
?>