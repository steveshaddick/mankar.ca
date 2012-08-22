<script src="/js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

<?php

$pages = $cms->getSitePage();
if (count($pages) == 0) {
	header("Location: http://" . SITE_URL . "simple-cms/site-pages/list/$cms->lastListPage");
	exit();
}



?>
<h2><a href="/simple-cms/site-pages/list/<?php echo $cms->lastListPage; ?>">&lt; Site Pages</a></h2>

<?php
if (isset($_GET['error'])) {
	if ($_GET['error'] == 0) {
			
		echo '*****************************UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING------------------------------------------<br />';
	}
}
?>

<h2><?php echo $pages[0]['pretty_url']; ?></h2>
<form enctype="multipart/form-data" id="frmProduct" name="frmProduct" action="<?php echo "/simple-cms/site-pages/save/$cms->actionData"; ?>" method="POST">

<table>

<?php

foreach ($pages as $sitePage)
{ 
	?>

	
	<tr>
    <td width= "600px">

	<?php

	switch ($sitePage['supertype_id']) {
		
		case 1:
			?>
			<strong>mankarulv.com</strong><br />
			<?php
			break;

		case 2:
			?>
			<strong>mafexulv.com</strong><br />
			<?php
			break;

		case 3:
			?>
			<strong>rofaulv.com</strong><br />
			<?php
			break;

		case 4:
			?>
			<strong>mantisulv.com</strong><br />
			<?php
			break;
	}
	?>

	<table>
		<?php

		foreach ($sitePage as $key=>$value) {

			?>
			<tr>
	    	<td width= "600px">
		    	<?php
				switch ($key) {
					case 'site_page_id':
					case 'location':
					case 'section':
					case 'supertype_id':
					case 'redirect_supertype':
					case 'has_nav':
					case 'pretty_url':
						break;

					default:
						?> 
						<i><?php echo $key; ?></i><br /><input type="text" id="<?php echo $key . '__' . $sitePage['supertype_id']; ?>" name="<?php echo $key . '__' . $sitePage['supertype_id']; ?>" value="<?php echo $value; ?>" style="width:400px;"/> 
						<?php
						break;
				}
				?>
			</td>
			</tr>
			<?php
		}
		?>

		<tr>
    	<td width= "600px">
			<i>Active</i><br /><input type="checkbox" id="has_nav<?php echo '__' . $sitePage['supertype_id']; ?>" name="has_nav<?php echo '__' . $sitePage['supertype_id']; ?>" value="<?php echo $sitePage['has_nav']; ?>" <?php if ($sitePage['has_nav'] == 1) {?>checked<?php } ?>>
		</td>
		</tr>

	</table>

    </td>
    </tr>

    <?php
}
?>

</table>
<hr />

<input type="submit" value="Save" />
<input type="button" name="cancel" onClick="window.location = '/simple-cms/site-pages/list/<?php echo $cms->lastListPage; ?>'" value="Cancel" />
</form>