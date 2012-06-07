<?php

require_once('includes/_init.php');
require_once('includes/_connect.php');


$result = mysql_query("SELECT actual_url FROM meta_tags WHERE pretty_url='{$_GET['page']}'");

if ($result) {
	$row = mysql_fetch_assoc($result);
	if ($row) {
		$url = $row['actual_url'];
		
		if (strpos($url,'?') > 0) {
		
			$query = substr($url, strpos($url,'?') + 1);
			$arr = explode("&", $query);
			foreach ($arr as $pair)
			{
				$key = substr($pair, 0, strpos($pair, '='));
				$value = substr($pair, strpos($pair, '=') +1);

				$_GET[$key] = $value;
			}
			$actual_url = substr($url,0,strpos($url,'?'));
			
		} else {
			$actual_url = $url;
		}
		$pageUrl = $url;
		$baseUrl = $actual_url;

		include($actual_url);
	} else {
		header('Location: http://www.mankar.ca/');
	}
} else {
	header('Location: http://www.mankar.ca/');
}

?>