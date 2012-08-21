<?php

if ($action == 'submit'){
	$new = (isset($_GET['new'])) ? $_GET['new'] : "no";
	
	if ($new == 'yes') {
		$query = "INSERT INTO dealers SET ";
	} else {
		$query = "UPDATE dealers SET ";
	}
	
	foreach ($_POST as $key=>$value)
	{
		switch ($key)
		{
			case 'dealer_id':
			case 'cancel':
			case 'active':
			case 'MAX_FILE_SIZE':
			case 'photofile':
			case 'deletephoto':
			break;
			
			case 'website':
				$value = trim($value);
				if (substr($value,0,7) != "http://") {
					$value = "http://".$value;
				}
				$query .= "$key='".$value."',";
			break;
			
			default:
			$query .= "$key='".trim($value)."',";
			break;
		}
	}
	if (isset($_POST['deletephoto'])) {
		//unlink();
		$query .= "logo='',";
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
				exec("convert $targetPath  -resize 75x75  -quality 80% ".DEALER_LOGO_LOCATION."$filename");
		
				$query .= "logo='$filename',";
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
		$query .= " WHERE dealer_id=$dealerId";
	}
	
	if (mysql_query($query)) {
		
		echo '*****************************DEALER UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING DEALER------------------------------------------<br />';
	}
	
	//echo '<br /><br />'.$query;
	
}

$dealers = $cms->getDealersTable();

?>
<a href="/simple-cms/dealers/insert"><b>INSERT NEW DEALER</b></a><br /><br />
<?php
if (count($dealers) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">Dealer ID</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($dealers as $dealer)
    {?>
        <tr>
        <td><a href="/simple-cms/dealers/edit?dealer=<?=$dealer['dealer_id'];?>"><?=$dealer['dealer_id'];?></a></td>
        <td><a href="/simple-cms/dealers/edit?dealer=<?=$dealer['dealer_id'];?>"><?=$dealer['name'];?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?=$dealer['name'];?>?','')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
    <tr>
    <td width="50px"><a href="?table=dealers&page=0">|&lt;</a></td>
    <td width="50px"><a href="?table=dealers&page=<?php if ($page > 0) { echo $page-1; } else {echo 0; }?>">&lt;</a></td>
    <td width="150px">Page <?php echo $page+1;?> of <?=$totalPages;?></td>
    <td width="50px"><a href="?table=dealers&page=<?php if ($page < ($totalPages-1)) { echo $page+1; } else {echo $totalPages-1; }?>">&gt;</a></td>
    <td width="50px"><a href="?table=dealers&page=<?php echo $totalPages-1;?>">&gt;|</a></td>
	</tr>
    </table>
<?php }  else {?>
	No dealers.
<?php } ?>