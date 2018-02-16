<?php
/**
 * Pagrindinė MODEL parent klasė
 */
abstract class Model {
	protected $_conn;

	/**
	 * Konstruktorius
	 */
	public function __construct() {
		$this->_conn = Database::getInstance();
	}

	/**
	 * Nustato klasės kintamuosius
	 */
	public function setData($data = []) {
		foreach ($data as $key => $value) {
			$this->{$key} = $value;
		}
	}
}
?>