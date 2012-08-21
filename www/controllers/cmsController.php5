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

		case 'products':
			$content = 'products.php';
			break;
			
		case 'parts':
			$content = 'parts.php';
			break;
		
		case 'product_types':
			$content = 'product-types.php';
			break;
		
		case 'dealers':
			switch ($cms->action)
			{
				case 'delete':

					$cms->deleteDealer();

					header("Location: http://" . SITE_URL . "simple-cms/dealers/list/$cms->lastListPage");
					break;
				
				case 'save':

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
		
		case 'meta_tags':
			$content = 'meta-tags.php';
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