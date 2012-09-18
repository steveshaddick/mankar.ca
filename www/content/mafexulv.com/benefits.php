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

				<h1>MAFEX&reg; Ultra-Low Volume (ULV)<br />Applicator Systems Main benefits</h1>
				<a href="<?php echo PICTURES_LOCATION; ?>mafex_spray_pattern.png" rel="lightbox[mafexbenefits]" title="The MAFEX atomizer creates evenly sized and spaced droplets for excellent coverage of the tuber."><img class="pright" src="<?php echo THUMBS_LOCATION; ?>mafex_spray_pattern.png" alt=""></a>
				<h2>Water Reduction</h2>
				<p>MAFEX&reg; Applicators don't use standard pressurized flood nozzles, which has been the standard way to get full coverage.  Using industrial spinning disc atomizers ensures even droplet size and excellent coverage, without the need for all that water.</p>
				<h2>Accurate Metering</h2>
				<p>MAFEX&reg;'s peristaltic pumps deliver very accurate dosage, which is adjustable and controlled by the computerized controller.</p>
				<a href="<?php echo PICTURES_LOCATION; ?>controller_with_alarm.jpg" rel="lightbox[mafexbenefits]" title="The controller allows easy adjustment of flow rate and monitors the system."><img class="pleft" src="<?php echo THUMBS_LOCATION; ?>controller_with_alarm.jpg" alt=""></a>
				<h2>Integration</h2>
				<p>The MAFEX&reg; system comes standard with a relay so that, if you wish, the pumps will stop pumping the second the table stops.  This means one less button to remember and no wasted product onto a non-moving belt or table.  Secondly, the system is lightweight and supplied with brackets to attach to your table.</p>
				<h2>Monitoring</h2>
				<p>The integrated controller allows you to adjust dosage on the fly, and also keeps an accurate log of how much product you have pumped through the system.</p>
				<p>Secondly, an integrated alarm is monitoring the atomizers to make sure they are spinning properply.  If not, a loud and bright alarm will sound immediately.  Also available is an optional flow sensor, so that if there is any disruption in the flow of the product to the atomizer (for example, if the tank is empty) the alarm will sound as well.</p>
				
				<?php
				break;
		}

	?>
</div>           