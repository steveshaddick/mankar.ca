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
			<a href="<?php echo PICTURES_LOCATION; ?>bema1000.jpg" rel="lightbox[mantis1]" title="The BEMA-1000 is a handheld option for smaller operations and maximum flexibility."><img class="pleft" src="<?php echo THUMBS_LOCATION; ?>bema1000.jpg" alt=""></a>  
        
			<h2>Above fixed forms</h2>
			<p>Either using a handheld BEMA model, or atomizers with pump mounted on a moving bar, above larger fixed forms.</p>

			<a href="<?php echo PICTURES_LOCATION; ?>mantisulv2.jpg" rel="lightbox[mantis1]" title="Here is one possible configuration with multiple atomizers mounted on a moving bar above the form."><img class="pright" src="<?php echo THUMBS_LOCATION; ?>mantisulv2.jpg" alt=""></a>
        
			<h2>Conveyors</h2>
			<p>A fixed installation above a conveyor belt or rollers, lubricating the belt and/or any forms that come by.</p>

			<?php
			break;
	}

?>
</div>
         