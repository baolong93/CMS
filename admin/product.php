<?php
	include_once '../include/connect.php'; //connect to the database
?>
<h1> Products </h1>
<table style="width:100%">
<tr>
  <th>ID</th>
  <th>Name</th> 
  <th>Stock</th>
  <th>Price</th>
  <th>Description</th>
  <th>Category</th>
  <th>Picture</th>
  <th>State</th>
  <th>Edit</th>
  <th>Delete</th>
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

		echo '<tr>';
        echo '<td>'.$row[0].'</td>';
        echo '<td>'.$row[1].'</td>';
        echo '<td>'.$row[3].'</td>';
        echo '<td>'.$row[2].'</td>';
        echo '<td>'.$row[4].'</td>';
        $query = "SELECT Name FROM Category WHERE ID = '$row[5]'";
        $catname = $mysqli->query($query);
        $cat = mysqli_fetch_row($catname);
        echo '<td>'.$cat[0].'</td>';
        echo '<td><img src="'.$row[6].'" width="150px" height="auto"></td>';
		if ($row[8] == 1) //product is actived display Deactive button.
		{
				echo '<td>';
				echo '<div id="active'.$row[0].'">';
				echo '<input type="hidden" name="status" id="status'.$row[0].'" value="deactive"/>';
				echo '<button value="DEACTIVE PRODUCT" onclick="changeActive('.$row[0].')"> Deactive </button>';
				echo '</div>';
				echo '</td>';
		} // end if statement.
		else   //product is deactived display Active button.
		{	
				echo '<td>';
				echo '<div id="active'.$row[0].'">';
				echo '<input type="hidden" name="status" id="status'.$row[0].'" value="active"/>';
				echo '<button value="active PRODUCT" onclick="changeActive('.$row[0].')"> Active </button>';
				echo '</div>';
				echo '</td>';
		} //end else statement
		echo '<td>';
		echo '<button onclick="edit('.$row[0].')">Edit</button>'; //Onclick event to trigger ajax link to edit page.
		echo '</td>';
		echo '<td>';
		echo '<form action="deleteProduct.php" method="post" onSubmit="return confirmDelete()">';
		echo '<input name="id" value="'.$row[0].'" type="hidden" />';
		echo '<input name="image" value="'.$row[5].'" type = "hidden" />';
		echo '<input type="submit" name="delete" value="Delete Product"/>';
		echo '</form>';
		echo '</td>';
		echo '</tr>';
	}//End for loop.
	}//End if statement.
	else 
	{
		echo "There is no product available in the store.";
	}//End Else statement.
echo '</table>';

?>


<script>
	// For delete confirm box.
	function confirmDelete() {
		var x = confirm("Are you sure you want to delete this product.");
		return x;
	}
</script>
