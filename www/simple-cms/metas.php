<?php

require_once('../_test/includes/_connect.php');

mysql_query("INSERT INTO meta_tags SET page='products',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='information',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='comparison',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='support',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='news',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='links',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='dealers',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='tradeshows',related_id=-1");
mysql_query("INSERT INTO meta_tags SET page='product_types',related_id=-1");


?>