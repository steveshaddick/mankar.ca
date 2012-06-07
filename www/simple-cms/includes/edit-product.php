<script src="js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

<?php

if ($action != 'insert') {

	$result = mysql_query("SELECT * FROM products WHERE product_id = $productId");
	$product = mysql_fetch_assoc($result);
	$new = 'no';
	
} else {
	
	$new = 'yes';
	$fields = mysql_fetch_fields('products');
	$product = array();
	foreach ($fields as $key => $field) {
		$product[$field->name] = "";
	}
	
}

$productTypes = array();
$result = mysql_query("SELECT type_id,name FROM product_types ORDER BY name");
while ($row = mysql_fetch_assoc($result))
{
	$productTypes[] = $row;
}

$photoStrip = array();
$result = mysql_query("SELECT * FROM product_photos WHERE product_id=$productId ORDER BY `order`");
while ($row = mysql_fetch_assoc($result))
{
	$photoStrip[] = $row;
}

$selectedParts = array();
$partsList = array();
$partsList[] = -999;
$result = mysql_query("SELECT part_id, part_code,name FROM parts WHERE part_id IN (SELECT part_id FROM parts_to_products WHERE product_id=$productId) ORDER BY part_code");
while ($row = mysql_fetch_assoc($result))
{
	$selectedParts[] = $row;
	$partsList[] = $row['part_id'];
}


$otherParts = array();
$result = mysql_query("SELECT part_id, part_code,name FROM parts WHERE part_id NOT IN (".implode(',',$partsList).") ORDER BY part_code");
while ($row = mysql_fetch_assoc($result))
{
	$otherParts[] = $row;
}


$result = mysql_query("SELECT * FROM meta_tags WHERE page='products' AND related_id=$productId LIMIT 1");
while ($row = mysql_fetch_assoc($result))
{
	$metaTags = array();
	$metaTags = $row;
}

?>
<h2><?=$product['name'];?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="?table=products&product=<?=$productId;?>&action=submit&new=<?=$new;?>" method="POST">
<table>
<tr>
    <td width= "600px">
      <img src="<?php echo IMAGES_LOCATION.$product['photo_page'];?>" /><br />
	  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      Upload new file:<br />
      <input id="photofile" name="photofile" type="file" /> OR Delete photo:
      <input type="checkbox" id="deletephoto" name="deletephoto" value="deletephoto">
      <hr />

</td></tr>
<tr>
             <td width= "600px">	<?php
	if (isset($metaTags)){
		foreach ($metaTags as $key=>$value)
		{
			?>
            
             <?php
			 if (($key != 'meta_tag_id') && ($key != 'related_id') && ($key != 'page') && ($key != 'actual_url')) {
				 ?>
                 <i><?=$key;?></i><br /><input type="text" id="<?=$key;?>" name="<?=$key;?>" value="<?=$value;?>" style="width:400px;"/><br />
                 <?php
			 }
			 ?>
             <?php
		}
	} else {
		
		if ($productId > -1) {
			mysql_query("INSERT INTO meta_tags SET page='products',related_id=$productId,actual_url='products.php?pid=$productId'");
		}
		
		?>
		<i>pretty url</i><br /><input type="text" id="pretty_url" name="pretty_url" value="" style="width:400px;"/><br />
        
        <i>meta_title</i><br /><input type="text" id="meta_title" name="meta_title" value="" style="width:400px;"/><br />
        <i>meta_description</i><br /><input type="text" id="meta_description" name="meta_description" value="" style="width:400px;"/><br />
        <i>meta_keywords</i><br /><input type="text" id="meta_keywords" name="meta_keywords" value="" style="width:400px;"/><br />
        <i>meta_title_fr</i><br /><input type="text" id="meta_title_fr" name="meta_title_fr" value="" style="width:400px;"/><br />
        <i>meta_description_fr</i><br /><input type="text" id="meta_description_fr" name="meta_description_fr" value="" style="width:400px;"/><br />
        <i>meta_keywords_fr</i><br /><input type="text" id="meta_keywords_fr" name="meta_keywords_fr" value="" style="width:400px;"/><br />
        <i>meta_title_sp</i><br /><input type="text" id="meta_title_sp" name="meta_title_sp" value="" style="width:400px;"/><br />
        <i>meta_description_sp</i><br /><input type="text" id="meta_description_sp" name="meta_description_sp" value="" style="width:400px;"/><br />
        <i>meta_keywords_sp</i><br /><input type="text" id="meta_keywords_sp" name="meta_keywords_sp" value="" style="width:400px;"/><br />
        <?php
	}
	?>
  
             </td>
             </tr>  
<?php

foreach ($product as $key=>$p)
{ ?>
	<tr>
    <td width= "600px">
    
<?php
	switch ($key) {

		case 'description':
		case 'description_fr':
		case 'description_sp':
		?><i><?=$key;?></i><br /><textarea id="<?=$key;?>" name="<?=$key;?>" class="mceAdvanced" style="width:300px"><?=$p;?></textarea><?php
		break;
		
		case 'type_id':
		?> <i><?=$key;?></i><br /><select name="<?=$key;?>" id="<?=$key;?>"> <?php
		foreach ($productTypes as $productType) 
		{?>
        	<option value="<?=$productType['type_id'];?>" <?php if ($productType['type_id'] == $p) echo 'SELECTED'; ?>><?=$productType['name'];?></option> 
		 <?php 
		} ?>
        </select>
        <?php
		break;

		case 'photo_list':
		case 'photo_page':
		case 'product_id':
		break;
		
		case 'manual':
		?><i>Manual</i><br />
        <a href="<?=MANUALS_LOCATION.$product['manual'];?>"><?=$product['manual'];?></a><br />
        <input id="manualfile" name="manualfile" type="file" /> OR Delete manual:
      	<input type="checkbox" id="deletemanual" name="deletemanual" value="deletemanual">
	  	<?php
		break;
		
		case 'active':
		?><i><?=$key;?></i><br /><input type="checkbox" id="<?=$key;?>" name="<?=$key;?>" value="<?=$p;?>" <?php if ($p==1) {?>checked<?php } ?>><?php
		break;
		
		default:
		?> <i><?=$key;?></i><br /><input type="text" id="<?=$key;?>" name="<?=$key;?>" value="<?=$p;?>" style="width:400px;"/> <?php
		break;

	}?>
    </td>
    </tr><?php
}?>

</table>
<hr />

<?php if ($action != 'insert') { ?>
<h3>Photos</h3>
UPLOAD NEW FILES: <input type="checkbox" id="uploadPhotoStrip" name="uploadPhotoStrip" value="uploadPhotoStrip"><br />
<i>Upload new photos</i><br />
<div id="photofiles_list">
<input type="file" name="photoStrip_files[]" id="photoStrip_files" class="multi"/>
</div>
<br />
<br />
<hr />
<div style="overflow:scroll; width:100%;">
<table>
<tr>
<?php
foreach ($photoStrip as $photo)
{
	?><td>
    <table width="200px">
    <tr><td>DELETE: <input type="checkbox" id="photoStrip_deletephoto[<?=$photo['photo_id'];?>]" name="photoStrip_deletephoto[<?=$photo['photo_id'];?>]" value="photoStrip_deletephoto"></td></tr>
    <tr><td><img src="<?php echo THUMBS_LOCATION.$photo['photo'];?>" /></td></tr>
    <tr><td><i>Order</i><br /><input type="text" id="photoStrip_order[<?=$photo['photo_id'];?>]" name="photoStrip_order[<?=$photo['photo_id'];?>]" value="<?=$photo['order'];?>" style="width:50px;"/></td></tr>
    <tr><td><i>Description</i><br /><textarea class="mceSimple" id="photoStrip_photo_description[<?=$photo['photo_id'];?>]" name="photoStrip_photo_description[<?=$photo['photo_id'];?>]" style="width:200px"><?=$photo['photo_description'];?></textarea></td></tr>
    <tr><td><i>Description FR</i><br /><textarea class="mceSimple" id="photoStrip_photo_description_fr[<?=$photo['photo_id'];?>]" name="photoStrip_photo_description_fr[<?=$photo['photo_id'];?>]" style="width:200px"><?=$photo['photo_description_fr'];?></textarea></td></tr>
	<tr><td><i>Description SP</i><br /><textarea class="mceSimple" id="photoStrip_photo_description_sp[<?=$photo['photo_id'];?>]" name="photoStrip_photo_description_sp[<?=$photo['photo_id'];?>]" style="width:200px"><?=$photo['photo_description_sp'];?></textarea></td></tr>
    </table>
    </td>
<?php } ?>
</tr>
</table>
</div>
SAVE PHOTO STRIP: <input type="checkbox" id="savePhotoStrip" name="savePhotoStrip" value="savePhotoStrip">
<hr />

<?php } ?>

<h3>Parts</h3>
<table>
<tr>
<td width="400px">
<i>Selected Parts</i><br />
(Check to REMOVE)
<div style="height:300px; width:350px; overflow:scroll;">
<?php
	$i = 0;
	foreach ($selectedParts as $selectedPart)
	{ 
		?>
        
        <input type="checkbox" id="removepart[<?=$i;?>]" name="removepart[<?=$i;?>]" value="<?=$selectedPart['part_id'];?>">
        <?php echo $selectedPart['part_code'].' - '.$selectedPart['name']; ?><br />
      	
		<?php
		$i++;
	}
?>
</div>
</td>
<td>
<i>Other Parts</i><br />
(Check to ADD)
<div style="height:300px; width:350px; overflow:scroll;">
<?php
	$i = 0;
	foreach ($otherParts as $otherPart)
	{ 
		?>
        
        <input type="checkbox" id="addpart[<?=$i;?>]" name="addpart[<?=$i;?>]" value="<?=$otherPart['part_id'];?>">
        <?php echo $otherPart['part_code'].' - '.$otherPart['name']; ?><br />
      	
		<?php
		$i++;
	}
?>
</div>
</td>
</tr>
</table>
SAVE PARTS: <input type="checkbox" id="saveParts" name="saveParts" value="saveParts">
<hr />
<input type="submit" value="Save" />
<input type="button" name="cancel" onClick="window.location='?table=products'" value="Cancel" />
</form>