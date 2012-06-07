<?php
	
	$partId = (isset($_GET['partid'])) ? intval($_GET['partid']) : -1;
	$productId = (isset($_GET['pid'])) ? intval($_GET['pid']) : -1;
	
	if ($partId > -1) {
		$result = mysql_query("SELECT * FROM parts WHERE part_id = $partId AND active=1 LIMIT 1");
		$part = mysql_fetch_assoc($result);
		$partCode = $part['part_code'];
		
		$result = mysql_query("SELECT * FROM products WHERE products.product_id = $productId AND active=1 LIMIT 1");
		$product = mysql_fetch_assoc($result);
		
		$allProducts = array();
		$result = mysql_query("SELECT * FROM products WHERE products.product_id IN (SELECT product_id FROM parts_to_products WHERE part_id = $partId) AND products.active=1 ");
		while ($row = mysql_fetch_assoc($result))
		{
			$allProducts[] =$row;
		}
	}
	
	switch ($lang) { 
		case LANGUAGE_ENGLISH :  
			define('APPLICABLE_PRODUCTS', 'Applicable Products');
			$partName = $part['name']; 
			break;
		case LANGUAGE_FRENCH :  
			define('APPLICABLE_PRODUCTS', 'Applicable Produits');
			$partName = $part['name_fr']; 
			break;
		case LANGUAGE_SPANISH :  
			define('APPLICABLE_PRODUCTS', 'Applicable Products');
			$partName = $part['name_sp']; 
			break;
	} 
	
	if ($partName == '') {
		$partName = $part['name'];
	}
	if ($part['photo'] == '') {
		$part['photo'] = 'no_photo.jpg';
	} else if (!file_exists(PARTS_LOCATION.$part['photo'])) {
		$part['photo'] = 'no_photo.jpg';
	}

?>

<div id="breadcrumb">
	<a href="support.php?page=parts"><?php switch ($lang) { 
								case LANGUAGE_ENGLISH : echo '< back to Parts'; break;
								case LANGUAGE_FRENCH : echo '< back to Parts'; break;
								case LANGUAGE_SPANISH : echo '< back to Parts'; break;
				} ?></a>
</div>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tblProduct">
        <tr>
          <td width="202" align="center" valign="top">
          		<img class="partPhoto" src="<?=PARTS_LOCATION.$part['photo'];?>" alt="<?=$partName;?>" />
    	</td>
    <td width="353" valign="top"><h3 class="productTitle">Code #<?=$part['part_code'];?></h3> 
    		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="37%" valign="top"><?php switch ($lang) { 
								case LANGUAGE_ENGLISH : echo 'Name'; break;
								case LANGUAGE_FRENCH : echo 'Nom'; break;
								case LANGUAGE_SPANISH : echo 'Nombre'; break;
				} ?></td>
                <td width="63%"><strong><?php echo $partName; ?></strong></td>
              </tr>
               <tr>
                <td width="37%"><?php switch ($lang) { 
								case LANGUAGE_ENGLISH : echo 'Old code'; break;
								case LANGUAGE_FRENCH : echo 'Old code'; break;
								case LANGUAGE_SPANISH : echo 'Old code'; break;
				} ?></td>
                <td width="63%"><strong><?php echo $part['old_code']; ?></strong></td>
              </tr>
              </table>
	</td>
    </tr>
</table>	
<h2><?=APPLICABLE_PRODUCTS;?></h2>
 <?php 
		foreach ($allProducts as $allProduct)
		{?>
		<a href="products.php?pid=<?php echo $allProduct['product_id']; ?>"><?php echo $allProduct['name']; ?></a><br />
	<?php } ?>