<div class="padContent">

	<?php

	$manuals = $mankarMain->pageData['manuals']

	?>
	<h1>MANTIS&reg; Ultra-Low Volume (ULV) Applicators</h1>
	<h2>User Manuals (in PDF format)</h2>
	  

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

</div>           