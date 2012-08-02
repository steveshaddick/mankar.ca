
<?php
	if (!isset($typeId)) {
		$typeId = isset($_GET['type']) ? intval($_GET['type']) : -1;
	}
	
?>


<div class="col2"> 
  
  <h2 class="leftHeading"><?=NAV_PRODUCTS;?></h2>
  <ul class="divLeftBox">
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
				<a href="/<?php echo $productType['pretty_url']; ?>"><?php if ($productType['icon'] != '') { ?><img class="typeIcon" src="/images/icons/<?php echo $productType['icon'];?>" alt= "" /> <?php } ?><span class="typeName"><?php echo $productType['name']; ?><span></a>
			</li>

			<?php
		}
  	?>
   </ul>
</div>