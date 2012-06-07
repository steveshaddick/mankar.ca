<title>Customer Details...</title>
<?php


include("config2.php");
echo "<a href=\"javascript:self.history.back();\"><-- Go Back</a><br><br>";
        $custid = $_GET['custid'];
        
        $result = mysql_query("SELECT * FROM customers WHERE custid='$custid' ",$connect);
        while($myrow = mysql_fetch_assoc($result))
             {
echo 'Customer: <b>';
echo $myrow['customer'];
echo '</b><br>Contact: <b>'; 
echo $myrow['contact'];
echo '</b><br>Street 1: <b>'; 
echo $myrow['street1'];
echo '</b><br>Street 2: <b>'; 
echo $myrow['street2'];
echo '</b><br>City: <b>'; 
echo $myrow['city'];
echo '</b><br>Province: <b>'; 
echo $myrow['province'];
echo '</b><br>Postal Code: <b>'; 
echo $myrow['postcode'];
echo '</b><br>Country: <b>'; 
echo $myrow['country'];
echo '</b><br>Phone 1: <b>'; 
echo $myrow['phone1'];
echo '</b><br>Phone 2: <b>'; 
echo $myrow['phone2'];
echo '</b><br>Fax: ';
echo $myrow['fax'];
echo '</b><br>E-mail: <b>'; 
echo $myrow['email'];
echo '</b><br>Website: <b>'; 
echo $myrow['website'];
echo '</b><br>GPS coordinates: <b>'; 
echo $myrow['gps'];
echo '</b><br>';
               echo "  || <a href=\"edit_cust.php?custid=$myrow[custid]\">Edit</a>
                 || <a href=\"delete_cust.php?custid=$myrow[custid]\">Delete</a><br>";
echo "<br><hr align=left width=160>";
//Now print contact history
$history = mysql_query("SELECT * from contact co LEFT JOIN contacttype ct ON co.contacttypeid = ct.contacttypeid WHERE co.custid = $myrow[custid] order by co.dtime DESC",$connect);
//lets make a loop and get all news from the database
        while($mycontactrow = mysql_fetch_array($history))
             {//begin of contact loop
               //now print the results:
echo '<b><br>Contact Date: </b>';
	       $datetime = strtotime($mycontactrow['dtime']);
	       echo date("M jS y", $datetime);
echo '<b><br>Contact Type: </b>';
echo $mycontactrow['contacttype'];
echo '<b><br>Talked to: </b>';
echo $mycontactrow['talkedto'];
echo '<b><br>Details: </b>';
echo $mycontactrow['details'];
echo '<b><br>Proposed Follow Up: </b>';
echo $mycontactrow['followup'];
echo '<b><br>Proposed Follow Up Date: </b>';
	       $datetime = strtotime($mycontactrow['followuptime']);
	       echo date("M jS y", $datetime);
               echo "<br>  || <a href=\"edit_contact.php?contactid=$mycontactrow[contactid]\">Edit</a>
                 ||<br><br>";
	       echo "<br><hr align=left width=160>";
             }//end of contact loop

echo "<br><br><a href=\"javascript:self.history.back();\"><-- Go Back</a>";
             }
?>
