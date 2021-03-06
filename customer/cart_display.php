<?php
include_once('../include/connect.php');
session_start();
//===========================ADD ITEM IN SHOPPING CART==============================
if(isset($_GET["type"]) && $_GET["type"]=='add')
{
	$product_ID 	= $_GET["product_ID"]; //product code
	$product_qty 	= $_GET["product_qty"]; //product code
	// $return_url 	= base64_decode($_POST["return_url"]); //return url

	//MySqli query - get details of item from db using product code
	$results = $mysqli->query("SELECT Name,Price,NumberofProduct FROM Product WHERE ID='$product_ID' LIMIT 1");
	$obj = $results->fetch_object();

	if($product_qty > $obj->NumberofProduct)
	{ //Checking whether the stock is available for order.
		die;
	}
	
	if ($results) 
	{ //we have the product info 
		
	//prepare array for the session variable
	$new_product = array(array('name'=>$obj->Name, 'ID'=>$product_ID, 'qty'=>$product_qty, 'price'=>$obj->Price));
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $item) //Check every single item in the cart.
			{
				if($item["ID"] == $product_ID)
				{ 
       				$product_qty += $item['qty']; //increase number of product in the cart
       				if ($product_qty > $obj->NumberofProduct) 
       				{
       					die;
       				} //Again to check the order compare to what the company hv in stock.
					$product[] = array('name'=>$item["name"], 'ID'=>$item["ID"], 'qty'=>$product_qty, 'price'=>$item["price"]);
					$found = true;
				}
				else
				{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$item["name"], 'ID'=>$item["ID"], 'qty'=>$item["qty"], 'price'=>$item["price"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
			}
			else
			{
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
			}
			
		}
		else
		{
			//create a new session var if does not exist
			$_SESSION["products"] = $new_product;
		}
	}
	
}
//===========================RETURN NUMBER OF ITEM IN THE CART==============================
	if(isset($_SESSION["products"]))
	{
		$total = 0;
		foreach ($_SESSION["products"] as $item)
		{
		$subtotal = $item["qty"];
		$total += $subtotal;
		}
		echo $total;
	}
	else 
	{
		echo "0";
	}
?>