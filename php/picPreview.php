<?php
	include_once('connect.php');
	$name = $_FILES['filename']['name'];
	$path = $_FILES['filename']['tmp_file'];
	echo '<img src="$path">';
?>