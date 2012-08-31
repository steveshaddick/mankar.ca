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
			<a href="<?php echo PICTURES_LOCATION; ?>application1.jpg" rel="lightbox[application]" title="In between gravestones"><img class="pright" src="<?php echo PICTURES_LOCATION; ?>thumbs/application1.jpg" alt=""></a>

			<h2>Potato Industry</h2>
			<p>The MAFEX Ultra-Low Volume applicator can be used to apply any liquid. Its most common usage is for the liquid treatment of potatoes with seed dressing agents, fungicides and anti-sprouting agents (e.g. Sprout Nip® EC).</p>
			 
			<h2>Other Fruits</h2>
			<p> The MAFEX can be used for the treatment of citrus and other fruits with various types of wax and fungicides. </p>
			  <a href="<?php echo PICTURES_LOCATION; ?>application2.jpg" rel="lightbox[application]" title="In a tree nursery"><img class="pright" src="<?php echo PICTURES_LOCATION; ?>thumbs/application2.jpg" alt=""></a>
			<h2>Humidification</h2>
			<p>Apply water with MAFEX for dust binding and humidity control.</p>

			<?php
			break;
	}

?>
</div>
         