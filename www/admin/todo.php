<title>.::Mankar Ontario ToDo List::.</title>
<?php

//LAST UPDATE
// 27-09-2007


// load the configuration file.
include("config.php");

$todo = mysql_query("SELECT * from contact co LEFT JOIN contacttype ct ON co.contacttypeid = ct.contacttypeid JOIN customers cu ON co.custid = cu.custid ORDER BY co.followuptime",$connect);

//lets make a loop and get all news from the database
        while($mycontactrow = mysql_fetch_array($todo))
             {//begin of contact loop
			$followuptime = $mycontactrow['followuptime'];
			if ($followuptime != '0000-00-00 00:00:00')
			{
               //now print the results:
               echo "<b><a href=\"read_more.php?custid=$mycontactrow[custid]\">";
               echo $mycontactrow['customer'];
               echo "</b> <i>";
               echo $mycontactrow['contact'];
               echo "</i></a>";
		echo '<br><i>';
	       $datetime = strtotime($mycontactrow['followuptime']);
	       echo date("M jS y", $datetime);
		echo '</i><br>';
		echo $mycontactrow['followup'];
               echo "  || <a href=\"edit_contact.php?contactid=$mycontactrow[contactid]\">Edit</a>
                 ||";
	       echo "<br><hr align=left width=160>";
			}//endif
             }//end of loop
?>
<!-- here you have the right to go Home or Add News. It's HTML not PHP -->
<br><br>
<a href=index.php>Home</a> <a href=add_cust.php>Add Customer</a> <a href=add_contact.php>Add Event</a>

