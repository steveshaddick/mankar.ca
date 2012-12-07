
<?php
	if (!isset($typeId)) {
		$typeId = isset($_GET['type']) ? intval($_GET['type']) : -1;
	}
	
?>
  
  <span class="sideColumnHeading" title="<?php echo NAV_PRODUCTS; ?>"><?php echo NAV_PRODUCTS; ?></span>
  <ul class="leftProductBox">
    <?php
		
		//this'll change
    	$currentType = '';
    	if (($mankarMain->pageLocation[0] == 'products') && (isset($mankarMain->pageLocation[1] ))) {
    		$currentType = $mankarMain->pageLocation[1];
    	}
    	if (($currentType == 0) && (isset($mankarMain->pageLocation[2] ))) {
    		$currentType = $mankarMain->pageLocation[2];
    	}

		foreach ($mankarMain->totalProductTypes as $productType)
		{
			?>

			<li <?php if ($currentType == $productType['type_id']) echo " class='leftHighlight'"; ?>>
				<a class="typeName" href="/<?php echo $productType['pretty_url']; ?>"><?php echo $productType['name']; ?></a>
			</li>

			<?php
		}
  	?>
   </ul>

  	<span class="sideColumnHeading"><?php echo NAV_OTHER_PRODUCTS; ?></span>
  	<ul class="leftProductBox otherProduct">
    <?php
		
		$postfix = '';
		if ($mankarMain->lang == LANGUAGE_FRENCH) {
			$postfix = '/fr';
		} else if ($mankarMain->lang == LANGUAGE_SPANISH) {
			$postfix = '/sp';
		} else if ($mankarMain->isUSA) {
			$postfix = '/usa';
		} 
		//this'll change
		foreach ($mankarMain->superTypes as $superType)
		{
			if ($superType['supertype_id'] != $mankarMain->superTypeId) {
				?>

				<li>
					<a class="typeName" href="http://<?php echo $mankarMain->envPrefix . $superType['url'] . $postfix ; ?>">
						<img class="superTypeIcon" src="/images/<?php echo $superType['icon']; ?>" alt="" /><?php echo $superType['name']; ?>
					</a><span class="smallSlug"><?php echo $superType['slug']; ?></span>
				</li>

				<?php
			}
		}
  	?>
   </ul>