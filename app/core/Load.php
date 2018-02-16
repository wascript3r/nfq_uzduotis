<?php
class Load {
	private $_registry;

	/**
	 * Konstruktorius
	 */
	public function __construct() {
		$this->_registry = Registry::getInstance();
	}

	/**
	 * Užkrauna tam tikrą modelį
	 * @param string $name - modelio pavadinimas be '_model'
	 */
	public function model($name) {
		$name .= '_model';

		if (!$this->_registry->{$name}) {
			$path = MODEL_PATH . $name . '.php';
			if (file_exists($path)) {
				require_once $path;
				$this->_registry->{$name} = new $name();
			}
		}
	}

	/**
	 * Užkrauna tam tikrą view failą
	 */
	public function view($name, $data = [], $include = true) {
		$path = VIEW_PATH . $name . '.php';
		if (file_exists($path)) {
			extract($data);

			if ($include) {
				include VIEW_PATH . 'header.php';
				include $path;
				include VIEW_PATH . 'footer.php';
			} else {
				include $path;
			}
		}
	}

	public function __get($name) {
		return $this->_registry->{$name};
	}
}
?>