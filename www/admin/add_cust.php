<title>Add Customer</title>
<?php

//LAST UPDATE
// 27-09-2007

include("config2.php");


  if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $customer = $_POST['customer'];
      $contact = $_POST['contact'];
      $street1 = $_POST['street1'];
      $street2 = $_POST['street2'];
      $city = $_POST['city'];
      $province = $_POST['province'];
      $postcode = $_POST['postcode'];
      $country = $_POST['country'];
      $phone1 = $_POST['phone1'];
      $phone2 = $_POST['phone2'];
      $fax = $_POST['fax'];
      $email = $_POST['email'];
      $website = $_POST['website'];
      $gps = $_POST['gps'];

              //check if (title) field is empty then print error message.
              if(!$customer){  //this means If the title is really empty.
                     echo "Error: Customer is a required field. Please fill it.";
                     exit(); //exit the script and don't do anything else.
              }// end of if

         //run the query which adds the data gathered from the form into the database
$result = mysql_query("INSERT INTO customers (customer, dtime, contact, street1, street2, city, province, postcode, country, phone1, phone2, fax, email, website, gps) VALUES ('$customer',NOW(),'$contact','$street1','$street2','$city','$province','$postcode','$country','$phone1','$phone2','$fax','$email','$website','$gps')");
          //print success message.
          echo "<b>Thank you! Customer added Successfully!<br>You'll be redirected to Home Page after (2) Seconds";
          echo "<meta http-equiv=Refresh content=2;url=index.php>";
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else

      ?>
      <br>
      <h3>.::Add Customer::.</h3>

      <form method="post" action="<?php echo $_SERVER[PHP_SELF] ?>">

      Customer: <input name="customer" size="40" maxlength="255">
      <br>
      Contact: <input name="contact" size="40" maxlength="255">
      <br>
      Street 1: <input name="street1" size="40" maxlength="255">
      <br>
      Street 2: <input name="street2" size="40" maxlength="255">
      <br>
      City: <input name="city" size="40" maxlength="255">
      <br>
      Province: <input name="province" size="40" maxlength="255">
      <br>
      Postal Code: <input name="postcode" size="40" maxlength="255">
      <br>
      Country: <input name="country" size="40" maxlength="255">
      <br>
      Phone 1: <input name="phone1" size="40" maxlength="255">
      <br>
      Phone 2: <input name="phone2" size="40" maxlength="255">
      <br>
      Fax: <input name="fax" size="40" maxlength="255">
      <br>
      E-mail: <input name="email" size="40" maxlength="255">
      <br>
      Website: <input name="website" size="40" maxlength="255">
      <br>
      GPS coordinates: <input name="gps" size="40" maxlength="255">
      <br>
      <input type="submit" name="submit" value="Add Customer">
      </form>
      <?
  }//end of else
  
  
?>

