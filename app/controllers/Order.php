<?php
class Order extends Controller {
	public function __construct() {
		parent::__construct();
		$this->_load->model('Order');
	}

	public function create() {
		$form = new Form();

		try {
			$this->Order_model->setData([
				'firstname' => $form->post('firstname'),
				'lastname' => $form->post('lastname'),
				'type' => $form->post('type'),
				'amount' => $form->post('amount'),
				'address' => $form->post('address'),
				'date' => $form->post('date')
			]);
			$this->Order_model->create();
			Tools::jsonSuccess('Bandelės buvo sėkmingai užsakytos!');
		} catch (ErrException $e) {
			Tools::jsonError($e->getMessage());
		}
	}

	/**
	 * @param string $orderBy - rikiavimo raktas
	 * @param string $asc - rikiuoti didėjančia arba mažėjančia tvarka
	 * @param string $search - paieškos raktažodis
	 */
	public function list($orderBy = '', $asc = '', $search = '') {
		if (!isLogged)
			return Redirect::to('login');
		if (!in_array($orderBy, ['id', 'firstname', 'lastname', 'type', 'amount', 'price', 'address', 'date']))
			$orderBy = 'id';
		if ($asc != 'asc' && $asc != 'desc')
			$asc = 'desc';
		$sort = $orderBy . ' ' . strtoupper($asc);
		$search = str_replace('-', ' ', $search);
		$rowCount = $this->Order_model->getAll('', $sort, $search, true);
		$paginator = new Paginator(ORDERS_PER_PAGE, MAX_PAGES, $rowCount);
		$this->_load->view('order/list', [
			'title' => 'Užsakymų sąrašas',
			'orders' => $rowCount > 0 ? $this->Order_model->getAll($paginator->getLimit(), $sort, $search) : [],
			'links' => $paginator->getLinks()
		]);
	}

	public function index() {
		Redirect::to('order/list');
	}
}
?>