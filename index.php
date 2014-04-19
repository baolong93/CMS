<?php
	session_start(); // start session cookies.
	include_once "php/connect.php"; //prevent from loading the file multiple times.
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
	<header class="mainheader">
				<h1 class="logo">CMS For Webscrpt</h1>

		<nav><ul>
				<li><a href="index.php" class="active" id = "homeButton">Home</a></li>
				<li><a href="php/product.php" id = "productButton">Product</a></li>
				<li><a href="php/insert.php" id="insertButton">Insert Product</a></li>
				<li><a href="#" id ="contactButton">Contact</a></li>
				<li><a href="php/shoppingCart/view_cart.php">Cart </a></li>
				<div id='cart'></div>
		</ul></nav>
	</header>

	<!-- <div id='cart'></div> -->
	<div class="maincontent">
		<div class="content" id="item">
			<article class="topcontent">
			<?php
		    //current URL of the Page. cart_update.php redirects back to this URL
			$current_url = base64_encode($_SERVER['REQUEST_URI']);
			$_SESSION["current_url"] = $current_url;
		    
		    //query for get product from the database.
			$results = $mysqli->query("SELECT * FROM Product ORDER BY id ASC");
		    if ($results) { 
			
		        //fetch results set as object and output HTML
		        while($prob = $results->fetch_object() )
		        if ( $prob->Active == 1)
		        {
		        {
					echo '<div class="product">'; 
		            echo '<form method="post" action="php/shoppingCart/cart_update.php">';
					echo '<div class="proPicture><a href="#" onclick ="changeProductView('. $prob->ID. ')"><img src="php/'.$prob->Picture.'"></a></div>';
		            echo '<div class="Name"><h3>'.$prob->Name.'</h3>';
		            // echo '<div class="Description">'.$prob->Description.'</div>';
		            echo '<div class="product-info">';
					echo 'Price £'.$prob->Price.' | ';
		            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
					echo '<button class="add_to_cart" id="cartButton">Add To Cart</button>';
					echo '</div></div>';
		            echo '<input type="hidden" name="product_ID" value="'.$prob->ID.'" />';
		            echo '<input type="hidden" name="type" value="add" />';
					echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
		            echo '</form>';
		            echo '</div>';
		        }
		    	}
    
		    }
		    ?>

			</article>

			<!-- <article class="bottomcontent">
				<header>
					<h2><a href="#" title="Second Post">Second product</a></h2>
				</header>

				<footer>
					<p class="post_info">Price $0.00</p>
				</footer>	

				<content>
					<p>dsafdsafdaf<p>
				</content>
			</article>
 -->
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
			        echo '<span class="remove-itm"><a href="php/shoppingCart/cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
			        echo '<h3>'.$cart_itm["name"].'</h3>';
			        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
			        echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
			        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
			        echo '</li>';
			        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
			        $total = ($total + $subtotal);
			    }
			    echo '</ol>';
			    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="php/shoppingCart/view_cart.php">Check-out!</a></span>';
				echo '<span class="empty-cart"><a href="php/shoppingCart/cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
			     //passing variable "emptycart=1" and return_url to the car_update.php file.
			}else{
			    echo 'Your Cart is empty';
			}
			?>
		</article>
	</aside>
</div>

<div id="mainpage"></div>

	<footer class="main_footer">
		<p>Copyright &copy: <a href="#" title="Bao Long Ngo">Ngo Bao Long</a></p>
	</footer>

</body>
</html>