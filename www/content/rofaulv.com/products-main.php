<div class="padContent">
<?php

	switch ($mankarMain->lang) {
		
	case LANGUAGE_SPANISH:
		?>
		<h1>Los productos ROFA® ULV</h1>

		<?php
		break;
	case LANGUAGE_FRENCH:
		?>
		<h1>Les produits ROFA® ULV</h1>
	
		<?php
		break;
	default:
		?>
		<h1>ROFA&reg; ULV Products</h1>
		<p>The ROFA&reg; systems are available with or without telescopic arms.  As well we carry the BEMA applicator, which is a variant for floor applications.</p>
	 
		<?php
		break;
	}

?>

	 <div class="productTypeListWrapper">
		<?php foreach ($mankarMain->productTypes as $type)
		{ 
		  	?>
		  	<div class="productTypeWrapper">
			  	<div class="productType">

			  		<div class="productImage">
			  			<?php
							echo '<a href="'.$type['pretty_url'].'" title="'.$type['name'].'">';
							echo '<img src="'.THUMBS_LOCATION.$type['thumbnail'].'" alt="'.$type['name'].'">';
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