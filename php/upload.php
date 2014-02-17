<?php


	//properties of uploaded file
	$name = $_FILES['filename']['name'];
	$type = $_FILES['filename']['type'];
	$size = $_FILES['filename']['size'];
	echo  $_FILES['filename']['tmp_file'];
	$error = $_FILES['filename']['error'];

// if ($error > 0)
// 	die("Error uploading file! Code $error.");
// else {
// 	move_uploaded_file($temp, $name);
// 	echo "upload complete '$name'<br /><img src='$name' />";
// }

?>
