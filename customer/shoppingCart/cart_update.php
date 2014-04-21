	<?php
session_start();
include_once('../../include/connect.php');

//If the emptycart is pushed, the session is 
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	session_destroy(); //finish session clear all the product.
	header('Location:'.$return_url); //redirect the page.
}

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	$product_ID 	= filter_var($_POST["product_ID"], FILTER_SANITIZE_NUMBER_INT); //product code
	$product_qty 	= filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //product code
	$return_url 	= base64_decode($_POST["return_url"]); //return url

	//MySqli query - get details of item from db using product code
	$results = $mysqli->query("SELECT Name,Price,NumberofProduct FROM Product WHERE ID='$product_ID' LIMIT 1");
	$obj = $results->fetch_object();

	if($product_qty > $obj->NumberofProduct){ //Checking whether the stock is available for order.
		die('<div align="center">The quantity is surpass the stock!<br /><a href="../../index.php">Back To Homepage</a>.</div>');
	}
	
	if ($results) { //we have the product info 
		
		//prepare array for the session variable
		$new_product = array(array('name'=>$obj->Name, 'code'=>$product_ID, 'qty'=>$product_qty, 'price'=>$obj->Price));
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $item) //Check every single item in the cart.
			{
				if($item["code"] == $product_ID){ 
       				$product_qty += $item['qty']; //increase number of product in the cart
       				if ($product_qty > $obj->NumberofProduct) {
       					die('<div align="center">The quantity is surpass the stock!<br /><a href="../../index.php">Back To Homepage</a>.</div>');
       				} //Again to check the order compare to what the company hv in stock.
					$product[] = array('name'=>$item["name"], 'code'=>$item["code"], 'qty'=>$product_qty, 'price'=>$item["price"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$item["name"], 'code'=>$item["code"], 'qty'=>$item["qty"], 'price'=>$item["price"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["products"] = $new_product;
		}
		
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}

//remove item from shopping cart
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