<?php


$newsItem = $cms->getEdit(($cms->action == 'insert'));

?>
<h2><a href="/simple-cms/news/list/<?php echo $cms->lastListPage; ?>">&lt; News</a></h2>
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
<h2><?php echo $newsItem['title'] ;?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="<?php echo "/simple-cms/news/save/$cms->actionData"; ?>" method="POST">
<table>

<?php

foreach ($newsItem as $key=>$p)
{ ?>
	<tr>
    <td width= "600px">
<?php
	switch ($key) {

		case 'news_id':
			break;

		case 'body':
		case 'body_fr':
		case 'body_sp':
		case 'excerpt':
			?><i><?=$key;?></i><br /><textarea id="<?=$key;?>" name="<?=$key;?>" class="mceAdvanced" style="width:300px"><?=$p;?></textarea><?php
			break;

		case 'active':
			?>
			<i>Active</i><br />
			<input type="checkbox" id="active" name="active" value="<?php echo $newsItem['active']; ?>" <?php if ($newsItem['active']==1) {?>checked<?php } ?>><br />
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
<input type="button" name="cancel" onClick="window.location='/simple-cms/news/list/<?php echo $cms->lastListPage; ?>'" value="Cancel" />
</form>

<script>
$(document).ready(function() {
	$("#newsDate").datepicker({ dateFormat: "yy-mm-dd" });
});
</script>