<?php

if ($action != 'insert') {

	$result = mysql_query("SELECT * FROM product_types WHERE type_id = $productTypeId");
	$productType = mysql_fetch_assoc($result);
	$new = 'no';
	
} else {
	
	$new = 'yes';
	$fields = mysql_fetch_fields('product_types');
	$productType = array();
	foreach ($fields as $key => $field) {
		$productType[$field->name] = "";
	}
	
}
$result = mysql_query("SELECT * FROM meta_tags WHERE page='product_types' AND related_id=$productTypeId LIMIT 1");
while ($row = mysql_fetch_assoc($result))
{
	$metaTags = array();
	$metaTags = $row;
}?>

<h2><?=$productType['name'];?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="?table=product_types&productType=<?=$productTypeId;?>&action=submit&new=<?=$new;?>" method="POST">
<table>
<tr>
    <td width= "600px">
      <img src="<?php echo THUMBS_LOCATION.$productType['thumbnail'];?>" /><br />
	  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      Upload new file:<br />
      <input id="photofile" name="photofile" type="file" /> OR Delete photo:
      <input type="checkbox" id="deletephoto" name="deletephoto" value="deletephoto">
      <hr />

</td></tr>
<tr>
<td width= "600px">
<?php
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
		
		mysql_query("INSERT INTO meta_tags SET page='product_types',related_id=$productTypeId");
		
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

            
foreach ($productType as $key=>$p)
{ ?>
	<tr>
    <td width= "600px">
<?php
	switch ($key) {

		case 'description':
		case 'description_fr':
		case 'description_sp':
		case 'blurb':
		case 'blurb_fr':
		case 'blurb_sp':
		?><i><?=$key;?></i><br /><textarea id="<?=$key;?>" name="<?=$key;?>" class="mceAdvanced" style="width:300px"><?=$p;?></textarea><?php
		break;
		
		case 'thumbnail':
		case 'type_id':
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

<input type="submit" value="Save" />
<input type="button" name="cancel" onClick="window.location='?table=product_types'" value="Cancel" />
</form>

