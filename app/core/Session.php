<?php
/**
 * Klasė, skirta darbui su sesijomis
 */
class Session {
	/**
	 * @var bool $_isStarted - apsauga nuo pakartotinio sesijos pradėjimo
	 */
	private static $_isStarted = false;

	public static function start() {
		if (!self::$_isStarted) {
			session_start();
			self::$_isStarted = true;
		}
	}

	public static function set($name, $value) {
		$_SESSION[$name] = $value;
	}

	/**
	 * Prideda naują masyvo elementą
	 */
	public function add($name, $value) {
		$_SESSION[$name][] = $value;
	}

	public static function get($name) {
		if (isset($_SESSION[$name])) {
			return $_SESSION[$name];
		}
		return null;
	}

	/**
	 * Ištrina sesiją
	 */
	public static function destroy() {
		if (self::$_isStarted) {
			session_unset();
			session_destroy();
		}
	}
}
?>