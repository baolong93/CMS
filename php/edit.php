

<?php
	include("connect.php");
	if(!isset($_POST['submitted'])){
		$query = "SELECT * FROM Product Where ID = $_GET[id]";
		$result = $mysqli->query($query);
		$product = mysqli_fetch_array($result);
	}
// Come back to put ajax into picture update.
?>
	<h1> Editing the product information </h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  ><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			Name:<input type="text" name="proName" value="<?php echo $product['Name']; ?>" />
			Number of Product:<input type="text" name="NoP" value="<?php echo $product['NumberofProduct']; ?>" />
			Price:<input type="text" name="price" value="<?php echo $product['Price']; ?>" />
			Description:<textarea name="desc" cols="50px" rows="5px" wrap="off"><?php echo $product['Description']?></textarea>
			<img src="<?php echo $product['Picture']; ?>" > 
			Image:<input type="file" name="filename" size="10" />
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" /> 
			<input type="submit"  name="submit" value="Modify" />
	</pre></form>

<?php
	if(isset($_POST['submitted'])){
		
		$update = "UPDATE Product SET Name ='$_POST[proName]',  
									  Description ='$_POST[desc]', 
									  NumberofProduct = '$_POST[NoP]', 
									  Price = '$_POST[price]' 
			       WHERE ID = $_POST[id]";
		$mysqli->query($update);
 
		if ($_FILES['filename']['name']!=""){   //check is new image has been put.
			$image = "picture/".$_FILES['filename']['name'];
			$temp = $_FILES['filename']['tmp_name'];
		// $query = "INSERT INTO Product VALUES $name;";
		move_uploaded_file($temp, $image);
			$updatePicture = "UPDATE Product SET Picture='$image' WHERE ID = $_POST[id]";
			$mysqli->query($updatePicture);
		}

		echo "all done";
		header("Location: product.php");
	}
?>