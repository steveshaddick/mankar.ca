<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>datepicker test</title>
    </head>
<body>
<?php

    // include the class
    require "includes/class.datepicker.php";

    // instantiate the object
    $dp=new datepicker();
    
?>

<p>
    Shortest way to start using the date picker...
</p>
<pre style="font-size:11px;">
// include the class
require "includes/class.datepicker.php";

// instantiate the object
$dp=new datepicker();

&lt;input type="text" id="date">

&lt;input type="button" value="..." onclick="&lt;?=$dp->show("date")?>">
</pre>

<p>Click on the button to see it work</p>

<input type="text" id="date">

<input type="button" value="..." onclick="<?=$dp->show("date")?>">

</body>
</html>
