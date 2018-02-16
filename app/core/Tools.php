<?php
/**
 * Klasė, skirta įvairioms funkcijoms
 */
class Tools {
	/**
	 * Sugeneruoja random string
	 * @param int $length - string ilgis
	 */
	public static function randomString($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	/**
	 * Sutvarkytos datos gavimas
	 */
	public static function formatDate($date, $full = false) {
		$now = time();
		$time = strtotime($date);
		$date = date('Y-m-d', $time);

		if ($date == date('Y-m-d', $now)) {
			return 'Šiandien, ' . date('H:i', $time);
		} elseif ($date == date('Y-m-d', $now - 86400)) {
			return 'Vakar, ' . date('H:i', $time);
		} else {
			return ($full) ? date('Y-m-d H:i', $time) : $date;
		}
	}

	/**
	 * Atvaizduoja error pranešima JSON formatu
	 */
	 public static function jsonError($message) {
		 echo json_encode([
			 'success' => false,
			 'message' => $message
		 ]);
	 }

	 /**
 	 * Atvaizduoja error pranešima JSON formatu
 	 */
 	 public static function jsonSuccess($message = null) {
		 $output = ['success' => true];
		 if ($message) $output['message'] = $message;
 		 echo json_encode($output);
 	 }
}
?>