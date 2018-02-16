<?php
/**
 * Klasė, skirta PDO prisijungimui
 */
class Database extends PDO {
	/**
	 * @var object $_dbInstance - apsauga nuo pakartotinio prisijungimo prie duomenų bazės
	 */
	private static $_dbInstance = null;

	public function __construct() {
		try {
			parent::__construct('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die('Įvyko klaida. Prašome bandyti vėliau.');
		}
	}

	public static function getInstance() {
		if (!self::$_dbInstance) {
			self::$_dbInstance = new Database();
		}
		return self::$_dbInstance;
	}
}
?>