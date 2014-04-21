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
		        while($prob = $result->fetch_object() )
		        {
		        	if ( $prob->Active == 1)  //check acti
			        {
						echo '<div class="product">'; 
			            echo '<form method="post" action="php/shoppingCart/cart_update.php">';
						echo '<div class="proPicture><a href="#" onclick ="changeProductView('. $prob->ID. ')"><img src="admin/'.$prob->Picture.'"></a></div>';
			            echo '<div class="Name"><h3>'.$prob->Name.'</h3>';
			            // echo '<div class="Description">'.$prob->Description.'</div>';
			            echo '<div class="product-info">';
						echo 'Price £'.$prob->Price.' | ';
						echo 'Stock:'.$prob->NumberofProduct;
			            // echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
						// echo '<button class="add_to_cart" id="cartButton">Add To Cart</button>';
						echo '</div></div>';
			            echo '<input type="hidden" name="product_ID" value="'.$prob->ID.'" />';
			            echo '<input type="hidden" name="type" value="add" />';
						// echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
			            echo '</form>';
			            echo '</div>';
			        }
		        }
    
		    }
		}	
?>