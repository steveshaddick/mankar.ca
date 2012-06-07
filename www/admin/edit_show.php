<title>Edit Event</title>

<?php

define('TRADESHOW_LOGO_LOCATION', '../images/tradeshow_logos/');
define('UPLOAD_LOCATION', '../uploads/');

include("config.php");

   $showid = $_GET['showid'];

   if(isset($_POST['submit']))
  {
      $showstart = $_POST['showstart'];
      $showend = $_POST['showend'];
      $showname = $_POST['showname'];
      $showlink = $_POST['showlink'];
      $details = $_POST['details'];
	  $details_fr = $_POST['details_fr'];
	  $details_sp = $_POST['details_sp'];
      
	  $city = $_POST['city'];
      $province = $_POST['province'];
      $country = $_POST['country'];
	  
	  if (isset($_POST['deletelogo'])) {
		//unlink();
		$filename = '';
		//echo "deleting photo";
	   } else if (isset($_FILES['logofile'])) {
			if ($_FILES['logofile']['name'] != "") {
				$filename = strtolower(ereg_replace("[^A-Za-z0-9.]", "", basename( $_FILES['logofile']['name'])));
				$filename = substr($filename, 0 , strrpos($filename,"."));
				$filename .= ".jpg";
				
				$targetPath = UPLOAD_LOCATION.$filename;
				
				//make this only upload if the file doesn't exist
				//and delete old file
				
				if(move_uploaded_file($_FILES['logofile']['tmp_name'], $targetPath)) {
					exec("convert $targetPath  -resize 100x100  -quality 80% ".TRADESHOW_LOGO_LOCATION."$filename");
					//echo "uploaded file";
					
				} else{
					echo "There was an error uploading ".$_FILES['logofile']['name']."<br />";
					$filename = '';
				}
			}
		}
	  


         $update = mysql_query("UPDATE tradeshows SET showstart='$showstart', showend='$showend', showname='$showname', showlink='$showlink', details_fr='$details_fr', details_sp='$details_sp',details='$details',city='$city', province='$province', country='$country',logo='$filename' WHERE showid='$showid'", $connect);
echo mysql_errno($connect) . ": " . mysql_error($connect) . "\n";
          echo "<br><b>Thank you! Event UPDATED Successfully!<br>You'll be redirected to Home Page after (2) Seconds";
          echo "<meta http-equiv=Refresh content=2;url=tradeshows.php>";
}
elseif($showid)
{
// include the datepicker class
require ("includes/class.datepicker.php");

// initiate the datepicker object
$dp=new datepicker();

        $result = mysql_query("SELECT * FROM tradeshows WHERE showid='$showid' ");
        while($myrow = mysql_fetch_assoc($result))
             {
      		$showstart = $myrow["showstart"];
      		$showend = $myrow["showend"];
      		$showname = $myrow["showname"];
      		$showlink = $myrow["showlink"];
      		$details = $myrow["details"];
			$details_fr = $myrow["details_fr"];
			$details_sp = $myrow["details_sp"];
      		
			$city = $myrow["city"];
      		$province = $myrow["province"];
      		$country = $myrow["country"];
			$logo = $myrow["logo"];

?>
<br>
<h3>.::Edit Event::.</h3>

<form enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="showid" value="<? echo $myrow['showid']?>">

		Show Start: <input name="showstart" id="showstart" value="<? echo $showstart; ?>"><input type="button" value="..." onclick="<?=$dp->show("showstart")?>">
      <br>
		Show End: <input name="showend" id="showend" value="<? echo $showend; ?>"><input type="button" value="..." onclick="<?=$dp->show("showend")?>">
      <br>
      Show Name: <input name="showname" size="40" maxlength="255" value="<? echo $showname; ?>">
      <br>
      Website: <input name="showlink" size="40" maxlength="255" value="<? echo $showlink; ?>">
      <br>
      Details: <textarea cols="100" rows="8" name="details"><? echo $details; ?></textarea>
      <br>
      Details FR: <textarea cols="100" rows="8" name="details_fr"><? echo $details_fr; ?></textarea>
      <br>
      Details SP: <textarea cols="100" rows="8" name="details_sp"><? echo $details_sp; ?></textarea>
      <br>
      City: <input name="city" size="40" maxlength="255" value="<? echo $city; ?>">
      <br>
      Province: <input name="province" size="40" maxlength="255" value="<? echo $province; ?>">
      <br>
      Country: <input name="country" size="40" maxlength="255" value="<? echo $country; ?>">
      <br>
      <?php if  ($myrow["logo"]!= '') {?><img src="<?=TRADESHOW_LOGO_LOCATION.$myrow["logo"];?>" /><br /><?php } ?>
	  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      Upload new logo:<br />
      <input id="logofile" name="logofile" type="file" /> OR Delete photo:
      <input type="checkbox" id="deletelogo" name="deletelogo" value="deletelogo">
      <hr />


<input type="submit" name="submit" value="Update Event">
</form>
<?
              }//end of while loop

  }//end else
?>

