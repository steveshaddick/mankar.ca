<script src="js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

<?php

if ($action != 'insert') {

	$result = mysql_query("SELECT * FROM dealers WHERE dealer_id = $dealerId");
	$dealer = mysql_fetch_assoc($result);
	$new = 'no';
	
} else {
	
	$new = 'yes';
	$fields = mysql_fetch_fields('dealers');
	$dealer = array();
	foreach ($fields as $key => $field) {
		$dealer[$field->name] = "";
	}
	
}

$provinces = array();
$result = mysql_query("SELECT state_id,state FROM state ORDER BY state");
while ($row = mysql_fetch_assoc($result))
{
	$provinces[] = $row;
}


?>
<h2><?=$dealer['name'];?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="?table=dealers&dealer=<?=$dealerId;?>&action=submit&new=<?=$new;?>" method="POST">
<table>
<tr>
    <td width= "600px">
      <img src="<?php echo DEALER_LOGO_LOCATION.$dealer['logo'];?>" /><br />
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
		?> <i><?=$key;?></i><br /><select name="<?=$key;?>" id="<?=$key;?>"> <?php
		foreach ($provinces as $province) 
		{?>
        	<option value="<?=$province['state_id'];?>" <?php if ($province['state_id'] == $p) echo 'SELECTED'; ?>><?=$province['state'];?></option> 
		 <?php 
		} ?>
        </select>
        <?php
		break;
		
		case 'country':
		?> <i><?=$key;?></i><br />
        <select name="<?=$key;?>" id="<?=$key;?>">
			<option value="Canada" <?php if ("Canada" == $p) echo 'SELECTED'; ?>>Canada</option> 
       	 	<option value="U.S.A." <?php if ("U.S.A." == $p) echo 'SELECTED'; ?>>U.S.A.</option> 
        </select>
        <?php
		break;

		case 'logo':
		case 'dealer_id':
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
<input type="button" name="cancel" onClick="window.location='?table=dealers'" value="Cancel" />
</form>