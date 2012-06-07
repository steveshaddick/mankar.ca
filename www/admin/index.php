<title>Customer contacts</title>
<?php

//LAST UPDATE
// 27-09-2007


// load the configuration file.
include("config2.php");
?>
<a href=add_cust.php>Add Customer</a>  || <a href=add_contact.php>Add Event</a>  || <a href=todo.php>See To Do List</a>  || <a href=tradeshows.php>Tradeshows</a><br><br><br>
<?php
        //load all news from the database and then OREDER them by newsid
        //you will notice that newlly added news will appeare first.
        //also you can OREDER by (dtime) instaed of (news id)
        $result = mysql_query("SELECT * FROM customers ORDER BY customer",$connect);
        //lets make a loop and get all news from the database
        while($myrow = mysql_fetch_array($result))
             {//begin of loop
               //now print the results:
               echo "<b><a href=\"read_more.php?custid=$myrow[custid]\">";
               echo $myrow['customer'];
               echo "</b> <i>";
               echo $myrow['contact'];
               echo "</i></a>";
               // Now print the options to (Read,Edit & Delete the news)
               echo "  || <a href=\"edit_cust.php?custid=$myrow[custid]\">Edit</a>
                 || <a href=\"delete_cust.php?custid=$myrow[custid]\">Delete</a><br>";
//Now print contact history
$history = mysql_query("SELECT * from contact co LEFT JOIN contacttype ct ON co.contacttypeid = ct.contacttypeid WHERE co.custid = $myrow[custid] order by co.dtime DESC",$connect);
//lets make a loop and get all news from the database
        while($mycontactrow = mysql_fetch_array($history))
             {//begin of contact loop
               //now print the results:
               echo "&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<b><a href=\"read_more.php?custid=$myrow[custid]\">";
	       $datetime = strtotime($mycontactrow['dtime']);
	       echo date("M jS y", $datetime);
               echo "</b> <i>";
               echo $mycontactrow['contacttype'];
               echo "</i></a>&#160;&#160;";
               echo $mycontactrow['followup'];
               echo "&#160;&#160;";
$followuptime = $mycontactrow['followuptime'];
	if ($followuptime != '0000-00-00 00:00:00')
	{
	       $datetime = strtotime($mycontactrow['followuptime']);
	       echo date("M jS y", $datetime);
	}
               echo "  || <a href=\"edit_contact.php?contactid=$mycontactrow[contactid]\">Edit</a>
                 ||<br><br>";
             }//end of contact loop
echo "<hr align=left width=160>";
             }//end of loop
?>
<!-- here you have the right to go Home or Add News. It's HTML not PHP -->
<br><br>
<a href=index.php>Home</a>  || <a href=add_cust.php>Add Customer</a>  || <a href=add_contact.php>Add Event</a>  || <a href=todo.php>See To Do List</a>

