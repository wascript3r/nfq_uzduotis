<?php
/**
 * Klasė, skirta darbui su užsakymais
 */
class Order_model extends Model {
	/**
	 * @var string $firstname - užsakovo vardas
	 * @var string $lastname - užsakovo pavarde
	 * @var int $type - bandelės rūšis
	 * @var int $amount - bandelių kiekis
	 * @var double $price - užsakymo kaina
	 * @var string $address - pristatymo adresas
	 * @var date $date - pristatymo data
	 */

	/**
	 * Konstruktorius
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Sukuria užsakymą
	 */
	public function create() {
		if (Validator::isEmpty($this->firstname)) {
			throw new ErrException('Nenurodytas vardas!');
		} elseif (Validator::isEmpty($this->lastname)) {
			throw new ErrException('Nenurodyta pavardė!');
		} elseif (Validator::isEmpty($this->type)) {
			throw new ErrException('Nenurodyta bandelės rūšis!');
		} elseif (Validator::isEmpty($this->amount)) {
			throw new ErrException('Nenurodytas bandelių kiekis!');
		} elseif (Validator::isEmpty($this->address)) {
			throw new ErrException('Nenurodytas pristatymo adresas!');
		} elseif (Validator::isEmpty($this->date)) {
			throw new ErrException('Nenurodyta pristatymo data!');
		} elseif (strlen($this->firstname) > 20) {
			throw new ErrException('Vardas negali būti ilgesnis nei 20 simbolių!');
		} elseif (strlen($this->lastname) > 20) {
			throw new ErrException('Pavardė negali būti ilgesnė nei 20 simbolių!');
		} elseif (strlen($this->address) > 100) {
			throw new ErrException('Adresas negali būti ilgesnis nei 100 simbolių!');
		}

		$this->type = (int) $this->type;
		$this->amount = (int) $this->amount;
		$bandele = $this->findBandele($this->type);
		if (!$bandele)
			throw new ErrException('Tokia bandelės rūšis neegzistuoja!');

		if ($this->amount <= 0 || $this->amount > 5) {
			throw new ErrException('Neteisingas kiekis!');
		} elseif (!Validator::isDate($this->date)) {
			throw new ErrException('Neteisingas datos formatas!');
		} elseif ($this->date < date('Y-m-d')) {
			throw new ErrException('Pristatymo data turi būti ne senesnė kaip šiandienos!');
		}
		$price = $bandele->price * $this->amount;

		$sql = $this->_conn->prepare('INSERT INTO orders (firstname, lastname, type, amount, price, address, date) VALUES (:firstname, :lastname, :type, :amount, :price, :address, :date)');
		$sql->execute([
			':firstname' => $this->firstname,
			':lastname' => $this->lastname,
			':type' => (int) $this->type,
			':amount' => (int) $this->amount,
			':price' => (double) $price,
			':address' => $this->address,
			':date' => $this->date
		]);
	}

	/**
	 * Visų užsakymų kiekio radimas
	 */
	public function getTotal() {
		return $this->_conn->query('SELECT id FROM orders')->rowCount();
	}

	/**
	 * Visų užsakymų kiekio radimas
	 */
	public function getBandelesCount() {
		return $this->_conn->query('SELECT id FROM bandeles')->rowCount();
	}

	/**
	 * Užsakymų fetchinimas
	 * @param string $sort - rikiavimo raktas
	 * @param string $limit - užsakymų limito nustatymas puslapiavimui
	 * @param string $search - paieškos raktas
	 * @param bool $rowCount - grąžinti tik užsakymų kiekį
	 */
	public function getAll($limit = '', $sort = 'id DESC', $search = '', $rowCount = false) {
		$queryStr = 'SELECT o.*, b.type AS type2 FROM orders o LEFT JOIN bandeles b ON o.type = b.id ';
		if ($search != '')
			$queryStr .= 'WHERE o.id LIKE :search OR ' .
			'firstname LIKE :search OR ' .
			'lastname LIKE :search OR ' .
			'b.type LIKE :search OR ' .
			'amount LIKE :search OR ' .
			'o.price LIKE :search OR ' .
			'address LIKE :search OR ' .
			'date LIKE :search ';
		$queryStr .= 'ORDER BY ' . $sort . ' ' . $limit;
		if ($search == '') {
			$result = $this->_conn->query($queryStr);
		} else {
			$result = $this->_conn->prepare($queryStr);
			$result->execute([
				':search' => '%' . $search . '%'
			]);
		}
		return $rowCount ? $result->rowCount() : $result->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Visų bandelių rūšių ir kainos gavimas
	 */
	public function getBandeles() {
		$result = $this->_conn->query('SELECT * FROM bandeles ORDER BY id ASC');
		return $result->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Bandelės radimas pagal id
	 * @param int $id - bandelės id
	 */
	public function findBandele($id) {
		$result = $this->_conn->prepare('SELECT * FROM bandeles WHERE id = :id');
		$result->execute([
			':id' => $id
		]);
		return $result->fetch(PDO::FETCH_OBJ);
	}
}
?>