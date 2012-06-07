<title>.::Add Product::.</title>
<?php

include("config.php");

  if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $type_id = $_POST['type_id'];
      $name = $_POST['name'];
      $code = $_POST['code'];
      $description = $_POST['description'];
      $old_name = $_POST['old_name'];
      $old_code = $_POST['old_code'];
      $spray_width = $_POST['spray_width'];
      $nozzles = $_POST['nozzles'];
      $tank = $_POST['tank'];
      $area = $_POST['area'];
      $time = $_POST['time'];
      $weight = $_POST['weight'];


              //check if (title) field is empty then print error message.
              if(!$type_id){  //this means If the title is really empty.
                     echo "Error: Type is a required field. Please fill it.";
                     exit(); //exit the script and don't do anything else.
              }// end of if

         //run the query which adds the data gathered from the form into the database
$result = mysql_query("INSERT INTO products (type_id, name, code, description, old_name, old_code, spray_width, nozzles, tank, area, time, weight) VALUES ('$type_id','$name','$code','$description','$old_name','$old_code','$spray_width','$nozzles','$tank','$area','$time','$weight')");
          //print success message.
          echo "<b>Thank you! Product added Successfully!<br>You'll be redirected to Home Page after (2) Seconds";
          echo "<meta http-equiv=Refresh content=1;url=product.php>";
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else

      ?>
      <br>
      <h3>.::Add Product::.</h3>

      <form method="post" action="">
      Product_Type: <select name=type_id value='type_id'>Product Type</option>
<option value=''>~Type~</option>
<?php
$type = mysql_query('SELECT * FROM product_types ORDER by type');

while($nt=mysql_fetch_array($type)){//Array or records stored in $nt
echo "<option value=$nt[type_id]>$nt[type]</option>";
/* Option values are added by looping through the array */
}
echo "</select>";// Closing of list box 
?>
      <br>
      Product Name: <input name="name" size="40" maxlength="255">
      <br>
      Product Code: <input name="code" size="40" maxlength="255">
      <br>
      Description: <textarea cols="100" rows="8" name="description"></textarea>
      <br>
      Old Name: <input name="old_name" size="40" maxlength="255">
      <br>
      Old Code: <input name="old_code" size="40" maxlength="255">
      <br>
      Spray Width: <input name="spray_width" size="40" maxlength="255">
      <br>
      Nozzles: <input name="nozzles" size="40" maxlength="255">
      <br>
      Total Tank Size: <input name="tank" size="40" maxlength="255">
      <br>
      Spray Area: <input name="area" size="40" maxlength="255">
      <br>
      Working Time: <input name="time" size="40" maxlength="255">
      <br>
		Weight: <input name="weight" size="40" maxlength="255">
      <br>      
      <input type="submit" name="submit" value="Add Product">
      </form>
      <?
  }//end of else
  
  
?>

