<?php
/**
 * Klasė, skirta prisijungimui bei registracijai
 */
class User_model extends Model {
	/**
	 * @var string $username - vartotojo vardas
	 * @var string $password - vartotojo slaptažodis
	 */

	/**
	 * Konstruktorius
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Tikrina, ar vartotojas įvedė teisingus duomenis
	 */
	public function login() {
		if (Validator::isEmpty($this->username)) {
			throw new ErrException('Nenurodytas vartotojo vardas!');
		} elseif (Validator::isEmpty($this->password)) {
			throw new ErrException('Nenurodytas vartotojo slaptažodis!');
		}

		$result = $this->_conn->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
		$result->execute([
			':username' => $this->username
		]);
		if ($result->rowCount() > 0) {
			$row = $result->fetch(PDO::FETCH_OBJ);
			$password_hash = $row->password;
			if (password_verify($this->password, $password_hash)) {
				Auth::deleteToken($row->id);

				$token = Tools::randomString();
				$sql = $this->_conn->prepare('INSERT INTO tokens (userid, token, ip) VALUES (:userid, :token, :ip)');
				$sql->execute([
					':userid' => $row->id,
					':token' => $token,
					':ip' => $_SERVER['REMOTE_ADDR']
				]);

				Session::start();
				Session::set('userid', $row->id);
				Session::set('token', $token);
			} else {
				throw new ErrException('Neteisingas vartotojo vardas arba slaptažodis!');
			}
		} else {
			throw new ErrException('Neteisingas vartotojo vardas arba slaptažodis!');
		}
	}

	/**
	 * Patikrina, ar vartotojas egzistuoja
	 */
	public function exists($id) {
		$result = $this->_conn->prepare('SELECT * FROM users WHERE id = :id');
		$result->execute([
			':id' => (int) $id
		]);
		if ($result->rowCount() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * Vartotojo su tam tikru id gavimas
	 * @param $id - vartotojo id
	 * @return object - vartotojas
	 */
	public function getById($id) {
		$result = $this->_conn->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
		$result->execute([
			':id' => (int) $id
		]);
		return $result->fetch(PDO::FETCH_OBJ);
	}
}
?>