<?php
require_once 'login.php'; //return fatal error if the file is not found and the file will be read only when it has not 
//previously been included.

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database);
?>