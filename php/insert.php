

<?php
/// Need to complete the validation.
include_once('connect.php');
include_once('header.php');

if (isset($_POST['submitted'])) 
{

		if ($_FILES) //Picture handling.
		{
			$name = $_FILES['filename']['name'];
			$temp = $_FILES['filename']['tmp_name'];
			$size = $_FILES['filename']['size'];
			$image = "picture/".$name;
			move_uploaded_file($temp, $image);
		}//End if statement.
	
		$productname 			= $_POST['proName'];
		$numberOfProduct 		= $_POST['NoP'];
		$price 					= $_POST['price'];
		$description 			= $_POST['desc'];
		$catID 					= $_POST['Category'];
		$date					= date("Y-m-d H:i:s");
		$sql					="INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, CategoryID, Picture, AddDate) 
								VALUES ('', '$productname', '$numberOfProduct', '$price', '$description', '$catID', '$image', '$date')";
		$results = $mysqli->query($sql);
		if (!$results) 
		{
			die('error inserting new product!'. mysqli_error($mysqli));
		} //end of nested statement.
} //end of if statement.
?>

<?php
$results = $mysqli->query("SELECT * FROM Category"); // Getting category list.
echo '<form method="post" action="insert.php" enctype="multipart/form-data" onSubmit="return validate(this)"><pre>';   
echo '<input type="hidden" name="submitted" value="yes"/>';
echo 'Name:             <input type="text" name="proName"/><br />';
echo 'Number of Product:<input type="text" name="NoP" value="1"/><br />';
echo 'Price:            <input type="text" name="price"/><br />';
echo 'Description:      <textarea name="desc" cols="50px" rows="5px" wrap="off">Description</textarea><br />';
echo 'Image:            <input type="file" name="filename" size="10" onComplete="PicPreview()"/><br />';
echo 'Category:   	  <select name="Category"><br />';
if ($results) 
{ 
		        //fetch results set as object and output HTML
    while($prob = $results->fetch_object())
	{
		echo '<option value="'.$prob->ID.'">'.$prob->Name.'</option>';
	}//End While statement.
    
}//End if statement.
echo '</select><br />';
echo '<input type="submit" value="Add Product"/>';
echo '</pre></form>';

echo '<div id="PicPreview"></div>';
?>

<?php 
include ('footer.php');
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

















