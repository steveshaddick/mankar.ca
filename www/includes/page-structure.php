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
			
			case 'information':
				?>

				<div id="sub-navigation">
					<ul class="navlist">
						<li<?php if ($mankarMain->pageLocation[1] == "main-benefits") echo " class='navHighlight'"; ?>><a href="/information"><?php echo NAV_BENEFITS;?></a></li>
						<?php if (isset($mankarMain->hasNav['technology'])) { ?> <li<?php if ($mankarMain->pageLocation[1] == "technology") echo " class='navHighlight'"; ?>><a href="/technology"><?php echo NAV_TECHNOLOGY;?></a></li> <?php } ?>
						<?php if (isset($mankarMain->hasNav['cost-share'])) { ?> <li<?php if ($mankarMain->pageLocation[1] == "cost-share") echo " class='navHighlight'"; ?>><a href="/cost-share"><?php echo NAV_COSTSHARE;?></a></li> <?php } ?>
						<?php if (isset($mankarMain->hasNav['areas-of-application'])) { ?> <li<?php if ($mankarMain->pageLocation[1] == "areas-of-application") echo " class='navHighlight'"; ?>><a href="/areas-of-application"><?php echo NAV_APPLICATION;?></a></li> <?php } ?>
					</ul>
				</div>

				<?php
				break;

			case 'support':
				?>

				<div id="sub-navigation">
					<ul class="navlist">
						<li<?php if ($mankarMain->pageLocation[1] == "tips") echo " class='navHighlight'"; ?>><a href="/support"><?php echo NAV_TIPS;?></a></li>
						<li<?php if ($mankarMain->pageLocation[1] == "manuals") echo " class='navHighlight'"; ?>><a href="/manuals"><?php echo NAV_MANUALS;?></a></li>
						<li<?php if ($mankarMain->pageLocation[1] == "parts") echo " class='navHighlight'"; ?>><a href="/parts"><?php echo NAV_PARTS;?></a></li>
					</ul>
				</div>

				<?php
				break;

		}?>
        

        <?php

        require (PAGE_CONTENT . $mankarMain->pageContent);

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
