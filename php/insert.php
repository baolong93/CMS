

<?php
include('connect.php');

if (isset($_POST['submitted'])) {

		if ($_FILES)
	{
		$name = $_FILES['filename']['name'];
		$temp = $_FILES['filename']['tmp_name'];
		$size = $_FILES['filename']['size'];
		// $query = "INSERT INTO Product VALUES $name;";
		$image = "picture/".$name;
		move_uploaded_file($temp, $image);
		// echo "Uploaded image '$name' <br /><img src=$image />";
	}
	
		$productname 			= $_POST['proName'];
		$numberOfProduct 		= $_POST['NoP'];
		$price 					= $_POST['price'];
		$description 			= $_POST['desc'];
		$sql					="INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, Picture) 
												VALUES ('', '$productname', '$numberOfProduct', '$price', '$description', '$image')";
		$results = $mysqli->query($sql);
		if (!$results) {
			die('error inserting new product!');
		} //end of nested statement.
} //end of if statement.
?>

<?php
	include('header.php');
?>
<body>
	<table class="input" border="0" cellpadding="2"
		cellspacing="5" bgcolor="#eeeee">
	<th colspan="2" align="center">Input Product</th>
		<form method="post" action="insert.php" enctype="multipart/form-data"onSubmit="return validate(this)"  ><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			<tr><td>Name:</td><td><input type="text" name="proName"/></td></tr>
			<tr><td>Number of Product:</td><td><input type="text" name="NoP" value="1"/></td></tr>
			<tr><td>Price:</td><td><input type="text" name="price"/></td></tr>
			<tr><td>Description:</td><td><textarea name="desc" cols="50px" rows="5px" wrap="off">Description</textarea></td></tr>
			<tr><td>Image:</td><td><input type="file" name="filename" size="10" /></td></tr>
			<tr><td colspan="2" align="center">
			<input type="submit" value="Add Product"/></td></tr>
	</pre></form></table>

</body>
<?php
	include('footer.php');
?>
 <script>
	function validate(form) {
	 fail = validateName(form.proName.value)
	 fail += validatePrice(form.price.value)
	 fail += validateDescription(form.desc.value)
	 if (fail == "") return true
	 	else {alert(fail); return false}
	}
 	</script>
 	<script>
		function validateName(field) {
		if (field == "") return "No Name was entered.\n";
		return ""
		}
		function validatePrice(field) {
			if (field == "") return "No Price was entered.\n"
			else if (field.length > 5) 
				return "Price can not be greater than 100000$";
			else if (![0-9].test(field))
				return "Invalid Price";
			return "" 
		}
		function validateDescription(field) {
			if (field == "") return "No description was entered.\n";
			else if (field.length > 200)
				return "description is too long!!.\n";
			return ""
		}
 </script>
