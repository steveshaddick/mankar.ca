<?php

$manuals = $mankarMain->pageData['manuals'];

switch ($mankarMain->superTypeId) {
	case 1:
		$title = "MANKAR&reg; Ultra-Low Volume (ULV) Spraying Systems";
		break;

	case 2:
		$title = "MAFEX&reg; Ultra-Low Volume (ULV) Applicators";
		break;

	case 3:
		$title = "MANTIS&reg; Ultra-Low Volume (ULV) Applicators";
		break;

	case 4:
		$title = "ROFA&reg; ULV Insecticide Sprayers";
		break;
}

switch ($mankarMain->lang) { 
	case LANGUAGE_ENGLISH :  
		define('ENGLISH_MANUAL', 'English');
		define('FRENCH_MANUAL', 'French');
		define('SPANISH_MANUAL', 'Spanish');
		break;

	case LANGUAGE_FRENCH :  
		define('ENGLISH_MANUAL', 'English');
		define('FRENCH_MANUAL', 'French');
		define('SPANISH_MANUAL', 'Spanish');
		break;

	case LANGUAGE_SPANISH :  
		define('ENGLISH_MANUAL', 'English');
		define('FRENCH_MANUAL', 'French');
		define('SPANISH_MANUAL', 'Spanish');
		break;
} 

?><div class="padContent">

	<?php

	

	?>
	<h1>MANKAR&reg; Ultra-Low Volume (ULV) Spraying Systems</h1>
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
	<li><?php echo $manual['name']; ?> : 
		<?php
		if ($manual['manual'] != "") {
			?>
			<a href="<?php echo MANUALS_LOCATION . $manual['manual']; ?>" target="_blank"><?php echo ENGLISH_MANUAL; ?></a>&nbsp;&nbsp;&nbsp;
			<?php
		}
		if ($manual['manual_fr'] != "") {
			?>
			<a href="<?php echo MANUALS_LOCATION . $manual['manual_fr']; ?>" target="_blank"><?php echo FRENCH_MANUAL; ?></a>&nbsp;&nbsp;&nbsp;
			<?php
		}
		if ($manual['manual_sp'] != "") {
			?>
			<a href="<?php echo MANUALS_LOCATION . $manual['manual_sp']; ?>" target="_blank"><?php echo SPANISH_MANUAL; ?></a>
			<?php
		}
		?>

	</li>
	<?php
	}
	?>
	</ul>

</div>           