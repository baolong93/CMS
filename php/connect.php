<?php
require_once 'login.php'; //return fatal error if the file is not found and the file will be read only when it has not 
//previously been included.

$connection = mysql_connect($db_hostname, $db_username, $db_password);
if (!$connection) die("Unable to connect to MySQl: ".mysql_error());
//connect to mySQl

mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
//select the database.

?>