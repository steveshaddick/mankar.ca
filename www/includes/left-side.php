
<?php
	if (!isset($typeId)) {
		$typeId = isset($_GET['type']) ? intval($_GET['type']) : -1;
	}
	
	$productTypes = array();
	$result = mysql_query("SELECT * FROM product_types WHERE active=1");
	while($row = mysql_fetch_assoc($result))
	{
		$productTypes[] = $row;
	}
	
	switch ($mankarMain->lang) { 
	case LANGUAGE_ENGLISH :  
		define('NAV_BENEFITS', 'Main Benefits');
		define('NAV_TECHNOLOGY', 'Technology & Patent');
		define('NAV_COSTSHARE', 'Government Cost-Share');
		define('NAV_APPLICATION', 'Areas of Application');
		define('NAV_MANUALS', 'Manuals / Tips');
		define('NAV_PARTS', 'Parts');
		break;
	case LANGUAGE_FRENCH :  
		define('NAV_BENEFITS', 'Main Benefits');
		define('NAV_TECHNOLOGY', 'Technology & Patent');
		define('NAV_COSTSHARE', 'Government Cost-Share');
		define('NAV_APPLICATION', 'Areas of Application');	
		define('NAV_MANUALS', 'Manuals / Tips');
		define('NAV_PARTS', 'Parts');
		break;
	case LANGUAGE_SPANISH :  
		define('NAV_BENEFITS', 'Main Benefits');
		define('NAV_TECHNOLOGY', 'Technology & Patent');
		define('NAV_COSTSHARE', 'Government Cost-Share');
		define('NAV_APPLICATION', 'Areas of Application');
		define('NAV_MANUALS', 'Manuals / Tips');
		define('NAV_PARTS', 'Parts');
		break;
} 

?>


<div class="col2"> 
  <?php switch ($mankarMain->baseUrl) {
	  case "information.php":
	  ?>
    <h2 class="leftHeading"><?=NAV_INFO;?></h2>
  	<ul class="divLeftBox">
    	<li<?php if ($subPage == "main-benefits") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=main-benefits'); ?>"><?=NAV_BENEFITS;?></a></li>
        <li<?php if ($subPage == "technology") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=technology'); ?>"><?=NAV_TECHNOLOGY;?></a></li>
        <li<?php if ($subPage == "cost-share") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=cost-share'); ?>"><?=NAV_COSTSHARE;?></a></li>
        <li<?php if ($subPage == "application") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php?page=application'); ?>"><?=NAV_APPLICATION;?></a></li>
    </ul>
      
  <?php break;
  	
	case "support.php":
	  ?>
    <h2 class="leftHeading"><?=NAV_SUPPORT;?></h2>
  	<ul class="divLeftBox">
       	<li<?php if ($subPage == "tips-manuals") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('support.php?page=tips-manuals'); ?>"><?=NAV_MANUALS;?></a></li>
        <li<?php if ($subPage == "parts") echo " class='leftHighlight'"; ?>><a href="<?php echo getPrettyUrl('support.php?page=parts'); ?>"><?=NAV_PARTS;?></a></li>
    </ul>
      
  <?php
  
  
  }?>

  <h2 class="leftHeading"><?=NAV_PRODUCTS;?></h2>
  <ul class="divLeftBox">
    <?php
		foreach ($productTypes as $pType)
		{
			echo '<li';
			if ($typeId == $pType['type_id']) echo " class='leftHighlight'";
			echo ' ><a href="'.getPrettyUrl('products.php?type='.$pType['type_id']).'">'.$pType['name'].'</a></li>';
		}
  	?>
   </ul>
</div>