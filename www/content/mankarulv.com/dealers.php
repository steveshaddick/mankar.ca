<?php

	$dealers = $mankarMain->getDealers();
	
	
	//order them into a 2d array, and obfuscate the email at the same time
	$dealers_can = array();
	$dealers_us = array();
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
	
?>

<div class="padContent">
	<h1><?php echo DEALERS;?></h1>
	<a class="dealerLocationLink" href="#usa">U.S.A.</a> | <a class="dealerLocationLink" href="#canada">Canada</a>
	<a name="canada"></a>
	<?php 	
	foreach ($dealers_can as $dealer)
	{
		if ($currentHeader != $dealer['state']) {
		$currentHeader = $dealer['state'];
		echo '<h2>'.$dealer['state'].'</h2>';
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
	?>

	<a name="usa"></a>
	<?php 	
	foreach ($dealers_us as $dealer)
	{
		if ($currentHeader != $dealer['state']) {
		$currentHeader = $dealer['state'];
		echo '<h2>'.$dealer['state'].'</h2>';
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
?>
</div>