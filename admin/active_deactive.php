<?php
	include_once '../include/connect.php'; //connect to the database
	if (isset($_GET['status']) && isset($_GET['id']) && $_GET['status'] == 'active') //Check whether deactive button is pushed.
	{
		$id = $_GET['id'];
		$query = "UPDATE Product SET Active = 1 WHERE ID = '$id'";
		$deactive = $mysqli->query($query);
				// echo '<form  method="post")">';
				echo '<input type="hidden" name="status" id="status'.$id.'" value="deactive"/>';
				// echo '<input type="hidden" name="id"  id="id"  value="'.$row[0].'" />';
				// echo '<input type="hidden" name="image" value="$row[5]" />';
				echo '<button value="DEACTIVE PRODUCT" onclick="changeActive('.$id.')"> Deactive </button>';
				// echo '</form>';

	}

	if (isset($_GET['status']) && isset($_GET['id']) && $_GET['status'] == 'deactive') //Active button is pushed.
	{
		$id = $_GET['id'];  //getting the id.
		$query = "UPDATE Product SET Active = 0 WHERE ID = '$id'"; 
		//back for delete the picture file.
		$active = $mysqli->query($query);
				// echo '<form method="post")">';
				echo '<input type="hidden" name="status" id="status'.$id.'" value="active"/>';
				// echo '<input type="hidden" name="id"  id="id"  value="'.$row[0].'" />';
				// echo '<input type="hidden" name="image" value="$row[5]" />';
				echo '<button value="DEACTIVE PRODUCT" onclick="changeActive('.$id.')"> active </button>';
				// echo '</form>';
	}

?>