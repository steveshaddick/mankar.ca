<title>Delete Event</title>
<?php

//LAST UPDATE
// 30-08-08

include("config.php");
        $custid = $_GET['showid'];
        $result = mysql_query("DELETE FROM tradeshows WHERE showid='$showid' ",$connect);

                     echo "<b>Event Deleted!<br>You'll be redirected to Home Page after (2) Seconds";
                     //header("location: index.php");
                     echo "<meta http-equiv=Refresh content=2;url=index.php>";
?>
