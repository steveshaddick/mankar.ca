<?php

error_reporting(E_ALL); 
ini_set("display_errors", 1); 

define('IMAGES_LOCATION', '../images/pics/');
define('PARTS_IMAGES_LOCATION', '../images/parts/');
define('THUMBS_LOCATION', '../images/thumbs/');
define('TRADESHOW_LOGO_LOCATION', '../images/tradeshow_logos/');
define('DEALER_LOGO_LOCATION', '../images/dealer_logos/');
define('UPLOAD_LOCATION', '../uploads/');
define('MANUALS_LOCATION', '../manuals/');

function mysql_fetch_fields($table) {
	// LIMIT 1 means to only read rows before row 1 (0-indexed)
	$result = mysql_query("SELECT * FROM $table LIMIT 1");
	$describe = mysql_query("SHOW COLUMNS FROM $table");
	$num = mysql_num_fields($result);
	$output = array();
	for ($i = 0; $i < $num; ++$i) {
			$field = mysql_fetch_field($result, $i);
			// Analyze 'extra' field
			$field->auto_increment = (strpos(mysql_result($describe, $i, 'Extra'), 'auto_increment') === FALSE ? 0 : 1);
			// Create the column_definition
			$field->definition = mysql_result($describe, $i, 'Type');
			if ($field->not_null && !$field->primary_key) $field->definition .= ' NOT NULL';
			if ($field->def) $field->definition .= " DEFAULT '" . mysql_real_escape_string($field->def) . "'";
			if ($field->auto_increment) $field->definition .= ' AUTO_INCREMENT';
			if ($key = mysql_result($describe, $i, 'Key')) {
					if ($field->primary_key) $field->definition .= ' PRIMARY KEY';
					else $field->definition .= ' UNIQUE KEY';
			}
			// Create the field length
			$field->len = mysql_field_len($result, $i);
			// Store the field into the output
			$output[$field->name] = $field;
	}
	return $output;
}

function removeQuotes($string)
{
	$ret = str_replace('"', '&quot;', $string);
	$ret = str_replace("'", '&rsquo;', $ret);
	
	return $ret;
}

require_once('../includes/_connect.php');

$table = (isset($_GET['table'])) ? $_GET['table'] : "";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple CMS for Mankar.ca</title>
<script type="text/javascript" src="js/functions.js"></script>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.3");
</script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		editor_selector : "mceAdvanced",
		plugins : "safari,style,layer,table,advhr,advimage,advlink,iespell,inlinepopups,preview,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
		// Theme options
		theme_advanced_buttons1 : "styleselect,formatselect,fontsizeselect",
		theme_advanced_buttons2 : "bold,italic,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,outdent,indent,blockquote,|,sub,sup,|,link,unlink,anchor,image",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
	
		// Example content CSS (should be your site CSS)
		content_css : "../_test/css/mankar-style.css",
	
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "js/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js"
});
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "simple",
		editor_selector : "mceSimple"
});
</script>

<style type="text/css">

body {margin:25px;}
</style>


</head>

<body>

<h1>Simple CMS for Mankar.ca</h1> 
<a href="http://www.mankar.ca/simple-cms">Home</a> 
<?php if ($table != '') {?>
	- <a href="?table=<?=$table;?>"><?=$table;?></a>
<?php } ?>
<br />

<?php
 	switch ($table)
	{
		case "":
		include 'includes/main.php';
		break;
		
		case "products":
		include 'includes/products.php';
		break;
		
		case "parts":
		include 'includes/parts.php';
		break;
		
		case "product_types":
		include 'includes/product-types.php';
		break;
		
		case "dealers":
		include 'includes/dealers.php';
		break;
		
		case "meta_tags":
		include 'includes/meta-tags.php';
		break;
		
		default:
		echo 'Sorry, this area is not available yet.';
		break;
	}
?>

</body>
</html>
