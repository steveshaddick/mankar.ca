<title>hotnews</title>
<?php

//LAST UPDATE
// 27-09-2007

include("config.php");
        $newsid = $_GET['newsid'];
        $result = mysql_query("DELETE FROM news WHERE newsid='$newsid' ",$connect);

                     echo "<b>News Deleted!<br>You'll be redirected to Home Page after (4) Seconds";
                     //header("location: index.php");
                     echo "<meta http-equiv=Refresh content=4;url=index.php>";
?>
