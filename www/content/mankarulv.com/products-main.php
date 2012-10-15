<div class="padContent">
<?php

	switch ($mankarMain->lang) {
		
	case LANGUAGE_SPANISH:
		?>
		<h1>Los productos MANKAR® ULV ofrecen soluciones especializadas para el empleo de herbicidas, por ej.</h1>
		<ul>
			<li>en la jardinería paisajística</li>
			<li>en la fruticultura y viticultura</li>
			<li>en la horticultura</li>
			<li>en la floricultura</li>
			<li>en el ámbito municipal y en areas industriales</li>
		</ul>

		<?php
		break;
	case LANGUAGE_FRENCH:
		?>
		<h1>Les produits MANKAR® ULV offrent des solutions spécialisées pour l‘utilisation d‘herbicides, par ex.</h1>
		<ul>
			<li>dans l‘horticulture et l‘architecture paysagiste</li>
			<li>dans les pépinières / cultures de sapins de Noël</li>
			<li>dans les vergers et les vignobles</li>
			<li>dans les cultures de plantes ornementales</li>
			<li>dans le domaine communal et les zones industrielles</li>
		</ul>
	
		<?php
		break;
	default:
		?>
		<h1>Products</h1>
		<p>Please choose one of the following categories of MANKAR&reg; products.  The various types have different features which may make them more applicable to your business, and if you are unsure which is best for you please give your nearest dealer a call.</p>
	 
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