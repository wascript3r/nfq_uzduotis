<?php
date_default_timezone_set('Europe/Vilnius');

// Autoloader
spl_autoload_register(function($class) {
	require_once('core/' . $class . '.php');
});

require_once 'config.php';
?>