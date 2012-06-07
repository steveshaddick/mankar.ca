<?php

$page = (isset($_GET['page'])) ? intval($_GET['page']) : 0;
if ($page < 0) $page = 0;

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$partId = (isset($_GET['part'])) ? intval($_GET['part']) : -1;


?>
<h2>Parts</h2>
<?php

switch ($action)
{
	case 'delete':
	mysql_query("DELETE FROM parts WHERE part_id = $partId");
	include 'includes/parts-table.php';
	echo '<script>alert("Part #'.$partId.' deleted.");</script>';
	break;
	
	case 'submit':
	include 'includes/parts-table.php';
	break;
	
	case 'edit':
	case 'insert':
	include 'includes/edit-part.php';
	break;
	
	
	default:
	include 'includes/parts-table.php';
	break;
}

?>