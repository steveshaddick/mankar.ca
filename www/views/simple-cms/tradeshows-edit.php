<?php


$tradeshow = $cms->getEdit(($cms->action == 'insert'));
$provinces = $cms->getStates();

?>
<h2><a href="/simple-cms/tradeshows/list/<?php echo $cms->lastListPage; ?>">&lt; Tradeshows</a></h2>
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
<h2><?php echo $tradeshow['showname'] ;?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="<?php echo "/simple-cms/tradeshows/save/$cms->actionData"; ?>" method="POST">
<table>
<tr>
    <td width= "600px">
      <img src="<?php echo TRADESHOW_LOGO_LOCATION.$tradeshow['logo'];?>" /><br />
	  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      Upload new file:<br />
      <input id="photofile" name="photofile" type="file" /> OR Delete photo:
      <input type="checkbox" id="deletephoto" name="deletephoto" value="deletephoto">
      <hr />

</td></tr>

<?php

foreach ($tradeshow as $key=>$p)
{ ?>
	<tr>
    <td width= "600px">
<?php
	switch ($key) {

		case 'state_id':
			?> 
			<i><?php echo $key; ?></i><br /><select name="<?php echo $key; ?>" id="<?php echo $key; ?>"> <?php
			foreach ($provinces as $province) 
			{
				?>
	        	<option value="<?php echo $province['state_id']; ?>" <?php if ($province['state_id'] == $p) echo 'SELECTED'; ?>><?php echo $province['state']; ?></option> 
			 	<?php 
			} 
			?>
	        </select>
	        <?php
			break;
		
		case 'country':
			?> 
			<i><?php echo $key; ?></i><br />
	        <select name="<?php echo $key; ?>" id="<?php echo $key; ?>">
				<option value="Canada" <?php if ("Canada" == $p) echo 'SELECTED'; ?>>Canada</option> 
	       	 	<option value="U.S.A." <?php if ("U.S.A." == $p) echo 'SELECTED'; ?>>U.S.A.</option> 
	        </select>
	        <?php
			break;

		case 'logo':
		case 'show_id':
		case 'province':
		case 'dtime':
			break;

		case 'details':
		case 'details_fr':
		case 'details_sp':
			?><i><?=$key;?></i><br /><textarea id="<?=$key;?>" name="<?=$key;?>" class="mceAdvanced" style="width:300px"><?=$p;?></textarea><?php
			break;

		default:
			?> 
			<i><?php echo $key; ?></i><br /><input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $p; ?>" style="width:400px;"/> 
			<?php
			break;

	}?>
    </td>
    </tr><?php
}?>

</table>
<hr />

<input type="submit" value="Save" />
<input type="button" name="cancel" onClick="window.location='/simple-cms/tradeshows/list/<?php echo $cms->lastListPage; ?>'" value="Cancel" />
</form>

<script>
$(document).ready(function() {
	$("#showstart").datepicker({ dateFormat: "yyyy-mm-dd" });
	$("#showend").datepicker({ dateFormat: "yyyy-mm-dd" });
});
</script>

