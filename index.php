<?php
include('php/function.php');

if (isset($_POST['submitted'])) {
	

		$productname 			= $_POST['name'];
		$numberOfProduct 		= $_POST['NoP'];
		$price 					= $_POST['price'];
		$description 			= $_POST['description'];
		$sql					="INSERT INTO Product (ID, Name, numberOfProduct, Price, Description) 
												VALUES ('','$productname', '$numberOfProduct', '$price', '$description')";

		if (!mysql_query($sql, $connection)) {
			die('error inserting new record ');
		} //end of nested statement.
	$newProduct = "Product has been input sucessfully";
} //end of if statement.
?>

<html lang="en">
<head>
	<title>CMS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
		<form method="post" action="index.php"><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			Name:               <input type="text" name="name"/>
			Number of Product:  <input type="text" name="NoP" value="1"/>
			Price:              <input type="text" name="price"/>
			Description:        <textarea name="description" cols="50px" rows="5px" wrap="off">Description
								</textarea>
			<input type="submit" value="Add Product"/>
		</pre></form>

<?php
	echo $newProduct;
?>
</body>

</html>