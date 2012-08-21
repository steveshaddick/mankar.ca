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
		$part['photo'] = 'no_photo.jpg';
	} else if (!file_exists(PARTS_LOCATION.$part['photo'])) {
		$part['photo'] = 'no_photo.jpg';
	}

?>

<div id="breadcrumb">
	<a href="/parts"><?php switch ($mankarMain->lang) { 
								case LANGUAGE_ENGLISH : echo '< back to Parts'; break;
								case LANGUAGE_FRENCH : echo '< back to Parts'; break;
								case LANGUAGE_SPANISH : echo '< back to Parts'; break;
				} ?></a>
</div>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tblProduct">
        <tr>
          <td width="202" align="center" valign="top">
          		<img class="partPhoto" src="<?=PARTS_LOCATION.$part['photo'];?>" alt="<?=$partName;?>" />
    	</td>
    <td width="353" valign="top"><h3 class="productTitle">Code #<?=$part['part_code'];?></h3> 
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