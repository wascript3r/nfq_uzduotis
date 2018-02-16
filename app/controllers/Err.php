<?php
class Err extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->_load->view('error/index', ['title' => 'Klaida!']);
	}
}
?>