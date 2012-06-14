<?php

error_reporting(E_ALL); 
ini_set("display_errors", 1); 

session_start();


if (!isset($_COOKIE['lang'])) {
	setcookie('lang', $lang, EXPIRE_COOKIE);
}
if (!isset($_COOKIE['units'])) {
	setcookie('units', $units, EXPIRE_COOKIE);
}

//print_r($_SESSION);

define('ABSPATH_INCLUDES', dirname(__FILE__).'/');





?>