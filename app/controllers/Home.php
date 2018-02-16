<?php
class Home extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->_load->model('Order');
		$this->_load->view('home/index', [
			'title' => 'Pagrindinis',
			'bandeles' => $this->Order_model->getBandeles()
		]);
	}
}
?>