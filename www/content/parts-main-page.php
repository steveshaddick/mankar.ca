<?php

	$search = (isset($_GET['q'])) ? $_GET['q'] : "";
	$productId = (isset($_GET['pid'])) ? $_GET['pid'] : -1;

	$allProducts = array();
	$result = mysql_query("SELECT * FROM products WHERE product_id IN (SELECT product_id FROM parts_to_products) AND products.active=1");
	while($row= mysql_fetch_assoc($result))
	{
		$allProducts[] = $row;
	}
	
	$strError = "";
	if ($productId > -1) {
		$parts = array();
		$result = mysql_query("SELECT * FROM parts WHERE part_id IN (SELECT part_id FROM parts_to_products WHERE parts_to_products.product_id=$productId) AND parts.active=1");
		while($row= mysql_fetch_assoc($result))
		{
			$parts[] = $row;
		}
		$strError = "There are no parts for this product.";
		
		$result = mysql_query("SELECT name FROM products WHERE product_id=$productId AND products.active=1");
		$partProduct = mysql_fetch_assoc($result);
		
	} else if ($search != "") {
		if (strlen($search) >= 3) {
			$parts = array();
			$result = mysql_query("SELECT * FROM parts WHERE (part_code LIKE '%$search%' OR name LIKE '%$search%' OR agtec_code LIKE '%$search%' OR old_code LIKE '%$search%') AND parts.active=1");
			while($row= mysql_fetch_assoc($result))
			{
				$parts[] = $row;
			}
			$strError = "The search has no results.";
		} else {
			$strError = "Search string too short.  Please enter at least 3 characters.";
		}
	}
	
	switch ($lang) { 
		case LANGUAGE_ENGLISH :  
			define('PARTS', 'Parts');
			break;
		case LANGUAGE_FRENCH :  
			define('PARTS', 'Parts');
			break;
		case LANGUAGE_SPANISH :  
			define('PARTS', 'Parts');
			break;
	} 
	
	switch ($lang) { 
		case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
		case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
	}
	
	
?>

<h3><?=PARTS;?></h3>

<p>
<?php switch ($lang) { 
		case LANGUAGE_ENGLISH : echo 'Please select your Mankar&reg; product, or search by part number or name.'; break;
		case LANGUAGE_FRENCH : echo 'Please select your Mankar&reg; product, or search by part number or name.'; break;
		case LANGUAGE_SPANISH : echo 'Please select your Mankar&reg; product, or search by part number or name.'; break;
} ?>
</p>

<form id="frmParts" name="frmParts" action="support.php" method="get">
	<div class="partSearchBox">
    <input type="hidden" id="page" name="page" value="parts" />
    <select class="cmbProducts" id="pid" name="pid">
    	<option value="-1"><?php switch ($lang) { 
			case LANGUAGE_ENGLISH : echo '[choose product]'; break;
			case LANGUAGE_FRENCH : echo '[choose product]'; break;
			case LANGUAGE_SPANISH : echo '[choose product]'; break;
		} ?></option>
		<?php
			foreach ($allProducts as $product)
			{ ?>
        	<option value="<?php echo $product['product_id']; ?>"><?php echo $product['name']; ?></option>
        <?php 
			} ?>
    </select>
	<input type="submit" value="Show Product">
    </div>
    
    <div class="partSearchBox">
        <input id="q" name="q" type="text" size="25" value="">
        <input type="submit" value="Search">
    </div>
</form>
<br style="clear:both" />

<?php 
	if (($productId > -1) || ($search != "")) { ?>
    
<?php if ($search != "") { ?>
		<span class="searchTitle"><?php switch ($lang) { 
			case LANGUAGE_ENGLISH : echo 'Search results for "'.$search.'"'; break;
			case LANGUAGE_FRENCH : echo 'Search results for "'.$search.'"'; break;
			case LANGUAGE_SPANISH : echo 'Search results for "'.$search.'"'; break;
		} ?></span>
<?php } ?>

<?php if ($productId > -1) { ?>
		<span class="searchTitle"><?php switch ($lang) { 
			case LANGUAGE_ENGLISH : echo 'Parts for "'.$partProduct['name'].'"'; break;
			case LANGUAGE_FRENCH : echo 'Parts for "'.$search.'"'; break;
			case LANGUAGE_SPANISH : echo 'Parts for "'.$search.'"'; break;
		} ?></span>
<?php } ?>

<?php
	if (count($parts) > 0) {
		foreach ($parts as $part)
		{ ?>
			<ul class="partsList">
				<li><a href="support.php?page=parts&partid=<?php echo $part['part_id']; ?>"><?php echo $part['name']; ?></a></li>
			</ul>
	<?php }
		}else { ?>
		<?php echo $strError; ?>
	<?php } 
	} ?>