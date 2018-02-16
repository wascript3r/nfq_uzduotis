<?php
/**
 * Klasė, atsakinga už formos duomenų gavimą
 */
class Form {
	/**
	 * Gauna POST duomenis
	 * @param bool $clean - apsauga nuo XSS
	 */
	public function post($name, $clean = true) {
		if (isset($_POST[$name])) {
			return ($clean) ? htmlspecialchars($_POST[$name]) : $_POST[$name];
		} else {
			return null;
		}
	}

	/**
	 * Gauna GET duomenis
	 * @param bool $clean - apsauga nuo XSS
	 */
	public function get($name, $clean = true) {
		if (isset($_GET[$name])) {
			return ($clean) ? htmlspecialchars($_GET[$name]) : $_GET[$name];
		} else {
			return null;
		}
	}
}
?>