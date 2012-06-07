<?php

exec('convert -version',$output, $return);

print_r($output);

?>