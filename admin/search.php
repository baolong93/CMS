<?php

include_once('../include/connect.php');

?>


<?php
	if(isset($_POST['search'])){
		$searchC = $_POST['search'];
		$searchC = preg_replace("[^A-Za-z0-9]", "", $searchC);
		$query="SELECT * FROM Product WHERE Name LIKE '%$searchC%'";
		$result = $mysqli->query($query);
		$searchCount = $result->num_rows;
		if ($searchCount == 0) {
			echo "There is no search result!";
		} else 
		{
			for ($i=0; $i < $searchCount; $i++)  //loop through all the row.
			{ 
				$row = mysqli_fetch_row($result);

				echo '<pre>';
				echo 'ID:  '.$row[0].'<br>';
				echo 'Name:  '.$row[1].'<br>';
				echo 'Number of Product:  '.$row[2].'<br>';					
				echo 'Price:  '.$row[3].'<br>';
				echo 'Description:  '.$row[4].'<br>';
				echo 'Picture: <img src="'.$row[5].'"><br>'; 
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
	}
?>