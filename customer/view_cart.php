<?php
session_start();
include_once('../include/connect.php');
include('header.php');
?>
<script src="../../script/script.js"></script>
 <h1>Your Cart</h1>
 <table style="width:700px">
<tr>
  <th>Remove</th>
  <th>Name</th>
  <th>Picture</th> 
  <th>Description</th>
  <th>Price</th>
  <th>Quantity</th>
  <th>Order Total</th>
</tr>
 	<?php
	if(isset($_SESSION["products"]))
    {
	    $total = 0;
		// $cart_items = 0;
		foreach ($_SESSION["products"] as $item)
        {
           $product_ID = $item["ID"];
		   $results = $mysqli->query("SELECT Name,Description, Picture, Price FROM Product WHERE ID='$product_ID' LIMIT 1");
		   $obj = $results->fetch_object();
		echo '<tr>';
        echo '<td><a href="removeItem.php?removeProduct='.$product_ID.'">&times;</a></td>';
        echo '<td>'.$obj->Name.'</td>';
        echo '<td><img src=../admin/'.$obj->Picture.' height="150px" width="auto"></td>';
        echo '<td>'.$obj->Description.'</td>';
        echo '<td>'.$obj->Price.'</td>';
        echo '<td>'.$item["qty"].'</td>';
        
			// echo '<span class="remove-item"><a href="#" onclick="removeProduct('.$product_ID.')">&times;</a></span>';
			// echo '<div class="p-Price">'.$currency.$obj->Price.'</div>';
   //          echo '<div class="product-info">';
			// echo '<h3>'.$obj->Name.' (ID :'.$product_ID.')</h3> ';
   //          echo '<div class="p-qty">Qty : '.$item["qty"].'</div>';
   //          echo '<div>'.$obj->Description.'</div>';
			// echo '</div>';
   //          echo '</li>';
			$subtotal = ($obj->Price*$item["qty"]);
			$total = ($total + $subtotal);
		echo '<td>'.$currency.$total.'</td>';
		echo '</tr>';
        }
    	// echo '</ul>';
		echo '<span class="check-out" id="checkout"><a href="checkout.php">Checkout</a></span>';
		echo '<span class="empty-cart"><a href="removeItem.php?emptycart=yes">Empty Cart</a></span>';
		echo '<strong>Total : '.$currency.$total.'</strong>  ';
		// echo '</span>';
		// echo '</form>';
		
    }else{
		echo 'Your Cart is empty';
	}
	echo '</table>';
    ?>
<?php 
include('footer.php');
?>
