<?php

//error_reporting(E_ALL); 
//ini_set("display_errors", 1); 

ini_set("url_rewriter.tags","");

define('LANGUAGE_ENGLISH','en');
define('LANGUAGE_FRENCH','fr');
define('LANGUAGE_SPANISH','sp');

define('UNIT_METRIC','metric');
define('UNIT_US','us');

define('PICTURES_LOCATION', 'images/pics/');
define('THUMBS_LOCATION', 'images/thumbs/');
define('PARTS_LOCATION', 'images/parts/');
define('DEALER_LOGO_LOCATION', 'images/dealer_logos/');
define('TRADESHOW_LOGO_LOCATION', 'images/tradeshow_logos/');
define('MANUALS_LOCATION', 'manuals/');

define('ENGLISH_CONTENT', 'content/en/');
define('FRENCH_CONTENT', 'content/fr/');
define('SPANISH_CONTENT', 'content/sp/');
define('GENERAL_CONTENT', 'content/');

define('NO_FRENCH', 'Nous sommes d&eacute;sol&eacute;s, cette section n\'est pas encore disponible en fran&ccedil;ais.');
define('NO_SPANISH', 'Lo sentimos mucho, esta p&aacute;gina no es disponible en espa&ntilde;ol.');

define('NO_PHOTO', 'no_photo.jpg');

define('HOME_PAGE', 'home');
define('PRODUCTS_PAGE', 'products');
define('INFORMATION_PAGE', 'information');
define('COMPARISON_PAGE', 'comparison');
define('SUPPORT_PAGE', 'support');
define('NEWS_PAGE', 'news');
define('LINKS_PAGE', 'links');
define('DEALERS_PAGE', 'dealers');
define('TRADESHOWS_PAGE', 'tradeshows');
define('TECHNOLOGY_PAGE', 'technology');

define('PAGE_PRODUCT', 'product');
define('PAGE_TYPE', 'type');

session_start();
//print_r($_SESSION);
if (isset($lang)) {
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
} else {
	$lang = LANGUAGE_ENGLISH;
}
	

if (isset($_GET['lang'])) {//check to see if they came from a page where they set the language - like if we are switching languages on the same page
	$lang=$_GET['lang'];
} elseif(isset($_SESSION['lang'])){ //see if they already chose a language
	//echo 'SESSIONS:'.$_SESSION['lang'];
	$lang = $_SESSION['lang'];
} elseif (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {//check second to see if they've been nice and set the language
	$langs=explode(",",$_SERVER["HTTP_ACCEPT_LANGUAGE"]);//grab all the languages

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
	}
}else{
	$lang = LANGUAGE_ENGLISH; 
}
//if all else fails, or screws up
if ($lang == ""){
	$lang = LANGUAGE_ENGLISH;
}

//same thing for units
if (isset($_GET['units'])) {
	$units=$_GET['units'];
} elseif(isset($_SESSION['units'])){ 
	$units = $_SESSION['units'];
} else {
	$units = UNIT_METRIC;
}
if ($units == ""){
	$units = UNIT_METRIC;
}

$_SESSION['lang'] = $lang;
//echo $_SESSION['lang'];
$_SESSION['units'] = $units;


define('ABSPATH_INCLUDES', dirname(__FILE__).'/');
require(ABSPATH_INCLUDES.'_connect.php');

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