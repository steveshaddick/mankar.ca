<?php

$page = (isset($_GET['page'])) ? intval($_GET['page']) : 0;
if ($page < 0) $page = 0;

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$productId = (isset($_GET['product'])) ? intval($_GET['product']) : -1;


?>
<h2>Products</h2>
<?php

switch ($action)
{
	case 'delete':
	mysql_query("DELETE FROM products WHERE product_id = $productId");
	include 'includes/products-table.php';
	echo '<script>alert("Product #'.$productId.' deleted.");</script>';
	break;
	
	case 'submit':
	include 'includes/products-table.php';
	break;
	
	case 'edit':
	case 'insert':
	include 'includes/edit-product.php';
	break;
	
	
	default:
	include 'includes/products-table.php';
	break;
}

?>