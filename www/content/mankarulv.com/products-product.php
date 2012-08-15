<?php
	
	$product = $mankarMain->pageData['product'];
	
	if ($product['photo_page'] == "") {
		$product['photo_page'] = NO_PHOTO;
	}
	
	switch ($mankarMain->lang) { 
		default:
		case LANGUAGE_ENGLISH :  
			define('PRODUCTS', 'Products');
			define('PARTS', 'Parts');
			define('MANUAL', 'Manual');
			define('PHOTOS', 'Photos');
			define('UNITS', 'Units');

			$description = $product['description'];
			break;
		case LANGUAGE_FRENCH :  
			define('PRODUCTS', 'Produits');
			define('PARTS', 'Parts');
			define('MANUAL', 'Manual');
			define('PHOTOS', 'Photos'); 
			define('UNITS', 'Units');

			$description = $product['description_fr'];
			break;
		case LANGUAGE_SPANISH :  
			define('PRODUCTS', 'Products');
			define('PARTS', 'Parts');
			define('MANUAL', 'Manual');
			define('PHOTOS', 'Photos');
			define('UNITS', 'Units');

			$description = $product['description_sp'];
			break;
	} 

	$noLang = false;
	if ($description == '') {
		$description = $product['description'];
		$noLang = true;
	}
	if ($noLang) {
		switch ($mankarMain->lang) { 
			case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
			case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
		}
	}
	
?>

<div id="breadcrumb">
	<div style="float:left">
	<a href="/products"><?php echo PRODUCTS;?></a> - <a href="<?php echo $product['type']['pretty_url']; ?>"><?php echo $product['type']['name']; ?></a> - <?php echo $product['name']; ?>
        </div>
		<div class="units"><?=UNITS;?>: <?php if ($mankarMain->units == UNIT_METRIC) { ?><a href="/locale/units/us">U.S.</a> <?php } else { ?> <span class="unitSelected">U.S.</span> <?php } ?> | 
								<?php if ($mankarMain->units != UNIT_METRIC) { ?><a href="/locale/units/metric">Metric</a> <?php } else { ?> <span class="unitSelected">Metric</span> <?php } ?>
		</div>
</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="202" align="center" valign="top">
          		
                <img src="<?php echo PICTURES_LOCATION.$product['photo_page']; ?>" alt="<?php echo $product['name']; ?>">
    
    </td>
    <td width="353" valign="top"><h3 class="productTitle"><?php echo $product['name']; ?></h3> 
    	<?php
		if ($product['product_code'] != "") {
			?>
	        <h4 style="color:#333333; margin-top:-20px;"><?php echo 'Model #'; echo $product['product_code']; ?></h4> 
            <?php
		}
		?>
            
			<?echo $description; ?>
            <hr />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php 
			 $apnd = ($mankarMain->units == UNIT_METRIC) ? '' : '_us';
			 $lineStyle = '';
			 if ($product['spray_width'.$apnd] != '' ) {
				 ?>
                  <tr class="<?=$lineStyle?>">
                    <td width="37%"><?php switch ($mankarMain->lang) { 
                                    case LANGUAGE_ENGLISH : echo 'Spray width'; break;
                                    case LANGUAGE_FRENCH : echo 'Largeur de vaporisation'; break;
                                    case LANGUAGE_SPANISH : echo 'Spray width'; break;
                    } ?></td>
                    <td width="63%"><strong><?php switch ($mankarMain->units) { 
                                    case UNIT_METRIC : echo $product['spray_width']; break;
                                    case UNIT_US : echo $product['spray_width_us']; break;
                    } ?></strong></td>
                  </tr>
                  <?php
                  $lineStyle = ($lineStyle == 'lineItemOdd') ?'' :'lineItemOdd';
			 }
			 if ($product['nozzles'] != '' ) {
				 ?>
                  <tr class="<?=$lineStyle?>">
                    <td><?php switch ($mankarMain->lang) { 
                                    case LANGUAGE_ENGLISH : echo 'No. of nozzles'; break;
                                    case LANGUAGE_FRENCH : echo 'Nombre de buses'; break;
                                    case LANGUAGE_SPANISH : echo 'No. of nozzles'; break;
                    } ?></td>
                    <td><strong><?php echo $product['nozzles']; ?></strong></td>
                  </tr>
                  <?php
                  $lineStyle = ($lineStyle == 'lineItemOdd') ?'' :'lineItemOdd';
			 }
			 if ($product['tank'.$apnd] != '' ) {
			 	?>
                  <tr class="<?=$lineStyle?>">
                    <td><?php switch ($mankarMain->lang) { 
                                    case LANGUAGE_ENGLISH : echo 'Tank capacity'; break;
                                    case LANGUAGE_FRENCH : echo 'Volume du r&eacute;servoir'; break;
                                    case LANGUAGE_SPANISH : echo 'Tank capacity'; break;
                    } ?></td>
                    <td><strong><?php switch ($mankarMain->units) { 
                                    case UNIT_METRIC : echo $product['tank']; break;
                                    case UNIT_US : echo $product['tank_us']; break;
                    } ?></strong></td>
                  </tr>
                  <?php
			 	$lineStyle = ($lineStyle == 'lineItemOdd') ?'' :'lineItemOdd';
			 }
			 if ($product['area'.$apnd] != '' ) {
				 ?>
                  <tr class="<?=$lineStyle?>">
                    <td><?php switch ($mankarMain->lang) { 
                                    case LANGUAGE_ENGLISH :  echo 'Area covered'; break;
                                    case LANGUAGE_FRENCH :  echo 'Surface traitable'; break;
                                    case LANGUAGE_SPANISH :  echo 'Area covered'; break;
                    } ?></td>
                    <td><strong><?php switch ($mankarMain->units) { 
                                    case UNIT_METRIC : echo $product['area']; break;
                                    case UNIT_US : echo $product['area_us']; break;
                    } ?></strong></td>
                  </tr>
                  <?php
				  $lineStyle = ($lineStyle == 'lineItemOdd') ?'' :'lineItemOdd';
			 }
			 if ($product['weight'.$apnd] != '' ) {
				 ?>
				  <tr class="<?=$lineStyle?>">
					<td><?php switch ($mankarMain->lang) { 
									case LANGUAGE_ENGLISH :  echo 'Weight'; break;
									case LANGUAGE_FRENCH :  echo 'Poids'; break;
									case LANGUAGE_SPANISH :  echo 'Weight'; break;
					} ?></td>
					<td><strong><?php switch ($mankarMain->units) { 
									case UNIT_METRIC : echo $product['weight']; break;
									case UNIT_US : echo $product['weight_us']; break;
					} ?></strong></td>
				  </tr>
                  <?php
				  $lineStyle = ($lineStyle == 'lineItemOdd') ?'' :'lineItemOdd';
			 }
			 if ($product['time'] != '' ) {
				 ?>
				  <tr class="<?=$lineStyle?>">
					<td><?php switch ($mankarMain->lang) { 
									case LANGUAGE_ENGLISH :  echo 'Working time'; break;
									case LANGUAGE_FRENCH :  echo 'Autonomie'; break;
									case LANGUAGE_SPANISH :  echo 'Working time'; break;
					} ?></td>
					<td><strong><?php echo $product['time']; ?></strong></td>
				   
				  </tr>
                  <?php
			 }
			 ?>
            </table>
            <hr />
          </td>
        </tr>
</table>
<br />

<?php if (count($product['pictures']) > 0) { 
	?>
    <h2><?=PHOTOS;?></h2>
	<span class="clickPhoto"><?php switch ($mankarMain->lang) { 
					case LANGUAGE_ENGLISH :  echo 'Click photos to see larger.'; break;
					case LANGUAGE_FRENCH :  echo 'Click photos to see larger.'; break;
					case LANGUAGE_SPANISH :  echo 'Click photos to see larger.'; break;
			} ?>
    </span>
    <div id="photoSlider">
    <table>
    <tr>
    <?php	
        
        foreach ($product['pictures'] as $key=>$pic)
        {
           $picDescription = "";
		   switch ($mankarMain->lang) { 
				case LANGUAGE_ENGLISH :   $picDescription = $pic['photo_description']; break;
				case LANGUAGE_FRENCH :  $picDescription = ($pic['photo_description_fr'] != '') ? $pic['photo_description_fr'] : $pic['photo_description']; break;
				case LANGUAGE_SPANISH :  $picDescription = ($pic['photo_description_sp'] != '') ? $pic['photo_description_sp'] : $pic['photo_description']; break;
			}
		    echo '<td><a href="'.PICTURES_LOCATION.$pic['photo'].'" rel="lightbox[micromantra]" title="'.$picDescription.'">';
            echo '<img src="'.THUMBS_LOCATION.$pic['photo'].'" />';
            echo '</a></td>';
        }
        
    ?>
    </tr>
    </table>
    </div>
<?php } ?>
<br />


<?php 
if (count($product['parts']) > 0) {
	?>
    <h2><?=PARTS;?></h2>
	<a href="/parts?pid=<?=$product['product_id']; ?>">
    <?php
    switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  echo 'View available parts for '.$product['name'].'.'; break;
		case LANGUAGE_FRENCH :  echo 'View available parts for '.$product['name'].'.'; break;
		case LANGUAGE_SPANISH :  echo 'View available parts for '.$product['name'].'.'; break;
	} 
	?>
    </a></li>
<?php 
}

?>

<?php if ($product['manual'] != "") {
	?>
	<h2><?=MANUAL;?></h2>
    <a href="<?php echo MANUALS_LOCATION.$product['manual'];?>" target="_blank">
     <?php
    switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  echo 'View PDF Manual for '.$product['name'].'.'; break;
		case LANGUAGE_FRENCH :  echo 'View PDF Manual for '.$product['name'].'.'; break;
		case LANGUAGE_SPANISH :  echo 'View PDF Manual for '.$product['name'].'.'; break;
	} 
	?>
    </a></li>
<?php }
?>