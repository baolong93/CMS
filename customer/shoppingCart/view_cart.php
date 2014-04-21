<?php
session_start();
include_once('../../include/connect.php');
include('../header.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View shopping cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css"></head>
<body>
<div id="products-wrapper">
 <h1>View Cart</h1>
 <div class="view-cart">
 	<?php
    $current_url = base64_encode($_SERVER['REQUEST_URI']);
	if(isset($_SESSION["products"]))
    {
	    $total = 0;
		echo '<form method="post" >';
		echo '<ul>';
		$cart_items = 0;
		foreach ($_SESSION["products"] as $item)
        {
           $product_code = $item["code"];
		   $results = $mysqli->query("SELECT Name,Description, Price FROM Product WHERE ID='$product_code' LIMIT 1");
		   $obj = $results->fetch_object();
		   
		    echo '<li class="cart-itm">';
			echo '<span class="remove-itm"><a href="cart_update.php?removep='.$item["code"].'&return_url='.$current_url.'">&times;</a></span>';
			echo '<div class="p-Price">'.$currency.$obj->Price.'</div>';
            echo '<div class="product-info">';
			echo '<h3>'.$obj->Name.' (Code :'.$product_code.')</h3> ';
            echo '<div class="p-qty">Qty : '.$item["qty"].'</div>';
            echo '<div>'.$obj->Description.'</div>';
			echo '</div>';
            echo '</li>';
			$subtotal = ($item["price"]*$item["qty"]);
			$total = ($total + $subtotal);

			// echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->Name.'" />';
			// echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$product_code.'" />';
			// echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj->Description.'" />';
			// echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$item["qty"].'" />';
			// $cart_items ++;
			
        }
    	echo '</ul>';
		echo '<span class="check-out"><a href="checkout.php">Checkout</a></span>';
		echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
		echo '<strong>Total : '.$currency.$total.'</strong>  ';
		echo '</span>';
		echo '</form>';
		
    }else{
		echo 'Your Cart is empty';
	}
	
    ?>
    </div>
</div>
<?php 
include('../footer.php');
