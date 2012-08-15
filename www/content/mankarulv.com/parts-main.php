<?php

	$allProducts = $mankarMain->getAllPartsProducts();
	$search = (isset($_GET['q'])) ? $_GET['q'] : "";
	$productId = (isset($_GET['pid'])) ? $_GET['pid'] : -1;

	//TODO: allow searching within product part results
	if ($productId > -1) {
		$productParts = $mankarMain->getPartsByProductId($productId);
	} else if ($search != '') {
		$productParts = $mankarMain->getPartsBySearch($search);
	}

	$error = '';
	if (isset($productParts['error'])) {
		switch ($productParts['error']) {
			case 'noparts':
				$error = 'There are no parts for this product.';
				break;

			case 'nosearch':
				$error = "The search has no results.";
				break;

			case 'tooshort':
				$error = "Search string too short.  Please enter at least 3 characters.";
				break;
		}
	}


	switch ($mankarMain->lang) { 
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
	
	switch ($mankarMain->lang) { 
		case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
		case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
	}
	
	
?>

<h3><?php echo PARTS;?></h3>

<p>
<?php switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH : echo 'Please select your Mankar&reg; product, or search by part number or name.'; break;
		case LANGUAGE_FRENCH : echo 'Please select your Mankar&reg; product, or search by part number or name.'; break;
		case LANGUAGE_SPANISH : echo 'Please select your Mankar&reg; product, or search by part number or name.'; break;
} ?>
</p>

<form id="frmParts" name="frmParts" action="/parts" method="get">
	<div class="partSearchBox">

    <select class="cmbProducts" id="pid" name="pid">
    	<option value="-1"><?php switch ($mankarMain->lang) { 
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
		<span class="searchTitle"><?php switch ($mankarMain->lang) { 
			case LANGUAGE_ENGLISH : echo 'Search results for "'.$search.'"'; break;
			case LANGUAGE_FRENCH : echo 'Search results for "'.$search.'"'; break;
			case LANGUAGE_SPANISH : echo 'Search results for "'.$search.'"'; break;
		} ?></span>
<?php } ?>

<?php if ($productId > -1) { ?>
		<span class="searchTitle"><?php switch ($mankarMain->lang) { 
			case LANGUAGE_ENGLISH : echo 'Parts for "'.$productParts['name'].'"'; break;
			case LANGUAGE_FRENCH : echo 'Parts for "'.$productParts['name'].'"'; break;
			case LANGUAGE_SPANISH : echo 'Parts for "'.$productParts['name'].'"'; break;
		} ?></span>
<?php } ?>

<?php
	if ($error === '') {
		foreach ($productParts['parts'] as $part)
		{ ?>
			<ul class="partsList">
				<li><a href="/parts/<?php echo $part['part_id']; ?>"><?php echo $part['name']; ?></a></li>
			</ul>
	<?php }
		}else { ?>
		<?php echo $error; ?>
	<?php } 
	} ?>