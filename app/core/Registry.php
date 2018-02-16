<?php
/**
 * Klasė, skirta perduoti globalius kintamuosius ir objektus
 */
class Registry {
	private static $_instance = null;
	private $_data;

	private function __construct() {}

	public static function getInstance() {
		if (!self::$_instance) {
			self::$_instance = new Registry();
		}
		return self::$_instance;
	}

	public function __get($name) {
		if (isset($this->_data[$name])) {
			return $this->_data[$name];
		}
		return null;
	}

	public function __set($name, $value) {
		$this->_data[$name] = $value;
	}
}
?>