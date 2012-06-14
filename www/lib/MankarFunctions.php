<?php

function getPrettyUrl($actualUrl)
{
	global $metaData;
	//logToFile('catchlog.txt',$metaData[$actualUrl]['pretty_url']);
	if (isset($metaData[$actualUrl]))
	{
		
		if ($metaData[$actualUrl]['pretty_url'] != '') {
			return 'http://www.mankar.ca/'.$metaData[$actualUrl]['pretty_url'];
		}
	}
	return $actualUrl;
}

function getMetaData($type, $url)
{
	global $metaData;
	global $lang;
	$post = ($lang == LANGUAGE_ENGLISH) ? '' : '_'.$lang;
	//logToFile('catchlog.txt',$url);
	if (isset($metaData[$url])) {
		if ($metaData[$url]['meta_'.$type.$post] != '') {
			return $metaData[$url]['meta_'.$type.$post];
		} else if ($metaData['index.php']['meta_'.$type.$post] != '') {
			return $metaData['index.php']['meta_'.$type.$post];
		}
	}
	
	if ($metaData['index.php']['meta_'.$type.$post] != '') {
		return $metaData['index.php']['meta_'.$type.$post];
	} else {
		return $metaData['index.php']['meta_'.$type];
	}
}

function logToFile($filename, $msg)
{ 
	// open file
	$fd = fopen('log/'.$filename, "a");
	// write string
	fwrite($fd, $msg . "\n");
	// close file
	fclose($fd);
}

?>