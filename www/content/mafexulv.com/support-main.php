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
				<h1>Support for MAFEX&reg; Ultra-Low Volume Applicators for Potatoes and Fruit</h1>

				<div class="productTypeListWrapper">
					 <div class="productTypeWrapper">
			          <div class="productType">

			            <div class="productImage">
			              <a href="/manuals" title="Manuals"><img src="<?php echo IMAGES_LOCATION; ?>manuals-icon.jpg" alt="Manuals"></a>
			            </div>
			            <div class="productName">

			              <a class="navLink" href="/parts">MANUALS</a>

			            </div>
			          </div>
			        </div>

			        <div class="productTypeSpacer">&nbsp;</div>

			        <div class="productTypeWrapper">
			          <div class="productType">

			            <div class="productImage">
			              <a href="/parts" title="Parts"><img src="<?php echo IMAGES_LOCATION; ?>parts-icon.jpg" alt="Parts"></a>
			            </div>
			            <div class="productName">

			              <a class="navLink" href="/parts">PARTS</a>

			            </div>
			          </div>
			        </div>

		        	<br class="clear" />
		       	</div>

				<h2>General Usage Tips</h2>
				<ul>
					<li>When stopping for short periods flush the atomizer head by pressing the "Flush" button for a few seconds.</li>
					<li>At the end of the day, run water through the entire system to flush all residue out of the hoses.</li>
				</ul>
				<h2>Controller Usage</h2>
				<ul>
					<li>To reset the total volume measured, press and hold the "Flow Rate +" button while the machine is not pumping.</li>
					<li>To restart the machine after an alarm, simply power off and on using the buttons.</li>
					<li>If you have air in the line after changing supply tanks, and you are using the flow sensor, press and hold the "Operation" button until the air bubble is past the sensor.</li>
				</ul>

				<?php
				break;
		}

	?>
</div>