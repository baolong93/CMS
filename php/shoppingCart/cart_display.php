
			<?php
			session_start();
			$current_url = $_SESSION["current_url"];
			if(isset($_SESSION["products"]))
			{
			    $total = 0;
			    foreach ($_SESSION["products"] as $cart_itm)
			    {
			        $subtotal = $cart_itm["qty"];
			        $total += $subtotal;
			    }
			    echo '<a href="view_cart.php"> Cart </a> '.$total;
			}else{
			    echo 'Cart 0';
			}
			?>