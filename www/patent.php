<?php
/*
  $Id: ultralowvolume.php
  http://www.mankar.ca

  Copyright (c) 2008 Mankar Ontario Inc.
 
*/
require('includes/doctype.html');
require('includes/lang_session.php');
?>
<html>
<head>
<?php require('includes/'.$lang.'/meta.html'); ?>
<title><?php echo $patenttitle ?></title>
<meta name="description" content="<?php echo $patentdescription ?>">
<meta name="keywords" content="<?php echo $patentkeywords ?>">
</head>
<body>
<?php require('includes/scripts.html'); ?>
<!-- header //-->
<?php require('includes/header.php'); ?>
<!-- header_eof //-->

<!-- left_navigation //-->
<div id="lh-col"><br>
<div id="navcontainer">
<?php require('includes/'.$lang.'/lh-col.html'); ?>
</div>
</div>
<!-- left_navigation_eof //-->

<!-- body_text //-->
<div id="rh-col">
<?php require('includes/'.$lang.'/patent.html'); ?>
</div>
<!-- body_text_eof //-->
<?php require('includes/'.$lang.'/googlescript.html'); ?>
</body>
</html>
<?php 
?>