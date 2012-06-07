<?php

if ($action == 'submit'){
	$new = (isset($_GET['new'])) ? $_GET['new'] : "no";
	
	if ($new == 'yes') {
		$query = "INSERT INTO parts SET ";
	} else {
		$query = "UPDATE parts SET ";
	}
	
	foreach ($_POST as $key=>$value)
	{
		switch ($key)
		{
			case 'part_id':
			case 'cancel':
			case 'active':
			case 'MAX_FILE_SIZE':
			case 'photofile':
			case 'deletephoto':
			break;
			
			default:
			$query .= "$key='".trim($value)."',";
			break;
		}
	}
	if (isset($_POST['deletephoto'])) {
		//unlink();
		$query .= "photo='',";
		//echo "deleting photo";
	} else if (isset($_FILES['photofile'])) {
		if ($_FILES['photofile']['name'] != "") {
			$filename = strtolower(ereg_replace("[^A-Za-z0-9.]", "", basename( $_FILES['photofile']['name'])));
			$filename = substr($filename, 0 , strrpos($filename,"."));
			$filename .= ".jpg";
			
			$targetPath = UPLOAD_LOCATION.$filename;
			
			//make this only upload if the file doesn't exist
			//and delete old file
			
			if(move_uploaded_file($_FILES['photofile']['tmp_name'], $targetPath)) {
				exec("convert $targetPath  -resize 150x150  -quality 80% ".PARTS_IMAGES_LOCATION."$filename");
		
				$query .= "photo='$filename',";
				//echo "uploaded file";
				
			} else{
				echo "There was an error uploading ".$_FILES['photofile']['name']."<br />";
			}
		}
	}

	if (!isset($_POST['active'])) {
		$query .= "active=0,";
	} else {
		$query .= "active=1,";
	}
	$query = substr($query, 0, strlen($query)-1);
	
	if ($new == 'no') {
		$query .= " WHERE part_id=$partId";
	}
	
	if (mysql_query($query)) {
		
		echo '*****************************PART UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING PART------------------------------------------<br />';
	}
	
	//echo '<br /><br />'.$query;
	
}

$result = mysql_query("SELECT COUNT(*) FROM parts");
$row = mysql_fetch_row($result);
$totalPages = ceil($row[0]/25);


$parts = array();
$result = mysql_query("SELECT part_id,name,part_code FROM parts ORDER BY part_code LIMIT ".($page * 25).",25");
while ($row = mysql_fetch_assoc($result))
{
	$parts[] = $row;
}

?>
<a href="?table=parts&action=insert"><b>INSERT NEW PART</b></a><br /><br />
<?php
if (count($parts) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="150px">Part ID</td><td width="150px">Code</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($parts as $part)
    {?>
        <tr>
        <td><a href="?table=parts&action=edit&part=<?=$part['part_id'];?>"><?=$part['part_id'];?></a></td>
        <td><a href="?table=parts&action=edit&part=<?=$part['part_id'];?>"><?=$part['part_code'];?></a></td>
        <td><a href="?table=parts&action=edit&part=<?=$part['part_id'];?>"><?=$part['name'];?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?=$part['name'];?>?','?table=parts&page=<?=$page;?>&action=delete&part=<?=$part['part_id'];?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
    <tr>
    <td width="50px"><a href="?table=parts&page=0">|&lt;</a></td>
    <td width="50px"><a href="?table=parts&page=<?php if ($page > 0) { echo $page-1; } else {echo 0; }?>">&lt;</a></td>
    <td width="150px">Page <?php echo $page+1;?> of <?=$totalPages;?></td>
    <td width="50px"><a href="?table=parts&page=<?php if ($page < ($totalPages-1)) { echo $page+1; } else {echo $totalPages-1; }?>">&gt;</a></td>
    <td width="50px"><a href="?table=parts&page=<?php echo $totalPages-1;?>">&gt;|</a></td>
	</tr>
    </table>
<?php }  else {?>
	No parts.
<?php } ?>