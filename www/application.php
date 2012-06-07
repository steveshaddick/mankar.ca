<?php
/*
   Copyright (c) 2009 Mankar Ontario Inc.
 
*/
require('includes/doctype.html');
require('news/wp-blog-header.php');
require('includes/lang_session.php');

?>
<html lang="<?php echo $lang ?>">
<head>
	<?php require('includes/'.$lang.'/meta.php'); ?>
	<title><?php echo $applicationTitle ?></title>
	<meta name="description" content="<?php echo $applicationDescription ?>">
	<meta name="keywords" content="<?php echo $applicationKeywords ?>">
	<?php require('includes/scripts.html'); ?>
    
</head>
<body>

<div id="container">
  <?php include 'includes/header.php'; ?>
  <div class="colmask holygrail">
  <div class="colmid">
    <div class="colleft">
      <div class="col1wrap">
        <div class="col1">
         <?php require('includes/'.$lang.'/contentApplication.html'); ?>
        </div>
       <?php require('includes/'.$lang.'/navigation.php'); ?> 
      </div>
      <?php require('includes/newscolumn.php'); ?> 
    </div>
  </div>
</div>
    <?php require('includes/'.$lang.'/footer.php'); ?>
</div>
	<?php require('includes/endscript.php'); ?>
</body>
</html>