<?php
	include_once '../include/connect.php'; //connect to the database
?>
<h1> Products </h1>
<table style="width:700px">
<tr>
  <th>ID</th>
  <th>Name</th> 
  <th>Stock</th>
  <th>Price</th>
  <th>Description</th>
  <th>Picture</th>
</tr>
<?php
	$query = "SELECT * FROM product";    //query for getting the product from database.
	$result = $mysqli->query($query); 
	if (!$result) die ("Database access failed: " . mysql_error()); //error message.

	$rows = mysqli_num_rows($result);  //getting number of row.

	if ($rows > 0)  //Checking whether product exist in the database to shown.
	{
	for ($i=0; $i < $rows; $i++)  //loop through all the row.
	{ 
		$row = mysqli_fetch_row($result);

		echo '<pre>';
		echo 'ID:  '.$row[0].'<br>';
		echo 'Name:  '.$row[1].'<br>';
		echo 'Number of Product:  '.$row[3].'<br>';					
		echo 'Price:  '.$row[2].'<br>';
		echo 'Description:  '.$row[4].'<br>';
		echo 'Picture: <img src="'.$row[5].'" width="150px" height="auto"><br>'; 
		echo '</pre>';
		if ($row[8] == 1) //product is actived display Deactive button.
		{
				echo '<div id="active'.$row[0].'">';
				// echo '<form method="post" id="activeButton">';
				echo '<input type="hidden" name="status" id="status'.$row[0].'" value="deactive"/>';
				// echo '<input type="hidden" name="id"  id="id"  value="'.$row[0].'" />';
				// echo '<input type="hidden" name="image" value="$row[5]" />';
				echo '<button value="DEACTIVE PRODUCT" onclick="changeActive('.$row[0].')"> Deactive </button>';
				// echo '</form>';
				echo '</div>';
		} // end if statement.
		else   //product is deactived display Active button.
		{
				echo '<div id="active'.$row[0].'">';
				// echo '<form method="post" id="activeButton">';
				echo '<input type="hidden" name="status" id="status'.$row[0].'" value="active"/>';
				// echo '<input type="hidden" name="id" id="id"   value="'.$row[0].'" />';
				// echo '<input type="hidden" name="image" value="$row[5]" />';
				echo '<button value="active PRODUCT" onclick="changeActive('.$row[0].')"> Active </button>';
				// echo '</form>';
				echo '</div>';
		} //end else statement
		
		echo '<button onclick="edit('.$row[0].')">Edit</button>'; //Onclick event to trigger ajax link to edit page.
		echo '<form action="deleteProduct.php" method="post" onsubmit="confirmDelete()">';
		echo '<input name="id" value="'.$row[0].'" type="hidden" />';
		echo '<input name="image" value="'.$row[5].'" type = "hidden" />';
		echo '<input type="submit" name="delete" value="Delete Product"/>';
		echo '</form>';

	}//End for loop.
	}//End if statement.
	
	else 
	{
		echo "There is no product available in the store.";
	}//End Else statement.


?>


<script>
	// For delete confirm box.
	function confirmDelete() {
		var x = confirm("Are you sure you want to delete this product.");
		return x;
	}
</script>
