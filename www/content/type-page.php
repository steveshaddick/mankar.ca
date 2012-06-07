<?php


	$products = array();
	$result = mysql_query("SELECT * FROM products WHERE products.type_id = $typeId AND active=1 ORDER BY products.product_order");
	while ($row = mysql_fetch_assoc($result))
	{
		$products[] = $row;
	}
	switch ($lang) { 
		case LANGUAGE_ENGLISH :  
			define('PRODUCTS', 'Products');
			define('UNITS', 'Units');
			define('READ_MORE', 'Read more...');
			define('READ_LESS', '(Read less)');
			break;
		case LANGUAGE_FRENCH :  
			define('PRODUCTS', 'Produits');
			define('UNITS', 'Units');
			define('READ_MORE', 'Read more...');
			define('READ_LESS', '(Read less)');
			break;
		case LANGUAGE_SPANISH :  
			define('PRODUCTS', 'Products');
			define('UNITS', 'Units');
			define('READ_MORE', 'Read more...');
			define('READ_LESS', '(Read less)');
			break;
	} 
	
	switch ($lang) { 
		case LANGUAGE_ENGLISH :  $blurb = $type['blurb']; $description = $type['description']; break;
		case LANGUAGE_FRENCH :   $blurb = $type['blurb_fr']; $description = $type['description_fr']; break;
		case LANGUAGE_SPANISH :  $blurb = $type['blurb_sp']; $description = $type['description_sp']; break;
	} 
	
	
	$noLang = false;
	if ($blurb == '') {
		$blurb = $type['blurb'];
		$noLang = true;
	}
	if ($description == '') {
		$description = $type['description'];
		$noLang = true;
	}
	if (strtolower($description) == 'empty') {
		$description = '';
	}
	if ($noLang) {
		switch ($lang) { 
			case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
			case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
		}
	}
	
?>

<div id="breadcrumb">
	<div style="float:left">
    <a href="<?php echo getPrettyUrl('products.php'); ?>"><?=PRODUCTS;?></a> - <?php echo $type['name']; ?>
     <?php
		$query = "";
		foreach ($_GET as $key=>$value)
		{
			if ($key != "units") {
				$query .= $key."=".$value."&";
			}
		} ?>
        </div>
		<div class="units"><?=UNITS;?>: <?php if ($units == UNIT_METRIC) {?><a href="<?php echo $baseUrl."?".$query."units=".UNIT_US; ?>">U.S.</a> <?php } else { ?> <span class="unitSelected">U.S.</span> <?php } ?> | 
								<?php if ($units != UNIT_METRIC) {?><a href="<?php echo $baseUrl."?".$query."units=".UNIT_METRIC; ?>">Metric</a> <?php } else { ?> <span class="unitSelected">Metric</span> <?php } ?>
		</div>
</div>

<h3 class="productType">
	<?php echo $type['display_title']; ?>
</h3>
<div id="productTypeBlurb">
<?=$blurb;?>
<?php
if ($description != '') {
	?>
    <div id="CollapsiblePanel1" class="CollapsiblePanel">
     
      <div id="CollapseContent" class="CollapsiblePanelContent">
      <?=$description;?>
      </div>
      <?php //the text for the collapse tab is also set in SpryCollapsiblePanel.js ?>
       <div id="CollapseTab" class="CollapsiblePanelTab" tabindex="0"><a href="#"><?=READ_MORE;?></a></div>
    
    </div>
    <?php
}
?>
</div>

<script type="text/javascript">
<!--
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", {contentIsOpen: false}, '<?=READ_MORE;?>','<?=READ_LESS;?>');
//-->
</script>


<?php
	foreach ($products as $product)
	{ ?>
	<table width="100%" border="0" cellpadding="0" cellspacing="2px" class="tblProduct">
        <tr>
          <td width="175px" align="center" valign="middle" style="border-right:thin solid #999999;">
          		<?php
					echo '<a href="'.getPrettyUrl('products.php?pid='.$product['product_id']).'" title="'.$product['name'].'">';
					echo '<img src="'.PICTURES_LOCATION.$product['photo_list'].'" alt="'.$product['name'].'" class="productTypeImage">';
					echo '</a>';
				?>        
         </td>
    <td valign="top" style="background:#f9f8f7; padding-left:5px;"><div  class="highlightLine"><span class="productTitle"><a href="<?php echo getPrettyUrl('products.php?pid='.$product['product_id']); ?>"><?php echo $product['name']; ?></a></span> </div>
              <br>
            <p>
			<?php 
			$apnd = ($units == UNIT_METRIC) ? '' : '_us';
			if ($product['spray_width'.$apnd] != '') {
				switch ($lang) { 
						case LANGUAGE_ENGLISH : echo 'Spray width: '; break;
						case LANGUAGE_FRENCH : echo 'Largeur de vaporisation: '; break;
						case LANGUAGE_SPANISH : echo 'Spray width: '; break;
					} ?>
					 <strong><?php switch ($units) { 
						case UNIT_METRIC : echo $product['spray_width']; break;
						case UNIT_US : echo $product['spray_width_us']; break;
					} ?></strong>
					</p>
                    <?php
			}
			?>
                <p>
              <?php switch ($lang) { 
								case LANGUAGE_ENGLISH : $desc = strip_tags($product['description']); break;
								case LANGUAGE_FRENCH : $desc =($product['description_fr'] != '') ? strip_tags($product['description_fr']) : strip_tags($product['description']); break;
								case LANGUAGE_SPANISH : $desc =($product['description_sp'] != '') ? strip_tags($product['description_sp']) : strip_tags($product['description']); break;
					} 
					if (strpos($desc,".") > 150) {
						echo substr($desc,0,strpos($desc,".",150)+1);
					} else {
						echo substr($desc,0,strpos($desc,".")+1);
					}
					?> <br /><span class="productMore"><a href="<?php echo getPrettyUrl('products.php?pid='.$product['product_id']); ?>"><?=READ_MORE;?></a></span></p><?php ;		
					?>

          </td>
        </tr>
</table>
<br />
<?php 
	}
	?>