<?php

$manuals = $mankarMain->pageData['manuals']

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
         <li><a href="<?php echo MANUALS_LOCATION . $manual['manual']; ?>" target="_blank"><?php echo $manual['name']; ?></a></li>
        <?php
	}
	?>
	</ul>

            