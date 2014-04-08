<?php
	include("connect.php");
	if(!isset($_POST['submitted'])){
		$query = "SELECT * FROM Product Where ID = $_GET[id]";
		$result = $mysqli->query($query);
		$product = mysqli_fetch_array($result);
	}

?>

	<h1> Editing the product information </h1>

	<table class="input" border="0" cellpadding="2"
		cellspacing="5" bgcolor="#eeeee">
	<th colspan="2" align="center">Input Product</th>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  ><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			<tr><td>Name:</td><td><input type="text" name="proName" value="<?php echo $product['Name']; ?>" /></td></tr>
			<tr><td>Number of Product:</td><td><input type="text" name="NoP" value="<?php echo $product['NumberofProduct']; ?>" /></td></tr>
			<tr><td>Price:</td><td><input type="text" name="price" value="<?php echo $product['Price']; ?>" /></td></tr>
			<tr><td>Description:</td><td><textarea name="desc" cols="50px" rows="5px" wrap="off"><?php echo $product['Description']?></textarea></td></tr>
			<tr><td>Image:</td><td><input type="file" name="filename" size="10" /></td></tr>
			<tr><td colspan="2" align="center">
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
			<input type="submit" value="Modify" /></td></tr>
	</pre></form></table>

<?php
	if(isset($_POST['submitted'])){
		$update = "UPDATE Product SET `Name`='$_POST[proName]',  `Description`='$_POST[desc]', `NumberofProduct` = '$_POST[NoP]', `Price` = '$_POST[price]' WHERE ID = $_POST[id]";
		$mysqli->query($update);

		echo "all done";
		header("Location: product.php");
	}
?>