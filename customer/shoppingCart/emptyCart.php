<?php

include_once('../include/connect.php');
session_start();

?>

<?php
	if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	session_destroy(); //finish session clear all the product.
	header('Location:'.$return_url); //redirect the page.
}
?>