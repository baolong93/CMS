<?php
echo <<<_END
<html>
<head>
	<title>Image Uploading</title>
</head>
<body>
<form method="post" action="upload.php" enctype="multipart/form-data">
Select File: <input type='file' name='filename' size='10' />
<input type='submit' value='Upload' />
</form>
_END;

if ($_FILES)
{
	$name = $_FILES['filename']['name'];
	$temp = $_FILES['filename']['tmp_name'];
	$size = $_FILES['geoip_db_filename(database)']
	move_uploaded_file($temp, "picture/".$name);
	$image = "picture/".$name;
	echo "Uploaded image '$name' <br /><img src=$image />";
}

echo "</body></html>";
?>
