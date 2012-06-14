<?php


class MankarMain {

	public $lang;
	public $units;
	
	private $mySQL;
	
	public function __construct() {

		require_once(dirname(__FILE__).'/../lib/MySQLUtility.php');
		
		if (isset($_GET['lang'])) {
			$this->lang = $_SESSION['lang'] = $_GET['lang'];
			setcookie('lang', $this->lang, EXPIRE_COOKIE);
		} else {
			$this->determineLanguage();
		}

		if (isset($_GET['units'])) {
			$this->units = $_SESSION['units'] = $_GET['units'];
			setcookie('units', $this->units, EXPIRE_COOKIE);
		} else {
			$this->determineUnits();
		}

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
		

		$this->mySQL = new MySQLUtility(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME);
		
	}

	public function getView($prettyUrl) {
		return $this->mySQL->getSingleRow("SELECT actual_url FROM meta_tags WHERE pretty_url='$prettyUrl'");
	}

	private function determineLanguage() {
		
		if (isset($_COOKIE['lang'])) { //see if they already chose a language back in the day 
			
			$this->lang = $_SESSION['lang'] = $_COOKIE['lang'];

		} elseif (isset($_SESSION['lang'])){ //see if they already chose a language

			$this->lang = $_SESSION['lang'];
			setcookie('lang', $this->lang, EXPIRE_COOKIE);

		} elseif (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {//check second to see if they've been nice and set the language
			
			$this->langs = explode(",",$_SERVER["HTTP_ACCEPT_LANGUAGE"]);//grab all the languages

			foreach ($this->langs as $value) {//start going through each one
				//select only the first two letters
				$choice=substr($value,0,2);

				//redirect to the different language page
				//based on their first chosen language
				switch ($choice) {
					case "fr":
					$this->lang = LANGUAGE_FRENCH; 
					break;
					case "en":
					$this->lang = LANGUAGE_ENGLISH;
					break;
					case "sp":
					$this->lang = LANGUAGE_SPANISH; 
					break;
					
					default:
					$this->lang = LANGUAGE_ENGLISH;
					break;
				}
				$_SESSION['lang'] = $this->lang;
				setcookie('lang', $this->lang, EXPIRE_COOKIE);
			}
		} else {

			$this->lang = $_SESSION['lang'] = LANGUAGE_ENGLISH;
			setcookie('lang', $this->lang, EXPIRE_COOKIE);

		}
		//if all else fails, or screws up
		switch ($this->lang)
		{
			case LANGUAGE_ENGLISH:
			case LANGUAGE_FRENCH:
			case LANGUAGE_SPANISH:
			break;
			
			default:
			$this->lang = LANGUAGE_ENGLISH;
			break;
		}
	}

	private function determineUnits() {
		if (isset($_COOKIE['units'])){ 

			$this->units = $_SESSION['units'] = $_COOKIE['units'];

		} elseif (isset($_SESSION['units'])){ 

			$this->units = $_SESSION['units'];
			setcookie('units', $this->units, EXPIRE_COOKIE);

		} else {
			$this->units = $_SESSION['units'] = UNIT_METRIC;
			setcookie('units', $this->units, EXPIRE_COOKIE);
		}

		switch ($this->units)
		{
			case UNIT_METRIC:
			case UNIT_US:
			break;
			
			default:
			$this->units = UNIT_METRIC;
			break;
		}
	}
}

?>