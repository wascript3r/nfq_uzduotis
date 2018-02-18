<?php
/**
 * Pagrindinė cms klasė
 */
class App {
	/**
	 * @var string $_controller - default controlleris
	 * @var string $_errController - default controlleris errorams
	 * @var string $_method - default controllerio funkcija
	 * @var string $_params - kintamieji, kurie bus perduoti į controllerio funkciją
	 */
	private $_controller = DEFAULT_PAGE;
	private $_errController = 'Err';
	private $_method = 'index';
	private $_params = [];
	private $_url = null;

	/**
	 * Konstruktorius
	 */
	public function __construct() {
		$this->_getUrl();

		$this->_loadController();
		$this->_callMethod();
	}

	/**
	 * Gauna svetainės url: http://svetaine.lt/{controller}/{method}/{params}
	 */
	private function _getUrl() {
		if (isset($_GET['url'])) {
			// $url = filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL);
			$url = trim($_GET['url'], '/');
			$this->_url = explode('/', $url);
		}
	}

	/**
	 * Užloadina controllerį
	 */
	private function _loadController() {
		if (isset($this->_url[0])) {
			$this->_url[0] = ucfirst($this->_url[0]);
			if (file_exists(CONTROLLER_PATH . $this->_url[0] . '.php')) {
				$this->_controller = $this->_url[0];
			} else {
				$this->_controller = $this->_errController;
			}
			unset($this->_url[0]);
		} else {
			Redirect::home();
		}
		require_once CONTROLLER_PATH . $this->_controller . '.php';
		$this->_controller = new $this->_controller();
	}

	/**
	 * Iškviečia iš url gautą controllerio funckiją
	 */
	private function _callMethod() {
		if (isset($this->_url[1]) && method_exists($this->_controller, $this->_url[1])) {
			$this->_method = $this->_url[1];
			unset($this->_url[1]);
		}
		$this->_params = $this->_url ? array_values($this->_url) : [];
		call_user_func_array([$this->_controller, $this->_method], $this->_params);
	}
}
?>