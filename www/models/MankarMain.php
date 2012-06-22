<?php


class MankarMain {

	public $lang = 'en';
	public $units = 'metric';
	public $metaData;
	public $pageUrl;
	public $baseUrl;

	public $extraMeta = '';
	public $flagLanguage = false;
	public $pageContent = '';

	public $pageLocation;
	public $productTypes;
	
	private $mySQL;

	
	
	public function __construct() {

		/*if (isset($_GET['lang'])) {
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
		}*/

		$this->determineLanguage();
		$this->determineUnits();

		$this->metaData = array(
			'title' => 'Chemical Weed Control with the Lowest Possible Environmental Impact',
			'description' => "Mankar's patented segment rotation nozzle is the primary element in all our spraying systems. It is ideal for targeted applications such as between crops, along fence or property lines, between buildi",
			'keywords' => 'ULV, CDA, controlled droplet application, ultra-low volume, roundup, glyphosate, herbicide, mankar',
			'extra' => ''
			);

		if ($_SERVER['PHP_SELF']!="/support.php") {
			$_SESSION['partPID'] = -1;
			$_SESSION['q'] = "";
		}

		$result = mysql_query("SELECT * FROM site_pages");
		while ($row = mysql_fetch_assoc($result))
		{
			$metaData[$row['actual_url']] = $row;
		}
		

		$this->mySQL = new MySQLUtility(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME);

		$this->productTypes = $this->mySQL->sendQuery("SELECT * FROM product_types WHERE active=1");
		
	}

	public function getPage($prettyUrl) {

		$result = $this->mySQL->getSingleRow("SELECT * FROM site_pages WHERE pretty_url='$prettyUrl'");
		if ($result === false) {
			return false;
		}

		$this->pageLocation = explode('/', $result['location']);

		//this only works if the lang code == the db field name
		$append = ($this->lang != LANGUAGE_ENGLISH) ? '_' . $this->lang : '';
		
		$this->metaData['title'] = ($result['meta_title'.$append] != '') ? $result['meta_title'.$append] : $this->metaData['title'];
		$this->metaData['description'] = ($result['meta_description'.$append] != '') ? $result['meta_title'.$append] : $this->metaData['description'];
		$this->metaData['keywords'] = ($result['meta_keywords'.$append] != '') ? $result['meta_title'.$append] : $this->metaData['keywords'];

		$this->pageUrl = $this->baseUrl = $result['actual_url'];

		return $this->pageLocation[0];
	}

	public function getProductType($typeId) {

		$productType = $this->mySQL->getSingleRow("SELECT * FROM product_types WHERE type_id = $typeId");
		$productType['productList'] = $this->mySQL->sendQuery("SELECT * FROM products WHERE type_id = '".$productType['type_id']."'");

		return $productType;
	}

	public function getProduct($productId) {

		$product = $this->mySQL->getSingleRow("SELECT * FROM products WHERE product_id = $productId");
		$product['type'] = $this->mySQL->getSingleRow("SELECT * FROM product_types WHERE type_id = ". $product['type_id']);
		
		$product['pictures'] = $this->mySQL->sendQuery("SELECT * FROM product_photos WHERE product_photos.product_id = $productId ORDER BY product_photos.order");
		$product['parts'] = $this->mySQL->sendQuery("SELECT * FROM parts WHERE parts.part_id IN (SELECT part_id FROM parts_to_products WHERE product_id = $productId)");

		return $product;
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