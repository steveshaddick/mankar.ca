<?php 
	
	
	
	$metaTitle = ($metaTitle == '') ? getMetaData('title', $pageUrl) : $metaTitle;
	$metaDescription = ($metaDescription == '') ? getMetaData('description',  $pageUrl) : $metaDescription;
	$metaKeywords = ($metaKeywords == '') ? getMetaData('keywords', $pageUrl) : $metaKeywords;
	
	if (($metaTitle=='') || ($metaDescription=='') || ($metaKeywords=='')) {
		
		
		
		/* ($page)
		{
			case HOME_PAGE:
			case PRODUCTS_PAGE:
			case INFORMATION_PAGE:
			case COMPARISON_PAGE:
			case SUPPORT_PAGE:
			case NEWS_PAGE:
			case LINKS_PAGE:
			case DEALERS_PAGE:
			case TRADESHOWS_PAGE:
				
				$result = mysql_query("SELECT * FROM meta_tags WHERE page='$page' AND related_id=-1 LIMIT 1");
				break;
		
			default:
				$result = mysql_query("SELECT * FROM meta_tags WHERE page='".HOME_PAGE."' LIMIT 1");
				break;
		}
		
		$general = mysql_fetch_assoc($result);
		
		if ($metaTitle == '') {
			$metaTitle = (($lang != LANGUAGE_ENGLISH) && ($general['meta_title_'.$lang]!='')) ? $general['meta_title_'.$lang] : $general['meta_title'];
		}
		if ($metaDescription == '') {
			$metaDescription = (($lang != LANGUAGE_ENGLISH) && ($general['meta_description_'.$lang]!='')) ? $general['meta_description_'.$lang] : $general['meta_description'];
		}
		if ($metaKeywords == '') {
			$metaKeywords = (($lang != LANGUAGE_ENGLISH) && ($general['meta_keywords_'.$lang]!='')) ? $general['meta_keywords_'.$lang] : $general['meta_keywords'];
		}*/

	}
	
	/*if (($metaTitle=='') || ($metaDescription=='') || ($metaKeywords=='')) {
		$result = mysql_query("SELECT * FROM meta_tags WHERE page='".HOME_PAGE."' LIMIT 1");
		$general = mysql_fetch_assoc($result);
		if ($metaTitle == '') {
			$metaTitle = (($lang != LANGUAGE_ENGLISH) && ($general['meta_title_'.$lang]!='')) ? $general['meta_title_'.$lang] : $general['meta_title'];
		}
		if ($metaDescription == '') {
			$metaDescription = (($lang != LANGUAGE_ENGLISH) && ($general['meta_description_'.$lang]!='')) ? $general['meta_description_'.$lang] : $general['meta_description'];
		}
		if ($metaKeywords == '') {
			$metaKeywords = (($lang != LANGUAGE_ENGLISH) && ($general['meta_keywords_'.$lang]!='')) ? $general['meta_keywords_'.$lang] : $general['meta_keywords'];
		}
	}*/
	

?>
<meta name="y_key" content="0b9d701837f52dd6" >
<meta name="msvalidate.01" content="E3BB9CC2E03F47E4AE9933B1F27FE83D" >
<meta name="verify-v1" content="zeZ78C8xi39aj2DZSQVNJqtrfcyTJnAqYuSpESNxuDE=" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link rel="stylesheet" type="text/css" href="http://www.mankar.ca/css/mankar-style.css" >
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
<link rel="icon" href="favicon.ico" type="image/gif" >
<title>Mankar.ca - <?=$metaTitle;?></title>
<meta name="description" content="<?=$metaDescription;?>">
<meta name="keywords" content="<?=$metaKeywords;?>">


<script type="text/javascript" src="http://www.mankar.ca/js/mootools-release-1.11.js"></script>
<script type="text/javascript" src="http://www.mankar.ca/js/slimbox.js"></script>
<script type="text/javascript" src="http://www.mankar.ca/js/SpryAssets/SpryCollapsiblePanel.js"></script>
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="http://www.mankar.ca/js/pngfix.js"></script>
<![endif]-->

<?php if (isset($extraMeta)) echo $extraMeta; ?>