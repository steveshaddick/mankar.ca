<?php

$page = (isset($_GET['page'])) ? intval($_GET['page']) : 0;
if ($page < 0) $page = 0;

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$dealerId = (isset($_GET['dealer'])) ? intval($_GET['dealer']) : -1;


?>
<h2>Dealers</h2>
<?php

switch ($action)
{
	case 'delete':
	mysql_query("DELETE FROM dealers WHERE dealer_id = $dealerId");
	include 'includes/dealers-table.php';
	echo '<script>alert("Dealer #'.$dealerId.' deleted.");</script>';
	break;
	
	case 'submit':
	include 'includes/dealers-table.php';
	break;
	
	case 'edit':
	case 'insert':
	include 'includes/edit-dealer.php';
	break;
	
	
	default:
	include 'includes/dealers-table.php';
	break;
}

?>