<?php

$productId = (isset($_GET['pid'])) ? intval($_GET['pid']) : -1;
$typeId = (isset($_GET['type'])) ? intval($_GET['type']) : -1;
$page = "";

if ($productId > -1) {
	$page = PAGE_PRODUCT;
} else if ($typeId > -1) {
	$page = PAGE_TYPE;
} else {
	$page = PRODUCTS_PAGE;
}

$productList = $mankarMain->getProductList($mankarMain->pageLocation[1]);

switch ($mankarMain->pageLocation[1])
{
	case 1:
		$pageContent = "products-main.php";
		break;

	case PAGE_PRODUCT:
		$pageContent = "product-page.php";
		$result = mysql_query("SELECT * FROM products WHERE products.product_id = $productId AND active=1 LIMIT 1");
		$product = mysql_fetch_assoc($result);
		
		$result = mysql_query("SELECT * FROM meta_tags WHERE page='products' AND related_id = $productId LIMIT 1");
		$meta = mysql_fetch_assoc($result); 
		$metaTitle = (($lang != LANGUAGE_ENGLISH) && ($meta['meta_title_'.$lang]!='')) ? $meta['meta_title_'.$lang] : $meta['meta_title'];
		$metaDescription = (($lang != LANGUAGE_ENGLISH) && ($meta['meta_description_'.$lang]!='')) ? $meta['meta_description_'.$lang] : $meta['meta_description'];
		$metaKeywords = (($lang != LANGUAGE_ENGLISH) && ($meta['meta_keywords_'.$lang]!='')) ? $meta['meta_keywords_'.$lang] : $meta['meta_keywords'];
		
		break;
		
	case PAGE_TYPE:
		$pageContent = "type-page.php";
		
		$result = mysql_query("SELECT * FROM product_types WHERE type_id = $typeId AND active=1 LIMIT 1");
		$type = mysql_fetch_assoc($result);
		
		$result = mysql_query("SELECT * FROM meta_tags WHERE page='product_types' AND related_id = $typeId LIMIT 1");
		$meta = mysql_fetch_assoc($result); 
		$metaTitle = (($lang != LANGUAGE_ENGLISH) && ($meta['meta_title_'.$lang] != '')) ? $meta['meta_title_'.$lang] : $meta['meta_title'];
		$metaDescription = (($lang != LANGUAGE_ENGLISH) && ($meta['meta_description_'.$lang] != '')) ? $meta['meta_description_'.$lang] : $meta['meta_description'];
		$metaKeywords = (($lang != LANGUAGE_ENGLISH) && ($meta['meta_keywords_'.$lang] != '')) ? $meta['meta_keywords_'.$lang] : $meta['meta_keywords'];
		break;
		
		
	default:
		$pageContent = "products-main.php";
		break;
}

$flagLanguage = false;

$extraMeta = '<script src="js/SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script><link href="css/SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />';

require(BASE_PATH.'/includes/page-structure.php');