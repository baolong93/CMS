<?php
	include('header.php'); //include header of the page
?>
<?php
include_once 'connect.php'; //connect to the database

	if (isset($_POST['delete']) && isset($_POST['id'])) //checking product delete.
	{
		$id = $_POST['id'];  //getting the id.
		$query = "DELETE FROM product WHERE ID = '$id'"; 
		//back for delete the picture file.
		$delete = $mysqli->query($query);
		$deleteImage = unlink($_POST['image']); //delete product image.
	}


	$query = "SELECT * FROM product";    
	$result = $mysqli->query($query); 


	if (!$result) die ("Database access failed: " . mysql_error()); //error message.

	$rows = mysqli_num_rows($result);  //getting number of row.

	if ($rows > 0) {
	for ($i=0; $i < $rows; $i++) 
	{ 
		$row = mysqli_fetch_row($result);
		echo <<<_END

		<pre>
		ID:  $row[0]
		Name:  $row[1]
		Number of Product:  $row[2]					
		Price:  $row[3]$
		Description:  $row[4]
		Picture: <img src='$row[5]'>   
		</pre>

		<form action="product.php" method="post" onSubmit="return confirmDelete()")">
		<input type="hidden" name="delete" value="yes"/>
		<input type="hidden" name="id"    value="$row[0]" />
		<input type="hidden" name="image" value="$row[5]" /> 
		<input type="submit" name="delete" value="DELETE PRODUCT"	/>
		</form>

		<form action="edit.php?id=$row[0]" method="post">  
		<input type="hidden" name="id" value="$row[0]" />
		<input type="submit" name="edit" value="EDIT PRODUCT" />
		</form>
_END;
	}
}
	else {
		echo "There is no product available in the store.";
	}
?>
<?php
	include('footer.php'); //footer of the page
?>

<script>
	// For delete confirm box.
	function confirmDelete() {
		var x = confirm("Are you sure you want to delete this product.");
		return x;
	}
</script>
