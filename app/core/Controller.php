<?php
/**
 * Pagrindinė CONTROLLER parent klasė
 */
abstract class Controller {
	protected $_registry;
	protected $_load;
	protected $_error = null;

	/**
	 * Konstruktorius
	 */
	public function __construct() {
		$this->_registry = Registry::getInstance();
		$this->_load = new Load();
		Auth::handleLogin();
	}

	abstract public function index();

	final public function __get($name) {
		return $this->_registry->{$name};
	}
}
?>