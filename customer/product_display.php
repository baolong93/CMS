
<?php
	session_start();
	include_once('../include/connect.php');
	// $current_url = $_SESSION['current_url'];
	$current_url = base64_encode($_SERVER['REQUEST_URI']);
	if (isset($_GET['id'])) {
		$query = "SELECT * FROM Product WHERE ID = $_GET[id]";
		$result = $mysqli->query($query);
		$items = $result->fetch_object();
					echo '<div class="items">'; 
					echo '<div class="proPicture"><img src="admin/'.$items->Picture.'" height="150px" width="auto"></div>';
		            echo '<div class="Name"><h3>'.$items->Name.'</h3>';
		            echo '<div class="Description">'.$items->Description.'</div>';
		            echo '<div class="product-info">';
					echo 'Price £'.$items->Price.' | ';
					echo 'Stock: '.$items->NumberofProduct.' | ';
		            echo 'Qty <input type="text" id="proQty" name="product_qty" value="1" size="3" />';
					echo '<button class="add_to_cart" id="addCart" onclick="changeCart()">Add To Cart</button>';
					echo '</div></div>';
		            echo '<input type="hidden" id = "product_ID" name="product_ID" value="'.$items->ID.'" />';
		            echo '<input type="hidden" name="type" value="add" />';
					echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
		            echo '</div>';
	}

?>
