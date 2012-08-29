<?php
	
	$productType = $mankarMain->pageData['productType'];


	switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  
			define('PRODUCTS', 'Products');
			define('UNITS', 'Units');
			define('READ_MORE', 'Read more...');
			define('READ_LESS', '(Read less)');
			define('VIEW_PRODUCT', 'View Product &gt;');

			$blurb = $productType['blurb']; 
			$description = $productType['description'];
			break;
		case LANGUAGE_FRENCH :  
			define('PRODUCTS', 'Produits');
			define('UNITS', 'Units');
			define('READ_MORE', 'Read more...');
			define('READ_LESS', '(Read less)');
			define('VIEW_PRODUCT', 'View Product &gt;');

			$blurb = $productType['blurb_fr']; 
			$description = $productType['description_fr']; 
			break;
		case LANGUAGE_SPANISH :  
			define('PRODUCTS', 'Products');
			define('UNITS', 'Units');
			define('READ_MORE', 'Read more...');
			define('READ_LESS', '(Read less)');
			define('VIEW_PRODUCT', 'View Product &gt;');

			$blurb = $productType['blurb_sp']; 
			$description = $productType['description_sp'];
			break;
	} 
	
	
	$noLang = false;
	if ($blurb == '') {
		$blurb = $productType['blurb'];
		$noLang = true;
	}
	if ($description == '') {
		$description = $productType['description'];
		$noLang = true;
	}
	if (strtolower($description) == 'empty') {
		$description = '';
	}
	if ($noLang) {
		switch ($mankarMain->lang) { 
			case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
			case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
		}
	}
	
?>

<div id="productTopBar">
	<div class="backButton">
    	<a href="/products"><span class="backArrow"><img src="/images/back-arrow.png" alt="" /></span><?php echo PRODUCTS; ?></a>
    </div>
	<div class="units">
		<a class="localeLink <?php if ($mankarMain->units == UNIT_US) { echo 'selected'; } ?>" href="/locale/units/us">U.S.</a>
		<a class="localeLink <?php if ($mankarMain->units == UNIT_METRIC) { echo 'selected'; } ?>" href="/locale/units/metric">Metric</a>
	</div>
	<br class="clear" />
</div>

<div class="padContent">
	<h1><?php echo $productType['display_title']; ?></h1>

	<div id="productTypeBlurb">
	<?php echo $blurb; ?>
	<?php
	if ($description != '') {
		?>
	    <div id="CollapsiblePanel1" class="CollapsiblePanel">
	     
	      <div id="CollapseContent" class="CollapsiblePanelContent">
	      <?php echo $description; ?>
	      </div>
	      <?php //the text for the collapse tab is also set in SpryCollapsiblePanel.js ?>
	       <div id="CollapseTab" class="CollapsiblePanelTab" tabindex="0"><a href="#"><?php echo READ_MORE; ?></a></div>
	    
	    </div>
	    <?php
	}
	?>
	</div>

	<script productType="text/javascript">
	<!--
	var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", {contentIsOpen: false}, '<?php echo READ_MORE;?>','<?php echo READ_LESS;?>');
	//-->
	</script>


	<?php
		foreach ($productType['productList'] as $product)
		{ ?>
		<table width="100%" border="0" cellpadding="0" cellspacing="2px" class="tblProduct">
	        <tr>
	          <td width="175px" align="center" valign="middle" style="border-right:thin solid #999999;">
	          		<?php
						echo '<a href="'.$product['pretty_url'].'" title="'.$product['name'].'">';
						echo '<img src="'.PICTURES_LOCATION.$product['photo_list'].'" alt="'.$product['name'].'" class="productTypeImage">';
						echo '</a>';
					?>        
	         </td>
	    <td valign="top" class="productWrapper">
	    	<div><a class="productTitle" href="<?php echo $product['pretty_url']; ?>"><?php echo $product['name']; ?></a></div>
	        <div class="productSpray">
				<?php 
				$apnd = ($mankarMain->units == UNIT_METRIC) ? '' : '_us';
				if ($product['spray_width'.$apnd] != '') {
					switch ($mankarMain->lang) { 
						case LANGUAGE_ENGLISH : echo 'Spray width: '; break;
						case LANGUAGE_FRENCH : echo 'Largeur de vaporisation: '; break;
						case LANGUAGE_SPANISH : echo 'Spray width: '; break;
					} ?>
					 <strong>
					 	<?php 
					 	switch ($mankarMain->units) { 
							case UNIT_METRIC : echo $product['spray_width']; break;
							case UNIT_US : echo $product['spray_width_us']; break;
						} ?>
					</strong>
	                <?php
				}
				?>
				</div>
	            <div class="productDescription">
	          	<?php 
	          		switch ($mankarMain->lang) { 
						case LANGUAGE_ENGLISH : $desc = strip_tags($product['description']); break;
						case LANGUAGE_FRENCH : $desc =($product['description_fr'] != '') ? strip_tags($product['description_fr']) : strip_tags($product['description']); break;
						case LANGUAGE_SPANISH : $desc =($product['description_sp'] != '') ? strip_tags($product['description_sp']) : strip_tags($product['description']); break;
					} 
					if (strpos($desc,".") > 150) {
						echo substr($desc,0,strpos($desc,".",150)+1);
					} else {
						echo substr($desc,0,strpos($desc,".")+1);
					}
					?> <br />
					<a class="viewProduct" href="<?php echo $product['pretty_url']; ?>"><?php echo VIEW_PRODUCT; ?></a>
				</div>

      </td>
    </tr>
	</table>
	<br />
	<?php 
		}
		?>
</div>