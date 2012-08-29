<?php

	switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  
			define('PRODUCTS', 'Products');
			break;
		case LANGUAGE_FRENCH :  
			define('PRODUCTS', 'Produits');
			break;
		case LANGUAGE_SPANISH :  
			define('PRODUCTS', 'Products');
			break;
	} 
	
?>

<div class="padContent">
	<h1><?=PRODUCTS;?></h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	  
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