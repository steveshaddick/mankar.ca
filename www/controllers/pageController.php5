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

$pageResult = $mankarMain->getPage($_GET['page']);

if ($pageResult['success'] === true) {

	switch ($mankarMain->pageLocation[0]) {

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
					$productType = $mankarMain->getProductType($mankarMain->pageLocation[1]);
					
					if ($productType === false) {
						header('Location: http://'.SITE_URL.'/');
						exit();
					}
					

					$mankarMain->pageData['productType'] = $productType;

					$mankarMain->metaData['extra'] = '<script src="js/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script><link href="css/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />';
					$mankarMain->pageContent = "products-type.php";

					break;

				case 3:
					//product page
					
					$product = $mankarMain->getProduct($mankarMain->pageLocation[2]);
					if ($product === false) {
						header('Location: http://'.SITE_URL.'/');
						exit();
					}

					$mankarMain->pageData['product'] = $product;

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

				switch (count($mankarMain->pageLocation)) {
				
					case 1:
						//main support page
						$mankarMain->pageLocation[1] = 'tips-manuals';
						$mankarMain->flagLanguage = true;
						$mankarMain->pageContent = "contentSupport.php";
						break;

					case 2:
						//part page

						$mankarMain->flagLanguage = false;
						if (isset($_GET['partId'])) {
							$mankarMain->pageContent = "parts-part.php";
						} else {
							$mankarMain->pageContent = "parts-main.php";
						}
						break;

				}

				break;

			case 'tradeshows':
				$mankarMain->flagLanguage = false;
				$mankarMain->pageContent = "tradeshows.php";
				break;

			case 'dealers':
				$mankarMain->flagLanguage = false;
				$mankarMain->pageContent = "dealers.php";
				break;

	}

	require(BASE_PATH.'/includes/page-structure.php');

} else {

	header('Location: ' . $pageResult['url']);
}

?>