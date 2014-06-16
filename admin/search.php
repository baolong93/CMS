<?php

include_once('../include/connect.php');

?>
<h1> Search Results </h1>
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
	if(isset($_GET['search'])){
		$searchC = $_GET['search'];
		$searchC = preg_replace("[^A-Za-z0-9]", "", $searchC);
		$query="SELECT * FROM Product WHERE Name LIKE '%$searchC%' || Description LIKE '%$searchC%'";
		$result = $mysqli->query($query);
		$searchCount = $result->num_rows;
		if ($searchCount == 0) {
			echo "There is no search result!";
		} else 
		{
			for ($i=0; $i < $searchCount; $i++)  //loop through all the row.
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
				echo '<form action="deleteProduct.php" method="post" onsubmit="confirmDelete()">';
				echo '<input name="id" value="'.$row[0].'" type="hidden" />';
				echo '<input name="image" value="'.$row[5].'" type = "hidden" />';
				echo '<input type="submit" name="delete" value="Delete Product"/>';
				echo '</form>';
				echo '</td>';
				echo '</tr>';

			}//End for loop.
		echo '</table>';
		}//End else statement.
	}
?>