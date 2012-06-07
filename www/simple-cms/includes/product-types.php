<?php

$page = (isset($_GET['page'])) ? intval($_GET['page']) : 0;
if ($page < 0) $page = 0;

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$productTypeId = (isset($_GET['productType'])) ? intval($_GET['productType']) : -1;


?>
<h2>Product Types</h2>
<?php

switch ($action)
{
	case 'delete':
	mysql_query("DELETE FROM product_types WHERE type_id = $productTypeId");
	include 'includes/product-types-table.php';
	echo '<script>alert("Product Type #'.$productTypeId.' deleted.");</script>';
	break;
	
	case 'submit':
	include 'includes/product-types-table.php';
	break;
	
	case 'edit':
	case 'insert':
	include 'includes/edit-product-type.php';
	break;
	
	
	default:
	include 'includes/product-types-table.php';
	break;
}

?>