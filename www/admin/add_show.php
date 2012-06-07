<title>Add Show</title>
<?php

//LAST UPDATE
// 30-08-08

include("config.php");


  if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $showstart = $_POST['showstart'];
      $showend = $_POST['showend'];
      $showname = $_POST['showname'];
      $showlink = $_POST['showlink'];
      $details = $_POST['details'];
      $city = $_POST['city'];
      $province = $_POST['province'];
      $country = $_POST['country'];


              //check if (title) field is empty then print error message.
              if(!$showname){  //this means If the title is really empty.
                     echo "Error: Show Name is a required field. Please fill it.";
                     exit(); //exit the script and don't do anything else.
              }// end of if

         //run the query which adds the data gathered from the form into the database
$result = mysql_query("INSERT INTO tradeshows (showstart, showend, showname, showlink, details, city, province, country, dtime) VALUES ('$showstart','$showend','$showname','$showlink','$details','$city','$province','$country',NOW())");
          //print success message.
          echo "<b>Thank you! Event added Successfully!<br>You'll be redirected to Home Page after (2) Seconds";
          echo "<meta http-equiv=Refresh content=2;url=tradeshows.php>";
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
      <h3>.::Add Event::.</h3>

      <form method="post" action="">

      Start of show: <input name="showstart" id="showstart"><input type="button" value="..." onclick="<?=$dp->show("showstart")?>">
      <br>
      End of show: <input name="showend" id="showend"><input type="button" value="..." onclick="<?=$dp->show("showend")?>">
      <br>
      Show Name: <input name="showname" size="40" maxlength="255">
      <br>
      Website: <input name="showlink" size="40" maxlength="255">
      <br>
      Show Details: <textarea cols="100" rows="8" name="details"></textarea>
      <br>
      City: <input name="city" size="40" maxlength="255">
      <br>
      Province: <input name="province" size="40" maxlength="255">
      <br>
      Country: <input name="country" size="40" maxlength="255">
      <br>
      <input type="submit" name="submit" value="Add Event">
      </form>
      <?
  }//end of else
  
  
?>

