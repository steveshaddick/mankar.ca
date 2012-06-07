<?php
$manuals = array();
$result = mysql_query("SELECT name, manual FROM products WHERE manual <> '' ORDER BY type_id, manual, product_code");
while ($row = mysql_fetch_assoc($result))
{
	$manuals[]=$row;
}



?>
<h3>Syst&egrave;mes de pulv&eacute;risation MANKAR Ultra-Low Volume</h3>
<p><strong>Manuel de l'utilisateur</strong><em> (en format PDF)</em></p>
<p><em>Nous sommes d&eacute;sol&eacute;s, cette section n&rsquo;est pas encore disponible en fran&ccedil;ais.</em></p>
 <?php
  $lastManual = "";
  	foreach ($manuals as $manual)
	{
		if ($lastManual != $manual['manual']) {
			if ($lastManual != "" ) {
				?>
            	</ul>
               	<?php
			}
			$lastManual = $manual['manual'];
			?>
            <ul>
            <?php
		}
		?>
         <li><a href="http://www.mankar.ca/manuals/<?=$manual['manual']?>" target="_blank"><?=$manual['name']?></a></li>
        <?php
	}
	?>
	</ul>


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
