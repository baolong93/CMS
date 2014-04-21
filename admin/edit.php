<!-- Validation needed, Ajax can be useful, navigate in the corner might be useful -->
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
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  onSubmit='validate(this)'><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			Name:				<input type="text" name="proName" value="<?php echo $product['Name']; ?>" />
			Number of Product:	<input type="text" name="NoP" value="<?php echo $product['NumberofProduct']; ?>" />
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

<script>
	function validate(form) {
	 fail = validateName(form.proName.value)
	 fail += validatePrice(form.price.value)
	 fail += validateDescription(form.desc.value)
	 fail += validateStock(form.NoP.value)
	 if (fail == "") return true
	 	else {alert(fail); return false}
	}
 	</script>
 	<script>
		function validateName(field) {
		if (field == "") {
			return "No Name was entered.\n";
		}
		else if (field.length < 8) {
			return "The product Name must be asleast 8 character.\n";
		}
		return "";
		};
		function validateStock(field) {
			if (field == "") {
				return "Stock at least one. \n";
			}
			else if (!/\d/.test(field)) {
				return "Stock can only be a number."
			}
			return "";
		};
		function validatePrice(field) {
			if (field == "") return "No Price was entered.\n"
			else if (!/\d{1,6}/.test(field))
				return "Price can only be a number and less than million";
			return "" 
		};
		function validateDescription(field) {
			if (field == "") return "No description was entered.\n";
			else if (field.length > 200){
				return "description is too long!!.\n";
			}
			return ""
		};
 </script>