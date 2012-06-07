<?php

switch ($lang) { 
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
	

	switch ($lang) { 
		case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
		case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
	}


echo "<h2>".UPCOMING_TRADESHOWS.":</h2>";

        //load all news from the database and then OREDER them by newsid
        //you will notice that newlly added news will appeare first.
        //also you can OREDER by (dtime) instaed of (news id)
        $today = date( 'Y-m-d H:i:s' );
	$lastyear = mktime(0, 0, 0, date("m"), date("d"), date("Y")-1);
	$lastyeartoday = date("Y-m-d H:i:s",$lastyear);
        $result = mysql_query("SELECT * FROM tradeshows WHERE showend >= '$today' ORDER BY showstart");
        //lets make a loop and get all news from the database
        while($myrow = mysql_fetch_array($result))
             {//begin of loop
               //now print the results:
               if ($myrow['logo'] != '') {
			   ?>
              <a href="<?=$myrow['showlink']?>" target="_blank"> <img class="imgTradeshow" src="<?=TRADESHOW_LOGO_LOCATION.$myrow['logo'];?>" /></a>
               <?php
			   }
			   echo "<a href=\"";
               echo $myrow['showlink'];
               echo "\">";
               echo $myrow['showname'];
               echo "</a><br><i>";
              	$starts = strtotime($myrow['showstart']);
	       		echo date("M jS", $starts);
               echo " - ";
               $ends = strtotime($myrow['showend']);
	       		echo date("M jS, Y", $ends);
               echo "</i>";
               echo "<br>";
               echo $myrow['city'];
               echo ", ";
               echo $myrow['province'];
               echo ", ";
               echo $myrow['country'];
               echo "<br clear='both'><p class='tradeShowDescription'>";
			   switch ($lang) { 
					case LANGUAGE_ENGLISH : echo $myrow['details']; break;
					case LANGUAGE_FRENCH : if ($myrow['details_fr'] != '') echo $myrow['details_fr']; else echo $myrow['details']; break;
					case LANGUAGE_SPANISH : if ($myrow['details_sp'] != '') echo $myrow['details_sp']; else echo $myrow['details']; break;
			   }
               echo "</p><br /><hr><br />";
             }//end of loop
echo "<h2>".PAST_TRADESHOWS.":</h2>";             
        $resultold = mysql_query("SELECT * FROM tradeshows WHERE showend < '$today' AND showend >= '$lastyeartoday' ORDER BY showstart DESC");
        //lets make a loop and get all old shows from the database
        while($myrow = mysql_fetch_array($resultold))
             {//begin of loop
               //now print the results:
			   if ($myrow['logo'] != '') {
			   ?>
               <a href="<?=$myrow['showlink']?>" target="_blank"><img class="imgTradeshow" src="<?=TRADESHOW_LOGO_LOCATION.$myrow['logo'];?>" /></a>
               <?php
			   }
               echo "<a target=\"_blank\" href=\"";
               echo $myrow['showlink'];
               echo "\">";
               echo $myrow['showname'];
               echo "</a><br><i>";
              	$starts = strtotime($myrow['showstart']);
	       		echo date("M jS", $starts);
               echo " - ";
               $ends = strtotime($myrow['showend']);
	       		echo date("M jS, Y", $ends);
               echo "</i>";
               echo "<br>";
               echo $myrow['city'];
               echo ", ";
               echo $myrow['province'];
               echo ", ";
               echo $myrow['country'];
               echo "<br clear='both'><p class='tradeShowDescription'>";
               switch ($lang) { 
					case LANGUAGE_ENGLISH : echo $myrow['details']; break;
					case LANGUAGE_FRENCH : if ($myrow['details_fr'] != '') echo $myrow['details_fr']; else echo $myrow['details']; break;
					case LANGUAGE_SPANISH : if ($myrow['details_sp'] != '') echo $myrow['details_sp']; else echo $myrow['details']; break;
			   }
               echo "</p><br /><hr><br />";
             }//end of loop
	//this is for shows older than one year, no hyperlink          
        $resultolder = mysql_query("SELECT * FROM tradeshows WHERE showend < '$lastyeartoday' ORDER BY showstart DESC");
        //lets make a loop and get all older shows from the database
        while($myrow = mysql_fetch_array($resultolder))
             {//begin of loop
               //now print the results:
			   if ($myrow['logo'] != '') {
			   ?>
               <img class="imgTradeshow" src="<?=TRADESHOW_LOGO_LOCATION.$myrow['logo'];?>" />
               <?php
			   }
               echo $myrow['showname'];
               echo "<br><i>";
              	$starts = strtotime($myrow['showstart']);
	       		echo date("M jS", $starts);
               echo " - ";
               $ends = strtotime($myrow['showend']);
	       		echo date("M jS, Y", $ends);
               echo "</i>";
               echo "<br>";
               echo $myrow['city'];
               echo ", ";
               echo $myrow['province'];
               echo ", ";
               echo $myrow['country'];
               echo "<br clear='both'><p class='tradeShowDescription'>";
               switch ($lang) { 
					case LANGUAGE_ENGLISH : echo $myrow['details']; break;
					case LANGUAGE_FRENCH : if ($myrow['details_fr'] != '') echo $myrow['details_fr']; else echo $myrow['details']; break;
					case LANGUAGE_SPANISH : if ($myrow['details_sp'] != '') echo $myrow['details_sp']; else echo $myrow['details']; break;
			   }
               echo "</p><br /><hr><br />";
             }//end of loop
?>
