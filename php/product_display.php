<?php
	session_start();
	include_once("connect.php");
	// $current_url = $_SESSION['current_url'];
	$current_url = base64_encode($_SERVER['REQUEST_URI']);
	if (isset($_GET['id'])) {
		$query = "SELECT * FROM Product WHERE ID = $_GET[id]";
		$result = $mysqli->query($query);
		$product = $result->fetch_object();
					echo '<div class="product">'; 
		            echo '<form method="post" action="../cart_update.php">';
					echo '<div class="proPicture"><img src="'.$product->Picture.'"></div>';
		            echo '<div class="Name"><h3>'.$product->Name.'</h3>';
		            echo '<div class="Description">'.$product->Description.'</div>';
		            echo '<div class="product-info">';
					echo 'Price £'.$product->Price.' | ';
		            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
					echo '<button class="add_to_cart" onclick="fetch()">Add To Cart</button>';
					echo '</div></div>';
		            echo '<input type="hidden" name="product_ID" value="'.$product->ID.'" />';
		            echo '<input type="hidden" name="type" value="add" />';
					echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
		            echo '</form>';
		            echo '</div>';
	} //end the if statement.

?>

<h2>Your Shopping Cart</h2>
			<?php
			if(isset($_SESSION["products"]))
			{
			    $total = 0;
			    echo '<ol>';
			    foreach ($_SESSION["products"] as $cart_itm)
			    {
			        echo '<li class="cart-itm">';
			        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
			        echo '<h3>'.$cart_itm["name"].'</h3>';
			        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
			        echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
			        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
			        echo '</li>';
			        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
			        $total = ($total + $subtotal);
			    }
			    echo '</ol>';
			    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">Check-out!</a></span>';
				echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
			     //passing variable "emptycart=1" and return_url to the car_update.php file.
			}else{
			    echo 'Your Cart is empty';
			}
			?>