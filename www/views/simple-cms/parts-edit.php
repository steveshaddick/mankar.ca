<?php

$part = ($cms->action == 'edit') ? $cms->getPart() : $cms->getPart(true);


?>
<h2><a href="/simple-cms/parts/list/<?php echo $cms->lastListPage; ?>">&lt; Parts</a></h2>


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

<h2><?php echo $part['name']; ?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmPart" action="/simple-cms/parts/save/<?php echo $cms->actionData; ?>" method="POST">
<table>
<tr>
    <td width= "600px">
      <img src="<?php echo PARTS_LOCATION.$part['photo'];?>" /><br />
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
<input type="button" name="cancel" onClick="window.location = '/simple-cms/parts/list/<?php echo $cms->lastListPage; ?>" value="Cancel" />
</form>