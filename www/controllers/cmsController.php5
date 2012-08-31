<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

session_start();


require_once(dirname(__FILE__).'/../env/config.php');
require_once(dirname(__FILE__).'/../lib/MankarFunctions.php');
require_once(dirname(__FILE__).'/../lib/MySQLUtility.php');
require_once(dirname(__FILE__).'/../lib/AuthUtility.php');
require_once(dirname(__FILE__).'/../models/SimpleCMS.php');

$cms = new SimpleCMS();

//check authentication
$auth = new AuthUtility();

if ($auth->authenticated !== true) {

	require_once(dirname(__FILE__).'/../lib/StringUtils.php');

	if ($cms->page == 'login') {
		if (isset($_POST['txtUsername'])) {
			if ($auth->login($_POST['txtUsername'], $_POST['txtPassword'], isset($_POST['chkRemember']))) {
				header("Location: http://" . SITE_URL . "simple-cms/main");
				exit();
			}
		}
	}
}
if ($auth->authenticated === true) {
	

	$content = '';
	
	switch ($cms->page) {

		case 'logout':
			$auth->logout();
			header("Location: http://" . SITE_URL . "simple-cms/main");
			exit();
			break;

		case 'tradeshows':
			switch ($cms->action)
			{
				case 'delete':
					$cms->deleteTradeshow();

					header("Location: http://" . SITE_URL . "simple-cms/tradeshows/list/$cms->lastListPage");
					break;
				
				case 'save':
					if (intval($cms->actionData) > 0) {
						$result = $cms->saveTradeshow('update');
					} else {
						$result = $cms->saveTradeshow('insert');
					}

					header("Location: http://" . SITE_URL . "simple-cms/tradeshows/edit/{$cms->actionData}?error={$cms->error}");
					break;
				
				case 'edit':
				case 'insert':
					$content = 'tradeshows-edit.php';
					break;

				case 'list':
					$content = 'tradeshows-list.php';
					break;
				
				default:
					header("Location: http://" . SITE_URL . "simple-cms/main");
					exit();
					break;
			}
			break;

		case 'products':
			switch ($cms->action)
			{
				case 'delete':
					$cms->deleteProduct();

					header("Location: http://" . SITE_URL . "simple-cms/products/list/$cms->lastListPage");
					break;
				
				case 'save':
					if (intval($cms->actionData) > 0) {
						$result = $cms->saveProduct('update');
					} else {
						$result = $cms->saveProduct('insert');
					}

					header("Location: http://" . SITE_URL . "simple-cms/products/edit/{$cms->actionData}?error={$cms->error}");
					break;
				
				case 'edit':
				case 'insert':
					$content = 'products-edit.php';
					break;

				case 'list':
					$content = 'products-list.php';
					break;
				
				default:
					header("Location: http://" . SITE_URL . "simple-cms/main");
					exit();
					break;
			}
			break;
			
		case 'parts':
			switch ($cms->action)
			{
				case 'delete':
					$cms->deletePart();

					header("Location: http://" . SITE_URL . "simple-cms/parts/list/$cms->lastListPage");
					break;
				
				case 'save':
					if (intval($cms->actionData) > 0) {
						$result = $cms->savePart('update');
					} else {
						$result = $cms->savePart('insert');
					}

					header("Location: http://" . SITE_URL . "simple-cms/parts/edit/{$cms->actionData}?error={$cms->error}");
					break;
				
				case 'edit':
				case 'insert':
					$content = 'parts-edit.php';
					break;

				case 'list':
					$content = 'parts-list.php';
					break;
				
				
				default:
					header("Location: http://" . SITE_URL . "simple-cms/main");
					exit();
					break;
			}
			break;
		
		case 'product_types':
			switch ($cms->action)
			{
				case 'delete':
					$cms->deleteProductType();

					header("Location: http://" . SITE_URL . "simple-cms/product_types/list/$cms->lastListPage");
					break;
				
				case 'save':
					if (intval($cms->actionData) > 0) {
						$result = $cms->saveProductType('update');
					} else {
						$result = $cms->saveProductType('insert');
					}

					header("Location: http://" . SITE_URL . "simple-cms/product_types/edit/{$cms->actionData}?error={$cms->error}");
					break;
				
				case 'edit':
				case 'insert':
					$content = 'product-types-edit.php';
					break;
				
				case 'list':
					$content = 'product-types-list.php';
					break;
				
				default:
					header("Location: http://" . SITE_URL . "simple-cms/main");
					exit();
					break;
			}
			break;
		
		case 'dealers':
			switch ($cms->action)
			{
				case 'delete':

					$cms->deleteDealer();

					header("Location: http://" . SITE_URL . "simple-cms/dealers/list/$cms->lastListPage");
					break;
				
				case 'save':
					//TODO clean these strings
					if (intval($cms->actionData) > 0) {
						$result = $cms->saveDealer('update');
					} else {
						$result = $cms->saveDealer('insert');
					}

					header("Location: http://" . SITE_URL . "simple-cms/dealers/edit/{$cms->actionData}?error={$cms->error}");
					break;
				
				case 'edit':
				case 'insert':
					$content = 'dealers-edit.php';
					break;
				
				case 'list':
					$content = 'dealers-list.php';
					break;

				default:
					header("Location: http://" . SITE_URL . "simple-cms/main");
					exit();
					break;
			}
			break;
		
		case 'site-pages':
			switch ($cms->action)
			{
				case 'save':
					$cms->saveSitePage();

					header("Location: http://" . SITE_URL . "simple-cms/site-pages/edit/{$cms->actionData}?error={$cms->error}");
					break;
				
				case 'edit':
					$content = 'site-pages-edit.php';
					break;
				
				
				case 'list':
					$content = 'site-pages-list.php';
					break;

				default:
					header("Location: http://" . SITE_URL . "simple-cms/main");
					exit();
					break;
			}
			break;
		
		case 'main':
			$content = 'main.php';
			break;

		default:
			header("Location: http://" . SITE_URL . "simple-cms/main");
			exit();
			break;
	}
} else {

	$content = 'authenticate.php';

}

require(BASE_PATH.'/views/simple-cms/cms-core.php');

exit();

?>