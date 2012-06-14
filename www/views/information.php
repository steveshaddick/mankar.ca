<?php

	require_once('includes/_init.php');
	
	$page = INFORMATION_PAGE;

	$subPage = (isset($_GET['page'])) ? $_GET['page'] : "main-benefits";

	switch ($subPage)
	{
		case "main-benefits":
		$pageContent = "contentBenefits.html";
		break;
		
		case "technology":
		$pageContent = "contentTechnology.html";
		break;
		
		case "cost-share":
		$pageContent = "contentCostShare.html";
		break;
		
		case "application":
		$pageContent = "contentApplication.html";
		break;
		
		default:
		$subPage = "main-benefits";
		$pageContent = "contentBenefits.html";
		break;
	}
	
	$flagLanguage = true;
	require('includes/_page-structure.php');
	
?>