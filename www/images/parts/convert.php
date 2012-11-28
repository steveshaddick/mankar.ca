<?php
exec("mogrify -resize 150x150 -quality 80% *.jpg");	

die();

for ($i=100142; $i < 102588; $i++) {
	if (file_exists($i . '.jpg')) {
		echo "mogrify {$i}.jpg  -resize 150x150  -quality 80% {$i}.jpg <br />";
		exec("mogrify {$i}.jpg  -resize 150x150  -quality 80% {$i}.jpg");
	}
}

?>