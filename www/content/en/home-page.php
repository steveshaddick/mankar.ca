 <h3>Chemical weed control with the lowest possible environmental impact.</h3>
          <a href="images/benefits1.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pright" src="images/benefits1.jpg" alt=""></a>
          <p>The Mankar line of sprayers offer chemical weed control with the lowest possible environmental impact.  In particular, the Mankar-Carry line are small, hand-held units that are convenient, light, and time-saving. </p>
          <p>Mankar's patented segment rotation nozzle is the primary element in all our spraying systems.  It is ideal for targeted applications such as between crops, along fence or property lines, between or under trees, or around buildings.  As you don't need to mix the chemical with any water you benefit from carrying a lot less weight, less downtime (no filling the tanks with water, measuring, etc) and virtually no drift!  For example an average backpack sprayer easily exceeds 20 kg, while a fully-loaded <a href="mini-mantra-plus_ULV_sprayer.php">Mini Mantra Plus</a> weighs only 3.3 kg!  
            
            This allows for the efficient application of different preparations in a wide range of areas and in a way that protects resources and the environment. </p>
          <a href="images/benefits2.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pleft" src="images/benefits2.jpg" alt=""></a>
          <p>While this unit's basic purpose is for Roundup or other glyphosate products, it easily can handle a variety of chemicals - we are continually testing this machine and are finding it very effective with a wide range of preparations.</p>
          <p><b>Mankar Distributing Inc.</b> is the distributor and dealer of the entire Mankar line in Ontario, Canada.  Please <a href="dealers.php">give us a call or drop us an email</a> so we can discuss how Mankar products can help you more efficiently control weeds in any application!</p>
          <br>
          <h5 class="productsHeading">Products</h5>
          <div id="divProducts">
                   <?php
		  	$types = array();
			$result = mysql_query("SELECT * FROM product_types WHERE active=1");
			while ($row = mysql_fetch_assoc($result))
			{
				if ($row['thumbnail'] == '') {
					$row['thumbnail'] = 'no_photo.jpg';
				}
				
				$types[] = $row;
				
			}
			?>
			
		  <?php foreach ($types as $type)
		  { ?>
          <div class="productBox">
			<div style="background: #efefef; padding:7px 0;">
            	<a href="products.php?type=<?=$type['type_id']; ?>"><?=$type['name']; ?></a>
            </div>
            <table>
            	<tr>
            		<td><a href="products.php?type=<?=$type['type_id']; ?>"><img style="max-height:120px;" src="<?php echo THUMBS_LOCATION.$type['thumbnail']; ?>" alt="<?php echo $type['name']; ?>" class="productTypeImage"></a></td>
                </tr>
            </table>

          </div>
		 <?php } ?>

          
      </div>
      <p id="clear">Mankar Distributing Inc. is a proud member of <a href="http://www.landscapeontario.com" target="_blank"><img src="images/lo.gif" alt=""> Landscape Ontario.</a></p>
