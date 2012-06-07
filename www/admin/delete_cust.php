<title>Delete Customer</title>
<?php

//LAST UPDATE
// 27-09-2007

include("config2.php");
        $custid = $_GET['custid'];
        $result = mysql_query("DELETE FROM customers WHERE custid='$custid' ",$connect);

                     echo "<b>Customer Deleted!<br>You'll be redirected to Home Page after (2) Seconds";
                     //header("location: index.php");
                     echo "<meta http-equiv=Refresh content=2;url=index.php>";
?>
