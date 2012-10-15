<div class="padContent">
<?php

	switch ($mankarMain->lang) {
		
	case LANGUAGE_SPANISH:
		?>
		<h1>Los productos MANTIS-ULV®</h1>

		<?php
		break;
	case LANGUAGE_FRENCH:
		?>
		<h1>Les produits MANTIS-ULV®</h1>
	
		<?php
		break;
	default:
		?>
		<h1>MANTIS-ULV&reg; Products</h1>
		<p>The MANTIS-ULV&reg; systems are available in various spray widths and flow rates.  To choose the right one for your operation, please consult with one of our dealers.</p>
	 
		<?php
		break;
	}

?>

	 <div class="productTypeListWrapper">
		<?php foreach ($mankarMain->totalProductTypes as $type)
		{ 
		  	?>
		  	<div class="productTypeWrapper">
			  	<div class="productType">

			  		<div class="productImage">
			  			<?php
							echo '<a href="'.$type['pretty_url'].'" title="'.$type['name'].'">';
							if (!isset($type['is_product'])) {
								echo '<img src="'.THUMBS_LOCATION.$type['thumbnail'].'" alt="'.$type['name'].'" />';
							} else {
								echo '<img src="'.PICTURES_LOCATION.$type['thumbnail'].'" alt="'.$type['name'].'" />';
							}
							echo '</a>';
						?>  
			  		</div>
			  		<div class="productName">

			  			<a class="navLink" href="<?php echo $type['pretty_url']; ?>"><?php echo $type['name']; ?></a>
			  			<?php 

			  			/*switch ($mankarMain->lang) { 
								case LANGUAGE_ENGLISH :  echo $type['blurb']; break;
								case LANGUAGE_FRENCH :  if ($type['blurb_fr'] != '') echo $type['blurb_fr']; else echo $type['blurb']; break;
								case LANGUAGE_SPANISH :   if ($type['blurb_sp'] != '') echo $type['blurb_sp']; else echo $type['blurb_sp']; break;
							} */
						?>
			  		</div>
			  	</div>
			  </div>

		<?php 
		} 
		?>
	</div>
</div>