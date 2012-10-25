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

				<h1>Support</h1>
				<div class="productTypeListWrapper">

			        <div class="productTypeWrapper">
			          <div class="productType">

			            <div class="productImage">
			              <a href="/manuals" title="Manuals"><img src="/images/manuals-icon.jpg" alt="Parts"></a>
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
			              <a href="/parts" title="Parts"><img src="/images/parts-icon.jpg" alt="Parts"></a>
			            </div>
			            <div class="productName">

			              <a class="navLink" href="/parts">PARTS</a>

			            </div>
			          </div>
			        </div>

			        <br class="clear" />
			    </div>

				<h2>Conseils g&eacute;n&eacute;raux d'utilisation</h2>
				<ul>
					<li>Apr&egrave;s utilisation, remplissez le r&eacute;servoir d'eau et ouvrez la valve  &agrave; son maximum. Videz le r&eacute;servoir en vaporisant &agrave; nouveau la zone que  vous venez de terminer.</li>
					<li>Suite &agrave; une p&eacute;riode de non-usage, regardez sous le capuchon du  pulv&eacute;risateur et assurez-vous que le n&eacute;buliseur tourne librement. Pour  ce faire, il est pr&eacute;f&eacute;rable d'utiliser un stylo ou un trombone. S'il  s'&eacute;tait ab&icirc;m&eacute; &agrave; cause de r&eacute;sidus d'herbicide, vous pourriez faire  sauter le fusible.</li>
				</ul>
				<h2>Pour charger la pile:</h2>
				<ul>
					<li>Branchez le chargeur &agrave; la pile AVANT de mettre l'alimentation 110 Volts AC du chargeur.</li>
					<li>Lorsque la pile est recharg&eacute;e, enlevez l'alimentation du chargeur (110 Volts AC) AVANT de retirer la pile.</li>
					<li>En suivant ces deux r&egrave;gles, vous &eacute;viterez une surtension soudaine de la pile. Sinon, vous risquez de faire sauter le fusible.</li>
				</ul>
				
				<?php
				break;

			default:
				?>
				<h1>Support</h1>

				<div class="productTypeListWrapper">
					 <div class="productTypeWrapper">
			          <div class="productType">

			            <div class="productImage">
			              <a href="/manuals" title="Manuals"><img src="/images/manuals-icon.jpg" alt="Parts"></a>
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
			              <a href="/parts" title="Parts"><img src="/images/parts-icon.jpg" alt="Parts"></a>
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
					<li>After use, fill the tank with water and open the valve to its  widest setting. Empty the tank by overspraying the area you just  completed.</li>
					<li>After a period of non-use, look under the spraycap and make sure  that the atomizer spins freely. It is best to use a pen or a paperclip.  If it has become gummed up due to some herbicide residue you could blow  the fuse!</li>
				</ul>
				<h2>Battery Charging Best Practices</h2>
				<ul>
					<li>Connect the charger to the battery BEFORE connecting the charger to the AC outlet.</li>
					<li>When the battery is charged, disconnect the charger from the wall BEFORE disconnecting from the battery.</li>
					<li>Following these two rules will ensure that you don't get a sudden  surge of power going into the battery. Otherwise you risk blowing the  fuse.</li>
				</ul>

				<?php
				break;
		}

	?>
</div>