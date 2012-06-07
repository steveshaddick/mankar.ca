<title>Edit Customer</title>

<?php

include("config2.php");

   $contactid = $_GET['contactid'];

   if(isset($_POST['submit']))
  {
      $contactid = $_POST['contactid'];
      $followup = $_POST['followup'];
      $followuptime = $_POST['followuptime'];


         $update = mysql_query("UPDATE contact SET followup='$followup', followuptime='$followuptime' WHERE contactid='$contactid'", $connect);
echo mysql_errno($connect) . ": " . mysql_error($connect) . "\n";
          echo "<br><b>Thank you! Customer UPDATED Successfully!<br>You'll be redirected to Home Page after (2) Seconds";
          echo "<meta http-equiv=Refresh content=2;url=index.php>";
}
elseif($contactid)
{
// include the datepicker class
require ("includes/class.datepicker.php");

// initiate the datepicker object
$dp=new datepicker();
        $result = mysql_query("SELECT * FROM contact co LEFT JOIN contacttype ct ON co.contacttypeid = ct.contacttypeid LEFT JOIN customers cu ON co.custid = cu.custid WHERE contactid='$contactid' ");
        while($myrow = mysql_fetch_assoc($result))
             {
      		$followup = $myrow["followup"];
      		$followuptime = $myrow["followuptime"];
?>
<br>
<h3>.::Edit Contact::.</h3><br>
<?php
		echo '<b><br>Contact Date: </b>';
	       $datetime = strtotime($myrow['dtime']);
	       echo date("M jS y", $datetime);
		echo '<b><br>Contact Type: </b>';
		echo $myrow['contacttype'];
		echo '<b><br>Talked to: </b>';
		echo $myrow['talkedto'];
		echo '<b><br>Details: </b>';
		echo $myrow['details'];
?>
<br><br>
<form method="post" action="<?php echo $PHP_SELF ?>">
<input type="hidden" name="contactid" value="<? echo $myrow['contactid']?>">

      Proposed Follow Up: <textarea cols="100" rows="8" name="followup"><? echo $followup; ?></textarea>
      <br>
      Date of Proposed Followup (can be approximate): <input name="followuptime" id="followuptime" value="<? echo $followuptime; ?>"><input type="button" value="..." onclick="<?=$dp->show("followuptime")?>">
      
<br><br><input type="submit" name="submit" value="Update Contact">
</form>
<?
              }//end of while loop

  }//end elseif
?>

