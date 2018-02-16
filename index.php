<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$time_started = microtime(true);
require_once 'app/init.php';

$app = new App();
// $time_ended = microtime(true);
// echo '<br><br>' . ($time_ended - $time_started);
?>