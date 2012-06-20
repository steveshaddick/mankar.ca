<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

session_start();

require_once(dirname(__FILE__).'/../env/config.php');

$_SESSION['lang'] = $_GET['lang'];
setcookie('lang', $_GET['lang'], EXPIRE_COOKIE, '/');

if (!isset($_SESSION['page'])) {
	$_SESSION['page'] = '';
}

header('Location: /' . $_SESSION['page']);

exit();

?>