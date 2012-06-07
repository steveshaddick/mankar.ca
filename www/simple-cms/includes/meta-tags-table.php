<?php

if ($action == 'submit'){
	$new = (isset($_GET['new'])) ? $_GET['new'] : "no";
	
	$query = "UPDATE meta_tags SET ";

	foreach ($_POST as $key=>$value)
	{
		switch ($key)
		{
			case 'meta_tag_id':
			case 'related_id':
			case 'page':
			break;
			
			default:
			$query .= "$key='".trim($value)."',";
			break;
		}
	}

	$query = substr($query, 0, strlen($query)-1);
	
	$query .= " WHERE meta_tag_id=$metaTagId";

	if (mysql_query($query)) {
		
		echo '*****************************META TAG UPDATED SUCCESSFULLY***************************************<br />';
	} else {
		echo '--------------------------------ERROR UPDATING META TAG------------------------------------------<br />';
	}
	
	//echo '<br /><br />'.$query;
	
}

$result = mysql_query("SELECT COUNT(*) FROM meta_tags WHERE related_id=-1");
$row = mysql_fetch_row($result);
$totalPages = ceil($row[0]/25);


$metaTags = array();
$result = mysql_query("SELECT meta_tag_id,page FROM meta_tags WHERE related_id=-1 ORDER BY page LIMIT ".($page * 25).",25");
while ($row = mysql_fetch_assoc($result))
{
	$metaTags[] = $row;
}

?>

<?php
if (count($metaTags) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">Meta Tag ID</td><td width="300px">Page</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($metaTags as $metaTag)
    {?>
        <tr>
        <td><a href="?table=meta_tags&action=edit&meta_tag=<?=$metaTag['meta_tag_id'];?>"><?=$metaTag['meta_tag_id'];?></a></td>
        <td><a href="?table=meta_tags&action=edit&meta_tag=<?=$metaTag['meta_tag_id'];?>"><?=$metaTag['page'];?></a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
    <tr>
    <td width="50px"><a href="?table=meta_tags&page=0">|&lt;</a></td>
    <td width="50px"><a href="?table=meta_tags&page=<?php if ($page > 0) { echo $page-1; } else {echo 0; }?>">&lt;</a></td>
    <td width="150px">Page <?php echo $page+1;?> of <?=$totalPages;?></td>
    <td width="50px"><a href="?table=meta_tags&page=<?php if ($page < ($totalPages-1)) { echo $page+1; } else {echo $totalPages-1; }?>">&gt;</a></td>
    <td width="50px"><a href="?table=meta_tags&page=<?php echo $totalPages-1;?>">&gt;|</a></td>
	</tr>
    </table>
<?php }  else {?>
	No meta tags for some reason.
<?php } ?>