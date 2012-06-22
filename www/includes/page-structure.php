<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?php echo $mankarMain->lang ?>">
<head>

	<meta name="y_key" content="0b9d701837f52dd6" >
	<meta name="msvalidate.01" content="E3BB9CC2E03F47E4AE9933B1F27FE83D" >
	<meta name="verify-v1" content="zeZ78C8xi39aj2DZSQVNJqtrfcyTJnAqYuSpESNxuDE=" >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	
	<title>Mankar.ca | <?php echo $mankarMain->metaData['title']; ?></title>
	<meta name="description" content="<?php echo $mankarMain->metaData['description']; ?>">
	<meta name="keywords" content="<?php echo $mankarMain->metaData['keywords']; ?>">

	<link rel="stylesheet" type="text/css" href="css/mankar-style.css" >
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
	<link rel="icon" href="favicon.ico" type="image/gif" >

	<script type="text/javascript" src="js/mootools-release-1.11.js"></script>
	<script type="text/javascript" src="js/slimbox.js"></script>
	<script type="text/javascript" src="js/SpryAssets/SpryCollapsiblePanel.js"></script>
	<!--[if lt IE 7.]>
	<script defer type="text/javascript" src="js/pngfix.js"></script>
	<![endif]-->

	<?php echo $mankarMain->metaData['extra']; ?>

</head>
<body>

<div id="container">
  
  <?php  require('header.php'); ?>
 
  <div class="colmask holygrail">
  <div class="colmid">
    <div class="colleft">
      <div class="col1wrap">
        <div class="col1">
        <?php
		if ($mankarMain->flagLanguage) {
			switch($mankarMain->lang)
			{
				case LANGUAGE_ENGLISH:
					require(ENGLISH_CONTENT.$mankarMain->pageContent);
					break;
					
				case LANGUAGE_FRENCH:
					if (file_exists(FRENCH_CONTENT.$mankarMain->pageContent)) {
						require(FRENCH_CONTENT.$mankarMain->pageContent);
					} else {
						echo "<p class='noLanguage'>".NO_FRENCH."</p>";
						require(ENGLISH_CONTENT.$mankarMain->pageContent);
					}
					break;
					
				case LANGUAGE_SPANISH:
					if (file_exists(SPANISH_CONTENT.$mankarMain->pageContent)) {
						require(SPANISH_CONTENT.$mankarMain->pageContent);
					} else {
						echo "<p class='noLanguage'>".NO_SPANISH."</p>";
						require(ENGLISH_CONTENT.$mankarMain->pageContent);
					}
					break;
			} 
		} else {
			require(GENERAL_CONTENT.$mankarMain->pageContent);
		} ?>
        </div>
       <?php  require('left-side.php'); ?>
      </div>
      <?php require('right-side.php'); 
      ?> 
    </div>
  </div>
</div>
    <?php require('footer.php'); ?>
</div>
</body>
</html>
