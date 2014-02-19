<?php
include('function.php');

if (isset($_POST['submitted'])) {
	
		$productname 			= $_POST['name'];
		$numberOfProduct 		= $_POST['NoP'];
		$price 					= $_POST['price'];
		$description 			= $_POST['description'];
		$sql					="INSERT INTO Product (ID, Name, numberOfProduct, Price, Description) 
												VALUES ('', '$productname', '$numberOfProduct', '$price', '$description')";
		if (!mysql_query($sql, $connection)) {
			die('error inserting new record ');
		} //end of nested statement.
} //end of if statement.
?>

<html>
<head>
	<title>CMS Insert page</title>
	<script>
		function isset(varname)
		{
			return typeof varname != 'undifined'
		}

		function validateName(field) {
			if (field == "") return "No Name was entered.\n"
			return ""
		}
		function validatePrice(field) {
			if (field == "") return "No Price was entered.\n"
			else if (field.length > 5) 
				return "Price can not be greater than 100000$"
			else if (![0-9].test(field))
				return "Invalid Price"
			return "" 
		}
		function validateDescription(field) {
			if (field == "") return "No description was entered.\n"
			else if (field.length > 200)
				return "description is too long!!.\n"
			return ""		
		}

	</script>
	<script>
	function validate(form) {
	 fail = validateName(form.name.value)
	 fail += validatePrice(form.price.value)
	 fail += validateDescription(form.description.value)
	 if (fail = "") return true
	 	else {alert(fail); return false}
	}
	</script>
</head>
<body>
		<form method="post" action="insert.php" onSubmit="return validate(this)"><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			Name:               <input type="text" name="name"/>
			Number of Product:  <input type="text" name="NoP" value="1"/>
			Price:              <input type="text" name="price"/>
			Description:        <textarea name="description" cols="50px" rows="5px" wrap="off">Description
								</textarea>
			<input type="submit" value="Add Product"/>
		</pre></form>

</body>
</html>
