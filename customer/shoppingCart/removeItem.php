<?php

include_once('../include/connect.php');
session_start();

?>
<?php
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
	$product_code 	= $_GET["removep"]; //get the product code to remove
	$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["products"] as $item) //loop through session array var
	{
		if($item["code"]!=$product_code){ //item does,t exist in the list
			$product[] = array('name'=>$item["name"], 'code'=>$item["code"], 'qty'=>$item["qty"], 'price'=>$item["price"]);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}
?>