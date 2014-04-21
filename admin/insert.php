

<?php
/// Need to complete the validation.
/// Need navigation in the coner
/// Ajax might useful here.
include_once('../include/connect.php');
include_once('header.php');

if (isset($_POST['submitted'])) 
{
	$productname 			= $_POST['proName'];
	$numberOfProduct 		= $_POST['NoP'];
	$price 					= $_POST['price'];
	$description 			= $_POST['desc'];
	$catID 					= $_POST['Category'];
	$date					= date("Y-m-d H:i:s");
	$sql					="INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, CategoryID, AddDate, Active) 
								VALUES ('', '$productname', '$numberOfProduct', '$price', '$description', '$catID', '$date', '1')";
	$results = $mysqli->query($sql);
	if (!$results) 
	{
		die('error inserting new product!'. mysqli_error($mysqli));
	} //end of nested statement.
	$productID = $mysqli->insert_id;

		if ($_FILES) //Picture handling.
		{
			$name = $_FILES['filename']['name'];
			$temp = $_FILES['filename']['tmp_name'];
			$size = $_FILES['filename']['size'];
			$name = strtolower(ereg_replace("[^A-Za-z0-9]", "", $name)); //Replace all the character other than numberic and string.
			$image = "picture/".$productID."/".$name;
			$path = "/picture/" . $productID . "/";// Checking folder exists.

				if (!is_dir($path)) 
				{
					    mkdir("picture/" . $productID, 0777);//Create a folder depends on productID.
				}//End loop for folder checking.

			switch ($_FILES['filename']['type']) {
				case 'image/jpeg': $extention = "jpg"; break;
				case 'image/gjf': $extention = "gif"; break;
				case 'image/png': $extention = 'png'; break;
				case 'image/tiff': $extention = 'tif'; break;
				default:		$extention = ''; break;
			}
			if ($extention)
			{

				move_uploaded_file($temp, $image);
				$query = "UPDATE Product SET Picture = '$image' WHERE ID = '$productID'";
				$results = $mysqli->query($query);

				if(!$results)
				{
					die('error inserting picture'. mysqli_error($mysqli));
				}
			}
			else 
			{
				echo "No image has been uploaded, image extention is not valid (jpeg, gjf, png and tiff)!";
			}
		}//End if statement.
	echo "Product has been added succesfully!!";
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
echo 'Image:            <input type="file" name="filename" size="10"/><br />';
echo 'Category:   	  <select name="Category">';
if ($results) 
{ 
		        //fetch results set as object and output HTML
    while($prob = $results->fetch_object())
	{
		echo '<option value="'.$prob->ID.'">'.$prob->Name.'</option>';
	}//End While statement.
    
}//End if statement.
echo '</select><br />';
echo '<div id="addCategory"></div>';
echo '<input type="submit" value="Add Product"/>';
echo '</pre></form >';
// echo '<div id="addCat"><form>';
// echo '<input type="checkbox" id="mycheck">Add more category<br />';
// echo '</form></div>';

// echo '<form method="post" onsubmit=""><pre>';
// echo '<input type="hidden" name="submitted" value="yes"/>';
// echo 'Name:             <input type="text" name="catName"/>';
// echo '<input type="submit" value="Add Category"/>';
// echo '</pre></form>';
?>

<?php 
include ('footer.php');
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

















