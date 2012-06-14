<?php

/**********************
 * @function	randomString
 * @author 		Steve Shaddick
 * @version 	1.1
 * @description 	generates a random alpha-numeric string.  NOT A GUID, but acceptable in a lot of scenarios.
 * @input	$length (integer) : the length of the resulting string.  DEFAULT 8.
				
 * @output 	an alpha-numberic string,
 			or false on error
			
 */
function randomString($length = 8)
{
	if ($length < 1) {
		trigger_error("randomString length must be at least 1.", E_USER_ERROR);
		return false;
	}
	
	$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$total = strlen($str) - 1;
	
	$rand = "";
	for ($i = 0; $i < $length; $i++){
		$rand .= substr($str, rand(0, $total), 1);
	}
	
	return $rand;
}

?>