<?php
session_start();
$_SESSION['units'] = 'us';
header('Location: http://www.mankar.ca/?units=us');
//require('../includes/'.$lang.'/googlescript.html');
?>