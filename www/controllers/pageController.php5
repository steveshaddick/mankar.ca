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

	switch ($view) {

		case 'home':
			$mankarMain->flagLanguage = true;
			$mankarMain->pageContent = "home-page.php";
			break;

		case 'products':

			$mankarMain->flagLanguage = false;

			switch (count($mankarMain->pageLocation)) {
				
				case 1:
					//main page
					$mankarMain->pageContent = "products-main.php";
					break;

				case 2:
					//product type page
					$mankarMain->metaData['extra'] = '<script src="js/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script><link href="css/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />';
					$mankarMain->pageContent = "products-type.php";

					break;

				case 3:
					//product page
					$mankarMain->metaData['extra'] = '<script src="js/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script><link href="css/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />';
					$mankarMain->pageContent = "products-product.php";

					break;

				default: 
					//main page
					$mankarMain->pageContent = "products-main.php";
					break;
			}
			
			break;

			case 'support':

				if (!isset($mankarMain->pageLocation[1])) {
					$mankarMain->pageLocation[1] = 'tips-manuals';
				} else {
					if ($mankarMain->pageLocation[1] == 'parts') {
						$mankarMain->flagLanguage = false;
						$partId = (isset($_GET['partid'])) ? intval($_GET['partid']) : -1;
					}
				}
				/*$page = SUPPORT_PAGE;
				$subPage = (isset($_GET['page'])) ? $_GET['page'] : "tips-manuals";
				switch ($subPage)
				{
					case "tips-manuals":
					$flagLanguage = true;
					$pageContent = "contentSupport.php";
					break;
					
					case "parts":
					$flagLanguage = false;
					$partId = (isset($_GET['partid'])) ? intval($_GET['partid']) : -1;
					
					if ($partId > -1) {
						$result = mysql_query("SELECT * FROM parts WHERE part_id = $partId AND active=1 LIMIT 1");
						$part = mysql_fetch_assoc($result);
						$pageContent = "parts-page.php";
					} else {
						$pageContent = "parts-main-page.php";
					}
					break;
					
					
					default:
					$subPage = "tips-manuals";
					$flagLanguage = true;
					$pageContent = "contentSupport.php";
					break;
				}*/

				$subPage = "tips-manuals";
				$mankarMain->flagLanguage = true;
				$mankarMain->pageContent = "contentSupport.php";

				break;

	}

	require(BASE_PATH.'/includes/page-structure.php');

} else {
	header('Location: http://'.SITE_URL.'/');
}

?>