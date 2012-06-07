<title>Tradeshows</title>
<?php

//LAST UPDATE
// 30-08-08


// load the configuration file.
include("config.php");
?>
<a href=add_show.php>Add Tradeshow</a>  || <a href=index.php>Admin Home</a><br><br><br>
<?php
        //load all news from the database and then OREDER them by newsid
        //you will notice that newlly added news will appeare first.
        //also you can OREDER by (dtime) instaed of (news id)
        $result = mysql_query("SELECT * FROM tradeshows ORDER BY showstart",$connect);
        //lets make a loop and get all news from the database
        while($myrow = mysql_fetch_array($result))
             {//begin of loop
               //now print the results:
               echo "<b>";
               echo $myrow['showname'];
               echo "</b><br>Starts: <i>";
              	$starts = strtotime($myrow['showstart']);
	       		echo date("M jS y", $starts);
               echo "</i><br>Ends: <i>";
               $ends = strtotime($myrow['showend']);
	       		echo date("M jS y", $ends);
               echo "</i><br>Link: <b>";
               echo $myrow['showlink'];
               echo "</b><br>Details:";
               echo $myrow['details'];
               echo "<br>Place:";
               echo $myrow['city'];
               echo ", ";
               echo $myrow['province'];
               echo ", ";
               echo $myrow['country'];
               echo "<br>";
               // Now print the options to (Read,Edit & Delete the news)
               echo "  || <a href=\"edit_show.php?showid=$myrow[showid]\">Edit</a>
                 || <a href=\"delete_show.php?showid=$myrow[showid]\">Delete</a><br>";

echo "<hr align=left width=160>";
             }//end of loop
?>
<!-- here you have the right to go Home or Add News. It's HTML not PHP -->
<br><br>
<a href=index.php>Home</a>  || <a href=add_cust.php>Add Customer</a>  || <a href=add_contact.php>Add Customer Contact</a>  || <a href=todo.php>See To Do List</a>

