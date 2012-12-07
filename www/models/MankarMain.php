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
	public $orphanedProducts;
	public $totalProductTypes;
	
	public $superTypes;
	public $superTypeUrl;
	public $superTypeLogo;
	public $superTypeName;
	public $superTypeSlug;
	public $superTypeId = 1;		//product supertypes for separating sites

	public $totalNewsPages;
	public $lastNewsPage;
	public $newsList;
	public $newsItem;

	public $isUSA = false;
	
	public $envPrefix = 'www.';

	public $nextTradeshow = array();

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
		
		if (isset($_COOKIE['usa']) && ($_COOKIE['usa'] == 1)){ 
			$this->isUSA = true;
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
				$data->superTypeLogo = $row['logo'];
				$data->superTypeName = $row['name'];
				$data->superTypeSlug = $row['slug'];
			}
		}
		$this->superTypes = $this->mySQL->sendQuery("SELECT * FROM supertypes", 'supertype_id', 'iterate', $this);
		
		$this->nextTradeshow = $this->mySQL->getSingleRow("SELECT * FROM tradeshows WHERE showend >= '".date( 'Y-m-d' )."' ORDER BY showstart");

		$this->productTypes = $this->mySQL->sendQuery("SELECT * FROM product_types WHERE active=1 AND supertype_id = $this->superTypeId");
		$this->orphanedProducts = $this->mySQL->sendQuery("SELECT product_id as type_id, pretty_url, name, supertype_id, photo_list as thumbnail, '1' as is_product FROM products WHERE active=1 AND supertype_id = $this->superTypeId AND type_id=0");
		$this->totalProductTypes = array_merge($this->productTypes, $this->orphanedProducts);

		$this->hasNav = $this->mySQL->sendQuery("SELECT pretty_url FROM site_pages WHERE (supertype_id=$this->superTypeId AND has_nav = 1)", 'pretty_url');
		
	}

	public function getPage($prettyUrl) {

		$prettyUrl = $this->mySQL->cleanString($prettyUrl);

		$urlParams = explode('/', $prettyUrl);
		$prettyUrl = $urlParams[0];

		foreach ($urlParams as $param) {
			switch ($param) {
				case 'usa':
					if ($prettyUrl == $param) { $prettyUrl = 'index'; }
					$this->isUSA = true;
					setcookie('usa', 1, EXPIRE_COOKIE);

					$this->units = $_SESSION['units'] = UNIT_US;
					setcookie('units', $this->units, EXPIRE_COOKIE);
					break;

				case 'fr':
					if ($prettyUrl == $param) { $prettyUrl = 'index'; }
					$this->lang = $_SESSION['lang'] = LANGUAGE_FRENCH;
					setcookie('lang', $this->lang, EXPIRE_COOKIE);
					break;

				case 'sp':
					if ($prettyUrl == $param) { $prettyUrl = 'index'; }
					$this->lang = $_SESSION['lang'] = LANGUAGE_SPANISH;
					setcookie('lang', $this->lang, EXPIRE_COOKIE);
					break;

			}
		}

		$sitePage = $this->mySQL->getSingleRow("SELECT * FROM site_pages WHERE pretty_url='$prettyUrl' AND supertype_id=$this->superTypeId");
		if ($sitePage === false) {
			$redirect = $this->mySQL->getSingleRow("SELECT * FROM site_pages WHERE pretty_url='$prettyUrl' AND redirect_supertype=$this->superTypeId");
			if ($redirect !== false) {
				return array('success' => false, 'url' => $this->superTypes[$redirect['supertype_id']]['url'] . $_SERVER['REQUEST_URI']);
			} else {
				$this->pageContent = '404.php';
			}
		} else {
			$this->pageContent = $sitePage['content_file'];
		}
		
		
		if ($this->pageContent == '') {
			$this->pageContent = '404.php';
		}
		
		if (isset($sitePage['location'])) {
			$this->pageLocation = explode('/', $sitePage['location']);
		}


		if (!file_exists(PAGE_CONTENT . '/' . $this->superTypes[$this->superTypeId]['url'] . '/' . $this->pageContent)) {
			if (!file_exists(PAGE_CONTENT . '/' . $this->superTypes[1]['url'] . '/' . $this->pageContent)) {
				return array('success' => false, 'url' => 'http://'.SITE_URL);
			} else {
				$this->pageContent = $this->superTypes[1]['url'] . '/' . $this->pageContent;
			}
		} else {
			$this->pageContent = $this->superTypes[$this->superTypeId]['url'] . '/' . $this->pageContent;
		}

		switch ($this->pageContent) {
			
			case '404.php':
				$this->metaData['title'] = TITLE_404;
				$this->metaData['description'] = '';
				$this->metaData['keywords'] = '';
				break;

			default:
				//this only works if the lang code == the db field name
				$append = ($this->lang != LANGUAGE_ENGLISH) ? '_' . $this->lang : '';

				$this->metaData['title'] = ($sitePage['meta_title'.$append] != '') ? $sitePage['meta_title'.$append] : ($sitePage['meta_title'] != '') ? $sitePage['meta_title'] : $this->metaData['title'];
				$this->metaData['description'] = ($sitePage['meta_description'.$append] != '') ? $sitePage['meta_description'.$append] : ($sitePage['meta_description'] != '') ? $sitePage['meta_description'] : $this->metaData['description'];
				$this->metaData['keywords'] = ($sitePage['meta_keywords'.$append] != '') ? $sitePage['meta_keywords'.$append] : ($sitePage['meta_keywords'] != '') ? $sitePage['meta_keywords'] : $this->metaData['keywords'];
				$this->metaData['extra'] .= $sitePage['extra_header'];
				break;
		}

		//$this->pageUrl = $this->baseUrl = $sitePage['actual_url'];

		return array('success' => true);
	}

	public function getNewsList($newsPage) {
		
		if (!isset($_SESSION['totalNewsPages']) || ($_SESSION['totalNewsPages'] == 0)) {
			$result = $this->mySQL->getSingleRow("SELECT COUNT(*) as totalRows FROM news WHERE active=1 AND supertypes LIKE '%$this->superTypeId%'");
			$this->totalNewsPages = $_SESSION['totalNewsPages'] = ceil($result['totalRows'] / 5);
		} else {
			$this->totalNewsPages = $_SESSION['totalNewsPages'];
		}

		if ($newsPage > $this->totalNewsPages) {
			$newsPage = $this->totalNewsPages;
		}
		if ($newsPage <= 0) {
			$newsPage = 1;
		}
		$this->lastNewsPage = $_SESSION['lastNewsPage'] = $newsPage;
		$this->newsList = $this->mySQL->sendQuery("SELECT * FROM news WHERE active=1 AND supertypes LIKE '%$this->superTypeId%' ORDER BY newsDate DESC LIMIT ". (($newsPage - 1) * 5) .",5");

	}

	public function getNewsItem($newsUrl) {

		$newsUrl = $this->mySQL->cleanString($newsUrl);

		$this->lastNewsPage = (isset($_SESSION['lastNewsPage'])) ? $_SESSION['lastNewsPage'] : 1;

		$this->newsItem = $this->mySQL->getSingleRow("SELECT * FROM news WHERE active=1 AND supertypes LIKE '%$this->superTypeId%' AND pretty_url = '$newsUrl'");
		if ($this->newsItem === false) {
			return array('success' => false, 'url' => 'http://'.SITE_URL.'news');
		}

		//override meta data
		$this->metaData['title'] = $this->newsItem['title'];
		$this->metaData['description'] = substr($this->newsItem['body'], 0, 160);

		return array('success' => true);
	}

	public function getProductType($typeId) {

		$typeId = intval($typeId);

		$productType = $this->mySQL->getSingleRow("SELECT * FROM product_types WHERE type_id = $typeId");
		if ($productType === false) {
			return $productType;
		}
		$productType['productList'] = $this->mySQL->sendQuery("SELECT * FROM products WHERE type_id = {$productType['type_id']} ORDER BY product_order");

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
		return $this->mySQL->sendQuery("SELECT * FROM products WHERE product_id IN (SELECT product_id FROM parts_to_products) AND products.active=1 AND products.supertype_id=$this->superTypeId");
	}

	public function getPartsByProductId($productId) {
		
		$productId = intval($productId);
		$error = '';

		$parts = $this->mySQL->sendQuery("SELECT * FROM parts WHERE parts.part_id IN (SELECT part_id FROM parts_to_products WHERE product_id = $productId) AND parts.active=1 ORDER BY parts.part_code");
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

			$parts = $this->mySQL->sendQuery("SELECT * FROM parts WHERE (part_code LIKE '%$search%' OR name LIKE '%$search%' OR agtec_code LIKE '%$search%' OR old_code LIKE '%$search%') AND parts.active=1  ORDER BY parts.part_code");
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
	    
	    $upcoming = $this->mySQL->sendQuery("SELECT * FROM tradeshows WHERE showend >= '$today' AND supertypes LIKE '%{$this->superTypeId}%' ORDER BY showstart");
	    $recent = $this->mySQL->sendQuery("SELECT * FROM tradeshows WHERE showend < '$today' AND showend >= '$lastyeartoday' AND supertypes LIKE '%{$this->superTypeId}%' ORDER BY showstart DESC");
	    $oneYear = $this->mySQL->sendQuery("SELECT * FROM tradeshows WHERE showend < '$lastyeartoday' AND supertypes LIKE '%{$this->superTypeId}%' ORDER BY showstart DESC");
		
		return array('upcoming'=>$upcoming, 'recent'=>$recent, 'oneYear'=>$oneYear);
	}

	public function getDealers() {
	
		return $this->mySQL->sendQuery("SELECT * FROM dealers JOIN state ON dealers.state_id=state.state_id WHERE active=1 AND supertypes LIKE '%{$this->superTypeId}%' ORDER BY state");
	}

	public function getManuals() {
		return $this->mySQL->sendQuery("SELECT name, manual, manual_fr, manual_sp FROM products WHERE (manual <> '' OR manual_fr <> '' OR manual_sp <> '') AND supertype_id = $this->superTypeId ORDER BY type_id, manual, product_code");
	}

	public function getRecentNews() {
		return $this->mySQL->sendQuery("SELECT * FROM news WHERE active = 1 AND supertypes LIKE '%{$this->superTypeId}%' ORDER BY newsDate DESC LIMIT 3");
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

			$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
			if (!empty($ip)) {
				
				include(BASE_PATH. '/lib/ip2locationlite.class.php');
				
				$ipLite = new ip2location_lite;
				$ipLite->setKey(IPINFO_API);

				$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
				$visitorGeolocation = $ipLite->getCountry($ip);
				
				if ($visitorGeolocation['statusCode'] == 'OK') {
					if ($visitorGeolocation['countryCode'] == 'US') {
						$this->units = $_SESSION['units'] = UNIT_US;
						$this->isUSA = true;
						setcookie('usa', 1, EXPIRE_COOKIE);
					} 
				}
			}

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