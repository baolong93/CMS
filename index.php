<?php
	session_start();
	include_once "php/connect.php"; //prevent from loading the file multiple times.
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Category and shopping cart</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="body">
	<header>
		<div class="maincontent">
		<div class="content">
			<?php
		    //current URL of the Page. cart_update.php redirects back to this URL
			$current_url = base64_encode($_SERVER['REQUEST_URI']);
    ;
		    
			$results = $mysqli->query("SELECT * FROM Product ORDER BY id ASC");
		    if ($results) { 
			
		        //fetch results set as object and output HTML
		        while($obj = $results->fetch_object())
		        {
					echo '<div class="topcontent">'; 
		            echo '<form method="post" action="cart_update.php">';
					echo '<div class="product-picture"><img src="php/'.$obj->Picture.'"></div>';
		            echo '<div class="Name"><h3>'.$obj->Name.'</h3>';
		            echo '<div class="Description">'.$obj->Description.'</div>';
		            echo '<div class="product-info">';
					echo 'Price '.$currency.$obj->Price.' | ';
		            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
					echo '<button class="add_to_cart">Add To Cart</button>';
					echo '</div></div>';
		            echo '<input type="hidden" name="product_ID" value="'.$obj->ID.'" />';
		            echo '<input type="hidden" name="type" value="add" />';
					echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
		            echo '</form>';
		            echo '</div>';
		        }
    
		    }
		    ?>
		</div>
	</div>

	<aside class="top_sidebar">
		<article>
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
		</article>
	</aside>
	</header>
</body>
</html>