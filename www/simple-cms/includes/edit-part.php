<?php

if ($action != 'insert') {

	$result = mysql_query("SELECT * FROM parts WHERE part_id = $partId");
	$part = mysql_fetch_assoc($result);
	$new = 'no';
	
} else {
	
	$new = 'yes';
	$fields = mysql_fetch_fields('parts');
	$part = array();
	foreach ($fields as $key => $field) {
		$part[$field->name] = "";
	}
	
}

?>
<h2><?=$part['name'];?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmPart" action="?table=parts&part=<?=$partId;?>&action=submit&new=<?=$new;?>" method="POST">
<table>
<tr>
    <td width= "600px">
      <img src="<?php echo PARTS_IMAGES_LOCATION.$part['photo'];?>" /><br />
	  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      Upload new file:<br />
      <input id="photofile" name="photofile" type="file" /> OR Delete photo:
      <input type="checkbox" id="deletephoto" name="deletephoto" value="deletephoto">
      <hr />

</td></tr>
<?php

foreach ($part as $key=>$p)
{ ?>
	<tr>
    <td width= "600px">
<?php
	switch ($key) {

		case 'photo':
		case 'part_id':
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
<input type="button" name="cancel" onClick="window.location='?table=parts'" value="Cancel" />
</form>