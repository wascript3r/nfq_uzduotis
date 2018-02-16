<?php
/**
 * Klasė, atsakinga už vartotojo autentifikavimą
 */
class Auth {
	/**
	 * Patikrina, ar vartotojas yra prisijungęs
	 */
	public static function handleLogin() {
		$isLogged = false;
		$conn = Database::getInstance();

		Session::start();
		$userid = Session::get('userid');
		$token = Session::get('token');

		if ($userid && $token) {
			$result = $conn->prepare('SELECT * FROM tokens WHERE userid = :userid AND token = :token AND ip = :ip');
			$result->execute([
				':userid' => $userid,
				':token' => $token,
				':ip' => $_SERVER['REMOTE_ADDR']
			]);
			if ($result->rowCount() > 0) {
				$isLogged = true;
			}
		}

		define('isLogged', $isLogged);
	}

	/**
	 * Ištrina visus vartotojo tokensus
	 * @param int $userid - vartotojo id
	 */
	public static function deleteToken($userid) {
		$conn = Database::getInstance();

		$sql = $conn->prepare('DELETE FROM tokens WHERE userid = :userid');
		$sql->execute([
			':userid' => (int) $userid
		]);
	}

	/**
	 * Atjungia vartotoją nuo svetainės
	 */
	public static function logout() {
		Session::start();
		$userid = Session::get('userid');
		if ($userid) {
			self::deleteToken($userid);
			Session::destroy();
		}
	}
}
?>