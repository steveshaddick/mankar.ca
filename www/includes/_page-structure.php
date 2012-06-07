<?php

/*
  Copyright (c) 2009 Mankar Ontario Inc.
 
*/
require('doctype.html');
//require('news/wp-blog-header.php');

?>
<html lang="<?php echo $lang ?>">
<head>
	<?php require('meta.php'); ?> 
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
		if ($flagLanguage) {
			switch($lang)
			{
				case LANGUAGE_ENGLISH:
					require(ENGLISH_CONTENT.$pageContent);
					break;
					
				case LANGUAGE_FRENCH:
					if (file_exists(FRENCH_CONTENT.$pageContent)) {
						require(FRENCH_CONTENT.$pageContent);
					} else {
						echo "<p class='noLanguage'>".NO_FRENCH."</p>";
						require(ENGLISH_CONTENT.$pageContent);
					}
					break;
					
				case LANGUAGE_SPANISH:
					if (file_exists(SPANISH_CONTENT.$pageContent)) {
						require(SPANISH_CONTENT.$pageContent);
					} else {
						echo "<p class='noLanguage'>".NO_SPANISH."</p>";
						require(ENGLISH_CONTENT.$pageContent);
					}
					break;
			} 
		} else {
			require(GENERAL_CONTENT.$pageContent);
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
