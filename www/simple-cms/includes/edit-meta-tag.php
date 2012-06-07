<script src="js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

<?php

$result = mysql_query("SELECT * FROM meta_tags WHERE meta_tag_id = $metaTagId");
$metaTag = mysql_fetch_assoc($result);



?>
<h2><?=$metaTag['page'];?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="?table=meta_tags&meta_tag=<?=$metaTagId;?>&action=submit" method="POST">
<table>

<?php

foreach ($metaTag as $key=>$p)
{ ?>
	<tr>
    <td width= "600px">
<?php
	switch ($key) {

		case 'meta_tag_id':
		case 'related_id':
		case 'page':
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
<input type="button" name="cancel" onClick="window.location='?table=meta_tags'" value="Cancel" />
</form>