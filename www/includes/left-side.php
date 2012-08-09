
<?php
	if (!isset($typeId)) {
		$typeId = isset($_GET['type']) ? intval($_GET['type']) : -1;
	}
	
?>


<div class="col2"> 
  
  <h2 class="leftHeading"><a href="/products" title="<?php echo NAV_PRODUCTS; ?>"><?php echo NAV_PRODUCTS; ?></a></h2>
  <ul class="leftProductBox">
    <?php
		
		//this'll change
    	$currentType = '';
    	if (($mankarMain->pageLocation[0] == 'products') && (isset($mankarMain->pageLocation[1] ))) {
    		$currentType = $mankarMain->pageLocation[1];
    	}

		foreach ($mankarMain->productTypes as $productType)
		{
			?>

			<li <?php if ($currentType == $productType['type_id']) echo " class='leftHighlight'"; ?>>
				<a class="typeName" href="/<?php echo $productType['pretty_url']; ?>"><?php echo $productType['name']; ?></a>
			</li>

			<?php
		}
  	?>
   </ul>

  	<h2 class="leftHeading"><a href="/products" title="<?php echo NAV_OTHER_PRODUCTS; ?>"><?php echo NAV_OTHER_PRODUCTS; ?></a></h2>
  	<ul class="leftProductBox otherProduct">
    <?php
		
		//this'll change
		foreach ($mankarMain->superTypes as $superType)
		{
			if ($superType['supertype_id'] != $mankarMain->superTypeId) {
				?>

				<li>
					<a class="typeName" href="http://<?php echo $mankarMain->envPrefix . $superType['url']; ?>"><img class="superTypeIcon" src="/images/<?php echo $superType['icon']; ?>" alt="" /><?php echo $superType['name']; ?></a>
				</li>

				<?php
			}
		}
  	?>
   </ul>
</div>