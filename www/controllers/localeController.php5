<?php
session_start();

require_once(dirname(__FILE__).'/../env/config.php');


switch ($_GET['key']) {
	
	case 'lang':
		$_SESSION['lang'] = $_GET['value'];
		setcookie('lang', $_GET['value'], EXPIRE_COOKIE, '/');

		if (isset($_SESSION['page'])) {
			$url = explode('/', $_SESSION['page']);
			switch ($url[count($url) -1]) {
				case LANGUAGE_ENGLISH:
				case LANGUAGE_FRENCH:
				case LANGUAGE_SPANISH:
					array_pop($url);
					$_SESSION['page'] = implode('/', $url);
					break;
			}
		}


		break;

	case 'units':
		$_SESSION['units'] = $_GET['value'];
		setcookie('units', $_GET['value'], EXPIRE_COOKIE, '/');

		if ($_SESSION['units'] != UNIT_US) {
			setcookie ('usa', "", time() - 3600, '/');
		}
		break;
}


if (!isset($_SESSION['page'])) {
	//I think if this occurs the user has disallowed cookies OR they're hitting this link directly, which they shouldn't

	$_SESSION['page'] = '';
}

header('Location: /' . $_SESSION['page']);

exit();

?>