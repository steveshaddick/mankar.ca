<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple CMS for Mankar.ca</title>

<link rel="stylesheet" href="/css/ui-lightness/jquery-ui-1.8.23.custom.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/js/simple-cms/functions.js"></script>
<script src="/js/jquery/jquery-ui-1.8.23.custom.min.js"></script>

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
		content_css : "/css/mankar-style.css",
	
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

	.expander {
		cursor: pointer;
	}
	.expander:hover {
		font-weight: bold;
	}

	.expanderWrapper {
		height:0px;
		overflow: hidden;

		transition: height 0.5s;
		-moz-transition: height 0.5s; /* Firefox 4 */
		-webkit-transition: height 0.5s; /* Safari and Chrome */
		-o-transition: height 0.5s; /* Opera */
	}

</style>


</head>

<body>

<h1>Simple CMS for Mankar.ca</h1>
<span>Supertypes: 1=mankarulv.com, 2=mafexulv.com, 3=rofaulv.com, 4=mantisulv.com</span><br />

<a href="/simple-cms">Home</a> 
<?php
if ($auth->authenticated) {
	?>
	&nbsp;&nbsp;&nbsp;&nbsp;<a href="/simple-cms/logout">Logout</a> <br />
	<?php
}
?>

<?php
 	require(BASE_PATH."/views/simple-cms/$content");
?>

</body>
</html>