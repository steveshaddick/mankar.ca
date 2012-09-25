<?php

  switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  
			define('UPCOMING_TRADESHOWS', 'Upcoming Tradeshows');
			define('PAST_TRADESHOWS', 'Past Tradeshows');
			break;
		case LANGUAGE_FRENCH :  
			define('UPCOMING_TRADESHOWS', 'Upcoming Tradeshows');
			define('PAST_TRADESHOWS', 'Past Tradeshows');
			break;
		case LANGUAGE_SPANISH :  
			define('UPCOMING_TRADESHOWS', 'Listado de Proximas Feria Comerciales');
			define('PAST_TRADESHOWS', 'Past Tradeshows');
			break;
	} 
	

	switch ($mankarMain->lang) { 
		case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
		case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
	}

  $tradeshows = $mankarMain->getTradeshows();

?>
<div class="padContent">
  <h1><?php echo UPCOMING_TRADESHOWS; ?></h1>

  <?php      
  foreach ($tradeshows['upcoming'] as $tradeshow) {
    ?>
    
    <div class="tradeshowItem">
      <?php
      if ($tradeshow['logo'] != '') {
        //TODO check for missing link
        //TODO add back to top
        ?>
        <a href="<?php echo $tradeshow['website']?>" target="_blank"> <img class="imgTradeshow" src="<?php echo TRADESHOW_LOGO_LOCATION.$tradeshow['logo'];?>" /></a>
        <?php
      }
      ?>

      <a class="tradeshowTitle" href="<?php echo $tradeshow['website'] ?>" target="_blank"><?php echo $tradeshow['showname']; ?></a><br />
      <i><?php echo date("M jS", strtotime($tradeshow['showstart'])); ?> - <?php echo date("M jS, Y", strtotime($tradeshow['showend'])); ?></i><br />
      <?php echo $tradeshow['city'] . ", " . $tradeshow['province'] . ", " . $tradeshow['country']; ?><br class="clear" />
      
      <p class="tradeshowDescription">
        <?php
        switch ($mankarMain->lang) { 
          case LANGUAGE_ENGLISH : echo $tradeshow['details']; break;
          case LANGUAGE_FRENCH : if ($tradeshow['details_fr'] != '') echo $tradeshow['details_fr']; else echo $tradeshow['details']; break;
          case LANGUAGE_SPANISH : if ($tradeshow['details_sp'] != '') echo $tradeshow['details_sp']; else echo $tradeshow['details']; break;
        }
        ?>
        </p>
      </div>
    <?php
  }
  ?>

  <h1><?php echo PAST_TRADESHOWS; ?></h1>           

  <?php
  foreach ($tradeshows['recent'] as $tradeshow) {
    ?>

    <div class="tradeshowItem">
      <?php
      if ($tradeshow['logo'] != '') {
        ?>
        <a href="<?php echo $tradeshow['website']?>" target="_blank"> <img class="imgTradeshow" src="<?php echo TRADESHOW_LOGO_LOCATION.$tradeshow['logo'];?>" /></a>
        <?php
      }
      ?>
      <a class="tradeshowTitle" href="<?php echo $tradeshow['website'] ?>"><?php echo $tradeshow['showname']; ?></a><br />
      <i><?php echo date("M jS", strtotime($tradeshow['showstart'])); ?> - <?php echo date("M jS, Y", strtotime($tradeshow['showend'])); ?></i><br />
      <?php echo $tradeshow['city'] . ", " . $tradeshow['province'] . ", " . $tradeshow['country']; ?><br class="clear" />
      
      <p class="tradeshowDescription">
        <?php
        switch ($mankarMain->lang) { 
          case LANGUAGE_ENGLISH : echo $tradeshow['details']; break;
          case LANGUAGE_FRENCH : if ($tradeshow['details_fr'] != '') echo $tradeshow['details_fr']; else echo $tradeshow['details']; break;
          case LANGUAGE_SPANISH : if ($tradeshow['details_sp'] != '') echo $tradeshow['details_sp']; else echo $tradeshow['details']; break;
        }
        ?>
        </p>
      </div>
    <?php
  }
  ?>

  <?php
  //this is for shows older than one year, no hyperlink
  foreach ($tradeshows['oneYear'] as $tradeshow) {
    if ($tradeshow['logo'] != '') {
      ?>
      <img class="imgTradeshow" src="<?php echo TRADESHOW_LOGO_LOCATION.$tradeshow['logo'];?>" />
      <?php
    }
    ?>
    <div class="tradeshowItem">
      <span class="tradeshowTitle"><?php echo $tradeshow['showname']; ?></span><br />
      <i><?php echo date("M jS", strtotime($tradeshow['showstart'])); ?> - <?php echo date("M jS, Y", strtotime($tradeshow['showend'])); ?></i><br />
      <?php echo $tradeshow['city'] . ", " . $tradeshow['province'] . ", " . $tradeshow['country']; ?><br clear="both" />
      
      <p class="tradeshowDescription">
        <?php
        switch ($mankarMain->lang) { 
          case LANGUAGE_ENGLISH : echo $tradeshow['details']; break;
          case LANGUAGE_FRENCH : if ($tradeshow['details_fr'] != '') echo $tradeshow['details_fr']; else echo $tradeshow['details']; break;
          case LANGUAGE_SPANISH : if ($tradeshow['details_sp'] != '') echo $tradeshow['details_sp']; else echo $tradeshow['details']; break;
        }
        ?>
        </p>
      </div>
    <?php
  }
  ?>
</div>