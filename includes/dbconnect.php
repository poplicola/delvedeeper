<?php
	// host , username , password 
    $link = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die("Could not connect: " . mysql_error());
    mysql_select_db($mysql_database) or die(mysql_error());
?>