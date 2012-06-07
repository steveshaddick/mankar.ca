<?php

$page = (isset($_GET['page'])) ? intval($_GET['page']) : 0;
if ($page < 0) $page = 0;

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$metaTagId = (isset($_GET['meta_tag'])) ? intval($_GET['meta_tag']) : -1;


?>
<h2>Meta Tags</h2>
<?php

switch ($action)
{
	case 'submit':
	include 'includes/meta-tags-table.php';
	break;
	
	case 'edit':
	case 'insert':
	include 'includes/edit-meta-tag.php';
	break;
	
	
	default:
	include 'includes/meta-tags-table.php';
	break;
}

?>