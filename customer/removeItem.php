<?php
include_once('../../include/connect.php');
session_start();
?>
<?php
if(isset($_GET["removeProduct"]) && isset($_SESSION["products"]))
{
	$product_ID = $_GET["removeProduct"]; //get the product ID to remove

	foreach ($_SESSION["products"] as $item) //loop through session array var
	{
		if($item["ID"]!=$product_ID){ //item does,t exist in the list
			$product[] = array('name'=>$item["name"], 'ID'=>$item["ID"], 'qty'=>$item["qty"], 'price'=>$item["price"]);
		}
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	header("location: view_cart.php");
}

if(isset($_GET["emptycart"]) && $_GET["emptycart"]=='yes')
{
	session_destroy(); //finish session clear all the product.
	echo "Your cart is empty!";
	header("location: view_cart.php");
}
?>