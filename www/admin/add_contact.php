<title>.::Add Details of Contact::.</title>
<?php

include("config2.php");

  if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $custid = $_POST['custid'];
      $date = $_POST['date'];
      $talkedto = $_POST['talkedto'];
      $contacttype = $_POST['contacttype'];
      $details = $_POST['details'];
      $followup = $_POST['followup'];
      $postcode = $_POST['postcode'];
      $followuptime = $_POST['followuptime'];


              //check if (title) field is empty then print error message.
              if(!$custid){  //this means If the title is really empty.
                     echo "Error: Customer is a required field. Please fill it.";
                     exit(); //exit the script and don't do anything else.
              }// end of if

         //run the query which adds the data gathered from the form into the database
$result = mysql_query("INSERT INTO contact (custid, dtime, talkedto, contacttypeid, details, followup, followuptime) VALUES ('$custid','$date','$talkedto','$contacttype','$details','$followup','$followuptime')");
          //print success message.
          echo "<b>Thank you! Contact History added Successfully!<br>You'll be redirected to Home Page after (2) Seconds";
          echo "<meta http-equiv=Refresh content=2;url=index.php>";
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else
// include the datepicker class
require ("includes/class.datepicker.php");

// initiate the datepicker object
$dp=new datepicker();

      ?>
      <br>
      <h3>.::Add Details of Contact::.</h3>

      <form method="post" action="">
      Customer: <select name=custid value='custid'>Customer</option>
<option value=''>~Customer~</option>
<?php
$datacity = mysql_query('SELECT * FROM customers ORDER by customer');

while($nt=mysql_fetch_array($datacity)){//Array or records stored in $nt
echo "<option value=$nt[custid]>$nt[customer]</option>";
/* Option values are added by looping through the array */
}
echo "</select>";// Closing of list box 
?>
      <br>
      Date of Contact: <input name="date" id="date"><input type="button" value="..." onclick="<?=$dp->show("date")?>">
      <br>
      Talked To: <input name="talkedto" size="40" maxlength="255">
      <br>
      Contact Type: <select name=contacttype value='contacttype'>Contact Type</option>
<option value=''>~Contact Type~</option>
<?php
$datacontacttype = mysql_query('SELECT * FROM contacttype ORDER by contacttype');

while($nt=mysql_fetch_array($datacontacttype)){//Array or records stored in $nt
echo "<option value=$nt[contacttypeid]>$nt[contacttype]</option>";
/* Option values are added by looping through the array */
}
echo "</select>";// Closing of list box 
?>
      <br>
      Details: <textarea cols="100" rows="8" name="details"></textarea>
      <br>
      What should we do to follow up?: <textarea cols="100" rows="8" name="followup"></textarea>
      <br>
      Date of Proposed Followup (can be approximate): <input name="followuptime" id="followuptime"><input type="button" value="..." onclick="<?=$dp->show("followuptime")?>">
      <br>
      <input type="submit" name="submit" value="Add Contact Info">
      </form>
      <?
  }//end of else
  
  
?>

