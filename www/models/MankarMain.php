<?php


class MankarMain {

	public $lang = 'en';
	public $units = 'metric';
	public $metaData;
	public $pageUrl;
	public $baseUrl;

	public $extraMeta = '';
	public $pageContent = '';		//the page content file
	public $languageWarning = false; 
	public $hasNav;
	
	public $sitePage = array();		//general array for holding specific page data

	public $pageLocation;			//array to hold page info
	public $productTypes;
	
	public $superTypes;
	public $superTypeUrl;
	public $superTypeId = 1;		//product supertypes for separating sites
	
	public $envPrefix = 'www.';

	private $mySQL;
	
	public function __construct() {

		$this->superTypeUrl = str_replace("www.", "", $_SERVER['SERVER_NAME']);
		$this->superTypeUrl = str_replace("dev.", "", $this->superTypeUrl);
		switch ($this->superTypeUrl) {
			
			case 'mankarusa.com':
				$_SESSION['units'] = UNIT_US;
				//nobreak;
			case 'mankar.ca':
				$this->superTypeUrl = "mankarulv.com";
				break;
		}

		if (ENVIRONMENT == 'development') {
			$this->envPrefix = 'dev.';
		}
		

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

		$this->mySQL = new MySQLUtility(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME);

		function iterate($row, &$data) {
			if ($row['url'] == $data->superTypeUrl) {
				$data->superTypeId = $row['supertype_id'];
			}
		}

		$this->superTypes = $this->mySQL->sendQuery("SELECT * FROM supertypes", 'supertype_id', 'iterate', $this);

		/*foreach ($this->superTypes as $superType) {
			echo $_SERVER['SERVER_NAME']." ".$value."<br />";
			if ($row['url'], strpos($_SERVER['SERVER_NAME']) {
					$this->superTypeId = $superType['supertype_id'];
				}
			
		}*/

		$this->productTypes = $this->mySQL->sendQuery("SELECT * FROM product_types WHERE active=1 AND supertype_id = $this->superTypeId");
		$this->hasNav = $this->mySQL->sendQuery("SELECT pretty_url FROM site_pages WHERE (supertype_id=$this->superTypeId AND has_nav = 1)", 'pretty_url');
		
	}

	public function getPage($prettyUrl) {

		$prettyUrl = $this->mySQL->cleanString($prettyUrl);

		$sitePage = $this->mySQL->getSingleRow("SELECT * FROM site_pages WHERE pretty_url='$prettyUrl' AND supertype_id=$this->superTypeId");
		if ($sitePage === false) {
			$redirect = $this->mySQL->getSingleRow("SELECT * FROM site_pages WHERE pretty_url='$prettyUrl' AND redirect_supertype=$this->superTypeId");
			if ($redirect !== false) {
				return array('success' => false, 'url' => $this->superTypes[$redirect['redirect_supertype']]['url'] . $_SERVER['REQUEST_URI']);
			} else {
				return array('success' => false, 'url' => 'http://'.SITE_URL.'/');
			}
		}

		$this->pageContent = $sitePage['content_file'];
		if ($this->pageContent == '') {
			return array('success' => false, 'url' => 'http://'.SITE_URL.'/');
		}

		if (!file_exists(PAGE_CONTENT . '/' . $this->superTypes[$this->superTypeId]['url'] . '/' . $this->pageContent)) {
			if (!file_exists(PAGE_CONTENT . '/' . $this->superTypes[1]['url'] . '/' . $this->pageContent)) {
				return array('success' => false, 'url' => 'http://'.SITE_URL.'/');
			} else {
				$this->pageContent = $this->superTypes[1]['url'] . '/' . $this->pageContent;
			}
		} else {
			$this->pageContent = $this->superTypes[$this->superTypeId]['url'] . '/' . $this->pageContent;
		}
		

		$this->pageLocation = explode('/', $sitePage['location']);

		//this only works if the lang code == the db field name
		$append = ($this->lang != LANGUAGE_ENGLISH) ? '_' . $this->lang : '';
		
		$this->metaData['title'] = ($sitePage['meta_title'.$append] != '') ? $sitePage['meta_title'.$append] : $this->metaData['title'];
		$this->metaData['description'] = ($sitePage['meta_description'.$append] != '') ? $sitePage['meta_title'.$append] : $this->metaData['description'];
		$this->metaData['keywords'] = ($sitePage['meta_keywords'.$append] != '') ? $sitePage['meta_title'.$append] : $this->metaData['keywords'];

		//$this->pageUrl = $this->baseUrl = $sitePage['actual_url'];

		return array('success' => true);
	}

	public function getProductType($typeId) {

		$typeId = intval($typeId);

		$productType = $this->mySQL->getSingleRow("SELECT * FROM product_types WHERE type_id = $typeId");
		if ($productType === false) {
			return $productType;
		}
		$productType['productList'] = $this->mySQL->sendQuery("SELECT * FROM products WHERE type_id = {$productType['type_id']}");

		return $productType;
	}

	public function getProduct($productId) {
		//TODO: error checking / active product checking
		
		$productId = intval($productId);

		$product = $this->mySQL->getSingleRow("SELECT * FROM products WHERE product_id = $productId");
		$product['type'] = $this->mySQL->getSingleRow("SELECT * FROM product_types WHERE type_id = ". $product['type_id']);
		
		$product['pictures'] = $this->mySQL->sendQuery("SELECT * FROM product_photos WHERE product_photos.product_id = $productId ORDER BY product_photos.order");
		$product['parts'] = $this->mySQL->sendQuery("SELECT * FROM parts WHERE parts.part_id IN (SELECT part_id FROM parts_to_products WHERE product_id = $productId)");

		return $product;
	}

	public function getAllPartsProducts() {
		return $this->mySQL->sendQuery("SELECT * FROM products WHERE product_id IN (SELECT product_id FROM parts_to_products) AND products.active=1");
	}

	public function getPartsByProductId($productId) {
		
		$productId = intval($productId);
		$error = '';

		$parts = $this->mySQL->sendQuery("SELECT * FROM parts WHERE parts.part_id IN (SELECT part_id FROM parts_to_products WHERE product_id = $productId)");
		$product = $this->mySQL->getSingleRow("SELECT name FROM products WHERE product_id=$productId AND products.active=1");

		if (count($parts) == 0) {
			$error = 'noparts';
		}

		return array('name' => $product['name'], 'parts'=> $parts, 'error'=>$error);
	}

	public function getPartsBySearch($search) {
		
		$parts = array();
		$error = '';

		if (strlen($search) >= 3) {
			$search = $this->mySQL->cleanString($search);

			$parts = $this->mySQL->sendQuery("SELECT * FROM parts WHERE (part_code LIKE '%$search%' OR name LIKE '%$search%' OR agtec_code LIKE '%$search%' OR old_code LIKE '%$search%') AND parts.active=1");
			if (count($parts) == 0) {
				$error = 'nosearch';
			}

		} else {
			$error = 'tooshort';
		}

		return array('parts'=> $parts, 'error'=>$error);
	}

	public function getPart($partId) {
		
		$partId = intval($partId);

		$part = $this->mySQL->getSingleRow("SELECT * FROM parts WHERE part_id = $partId AND active=1");
		if ($part === false) {
			return false;
		}
		
		$part['applicableProducts'] = $this->mySQL->sendQuery("SELECT * FROM products WHERE products.product_id IN (SELECT product_id FROM parts_to_products WHERE part_id = $partId) AND products.active=1");
		
		return $part;

	}

	public function getTradeshows() {

		$today = date( 'Y-m-d H:i:s' );
		$lastyear = mktime(0, 0, 0, date("m"), date("d"), date("Y")-1);
	    $lastyeartoday = date("Y-m-d H:i:s",$lastyear);
	    
	    $upcoming = $this->mySQL->sendQuery("SELECT * FROM tradeshows WHERE showend >= '$today' ORDER BY showstart");
	    $recent = $this->mySQL->sendQuery("SELECT * FROM tradeshows WHERE showend < '$today' AND showend >= '$lastyeartoday' ORDER BY showstart DESC");
	    $oneYear = $this->mySQL->sendQuery("SELECT * FROM tradeshows WHERE showend < '$lastyeartoday' ORDER BY showstart DESC");
		
		return array('upcoming'=>$upcoming, 'recent'=>$recent, 'oneYear'=>$oneYear);
	}

	public function getDealers() {
	
		return $this->mySQL->sendQuery("SELECT * FROM dealers JOIN state ON dealers.state_id=state.state_id WHERE active=1 AND supertypes LIKE '%{$this->superTypeId}%' ORDER BY state");
	}

	public function getManuals() {
		return $this->mySQL->sendQuery("SELECT name, manual FROM products WHERE manual <> '' AND supertype_id = $this->superTypeId ORDER BY type_id, manual, product_code");
	}


	/* PRIVATE FUNCTIONS */

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