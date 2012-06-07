<?php
include("includes/config.php");

echo "<h2>Parts:</h2>";

        //load all news from the database and then ORDER them by newsid
        //you will notice that newlly added news will appeare first.
        //also you can ORDER by (dtime) instaed of (news id)
        $today = date( 'Y-m-d H:i:s' );
        $result = mysql_query("SELECT * FROM parts ORDER BY part_code",$connect);
        //lets make a loop and get all news from the database
        while($myrow = mysql_fetch_array($result))
             {//begin of loop
               //now print the results:
               echo "Part Code: <b>";
               echo $myrow['part_code'];
               echo "</b><br><br>Old Code:";
               echo $myrow['old_code'];
               echo "<br><br>Old AGTEC Code:";
              	echo $myrow['agtec_code'];
               echo "<br><br><b>Description:</b>";
               echo $myrow['description'];
               echo "<br><br><img src='http://www.mankar.ca/pics/parts/";
               echo $myrow['part_code'];
               echo ".jpg'>";
               echo "<br><br><hr>";
             }//end of loop

?>
