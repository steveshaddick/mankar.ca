<div class="padContent">
	<?php

	switch ($mankarMain->lang) {
		
		case LANGUAGE_SPANISH:

			echo NO_SPANISH;
			break;
	}

	switch ($mankarMain->lang) {

		case LANGUAGE_FRENCH:
			?>

			<h1>Domaine d'application</h1>
			<a href="<?php echo PICTURES_LOCATION; ?>application1.jpg" rel="lightbox[application]" title="In between gravestones"><img class="pright" src="<?php echo THUMBS_LOCATION; ?>application1.jpg" alt=""></a>

			<h2>Exploitations horticoles, p&eacute;pini&egrave;res, centres de jardinage</h2>
			<p>p. ex., cultures foresti&egrave;res, cultures de sapins de no&euml;l, d&rsquo;arbres et de plantes</p>
			<h2>Agriculture, horticulture, viticulture et sylviculture</h2>
			<p>p.ex., repousses de pommes de terre, fraises, lutte contre le prunus padus (cerisier &agrave; grappes)</p>
			<h2>Communes (selon disposition)</h2>
			<p>p. ex. : rues, cimeti&egrave;res, installations sportives et parcs</p>
			<a href="<?php echo PICTURES_LOCATION; ?>application2.jpg" rel="lightbox[application]" title="In a tree nursery"><img class="pright" src="<?php echo THUMBS_LOCATION; ?>application2.jpg" alt=""></a>
			<h2>Horticulture et architecture paysagiste</h2>
			<p>p. ex. : cr&eacute;ation d&rsquo;espaces verts aux abords des rues, dans les  communes, les zones industrielles, les installations sportives, les  jardins priv&eacute;s, les ports et les a&eacute;roports, les h&ocirc;pitaux, les  universit&eacute;s et les parcs d&rsquo;exposition</p>
			<h2>Loisirs</h2>
			<p>p. ex. : campings, ensembles de maisons individuelles, terrains de  golf, installations sportives, jardins zoologiques, parcs de loisirs</p>
			
			<?php
			break;

		default:
			?>

			<h1>Areas of application</h1>
			<a href="<?php echo PICTURES_LOCATION; ?>application1.jpg" rel="lightbox[application]" title="In between gravestones"><img class="pright" src="<?php echo THUMBS_LOCATION; ?>application1.jpg" alt=""></a>

			<h2>Garden centres, tree nurseries</h2>
			<p>e.g. Christmas tree and forestry cultivation, trees, shrubs, plants</p>
			<h2>Agriculture, landscape gardening, viticulture, forestry</h2>
			<p>e.g. potatoes, strawberries, control of Prunus padus (bird cherry)</p>
			<h2>Local authorities</h2>
			<p>e.g. streets, cemeteries, sports facilities, parks</p>
			 
			<h2>Gardening and landscape gardening</h2>
			<p>e.g. maintenance of green areas: roadsides, ditches, business parks,  private gardens, airports, hospitals, universities, exhibition centres</p>
			  <a href="<?php echo PICTURES_LOCATION; ?>application2.jpg" rel="lightbox[application]" title="In a tree nursery"><img class="pright" src="<?php echo THUMBS_LOCATION; ?>application2.jpg" alt=""></a>
			<h2>Leisure</h2>
			<p>e.g. camp sites, trailer parks, golf courses, sports grounds, zoos, theme parks</p>

			<?php
			break;
	}

?>
</div>
         