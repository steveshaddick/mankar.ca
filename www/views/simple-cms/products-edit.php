<script src="/js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

<?php

$product =  $cms->getEdit(($cms->action == 'insert'));
$productTypes = $cms->getProductTypes();

$photoStrip = $product['photoStrip'];
$selectedParts = $product['selectedParts'];
$otherParts = $product['otherParts'];
$metaTags = $product['metaTags'];

$provinces = $cms->getStates();

?>

<h2><a href="/simple-cms/products/list/<?php echo $cms->lastListPage; ?>">&lt; Products</a></h2>

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

<h2><?php echo $product['name'];?></h2>

<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="<?php echo "/simple-cms/products/save/$cms->actionData"; ?>" method="POST">
<div>
      <img src="<?php echo PICTURES_LOCATION.$product['photo_page'];?>" /><br />
	  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      Upload new file:<br />
      <input id="photofile" name="photofile" type="file" /> OR Delete photo:
      <input type="checkbox" id="deletephoto" name="deletephoto" value="deletephoto" />
      <hr />

</div>

<span class="expander" onclick="expander('meta');">+ Meta</span>
<div id="meta" class="expanderWrapper">
	<div class="expanderContent">
  	<?php
	if (count($metaTags) > 0){
		foreach ($metaTags as $key=>$value)
		{
			?>
            
             <?php
			 if (($key != 'meta_tag_id') && ($key != 'related_id') && ($key != 'page') && ($key != 'actual_url')) {
				 ?>
                 <i><?php echo $key;?></i><br /><input type="text" id="<?php echo $key;?>" name="<?php echo $key;?>" value="<?php echo $value;?>" style="width:400px;"/><br />
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
  </div>
</div>
<hr />

<span class="expander" onclick="expander('info');">+ Info</span>
<div id="info" class="expanderWrapper">
	<div class="expanderContent">

		<i>Active</i><br />
		<input type="checkbox" id="active" name="active" value="<?php echo $product['active']; ?>" <?php if ($product['active']==1) {?>checked<?php } ?>><br />

		<?php
		foreach ($product as $key=>$p)
		{ 

			switch ($key) {
				
				case 'type_id':
					?> 

					<i>Type</i><br />
					<select name="<?php echo $key;?>" id="<?php echo $key;?>"> 
						<option value="0">NONE</option>
						<?php
						foreach ($productTypes as $productType) 
						{
							?>
				        	<option value="<?php echo $productType['type_id'];?>" <?php if ($productType['type_id'] == $p) echo 'SELECTED'; ?>><?php echo $productType['name'];?></option> 
						 	<?php 
						} 
						?>
			        </select><br />
			        <?php
					break;

				case 'supertype_id':
					?> 
					<i>Super Type</i><br />
					<select name="<?php echo $key;?>" id="<?php echo $key;?>"> 
						<option value="1" <?php if ($product['supertype_id'] == 1) echo 'SELECTED'; ?>>mankarulv.com</option>
						<option value="2" <?php if ($product['supertype_id'] == 2) echo 'SELECTED'; ?>>mafexulv.com</option> 
						<option value="3" <?php if ($product['supertype_id'] == 3) echo 'SELECTED'; ?>>rofaulv.com</option> 
						<option value="4" <?php if ($product['supertype_id'] == 4) echo 'SELECTED'; ?>>mantisulv.com</option> 
			        </select><br />
			        <?php
					break;

				case 'pretty_url':
				case 'product_order':
				case 'name':
				case 'product_code':
				case 'old_name':
				case 'old_code':
				case 'spray_width':
				case 'spray_width_us':
				case 'nozzles':
				case 'tank':
				case 'tank_us':
				case 'area':
				case 'area_us':
				case 'time':
				case 'weight':
				case 'weight_us':
				case 'youtube_top':
				case 'youtube_bottom':
					?> 
					<i><?php echo $key;?></i><br /><input type="text" id="<?php echo $key;?>" name="<?php echo $key;?>" value="<?php echo $p;?>" style="width:400px;"/> <br />
					<?php
					break;

				case 'manual':
					?>
					<br />
					<i>Manual</i><br />
			        <a href="<?php echo MANUALS_LOCATION.$product['manual'];?>"><?php echo $product['manual'];?></a><br />
			        <input id="manualfile" name="manualfile" type="file" /> OR Delete manual:
			      	<input type="checkbox" id="deletemanual" name="deletemanual" value="deletemanual">
				  	
				  	<?php
					break;

				case 'manual_fr':
					?>
					<br /><br />
					<i>French Manual</i><br />
			        <a href="<?php echo MANUALS_LOCATION.$product['manual_fr'];?>"><?php echo $product['manual_fr'];?></a><br />
			        <input id="manualfile_fr" name="manualfile_fr" type="file" /> OR Delete manual:
			      	<input type="checkbox" id="deletemanual_fr" name="deletemanual_fr" value="deletemanual_fr">
				  	
				  	<?php
					break;

				case 'manual_sp':
					?>
					<br /><br />
					<i>Spanish Manual</i><br />
			        <a href="<?php echo MANUALS_LOCATION.$product['manual_sp'];?>"><?php echo $product['manual_sp'];?></a><br />
			        <input id="manualfile_sp" name="manualfile_sp" type="file" /> OR Delete manual:
			      	<input type="checkbox" id="deletemanual_sp" name="deletemanual_sp" value="deletemanual_sp">
				  	
				  	<?php
					break;

				default:
					break;

			}
		}
		?>
	</div>
</div>
<hr />

<span class="expander" onclick="expander('descriptions');">+ Descriptions</span>
<div id="descriptions" class="expanderWrapper">
	<div class="expanderContent">

		<?php
		foreach ($product as $key=>$p)
		{ 
			?>
			
			<?php
			switch ($key) {

				case 'description':
				case 'description_fr':
				case 'description_sp':
					?>
					<i><?php echo $key;?></i><br />
					<textarea id="<?php echo $key;?>" name="<?php echo $key;?>" class="mceAdvanced" style="width:300px"><?php echo $p;?></textarea><br />
					<?php
					break;
				
				default:
					break;

			}?>
		    <?php
		}?>
	</div>
</div>
<hr />

<span class="expander" onclick="expander('photos');">+ Photos</span>
<div id="photos" class="expanderWrapper">
	<div class="expanderContent">

		<?php 
		if ($cms->action != 'insert') { 
			?>
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
					    <tr><td>DELETE: <input type="checkbox" id="photoStrip_deletephoto[<?php echo $photo['photo_id'];?>]" name="photoStrip_deletephoto[<?php echo $photo['photo_id'];?>]" value="photoStrip_deletephoto"></td></tr>
					    <tr><td><img src="<?php echo THUMBS_LOCATION.$photo['photo'];?>" /></td></tr>
					    <tr><td><i>Order</i><br /><input type="text" id="photoStrip_order[<?php echo $photo['photo_id'];?>]" name="photoStrip_order[<?php echo $photo['photo_id'];?>]" value="<?php echo $photo['order'];?>" style="width:50px;"/></td></tr>
					    <tr><td><i>Description</i><br /><textarea class="mceSimple" id="photoStrip_photo_description[<?php echo $photo['photo_id'];?>]" name="photoStrip_photo_description[<?php echo $photo['photo_id'];?>]" style="width:200px"><?php echo $photo['photo_description'];?></textarea></td></tr>
					    <tr><td><i>Description FR</i><br /><textarea class="mceSimple" id="photoStrip_photo_description_fr[<?php echo $photo['photo_id'];?>]" name="photoStrip_photo_description_fr[<?php echo $photo['photo_id'];?>]" style="width:200px"><?php echo $photo['photo_description_fr'];?></textarea></td></tr>
						<tr><td><i>Description SP</i><br /><textarea class="mceSimple" id="photoStrip_photo_description_sp[<?php echo $photo['photo_id'];?>]" name="photoStrip_photo_description_sp[<?php echo $photo['photo_id'];?>]" style="width:200px"><?php echo $photo['photo_description_sp'];?></textarea></td></tr>
					</table>
				    </td>
					<?php 
				} 
				?>

				</tr>
				</table>
			</div>
			SAVE PHOTO STRIP: <input type="checkbox" id="savePhotoStrip" name="savePhotoStrip" value="savePhotoStrip">

			<?php 
		} 
		?>

	</div>
</div>
<hr />

<span class="expander" onclick="expander('parts');">+ Parts</span>
<div id="parts" class="expanderWrapper">
	<div class="expanderContent">

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
			        
			        <input type="checkbox" id="removepart[<?php echo $i;?>]" name="removepart[<?php echo $i;?>]" value="<?php echo $selectedPart['part_id'];?>">
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
			        
			        <input type="checkbox" id="addpart[<?php echo $i;?>]" name="addpart[<?php echo $i;?>]" value="<?php echo $otherPart['part_id'];?>">
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

	</div>
</div>
<hr />

<input type="submit" value="Save" />
<input type="button" name="cancel" onClick="window.location='/simple-cms/products/list/<?php echo $cms->lastListPage; ?>'" value="Cancel" />
</form>

<script>
function expander(id) {
	var $div = $("#" + id);

	if ($div.hasClass('opened')) {
		$div.removeClass('opened').css('height', '0px');
	} else {
		var height = $('.expanderContent', $div).height();
		$div.addClass('opened').css('height', height + 'px');
	}
}
</script>