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
				<h1>Support for ROFA&reg; Ultra-Low Volume Applicators for Insecticides</h1>

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
					<li>First turn on the atomizer, then open the valve.  When finished close the valve first, then turn off the atomizer.  This will ensure no dripping.</li>
					<li>Periodically run water through the entire system to flush all residue out of the hoses and the atomizer.</li>
					<li>Leave the ROFA connected to the charger whenever not in use.  This will not damage the battery.</li>
				</ul>

				<?php
				break;
		}

	?>
</div>