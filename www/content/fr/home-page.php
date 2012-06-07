<h3>Herbicide contribuant au respect de l'environnement.</h3>
<a href="pics/benefits1.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pright" src="pics/thumbs/benefits1.jpg" alt=""></a>
<p>Les syst&egrave;mes de pulv&eacute;risation Mankar vous proposent une technique d'application d' herbicide bonne pour l'environnement. L&eacute;gers et pratiques, gagnez du temps et all&eacute;gez votre travail gr&acirc;ce aux mod&egrave;les portables MANKAR&reg;.</p>

<p>Tous les syst&egrave;mes de vaporisation Mankar sont &eacute;quip&eacute;s d'une buse rotative brevet&eacute;e &agrave; secteur r&eacute;glable. Facile &agrave; utiliser, c'est id&eacute;al pour appliquer aux endroits qui n&eacute;cessitent une certaine vigilance, par exemple: entre les rang&eacute;es de r&eacute;colte, le long des cl&ocirc;tures et des lignes s&eacute;paratives d'une propri&eacute;t&eacute;, entre et sous les arbres et fleurs, autour des immeubles...Gr&acirc;ce &agrave; l'application d'herbicide g&eacute;n&eacute;ralement non dilu&eacute;, c'est-&agrave;-dire sans addition d'eau,  vous b&eacute;n&eacute;ficiez d'une charge moins lourde, vous pouvez commencer le travail imm&eacute;diatement sans &ecirc;tre oblig&eacute; de l'interrompre par des remplissages fastidieux et prises de mesure inutiles, et vous minimisez le risque de d&eacute;rive! Par exemple, un pulv&eacute;risateur portable conventionnel n&eacute;cessite des quantit&eacute;s beaucoup plus &eacute;lev&eacute;es et p&egrave;se en moyenne 20kg . En revanche, un r&eacute;servoir Mini Mantis Plus p&egrave;se &agrave; peine 3.3 kg! En somme, il vous est donc possible d'utiliser plusieurs sortes d'herbicides, d'en faire l'application &agrave; plusieurs endroits, et ce, tout en respectant l'environnement.</p>
<a href="pics/benefits2.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pleft" src="pics/thumbs/benefits2.jpg" alt=""></a>
<p>Bien que cet appareil fut initialement con&ccedil;u  pour l'utilisation d'herbicides tels que Roundup et d'autres produits glyphosates, ce pulv&eacute;risateur peut facilement s'adapter au traitement des cultures les plus vari&eacute;es. Nous testons continuellement cette machine et la consid&eacute;rons tr&egrave;s efficace puisqu'elle peut s'utiliser avec plusieurs sortes d'herbicides.</p>
<p><b>Mankar Ontario Inc.</b> est le distributeur et leader des syst&egrave;mes Mankar de l'Ontario, Canada.
N'h&eacute;sitez pas &agrave; <a href="contactus.php">nous contacter</a>, et d&eacute;couvrez comment nos produits peuvent optimiser votre cont&ocirc;le herbicide!</p>
<br>
          <h5 class="productsHeading">Produits</h5>
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
