<html>
<head>
<title>Uploading a file</title>
</head>

<body>

<form action="upload.php" method="POST" enctype="multipart/form-data">
	File:
	<input type="file" name="filename"> <input type="submit" name="submit" value="upload">
</form>


<?php
include 'php/connect.php';
if (isset($_POST['submit']))
{
	$name = mysql_real_escape_string($_FILES["filename"]["name"]);
	$data = mysql_real_escape_string(file_get_contents($_FILES["filename"]["tmp_name"]));
	$type = mysql_real_escape_string($_FILES["filename"]["type"]);

	if(substr($type,0,5) == "image")
	{
		mysql_query("INSERT INTO Picture VALUES ('', '$name', '$data')");
	}
	else 
	{
		echo "'";
	}

	

}

?>
</body>





</html>