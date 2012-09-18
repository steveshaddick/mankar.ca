<div class="padContent">
	<?php

	switch ($mankarMain->lang) {
		
		case LANGUAGE_SPANISH:

			echo NO_SPANISH;
			break;
		case LANGUAGE_FRENCH:	
			echo NO_FRENCH;
			break;
	}

	switch ($mankarMain->lang) {


		default:
			?>

			<h1>Areas of application</h1>
			<a href="<?php echo PICTURES_LOCATION; ?>rofa-cows.jpg" rel="lightbox[rofaapplication]" title="ROFA applicator used in a dairy barn."><img class="pright" src="<?php echo THUMBS_LOCATION; ?>rofa-cows.jpg" alt="ROFA applicator"></a>

			<h2>Livestock Industry</h2>
			<p>The ROFA can be used to apply insecticides around livestock such as cows, horses, mink, chickens, and anywhere else you have a fly problem.</p>

			<a href="<?php echo PICTURES_LOCATION; ?>bema-pool.jpg" rel="lightbox[rofaapplication]" title="BEMA-500 applicator used to sanitize pool area."><img class="pleft" src="<?php echo THUMBS_LOCATION; ?>bema-pool.jpg" alt="BEMA-500 Applicator"></a>
			 
			<h2>Sanitation</h2>
			<p> The ROFA and BEMA applicators can be used to apply sanitizing products to areas such as pools and food preparation areas.</p>

			<?php
			break;
	}

?>
</div>
         