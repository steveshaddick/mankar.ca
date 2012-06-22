<?php
session_start();

require_once(dirname(__FILE__).'/../env/config.php');


switch ($_GET['key']) {
	
	case 'lang':
		$_SESSION['lang'] = $_GET['value'];
		setcookie('lang', $_GET['value'], EXPIRE_COOKIE, '/');
		break;

	case 'units':
		$_SESSION['units'] = $_GET['value'];
		setcookie('units', $_GET['value'], EXPIRE_COOKIE, '/');
		break;
}


if (!isset($_SESSION['page'])) {
	//I think if this occurs the user has disallowed cookies OR they're hitting this link directly, which they shouldn't

	$_SESSION['page'] = '';
}

header('Location: /' . $_SESSION['page']);

exit();

?>