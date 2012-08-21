<?php

	switch ($mankarMain->lang) {
		
		case LANGUAGE_SPANISH:

			echo NO_SPANISH;
			break;
	}

	switch ($mankarMain->lang) {

		case LANGUAGE_FRENCH:
			?>

			<h3>Support</h3>

			<p><a href="/manuals">MANUALS</a></p>
			<p><a href="/parts">PARTS</a></p>

			<p><strong>Conseils g&eacute;n&eacute;raux d'utilisation</strong></p>
			<ul>
				<li>Apr&egrave;s utilisation, remplissez le r&eacute;servoir d'eau et ouvrez la valve  &agrave; son maximum. Videz le r&eacute;servoir en vaporisant &agrave; nouveau la zone que  vous venez de terminer.</li>
				<li>Suite &agrave; une p&eacute;riode de non-usage, regardez sous le capuchon du  pulv&eacute;risateur et assurez-vous que le n&eacute;buliseur tourne librement. Pour  ce faire, il est pr&eacute;f&eacute;rable d'utiliser un stylo ou un trombone. S'il  s'&eacute;tait ab&icirc;m&eacute; &agrave; cause de r&eacute;sidus d'herbicide, vous pourriez faire  sauter le fusible.</li>
			</ul>
			<p><strong>Pour charger la pile:</strong></p>
			<ul>
				<li>Branchez le chargeur &agrave; la pile AVANT de mettre l'alimentation 110 Volts AC du chargeur.</li>
				<li>Lorsque la pile est recharg&eacute;e, enlevez l'alimentation du chargeur (110 Volts AC) AVANT de retirer la pile.</li>
				<li>En suivant ces deux r&egrave;gles, vous &eacute;viterez une surtension soudaine de la pile. Sinon, vous risquez de faire sauter le fusible.</li>
			</ul>
			
			<?php
			break;

		default:
			?>
			<h3>Support</h3>

			<p><a href="/manuals">MANUALS</a></p>
			<p><a href="/parts">PARTS</a></p>

			<p><strong>General Usage Tips</strong></p>
			<ul>
				<li>after use, fill the tank with water and open the valve to its  widest setting. Empty the tank by overspraying the area you just  completed.</li>
				<li>After a period of non-use, look under the spraycap and make sure  that the atomizer spins freely. It is best to use a pen or a paperclip.  If it has become gummed up due to some herbicide residue you could blow  the fuse!</li>
			</ul>
			<p><strong>Battery Charging Best Practices</strong></p>
			<ul>
				<li>Connect the charger to the battery BEFORE connecting the charger to the AC outlet.</li>
				<li>When the battery is charged, disconnect the charger from the wall BEFORE disconnecting from the battery.</li>
				<li>Following these two rules will ensure that you don't get a sudden  surge of power going into the battery. Otherwise you risk blowing the  fuse.</li>
			</ul>

			<?php
			break;
	}

?>






