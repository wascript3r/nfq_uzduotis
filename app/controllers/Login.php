<?php
class Login extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$form = new Form();

		if (!$form->post('login')) {
			if (isLogged)
				return Redirect::to('order/list');

			$this->_load->view('login/index', [
				'title' => 'Prisijungimas'
			]);
			return;
		}

		if (isLogged)
			return Tools::jsonError('Jūs jau esate prisijungęs!');

		$this->_load->model('User');
		try {
			$this->User_model->setData([
				'username' => $form->post('username'),
				'password' => $form->post('password', false)
			]);
			$this->User_model->login();
			Tools::jsonSuccess();
		} catch (ErrException $e) {
			Tools::jsonError($e->getMessage());
		}
	}
}
?>