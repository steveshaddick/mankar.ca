<?php

require_once(dirname(__FILE__).'/../includes/language.php');


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?php echo $mankarMain->lang ?>">
<head>

	<meta name="y_key" content="0b9d701837f52dd6" >
	<meta name="msvalidate.01" content="E3BB9CC2E03F47E4AE9933B1F27FE83D" >
	<meta name="verify-v1" content="zeZ78C8xi39aj2DZSQVNJqtrfcyTJnAqYuSpESNxuDE=" >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	
	<title><?php echo $mankarMain->superTypeUrl; ?> | <?php echo $mankarMain->metaData['title']; ?></title>
	<meta name="description" content="<?php echo $mankarMain->metaData['description']; ?>">
	<meta name="keywords" content="<?php echo $mankarMain->metaData['keywords']; ?>">

	<link rel="stylesheet" type="text/css" href="/css/main.min.css" >
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" >
	<link rel="icon" href="/favicon.ico" type="image/gif" >

	<script type="text/javascript" src="/js/main.min.js"></script>
	<!--[if lt IE 7.]>
	<script defer type="text/javascript" src="/js/pngfix.js"></script>
	<![endif]-->

	<?php echo $mankarMain->metaData['extra']; ?>

</head>
<body>

<div id="container" class="container-<?php echo $mankarMain->pageLocation[0]; ?>">
  
  <?php  require('header.php'); ?>

  <div class="columnWrapper">
	  <div class="contentColumn">
		<?php switch ($mankarMain->pageLocation[0]) {

		case 'information':
			?>

			<div id="sub-navigation">
				<ul class="navlist">
					<li class="navListItem <?php if ($mankarMain->pageLocation[1] == "main-benefits") echo 'navHighlight'; ?>"><a class="subNavLink" href="/information"><?php echo NAV_BENEFITS;?></a></li>
					<?php if (isset($mankarMain->hasNav['technology'])) { ?> <li class="navListItem <?php if ($mankarMain->pageLocation[1] == "technology") echo 'navHighlight'; ?>"><a class="subNavLink" href="/technology"><?php echo NAV_TECHNOLOGY;?></a></li> <?php } ?>
					<?php if (isset($mankarMain->hasNav['cost-share'])) { ?> <li class="navListItem <?php if ($mankarMain->pageLocation[1] == "cost-share") echo 'navHighlight'; ?>"><a class="subNavLink" href="/cost-share"><?php echo NAV_COSTSHARE;?></a></li> <?php } ?>
					<?php if (isset($mankarMain->hasNav['areas-of-application'])) { ?> <li class="navListItem <?php if ($mankarMain->pageLocation[1] == "areas-of-application") echo 'navHighlight'; ?>"><a class="subNavLink" href="/areas-of-application"><?php echo NAV_APPLICATION;?></a></li> <?php } ?>
				</ul>
			</div>

			<?php
			break;

		case 'support':
			?>

			<div id="sub-navigation">
				<ul class="navlist">
					<li class="navListItem <?php if ($mankarMain->pageLocation[1] == "tips") echo 'navHighlight'; ?>"><a class="subNavLink" href="/support"><?php echo NAV_TIPS;?></a></li>
					<li class="navListItem <?php if ($mankarMain->pageLocation[1] == "manuals") echo 'navHighlight'; ?>"><a class="subNavLink" href="/manuals"><?php echo NAV_MANUALS;?></a></li>
					<li class="navListItem <?php if ($mankarMain->pageLocation[1] == "parts") echo 'navHighlight'; ?>"><a class="subNavLink" href="/parts"><?php echo NAV_PARTS;?></a></li>
				</ul>
			</div>

			<?php
			break;

		}?>


		<?php

		require (PAGE_CONTENT . $mankarMain->pageContent);

		?>
	  </div>

	  <div class="leftColumn">
	  	<?php  require('left-side.php'); ?>
	  </div>

	  <div class="rightColumn">
	  	<?php require('right-side.php'); ?> 
	  </div>

	</div>

    <?php require('footer.php'); ?>
</div>
 
</body>
</html>
