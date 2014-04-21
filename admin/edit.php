<!-- Ajax can be useful, navigate in the corner might be useful -->
<?php
	include('../include/connect.php');
	if(!isset($_POST['submitted'])){ //Getting the product that admin want to edit.
		$query = "SELECT * FROM Product Where ID = $_GET[id]"; //id got from URl.
		$result = $mysqli->query($query);
		$product = mysqli_fetch_array($result);
	}
// Come back to put ajax into picture update.
?>
	<h1> Editing the product information </h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  onSubmit='return validate(this)'><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
Name:				<input type="text" name="proName" value="<?php echo $product['Name']; ?>" />
Number of Product:	           <input type="text" name="NoP" value="<?php echo $product['NumberofProduct']; ?>" />
Price:				<input type="text" name="price" value="<?php echo $product['Price']; ?>" />
Description:		<textarea name="desc" cols="50px" rows="5px" wrap="off"><?php echo $product['Description']?></textarea>
<img src="<?php echo $product['Picture']; ?>" > <!--Display old product picture -->
Image:				<input type="file" name="filename" size="10" />
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" /> 
			<input type="submit"  name="submit" value="Modify" />
</pre></form>

<div id='cart'></div>

<?php
	if(isset($_POST['submitted'])){//UPdating new product fields.
		$update = "UPDATE Product SET Name ='$_POST[proName]',  
									  Description ='$_POST[desc]', 
									  NumberofProduct = '$_POST[NoP]', 
									  Price = '$_POST[price]' 
			       WHERE ID = $_POST[id]";
		$mysqli->query($update);
 
		if ($_FILES['filename']['name']!=""){   //check is new image has been put.
			unlink($product['Picture']);
			$image = "picture/".$_POST['id'].$_FILES['filename']['name'];
			$temp = $_FILES['filename']['tmp_name'];
			move_uploaded_file($temp, $image);
			$updatePicture = "UPDATE Product SET Picture='$image' WHERE ID = $_POST[id]";
			$mysqli->query($updatePicture);
		} //End update picture if statement.

		echo "all done";
		header("Location: index.php");
	}// End main if statement.
?>

<script src="../script/validate.js"></script>
