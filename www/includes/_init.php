<?php

error_reporting(E_ALL); 
ini_set("display_errors", 1); 

session_start();
$expireCookie=time()+(60*60*24*365*5);

//print_r($_SESSION);

if (isset($_GET['lang'])) {//check to see if they came from a page where they set the language - like if we are switching languages on the same page
	$lang = $_SESSION['lang'] = $_GET['lang'];
	setcookie('lang', $lang, $expireCookie);
} elseif (isset($_COOKIE['lang'])) { //see if they already chose a language back in the day 
	$lang = $_SESSION['lang'] = $_COOKIE['lang'];
} elseif (isset($_SESSION['lang'])){ //see if they already chose a language
	//echo 'SESSIONS:'.$_SESSION['lang'];
	$lang = $_SESSION['lang'];
	if ($_COOKIE['lang'] != $lang) {
		setcookie('lang', $lang, $expireCookie);
	}
} elseif (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {//check second to see if they've been nice and set the language
	$langs = explode(",",$_SERVER["HTTP_ACCEPT_LANGUAGE"]);//grab all the languages

	foreach ($langs as $value) {//start going through each one
		//select only the first two letters
		$choice=substr($value,0,2);

		//redirect to the different language page
		//based on their first chosen language
		switch ($choice) {
			case "fr":
			$lang = LANGUAGE_FRENCH; 
			break;
			case "en":
			$lang = LANGUAGE_ENGLISH;
			break;
			case "sp":
			$lang = LANGUAGE_SPANISH; 
			break;
			
			default:
			$lang = LANGUAGE_ENGLISH;
			break;
		}
		$_SESSION['lang'] = $lang;
		setcookie('lang', $lang, $expireCookie);
	}
} else {
	$lang = $_SESSION['lang'] = LANGUAGE_ENGLISH;
	if ($_COOKIE['lang'] != $lang) {
		setcookie('lang', $lang, $expireCookie);
	} 
}
//if all else fails, or screws up
switch ($lang)
{
	case LANGUAGE_ENGLISH:
	case LANGUAGE_FRENCH:
	case LANGUAGE_SPANISH:
	break;
	
	default:
	$lang = LANGUAGE_ENGLISH;
	break;
}

//same thing for units
if (isset($_GET['units'])) {

	$units = $_SESSION['units'] = $_GET['units'];
	setcookie('units', $units, $expireCookie);

} elseif (isset($_COOKIE['units'])){ 

	$units = $_SESSION['units'] = $_COOKIE['units'];

} elseif (isset($_SESSION['units'])){ 

	$units = $_SESSION['units'];
	if ($_COOKIE['units'] != $units) {
		setcookie('units', $units, $expireCookie);
	} 
} else {
	$units = $_SESSION['units'] = UNIT_METRIC;
	if ($_COOKIE['units'] != $units) {
		setcookie('units', $units, $expireCookie);
	} 
}

switch ($units)
{
	case UNIT_METRIC:
	case UNIT_US:
	break;
	
	default:
	$units = UNIT_METRIC;
	break;
}


define('ABSPATH_INCLUDES', dirname(__FILE__).'/');

if (!isset($flagLanguage)) $flagLanguage = false;

if ($_SERVER['PHP_SELF']!="/support.php") {
	$_SESSION['partPID'] = -1;
	$_SESSION['q'] = "";
}

$pageUrl = substr($_SERVER['PHP_SELF'],1);
$baseUrl = substr($_SERVER['PHP_SELF'],1);
$metaTitle = '';
$metaDescription = '';
$metaKeywords = '';

$metaData = array();
$result = mysql_query("SELECT * FROM meta_tags");
while ($row = mysql_fetch_assoc($result))
{
	$metaData[$row['actual_url']] = $row;
	
}

function getPrettyUrl($actualUrl)
{
	global $metaData;
	//logToFile('catchlog.txt',$metaData[$actualUrl]['pretty_url']);
	if (isset($metaData[$actualUrl]))
	{
		
		if ($metaData[$actualUrl]['pretty_url'] != '') {
			return 'http://www.mankar.ca/'.$metaData[$actualUrl]['pretty_url'];
		}
	}
	return $actualUrl;
}

function getMetaData($type, $url)
{
	global $metaData;
	global $lang;
	$post = ($lang == LANGUAGE_ENGLISH) ? '' : '_'.$lang;
	//logToFile('catchlog.txt',$url);
	if (isset($metaData[$url])) {
		if ($metaData[$url]['meta_'.$type.$post] != '') {
			return $metaData[$url]['meta_'.$type.$post];
		} else if ($metaData['index.php']['meta_'.$type.$post] != '') {
			return $metaData['index.php']['meta_'.$type.$post];
		}
	}
	
	if ($metaData['index.php']['meta_'.$type.$post] != '') {
		return $metaData['index.php']['meta_'.$type.$post];
	} else {
		return $metaData['index.php']['meta_'.$type];
	}
}

function logToFile($filename, $msg)
{ 
	// open file
	$fd = fopen('log/'.$filename, "a");
	// write string
	fwrite($fd, $msg . "\n");
	// close file
	fclose($fd);
}

?>