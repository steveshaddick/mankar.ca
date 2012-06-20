<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

session_start();

require_once(dirname(__FILE__).'/../env/config.php');
require_once(dirname(__FILE__).'/../lib/MankarFunctions.php');
require_once(dirname(__FILE__).'/../lib/MySQLUtility.php');

require_once(dirname(__FILE__).'/../models/MankarMain.php');

$mankarMain = new MankarMain();

$_SESSION['page'] = ($_GET['page'] != 'index') ? $_GET['page'] : '';

$view = $mankarMain->getPage($_GET['page']);

if ($view !== false) {

	if (strpos($view,'?') !== false) {
		parse_str($view, $query);
		foreach ($query as $key => $value) {
			$_GET[$key] = $value;
		}
		//$view = substr($view, 0, strpos($view,'?'));
	}

	include(BASE_PATH.'/views/'.$view);

} else {
	header('Location: http://'.SITE_URL.'/');
}

/*	$row = mysql_fetch_assoc($result);
	if ($row) {
		$url = $row['actual_url'];
		
		if (strpos($url,'?') > 0) {
		
			$query = substr($url, strpos($url,'?') + 1);
			$arr = explode("&", $query);
			foreach ($arr as $pair)
			{
				$key = substr($pair, 0, strpos($pair, '='));
				$value = substr($pair, strpos($pair, '=') +1);

				$_GET[$key] = $value;
			}
			$actual_url = substr($url,0,strpos($url,'?'));
			
		} else {
			$actual_url = $url;
		}
		$pageUrl = $url;
		$baseUrl = $actual_url;

		include(BASE_PATH.'/views/'.$actual_url);
	} else {
		header('Location: http://'.SITE_URL.'/');
	}
} else {
	header('Location: http://'.SITE_URL.'/');
}*/

?>