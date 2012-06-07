<title>Edit Customer</title>

<?php

include("config2.php");

   $custid = $_GET['custid'];

   if(isset($_POST['submit']))
  {
   	$custid = $_POST['custid'];
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


         $update = mysql_query("UPDATE customers SET customer='$customer', contact='$contact', street1='$street1', street2='$street2', city='$city', province='$province', postcode='$postcode', country='$country', phone1='$phone1', phone2='$phone2', fax='$fax', email='$email', website='$website', gps='$gps' WHERE custid='$custid'", $connect);
echo mysql_errno($connect) . ": " . mysql_error($connect) . "\n";
          echo "<br><b>Thank you! Customer UPDATED Successfully!<br>You'll be redirected to Home Page after (2) Seconds";
          echo "<meta http-equiv=Refresh content=2;url=index.php>";
}
elseif($custid)
{

        $result = mysql_query("SELECT * FROM customers WHERE custid='$custid' ");
        while($myrow = mysql_fetch_assoc($result))
             {
      		$customer = $myrow["customer"];
      		$contact = $myrow["contact"];
      		$street1 = $myrow["street1"];
      		$street2 = $myrow["street2"];
      		$city = $myrow["city"];
      		$province = $myrow["province"];
      		$postcode = $myrow["postcode"];
      		$country = $myrow["country"];
      		$phone1 = $myrow["phone1"];
      		$phone2 = $myrow["phone2"];
      		$fax = $myrow["fax"];
      		$email = $myrow["email"];
      		$website = $myrow["website"];
      		$gps = $myrow["gps"];
?>
<br>
<h3>.::Edit Customer::.</h3>

<form method="post" action="<?php echo $PHP_SELF ?>">
<input type="hidden" name="custid" value="<? echo $myrow['custid']?>">

      Customer: <input name="customer" size="40" maxlength="255" value="<? echo $customer; ?>">
      <br>
      Contact: <input name="contact" size="40" maxlength="255" value="<? echo $contact; ?>">
      <br>
      Street 1: <input name="street1" size="40" maxlength="255" value="<? echo $street1; ?>">
      <br>
      Street 2: <input name="street2" size="40" maxlength="255" value="<? echo $street2; ?>">
      <br>
      City: <input name="city" size="40" maxlength="255" value="<? echo $city; ?>">
      <br>
      Province: <input name="province" size="40" maxlength="255" value="<? echo $province; ?>">
      <br>
      Postal Code: <input name="postcode" size="40" maxlength="255" value="<? echo $postcode; ?>">
      <br>
      Country: <input name="country" size="40" maxlength="255" value="<? echo $country; ?>">
      <br>
      Phone 1: <input name="phone1" size="40" maxlength="255" value="<? echo $phone1; ?>">
      <br>
      Phone 2: <input name="phone2" size="40" maxlength="255" value="<? echo $phone2; ?>">
      <br>
      Fax: <input name="fax" size="40" maxlength="255" value="<? echo $fax; ?>">
      <br>
      E-mail: <input name="email" size="40" maxlength="255" value="<? echo $email; ?>">
      <br>
      Website: <input name="website" size="40" maxlength="255" value="<? echo $website; ?>">
      <br>
      GPS coordinates: <input name="gps" size="40" maxlength="255" value="<? echo $gps; ?>">
      <br>
<input type="submit" name="submit" value="Update Customer">
</form>
<?
              }//end of while loop

  }//end else
?>

