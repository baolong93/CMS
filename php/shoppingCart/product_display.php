?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>CMS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewpoint" content="width=device-width initial-scale=1.0" /> <!-- Responsive site. -->
	<script src="script/script.js">
</script>
</head>

<body class="body">
</body>
<html>




<?php
	session_start();
	include_once("../connect.php");
	// $current_url = $_SESSION['current_url'];
	$current_url = base64_encode($_SERVER['REQUEST_URI']);
	if (isset($_GET['id'])) {
		$query = "SELECT * FROM Product WHERE ID = $_GET[id]";
		$result = $mysqli->query($query);
		$items = $result->fetch_object();
					echo '<div class="items">'; 
		            // echo '<form method="post" onsubmit="changeCart()">';
					echo '<div class="proPicture"><img src="php/'.$items->Picture.'"></div>';
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
		            // echo '</form>';
		            echo '</div>';
	} //end the if statement.

?>

<h2>Your Shopping Cart</h2>
			// <?php
			// if(isset($_SESSION["products"]))
			// {
			//     $total = 0;
			//     echo '<ol>';
			//     foreach ($_SESSION["products"] as $item)
			//     {
			//         echo '<li class="cart-itm">';
			//         echo '<span class="remove-itm"><a href="cart_update.php?removep='.$item["code"].'&return_url='.$current_url.'">&times;</a></span>';
			//         echo '<h3>'.$item["name"].'</h3>';
			//         echo '<div class="p-code">P code : '.$item["code"].'</div>';
			//         echo '<div class="p-qty">Qty : '.$item["qty"].'</div>';
			//         echo '<div class="p-price">Price :'.$currency.$item["price"].'</div>';
			//         echo '</li>';
			//         $subtotal = ($item["price"]*$item["qty"]);
			//         $total = ($total + $subtotal);
			//     }
			//     echo '</ol>';
			//     echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">Check-out!</a></span>';
			// 	echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
			//      //passing variable "emptycart=1" and return_url to the car_update.php file.
			// }else{
			//     echo 'Your Cart is empty';
			// }
			// ?>