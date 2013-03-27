<?php


	$part = $mankarMain->pageData['part'];
	
	switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  
			define('APPLICABLE_PRODUCTS', 'Applicable Products');
			$partName = $part['name']; 
			break;
		case LANGUAGE_FRENCH :  
			define('APPLICABLE_PRODUCTS', 'Applicable Produits');
			$partName = $part['name_fr']; 
			break;
		case LANGUAGE_SPANISH :  
			define('APPLICABLE_PRODUCTS', 'Applicable Products');
			$partName = $part['name_sp']; 
			break;
	} 
	
	if ($partName == '') {
		$partName = $part['name'];
	}
	if ($part['photo'] == '') {
		$part['photo'] = 'no-photo.gif';
	} else if (!file_exists($_SERVER['DOCUMENT_ROOT']. PARTS_LOCATION.'/'.$part['photo'])) {
		$part['photo'] = 'no-photo.gif';
	}

?>


<div id="productTopBar">
	<div class="backButton">
    	<a href="javascript:void(0);" onclick="window.history.back();"><span class="backArrow"><img src="/images/back-arrow.png" alt="" /></span>Parts</a>
    </div>
	<br class="clear" />
</div>

<div class="padContent">

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="part-table">
        <tr>
        <td width="202" align="center" valign="top">
          		<?php img($part['photo'], PARTS_LOCATION, PARTS_LOCATION.'no-photo.gif', array('class'=>'partPhoto', 'alt'=>$partName)); ?>
    	</td>
    <td width="353" valign="top">
    	<h1 class="productTitle">Code #<?=$part['part_code'];?></h1> 
    		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="37%" valign="top"><?php switch ($mankarMain->lang) { 
								case LANGUAGE_ENGLISH : echo 'Name'; break;
								case LANGUAGE_FRENCH : echo 'Nom'; break;
								case LANGUAGE_SPANISH : echo 'Nombre'; break;
				} ?></td>
                <td width="63%"><strong><?php echo $partName; ?></strong></td>
              </tr>
               <tr>
                <td width="37%"><?php switch ($mankarMain->lang) { 
								case LANGUAGE_ENGLISH : echo 'Old code'; break;
								case LANGUAGE_FRENCH : echo 'Old code'; break;
								case LANGUAGE_SPANISH : echo 'Old code'; break;
				} ?></td>
                <td width="63%"><strong><?php echo $part['old_code']; ?></strong></td>
              </tr>
              </table>
	</td>
    </tr>
</table>	
<h2><?php echo APPLICABLE_PRODUCTS; ?></h2>
 <?php 
		foreach ($part['applicableProducts'] as $product)
		{?>
		<a href="/<?php echo $product['pretty_url']; ?>"><?php echo $product['name']; ?></a><br />
	<?php } ?>

</div>