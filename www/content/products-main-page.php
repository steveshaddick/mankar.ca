<?php

	$types = array();
	$result = mysql_query("SELECT * FROM product_types WHERE active=1");
	while ($row = mysql_fetch_assoc($result))
	{
		$types[] = $row;
	}
	
	switch ($lang) { 
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

<h3><?=PRODUCTS;?></h3>
  <?php foreach ($types as $type)
  { ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="2px" class="tblProduct">
        <tr>
          <td width="175px" align="center" valign="middle" style="border-right:thin solid #999999;">
          		<?php
					echo '<a href="'.getPrettyUrl('products.php?type='.$type['type_id']).'" title="'.$type['name'].'">';
					echo '<img src="'.THUMBS_LOCATION.$type['thumbnail'].'" alt="'.$type['name'].'" class="productTypeImage">';
					echo '</a>';
				?>        
         </td>
    <td valign="top" style="background:#f9f8f7; padding-left:5px;"><div  class="highlightLine"><span class="productTitle"><a href="<?php echo getPrettyUrl('products.php?type='.$type['type_id']); ?>"><?php echo $type['name']; ?></a></span> </div>
                <p>
              <?php switch ($lang) { 
						case LANGUAGE_ENGLISH :  echo $type['blurb']; break;
						case LANGUAGE_FRENCH :  if ($type['blurb_fr'] != '') echo $type['blurb_fr']; else echo $type['blurb']; break;
						case LANGUAGE_SPANISH :   if ($type['blurb_sp'] != '') echo $type['blurb_sp']; else echo $type['blurb_sp']; break;
					} 
			?>
            </p>
          </td>
        </tr>
</table>
<br />
 <?php } ?>