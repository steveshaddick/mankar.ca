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
			<a href="<?php echo PICTURES_LOCATION; ?>applicationpotato.jpg" rel="lightbox[mafexapplication]" title="MAFEX applicator used in potatoes."><img class="pright" src="<?php echo THUMBS_LOCATION; ?>applicationpotato.jpg" alt=""></a>

			<h2>Potato Industry</h2>
			<p>The MAFEX Ultra-Low Volume applicator can be used to apply any liquid. Its most common usage is for the liquid treatment of potatoes with seed dressing agents, fungicides and anti-sprouting agents (e.g. Sprout Nip® EC).</p>
			 
			<h2>Other Fruits</h2>
			<p> The MAFEX can be used for the treatment of citrus and other fruits with various types of wax and fungicides. </p>
			  <a href="<?php echo PICTURES_LOCATION; ?>applicationcitrus.jpg" rel="lightbox[mafexapplication]" title="MAFEX applicator used in citrus to add lustre."><img class="pright" src="<?php echo THUMBS_LOCATION; ?>applicationcitrus.jpg" alt=""></a>
			<h2>Humidification</h2>
			<p>Apply water with MAFEX for dust binding and humidity control.</p>

			<?php
			break;
	}

?>
</div>
         