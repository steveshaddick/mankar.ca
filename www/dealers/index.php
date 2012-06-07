<?php
// PHP File Tree Demo
// For documentation and updates, visit http://abeautifulsite.net/notebook.php?article=21

// Main function file
include("../dealers_include/php_file_tree.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Mankar Ontario Dealer Resources</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link href="../dealers_include/styles/default/default.css" rel="stylesheet" type="text/css" media="screen" />
		
		<!-- Makes the file tree(s) expand/collapsae dynamically -->
		<script src="../dealers_include/jquery-1.3.2.js" type="text/javascript"></script>
		<script src="../dealers_include/php_file_tree_jquery.js" type="text/javascript"></script>
	</head>

	<body>
	
		<h1>Mankar Ontario Dealer Resources</h1>
	
		<p>
			You can download any of the following:
		</p>
		
		
		<hr />
		
		<h2>Browsing...</h2>
		
		<?php
		
		// This links the user to http://example.com/?file=filename.ext
		//echo php_file_tree(".", "[link]"); 
		echo php_file_tree($_SERVER['DOCUMENT_ROOT']."/dealers/material/","http://www.mankar.ca/dealers/material/[link]");
		//echo php_file_tree($_SERVER['DOCUMENT_ROOT']."/dealers/material/", "http://www.mankar.ca/?file=[link]/");

		// This links the user to http://example.com/?file=filename.ext and only shows image files
		//$allowed_extensions = array("gif", "jpg", "jpeg", "png");
		//echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "http://example.com/?file=[link]/", $allowed_extensions);
		
		// This displays a JavaScript alert stating which file the user clicked on
		//echo php_file_tree($_SERVER['DOCUMENT_ROOT']."/dealers/material/", "javascript:alert('You clicked on [link]');");
		echo $urlToExplode;
		?>
		
	</body>
	
</html>
