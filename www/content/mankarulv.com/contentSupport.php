<?php
$manuals = array();
$result = mysql_query("SELECT name, manual FROM products WHERE manual <> '' ORDER BY type_id, manual, product_code");
while ($row = mysql_fetch_assoc($result))
{
	$manuals[]=$row;
}



?>
<h3>MANKAR&reg; Ultra-Low Volume (ULV) Spraying Systems</h3>
<p><strong>User Manuals</strong><em> (in PDF format)</em></p>
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
            