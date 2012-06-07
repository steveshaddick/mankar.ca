<?php

//LAST UPDATE
// 30-08-08


// load the configuration file.
include("config.php");

        //load all news from the database and then OREDER them by newsid
        //you will notice that newlly added news will appeare first.
        //also you can OREDER by (dtime) instaed of (news id)
        $today = date( 'Y-m-d H:i:s' );
        $result = mysql_query("SELECT * FROM tradeshows WHERE showend >= '$today' ORDER BY showstart LIMIT 1",$connect);
        //lets make a loop and get all news from the database
        while($myrow = mysql_fetch_array($result))
             {//begin of loop
               //now print the results:
               echo "<h4>Our Next Tradeshow:</h4><a href=\"";
               echo $myrow['showlink'];
               echo "\">";
               echo $myrow['showname'];
               echo "</a><br><i>";
              	$starts = strtotime($myrow['showstart']);
	       		echo date("M jS", $starts);
               echo " - ";
               $ends = strtotime($myrow['showend']);
	       		echo date("M jS, y", $ends);
               echo "</i>";
               echo "<br>";
               echo $myrow['city'];
               echo ", ";
               echo $myrow['province'];
               echo ", ";
               echo $myrow['country'];
//               echo "<br><i><a href=\"mankar_tradeshows.php\">more shows...</a></i>";
             }//end of loop
?>
