<?php
	include_once('../include/connect.php');
	if(isset($_GET['search'])){
		$searchC = $_GET['search'];
		$searchC = preg_replace("[^A-Za-z0-9]", "", $searchC);
		$query="SELECT * FROM Product WHERE Name LIKE '%$searchC%'";
		$result = $mysqli->query($query);
		$searchCount = $result->num_rows;
		if ($searchCount == 0) 
		{
			echo "There is no product that match your search!";
		} 
		else
		{
		        //fetch results set as object and output HTML
				echo '<div class="topcontent">';
		        while($prob = $result->fetch_object() )
		        {
		        	if ( $prob->Active == 1)  //check acti
			        {
						echo '<div class="product">'; 
			            echo '<form method="post">';
						echo '<div class="proPicture"><a href="#" onclick ="changeProductView('. $prob->ID. ')"><img src="admin/'.$prob->Picture.'" height="auto" width="100px"></a></div>';
			            echo '<div class="Name"><h3>'.$prob->Name.'</h3></div>';
			            echo '<div class="product-info"></div>';
						echo 'Price £'.$prob->Price.' | ';
						echo 'Stock:'.$prob->NumberofProduct;
			            echo '</form>';
			            echo '</div>';
			        }
		        }
		        echo '</div>';
    
		    }
		}	
?>