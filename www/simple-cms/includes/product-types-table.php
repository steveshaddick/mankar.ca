<?php

if ($action == 'submit'){
	$new = (isset($_GET['new'])) ? $_GET['new'] : "no";
	
	if ($new == 'yes') {
		$query = "INSERT INTO product_types SET ";
	} else {
		$query = "UPDATE product_types SET ";
	}
	
	foreach ($_POST as $key=>$value)
	{
		switch ($key)
		{
			case 'product_type_id':
			case 'cancel':
			case 'active':
			case 'deletephoto':
			case 'MAX_FILE_SIZE':
			case 'photofile':
			case 'deletephoto':
			case 'meta_title':
			case 'meta_description':
			case 'meta_keywords':
			case 'meta_title_fr':
			case 'meta_description_fr':
			case 'meta_keywords_fr':
			case 'meta_title_sp':
			case 'meta_description_sp':
			case 'meta_keywords_sp':
			case 'pretty_url':
			break;
			
			default:
			$query .= "$key='".trim($value)."',";
			break;
		}
	}
	if (isset($_POST['deletephoto'])) {
		//unlink();
		$query .= "thumbnail='',";
		//echo "deleting photo";
	} else if (isset($_FILES['photofile'])) {
		if ($_FILES['photofile']['name'] != "") {
			$filename = strtolower(ereg_replace("[^A-Za-z0-9.]", "", basename( $_FILES['photofile']['name'])));
			$filename = substr($filename, 0 , strrpos($filename,"."));
			$filename .= ".jpg";
			
			$targetPath = UPLOAD_LOCATION.$filename;
			
			//make this only upload if the file doesn't exist
			//and delete old file
			
			if (!file_exists(THUMBS_LOCATION.'$filename')) {
				if(move_uploaded_file($_FILES['photofile']['tmp_name'], $targetPath)) {
					exec("convert $targetPath  -resize 150x150  -quality 80% ".THUMBS_LOCATION."$filename");
	
					$query .= "thumbnail='$filename',";
					//echo "uploaded file";
					
				} else{
					echo "There was an error uploading ".$_FILES['photofile']['name']."<br />";
				}
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
		$query .= " WHERE type_id=$productTypeId";
	}
	
	//echo '<br /><br />'.$query;
	if (mysql_query($query)) {
		if ($new == 'yes') {
			$productTypeId = mysql_insert_id();
		} 
		echo '*****************************PRODUCT TYPE UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING PRODUCT TYPE------------------------------------------<br />';
	}
	
	if ($new == 'yes') {
		$query = "INSERT INTO meta_tags SET ";
	} else {
		$query = "UPDATE meta_tags SET ";
	}	
	$query .= "pretty_url='".$_POST['pretty_url']."',";
	$query .= "actual_url='products.php?type=$productTypeId',";
	$query .= "meta_title='".$_POST['meta_title']."',";
	$query .= "meta_description='".$_POST['meta_description']."',";
	$query .= "meta_keywords='".$_POST['meta_keywords']."',";
	$query .= "meta_title_fr='".$_POST['meta_title_fr']."',";
	$query .= "meta_description_fr='".$_POST['meta_description_fr']."',";
	$query .= "meta_keywords_fr='".$_POST['meta_keywords_fr']."',";
	$query .= "meta_title_sp='".$_POST['meta_title_sp']."',";
	$query .= "meta_description_sp='".$_POST['meta_description_sp']."',";
	$query .= "meta_keywords_sp='".$_POST['meta_keywords_sp']."'";
	if ($new == 'yes') {
		$query = ",page='product_types',related_id=$productTypeId";
	} else {
		$query .= " WHERE related_id=$productTypeId AND page='product_types'";
	}
	mysql_query($query);

}

$result = mysql_query("SELECT COUNT(*) FROM product_types");
$row = mysql_fetch_row($result);
$totalPages = ceil($row[0]/25);

$productTypes = array();
$result = mysql_query("SELECT type_id,name FROM product_types ORDER BY name LIMIT ".($page * 25).",25");
while ($row = mysql_fetch_assoc($result))
{
	$productTypes[] = $row;
}

?>
<a href="?table=product_types&action=insert"><b>INSERT NEW PRODUCT TYPE</b></a><br /><br />
<?php
if (count($productTypes) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">Product Type ID</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($productTypes as $productType)
    {?>
        <tr>
        <td><a href="?table=product_types&action=edit&productType=<?=$productType['type_id'];?>"><?=$productType['type_id'];?></a></td>
        <td><a href="?table=product_types&action=edit&productType=<?=$productType['type_id'];?>"><?=$productType['name'];?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?=$productType['name'];?>?','?table=product_types&page=<?=$page;?>&action=delete&productType=<?=$productType['type_id'];?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
    <tr>
    <td width="50px"><a href="?table=product_types&page=0">|&lt;</a></td>
    <td width="50px"><a href="?table=product_types&page=<?php if ($page > 0) { echo $page-1; } else {echo 0; }?>">&lt;</a></td>
    <td width="150px">Page <?php echo $page+1;?> of <?=$totalPages;?></td>
    <td width="50px"><a href="?table=product_types&page=<?php if ($page < ($totalPages-1)) { echo $page+1; } else {echo $totalPages-1; }?>">&gt;</a></td>
    <td width="50px"><a href="?table=product_types&page=<?php echo $totalPages-1;?>">&gt;|</a></td>
	</tr>
    </table>
<?php }  else {?>
	No product types.
<?php } ?>