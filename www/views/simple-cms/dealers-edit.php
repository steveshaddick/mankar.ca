<script src="/js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

<?php

if ($cms->action == 'edit') {

	$dealer = $cms->getDealer();
	
} else {
	
	$dealer = $cms->getDealer(true);
	
}

$provinces = $cms->getStates();

?>
<h2><a href="/simple-cms/dealers/list/<?php echo $cms->lastListPage; ?>">&lt; Dealers</a></h2>


<?php
if (isset($_GET['error'])) {
	if ($_GET['error'] == 0) {
			
		echo '*****************************DEALER UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING DEALER------------------------------------------<br />';
	}
}
?>

<h2><?php echo $dealer['name']; ?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="<?php echo "/simple-cms/dealers/save/$cms->actionData" ; ?>" method="POST">
<table>
<tr>
    <td width= "600px">
      <img src="<?php echo DEALER_LOGO_LOCATION.$dealer['logo']; ?>" /><br />
	  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
      Upload new file:<br />
      <input id="photofile" name="photofile" type="file" /> OR Delete photo:
      <input type="checkbox" id="deletephoto" name="deletephoto" value="deletephoto">
      <hr />

</td></tr>
<?php

foreach ($dealer as $key=>$p)
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
		case 'dealer_id':
			break;

		
		case 'active':
			?>
			<i><?php echo $key; ?></i><br /><input type="checkbox" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $p; ?>" <?php if ($p==1) {?>checked<?php } ?>>
			<?php
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
<input type="button" name="cancel" onClick="window.location = '/simple-cms/dealers/list/<?php echo $cms->lastListPage; ?>'; " value="Cancel" />
</form>