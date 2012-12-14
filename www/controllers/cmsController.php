<?php

session_start();


require_once(dirname(__FILE__).'/../env/config.php');
require_once(dirname(__FILE__).'/../lib/MankarFunctions.php');
require_once(dirname(__FILE__).'/../lib/MySQLUtility.php');
require_once(dirname(__FILE__).'/../lib/AuthUtility.php');

require_once(dirname(__FILE__).'/../models/simple-cms/SimpleCMSEditor.php');
require_once(dirname(__FILE__).'/../models/simple-cms/SimpleCMSListView.php');

$cms = null;

//check authentication
$auth = new AuthUtility();

$get = explode('/', $_GET['page']);
$page = isset($get[0]) ? $get[0] : '';
$action = isset($get[1]) ? $get[1] : '';
$actionData = isset($get[2]) ? $get[2] : '';

if ($auth->authenticated !== true) {
	require_once(dirname(__FILE__).'/../lib/StringUtils.php');

	if ($page == 'login') {
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
	
	switch ($page) {

		case 'logout':
			$auth->logout();
			header("Location: http://" . SITE_URL . "simple-cms/main");
			exit();
			break;

		case 'news':

			require_once(dirname(__FILE__).'/../models/simple-cms/NewsEditor.php');
			$cms = new NewsEditor();

			break;

		case 'tradeshows':

			require_once(dirname(__FILE__).'/../models/simple-cms/TradeshowsEditor.php');
			$cms = new TradeshowsEditor();

			break;

		case 'products':

			require_once(dirname(__FILE__).'/../models/simple-cms/ProductsEditor.php');
			$cms = new ProductsEditor();

			break;
			
		case 'parts':

			require_once(dirname(__FILE__).'/../models/simple-cms/PartsEditor.php');
			$cms = new PartsEditor();

			break;
		
		case 'product_types':

			require_once(dirname(__FILE__).'/../models/simple-cms/ProductTypesEditor.php');
			$cms = new ProductTypesEditor();

			break;
		
		case 'dealers':

			require_once(dirname(__FILE__).'/../models/simple-cms/DealersEditor.php');
			$cms = new DealersEditor();

			break;
		
		case 'site_pages':

			require_once(dirname(__FILE__).'/../models/simple-cms/SitePagesEditor.php');
			$cms = new SitePagesEditor();

			break;
		
		case 'main':
			$content = 'main.php';
			break;

		default:
			header("Location: http://" . SITE_URL . "simple-cms/main");
			exit();
			break;
	}

	if ($cms) {

		switch ($action)
		{
			case 'delete':
				$cms->delete();

				header("Location: http://" . SITE_URL . "simple-cms/$cms->table/list/$cms->lastListPage");
				break;
			
			case 'save':
				if (intval($actionData) > 0) {
					$result = $cms->save('update');
				} else {
					$result = $cms->save('insert');
				}

				header("Location: http://" . SITE_URL . "simple-cms/$cms->table/edit/{$cms->actionData}?error={$cms->error}");
				break;
			
			case 'edit':
			case 'insert':
				$content = $cms->editPage;
				break;

			case 'list':
				$view = new SimpleCMSListView($cms);
				$content = 'list.php';
				break;
			
			default:
				header("Location: http://" . SITE_URL . "simple-cms/main");
				exit();
				break;
		}
	}
} else {

	$content = 'authenticate.php';

}

require(BASE_PATH.'/views/simple-cms/cms-core.php');

exit();

?>