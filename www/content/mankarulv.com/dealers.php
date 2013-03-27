<?php

	$dealers = $mankarMain->getDealers();
	
	
	//order them into a 2d array, and obfuscate the email at the same time
	$dealers_can = array();
	$dealers_us = array();
	$dealers_mex = array();
	$sort = "";
	foreach ($dealers as $dealer)
	{
		$newEmail = "";
		for ($i=0; $i<strlen($dealer['email']); $i++)
		{
			$newEmail .= '&#'.ord(substr($dealer['email'],$i, 1)).';';
		}
		
		$dealer['email'] = $newEmail;
		
		switch ($dealer['country']){
			case 'Canada':
			$dealers_can[] = $dealer;
			break;
			
			case 'U.S.A.':
			$dealers_us[] = $dealer;
			break;
			
			case 'México':
			$dealers_mex[] = $dealer;
			break;
		}
	}
	
	$currentHeader = "";
	
	switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  
			define('DEALERS', 'Dealers');
			define('PHONE', 'Phone');
			define('FAX', 'Fax');
			define('EMAIL', 'Email');
			break;
		case LANGUAGE_FRENCH :  
			define('DEALERS', 'Dealers');
			define('PHONE', 'Phone');
			define('FAX', 'Fax');
			define('EMAIL', 'Email');
			break;
		case LANGUAGE_SPANISH :  
			define('DEALERS', 'Dealers');
			define('PHONE', 'Phone');
			define('FAX', 'Fax');
			define('EMAIL', 'Email');
			break;
	} 
	
	switch ($mankarMain->lang) { 
		case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
		case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
	}

	$dealersOrder = ($mankarMain->isUSA) ? array($dealers_us, $dealers_can, $dealers_mex) : array($dealers_can, $dealers_us, $dealers_mex);
	
?>

<div class="padContent">
	<h1><?php echo DEALERS;?></h1>
	
	<?php
	foreach ($dealersOrder as $dealers_country) {
		if (!empty($dealers_country)) {
			?>
			<div class="dealer-quick-locate-box">
				<span class="country-heading"><?php echo $dealers_country[0]['country']; ?></span>
				<div class="country-list">
					<?php
					$currentHeader = '';
					foreach ($dealers_country as $dealer)
					{
						if ($currentHeader != $dealer['state']) {
							$currentHeader = $dealer['state'];
							?>
							<a href="#<?php echo $dealer['state']; ?>"><?php echo $dealer['state']; ?></a><br />
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php
		}
	}
	$currentHeader = '';
	?>
	<br class="clear" />

	<?php
	foreach ($dealersOrder as $dealers_country) {
		foreach ($dealers_country as $dealer)
		{
			if ($currentHeader != $dealer['state']) {
				$currentHeader = $dealer['state'];
				?>
				<a name="<?php echo $dealer['state']; ?>"></a>
				<h2 class="dealer-state"><?php echo $dealer['state']; ?></h2>
				<?php
			}
			?>
			<div class="dealerItem">
				<table class="tblDealer">
					<tr>
						<td style="width:85px;" valign="top"><img src="<?php echo DEALER_LOGO_LOCATION.$dealer['logo']; ?>" class="dealerPicture" title="<?php echo $dealer['name'];?>" /></td>
						<td style="width:300px;" valign="top">
							<span class="dealerName"><?php echo $dealer['name'];?></span><br />
							<a href="<?php echo $dealer['website'];?>" target="_blank"><?php echo $dealer['website'];?></a><br /><br />
							<?php echo $dealer['address'];?><br />
							<?php echo $dealer['city'];?>, <?php echo $dealer['state_abbr'];?><br />
							<?php echo $dealer['zip'];?><br />
							<?php echo $dealer['country'];?><br />
							<?php echo PHONE;?>: <?php echo $dealer['phone'];?><br />
							<?php if ($dealer['fax'] != "") echo FAX.':'.$dealer['fax'].'<br />';?>
							<?php if ($dealer['email'] != "") { ?><?php echo EMAIL;?>:  <a href="mailto:<?php echo $dealer['email'];?>"><?php echo $dealer['email'];?></a><br /><?php } ?>
						</td>
						<td valign="top">
							<a href="http://maps.google.ca/maps?q=<?php echo $dealer['map']; ?>" target="_blank"><img border="0" src="http://maps.google.com/maps/api/staticmap?markers=size:mid|color:0xf4a300|label:M|<?php echo $dealer['map']; ?>&zoom=9&size=200x200&sensor=false" alt="<?php echo $dealer['name'];?>" /></a>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
	}
	?>

	
</div>