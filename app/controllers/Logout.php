<?php
class Logout {
	public function __construct() {
		Auth::logout();
		Redirect::home();
	}
}
?>