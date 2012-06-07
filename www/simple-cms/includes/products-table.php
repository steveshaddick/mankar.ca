<?php



if ($action == 'submit'){
	$new = (isset($_GET['new'])) ? $_GET['new'] : "no";
	
	if ($new == 'yes') {
		$query = "INSERT INTO products SET ";
	} else {
		$query = "UPDATE products SET ";
	}
	
	foreach ($_POST as $key=>$value)
	{
		if (!(substr($key,0,11) == "photoStrip_")) {
			switch ($key)
			{
				case 'product_id':
				case 'cancel':
				case 'active':
				case 'deletephoto':
				case 'MAX_FILE_SIZE':
				case 'photofile':
				case 'deletephoto':
				case 'savePhotoStrip';
				case 'uploadPhotoStrip';
				case 'manualfile':
				case 'deletemanual':
				case 'removepart':
				case 'addpart':
				case 'saveParts':
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
	}
	if (isset($_POST['deletephoto'])) {
		//unlink();
		$query .= "photo_page='',photo_list='',";
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
				exec("convert $targetPath  -resize 150x150  -quality 80% ".IMAGES_LOCATION."list_$filename");
				exec("convert $targetPath  -resize 200x375  -quality 80% ".IMAGES_LOCATION."page_$filename");
		
				$query .= "photo_list='list_$filename',";
				$query .= "photo_page='page_$filename',";
				//echo "uploaded file";
				
			} else{
				echo "There was an error uploading ".$_FILES['photofile']['name']."<br />";
			}
		}
	}
	if (isset($_POST['deletemanual'])) {
		//unlink();
		$query .= "manual='',";
		//echo "deleting photo";
	} else if (isset($_FILES['manualfile'])) {
		if ($_FILES['manualfile']['name'] != "") {
			$filename = preg_replace("/[^A-Za-z0-9.\\-\\+]/", "", basename( $_FILES['manualfile']['name']));
			
			$targetPath = MANUALS_LOCATION.$filename;
			
			//make this only upload if the file doesn't exist
			//and delete old file
			if (!file_exists(MANUALS_LOCATION.$filename)){
				if(move_uploaded_file($_FILES['manualfile']['tmp_name'], $targetPath)) {
					$query .= "manual='$filename',";
					//echo "uploaded file";
				} else{
					echo "There was an error uploading ".$_FILES['manualfile']['name']."<br />";
				}
			} else {
				$query .= "manual='$filename',";
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
		$query .= " WHERE product_id=$productId";
	}

	if (mysql_query($query)) {
		if ($new == 'yes') {
			$productId = mysql_insert_id();
		}
		echo '*****************************PRODUCT UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING PRODUCT------------------------------------------<br />';
	}
	
	if ($new == 'yes') {
		$query = "INSERT INTO meta_tags SET ";
	} else {
		$query = "UPDATE meta_tags SET ";
	}
	$query .= "pretty_url='".$_POST['pretty_url']."',";
	$query .= "actual_url='products.php?pid=$productId',";
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
		$query .= ",page='products',related_id=$productId";
	} else {
		$query .= " WHERE related_id=$productId AND page='products'";
	}
	mysql_query($query);

	//echo '<br /><br />'.$query;
	
	//photostrip
	if (isset($_POST['savePhotoStrip']))
	{
		//save edited data
		$photoStrip = array();
		$result = mysql_query("SELECT * FROM product_photos WHERE product_id=$productId ORDER BY `order`");
		while ($row = mysql_fetch_assoc($result))
		{
			$photoStrip[] = $row;
		}
		
		foreach ($photoStrip as $photo)
		{
			if (isset($_POST['photoStrip_deletephoto'][$photo['photo_id']])) {
				//echo "DELETE FROM product_photos WHERE photo_id=".$photo['photo_id']."<br />";
				mysql_query("DELETE FROM product_photos WHERE photo_id=".$photo['photo_id']);
			} else {
				
				$query = "UPDATE product_photos SET ";
				$query .= "`order`=".$_POST['photoStrip_order'][$photo['photo_id']].",";
				$query .= "photo_description='".removeQuotes($_POST['photoStrip_photo_description'][$photo['photo_id']])."',";
				$query .= "photo_description_fr='".removeQuotes($_POST['photoStrip_photo_description_fr'][$photo['photo_id']])."',";
				$query .= "photo_description_sp='".removeQuotes($_POST['photoStrip_photo_description_sp'][$photo['photo_id']])."'";
				$query .= " WHERE photo_id=".$photo['photo_id'];
				
				//echo $query."<br />";
				if (mysql_query($query)) {
		
					echo '*****************************PHOTO STRIP UPDATED SUCCESSFULLY***************************************<br />';
				} else {
					echo '--------------------------------ERROR UPDATING PHOTOSTRIP------------------------------------------<br />';
				}
			}
		}
	}
	if (isset($_POST['uploadPhotoStrip']))
	{
		foreach ($_FILES['photoStrip_files']['name'] as $key=>$file)
		{
			$filename = strtolower(ereg_replace("[^A-Za-z0-9.]", "", basename( $_FILES['photoStrip_files']['name'][$key])));
			$filename = substr($filename, 0 , strrpos($filename,"."));
			$filename .= ".jpg";
			
			$targetPath = UPLOAD_LOCATION.$filename;
			
			//make this only upload if the file doesn't exist
			//and delete old file, if not used anywhere else
			
			if(move_uploaded_file($_FILES['photoStrip_files']['tmp_name'][$key], $targetPath)) {
				exec("convert $targetPath  -resize 1000x1000\>  -quality 100% $targetPath");
				//echo $targetPath;
				$image = imagecreatefromjpeg($targetPath);
				$imageSize = getimagesize($targetPath);
				$ratio = $imageSize[0] / $imageSize[1];
				$newHeight = 100;
				$newWidth = 100 * $ratio;
				$thumb = imagecreatetruecolor($newWidth,$newHeight);
				imagecopyresampled($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight,  $imageSize[0],  $imageSize[1]);
				imagejpeg($thumb, THUMBS_LOCATION."$filename");
				imagedestroy($image);
				//echo "width:$newWidth   height:$newHeight<br />";
				//exec("convert $targetPath  -resize 100x100^  -quality 80% ".THUMBS_LOCATION."$filename");
				exec("convert $targetPath  -resize 500x500\>  -quality 80% ".IMAGES_LOCATION."$filename");
		
				$query = "INSERT INTO product_photos (product_id, photo) VALUES ($productId,'$filename')";
				
				//echo $query."<br />";
				if (mysql_query($query)) {
		
					echo '*****************************PHOTO ADDED SUCCESSFULLY***************************************<br />';
				} else {
					echo '--------------------------------ERROR ADDING PHOTO------------------------------------------<br />';
				}
				
			} else{
				echo "There was an error uploading ".$_FILES['photoStrip_files']['name'][$key]."<br />";
			}
		}
	}
	
	
	//parts
	if (isset($_POST['saveParts']))
	{

		if (isset($_POST['removepart'])){
			$query = "DELETE FROM parts_to_products WHERE product_id=$productId AND part_id IN (".implode(',',$_POST['removepart']).")";
			//echo $query."<br /><br />";
			mysql_query($query);
		}
		if (isset($_POST['addpart'])){

			foreach ($_POST['addpart'] as $part)
			{
				$query = "INSERT INTO parts_to_products SET product_id=$productId,part_id=$part";
				//echo $query."<br />";
				mysql_query($query);
			}
		}
	}
}

$result = mysql_query("SELECT COUNT(*) FROM products");
$row = mysql_fetch_row($result);
$totalPages = ceil($row[0]/100);


$products = array();
$result = mysql_query("SELECT product_id,name FROM products ORDER BY name LIMIT ".($page * 100).",100");
while ($row = mysql_fetch_assoc($result))
{
	$products[] = $row;
}

?>
<a href="?table=products&action=insert"><b>INSERT NEW PRODUCT</b></a><br /><br />
<?php
if (count($products) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">Product ID</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($products as $product)
    {?>
        <tr>
        <td><a href="?table=products&action=edit&product=<?=$product['product_id'];?>"><?=$product['product_id'];?></a></td>
        <td><a href="?table=products&action=edit&product=<?=$product['product_id'];?>"><?=$product['name'];?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?=$product['name'];?>?','?table=products&page=<?=$page;?>&action=delete&product=<?=$product['product_id'];?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
    <tr>
    <td width="50px"><a href="?table=products&page=0">|&lt;</a></td>
    <td width="50px"><a href="?table=products&page=<?php if ($page > 0) { echo $page-1; } else {echo 0; }?>">&lt;</a></td>
    <td width="150px">Page <?php echo $page+1;?> of <?=$totalPages;?></td>
    <td width="50px"><a href="?table=products&page=<?php if ($page < ($totalPages-1)) { echo $page+1; } else {echo $totalPages-1; }?>">&gt;</a></td>
    <td width="50px"><a href="?table=products&page=<?php echo $totalPages-1;?>">&gt;|</a></td>
	</tr>
    </table>
<?php }  else {?>
	No products.
<?php } ?>