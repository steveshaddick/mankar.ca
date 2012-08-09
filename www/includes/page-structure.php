<?php

require_once(dirname(__FILE__).'/../includes/language.php');


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?php echo $mankarMain->lang ?>">
<head>

	<meta name="y_key" content="0b9d701837f52dd6" >
	<meta name="msvalidate.01" content="E3BB9CC2E03F47E4AE9933B1F27FE83D" >
	<meta name="verify-v1" content="zeZ78C8xi39aj2DZSQVNJqtrfcyTJnAqYuSpESNxuDE=" >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	
	<title>Mankar.ca | <?php echo $mankarMain->metaData['title']; ?></title>
	<meta name="description" content="<?php echo $mankarMain->metaData['description']; ?>">
	<meta name="keywords" content="<?php echo $mankarMain->metaData['keywords']; ?>">

	<link rel="stylesheet" type="text/css" href="/css/mankar-style.css" >
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" >
	<link rel="icon" href="/favicon.ico" type="image/gif" >

	<script type="text/javascript" src="/js/mootools-release-1.11.js"></script>
	<script type="text/javascript" src="/js/slimbox.js"></script>
	<script type="text/javascript" src="/js/SpryAssets/SpryCollapsiblePanel.js"></script>
	<!--[if lt IE 7.]>
	<script defer type="text/javascript" src="/js/pngfix.js"></script>
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

		<?php switch ($mankarMain->pageLocation[0]) {
			case "information.php":
				?>
				<h2 class="leftHeading"><?=NAV_INFO;?></h2>
				<ul class="divLeftBox">
				<li<?php if ($subPage == "main-benefits") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=main-benefits'); ?>"><?=NAV_BENEFITS;?></a></li>
				<li<?php if ($subPage == "technology") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=technology'); ?>"><?=NAV_TECHNOLOGY;?></a></li>
				<li<?php if ($subPage == "cost-share") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=cost-share'); ?>"><?=NAV_COSTSHARE;?></a></li>
				<li<?php if ($subPage == "application") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=application'); ?>"><?=NAV_APPLICATION;?></a></li>
				</ul>

				<?php 
				break;

			case "support":
				?>
				<div id="sub-navigation">
					<ul class="navlist">
						<li<?php if ($mankarMain->pageLocation[1] == "tips-manuals") echo " class='navHighlight'"; ?>><a href="/support"><?=NAV_MANUALS;?></a></li>
						<li<?php if ($mankarMain->pageLocation[1] == "parts") echo " class='navHighlight'"; ?>><a href="/parts"><?=NAV_PARTS;?></a></li>
					</ul>
				</div>
				<?php
				break;

		}?>
        

        <?php

        $contentFile = (strpos($mankarMain->pageContent, 'CONTENT_FILE::') !== false) ? str_replace('CONTENT_FILE::', '', $mankarMain->pageContent) : '';

        if ($contentFile !== '') {
			if ($mankarMain->flagLanguage) {
				switch($mankarMain->lang)
				{
					case LANGUAGE_ENGLISH:
						require(ENGLISH_CONTENT.$contentFile);
						break;
						
					case LANGUAGE_FRENCH:
						if (file_exists(FRENCH_CONTENT.$contentFile)) {
							require(FRENCH_CONTENT.$contentFile);
						} else {
							echo "<p class='noLanguage'>".NO_FRENCH."</p>";
							require(ENGLISH_CONTENT.$contentFile);
						}
						break;
						
					case LANGUAGE_SPANISH:
						if (file_exists(SPANISH_CONTENT.$contentFile)) {
							require(SPANISH_CONTENT.$contentFile);
						} else {
							echo "<p class='noLanguage'>".NO_SPANISH."</p>";
							require(ENGLISH_CONTENT.$contentFile);
						}
						break;
				} 
			} else {
				require(GENERAL_CONTENT.$contentFile);
			} 
		} else {
			echo $mankarMain->pageContent;
		}
		?>
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
