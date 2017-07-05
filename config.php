<?php
mysql_connect("127.0.0.1","root","") or
die ("Can't disconnect to server" );
mysql_select_db("library") or
die ("template no found");
mysql_set_charset('utf8');
?>