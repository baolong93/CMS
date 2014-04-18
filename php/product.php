<?php
	include_once 'connect.php'; //connect to the database
	include('header.php'); //include header of the page
?>
<div class="maincontent">
		<div class="content" id="item">
			<article class="topcontent">
<?php
	if (isset($_POST['deactive']) && isset($_POST['id'])) //checking product delete.
	{
		$id = $_POST['id'];  //getting the id.
		$query = "UPDATE Product SET Active = 0 WHERE ID = '$id'"; 
		//back for delete the picture file.
		$deactive = $mysqli->query($query);
		// $deleteImage = unlink($_POST['image']); //delete product image.
	}

	if (isset($_POST['active']) && isset($_POST['id']))
	{
		$id = $_POST['id'];  //getting the id.
		$query = "UPDATE Product SET Active = 1 WHERE ID = '$id'"; 
		//back for delete the picture file.
		$active = $mysqli->query($query);
	}


	$query = "SELECT * FROM product";    
	$result = $mysqli->query($query); 


	if (!$result) die ("Database access failed: " . mysql_error()); //error message.

	$rows = mysqli_num_rows($result);  //getting number of row.

	if ($rows > 0) {
	for ($i=0; $i < $rows; $i++) 
	{ 
		$row = mysqli_fetch_row($result);

		echo '<pre>';
		echo 'ID:  '.$row[0].'<br />';
		echo 'Name:  '.$row[1].'';
		echo 'Number of Product:  '.$row[2].'<br />';					
		echo 'Price:  '.$row[3].'<br />';
		echo 'Description:  '.$row[4].'<br />';
		echo 'Picture: <img src="'.$row[5].'"><br />'; 
		echo '</pre>';
		if ($row[8] == 1)
		{
				echo '<form action="product.php" method="post" )">';
				echo '<input type="hidden" name="deactive" value="yes"/>';
				echo '<input type="hidden" name="id"    value="'.$row[0].'" />';
				echo '<input type="hidden" name="image" value="$row[5]" />';
				echo '<input type="submit" name="deactive" value="DEACTIVE PRODUCT"	/>';
				echo '</form>';
		}
		else 
		{
				echo '<form action="product.php" method="post" )">';
				echo '<input type="hidden" name="active" value="yes"/>';
				echo '<input type="hidden" name="id"    value="'.$row[0].'" />';
				echo '<input type="hidden" name="image" value="$row[5]" />';
				echo '<input type="submit" name="active" value="ACTIVE PRODUCT"	/>';
				echo '</form>';
		}

		echo '<button onclick="edit($row[0])">Edit</button>';

	}
}
	else {
		echo "There is no product available in the store.";
	}
?>

</article>
</div>
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
