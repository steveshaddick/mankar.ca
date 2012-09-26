<?php

$productType = $cms->getEdit(($cms->action == 'insert'));
$metaTags = $productType['metaTags'];

?>
<h2><a href="/simple-cms/product_types/list/<?php echo $cms->lastListPage; ?>">&lt; Product Types</a></h2>
<?php
if (isset($_GET['error'])) {
	if ($_GET['error'] == 0) {
			
		echo '*****************************UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING------------------------------------------<br />';
		echo $cms->errorMessage;
	}
}
?>
<h2><?=$productType['name'];?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="<?php echo "/simple-cms/product_types/save/$cms->actionData"; ?>" method="POST">
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
	if (count($metaTags) > 0){
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
		
		?>
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

		case 'supertype_id':
			?> 
			<i>Super Type</i><br />
			<select name="<?php echo $key;?>" id="<?php echo $key;?>"> 
				<option value="1" <?php if ($productType['supertype_id'] == 1) echo 'SELECTED'; ?>>mankarulv.com</option>
				<option value="2" <?php if ($productType['supertype_id'] == 2) echo 'SELECTED'; ?>>mafexulv.com</option> 
				<option value="3" <?php if ($productType['supertype_id'] == 3) echo 'SELECTED'; ?>>rofaulv.com</option> 
				<option value="4" <?php if ($productType['supertype_id'] == 4) echo 'SELECTED'; ?>>mantisulv.com</option> 
	        </select>
	        <?php
			break;
		
		case 'thumbnail':
		case 'type_id':
		case 'metaTags':
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
<input type="button" name="cancel" onClick="window.location='/simple-cms/product_types/list/<?php echo $cms->lastListPage; ?>'" value="Cancel" />
</form>

