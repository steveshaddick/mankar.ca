<?php
	require_once('includes/_init.php');
	
	$page = SUPPORT_PAGE;
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
	}
	
	
	require('includes/_page-structure.php');
	
?>