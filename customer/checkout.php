<?php 
	include_once('../include/connect.php');
	session_start();// start the session.
	include("header.php");
?>
<script>
function validate(form) {
	 fail = validateName(form.Name.value)
	 fail += validateEmail(form.email.value)
	 fail += validateAddress(form.AddressLine1.value)
	 fail += validateAddress(form.AddressLine2.value)
	 fail += validateAddress(form.town.value)
	 fail += validateAddress(form.county.value)
	 fail += validateAddress(form.postcode.value)
	 if (fail == "") return true
	 	else {alert(fail); return false}
	};
		function validateName(field) {
		if (field == "") {
			return "No Name was entered.\n";
		}
		else if (field.length < 8) {
			return "The product Name must be asleast 8 character.\n";
		}
		else if (/[^a-zA-Z]/.test(field)) {
			return "Name can only be a string."
		}
		return "";
		};
		function validateEmail(field) {
			if (field == "") {
			return "No Email was entered.\n";
		}
		else if (!((field.indexOf(".")>0) && (field.indexOf("@")>0)) || /[^a-zA-Z0-9.@_-]/.test(field))
		{
			return "the Email address is invalid."
		}
		return "";
		};
		function validatePhone(field) {
			if (field == "") {
				return "Phone number at least one. \n";
			}
			else if (!/\d/.test(field)) {
				return "Phone number can only be a number."
			}
			else if (field.length != 11){
				return "invalid"
			}
			return "";
		};
		function validateAddress(field) {
			if (field == "") return "No Address was entered.\n";
			else if (!/[^a-zA-Z0-9]/.test(field)){
				return "invalid address!.\n";
			}
			return ""
		};
</script>

<?php
	if(isset($_POST['submitted'])){
		$name = $mysqli->real_escape_string($_POST['Name']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$phone = $mysqli->real_escape_string($_POST['phone']);
		$addressl1 = $mysqli->real_escape_string($_POST['AddressLine1']);
		$addressl2 = $mysqli->real_escape_string($_POST['AddressLine2']);
		$town = $mysqli->real_escape_string($_POST['town']);
		$county = $mysqli->real_escape_string($_POST['county']);
		$postcode = $mysqli->real_escape_string($_POST['postcode']);
		$country = $mysqli->real_escape_string($_POST['country']);

		//PUT DATA TO THE DATABASE FOR ADDRESS TABLE.
		$query = "INSERT INTO Address 
				  VALUES ('', '$addressl1', '$addressl2', '$town', '$county', '$postcode', '$country')";
		$result = $mysqli->query($query);
		if (!$result) {
			echo "something went wrong!!".mysqli_error($mysqli)."<br>";
		}
		$addressID = $mysqli->insert_id; //Get ID of the address just created.

		//PUT DATA TO THE DATABASE FOR CUSTOMER TABLE.
		$query = "INSERT INTO Customer (ID, Name, Email, AddressID, Phone) 
				  VALUES ('', '$name', '$email', '$addressID', '$phone')";
		$result = $mysqli->query($query);
		if (!$result) {
			echo "something went wrong!!".mysqli_error($mysqli)."<br>";
		}
		$customerID = $mysqli->insert_id;//get the customer id.

		//PUT DATA TO THE DATABASE FOR ORDERT TABLE.
		$orderDate = date("Y-m-d H:i:s");
		$query = "INSERT INTO OrderT (ID, OrderDate, CustomerID) 
				  VALUES ('', '$orderDate', '$customerID')";
		$mysqli->query($query);
		if (!$result) {
			echo "something went wrong!!".mysqli_error($mysqli)."<br>";
		}
		$orderID = $mysqli->insert_id;

		//PUT DATA TO THE DATABASE FOR ORDER_INFO TABLE.
		foreach ($_SESSION["products"] as $item) //Loop through all the product in the cart.
        {
            $product_ID = $item["ID"];
		    $quantity = $item['qty'];
		    $subtotal = ($item["price"]*$item["qty"]);
		    $query = "INSERT INTO ORDER_INFO (ID, OrderID, Product_ID, Quantity, Price)
		   			 VALUES ('', '$orderID','$product_ID',  '$quantity', '$subtotal')";
		    $mysqli->query($query);
			if (!$result) 
			{
				echo "something went wrong!!".mysqli_error($mysqli)."<br>";
			}//End if statement.
			$results = $mysqli->query("SELECT NumberofProduct FROM Product WHERE ID='$product_ID' LIMIT 1");
			$obj = $results->fetch_object();
			$stock = $obj->NumberofProduct - $quantity; //Update product's stock.
			$results = $mysqli->query("UPDATE Product SET NumberofProduct = '$stock' WHERE ID = '$product_ID'");
        }//End foreach loop.
        session_destroy();//clear the cart.

	}//End main if statement.
?>

<h2>Customer Information</h2>
		<form method="post" action="checkout.php" onSubmit="return validate(this)"><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			Name:             <input type="text" name="Name"/>
			Email Address:<input type="text" name="email" />
			Phone:            <input type="text" name="phone"/>
			Address Line 1:      <input type="text" name="AddressLine1"> <!--compulsory!-->
			Address Line 2:    <input type="text" name="AddressLine2">
			Town/City:     <input type="text" name="town">
			County:       	<input type="text" name="county">
			Postcode:		<input type="text" name="postcode">
			Country:   		<select name="country">
							<option value="Vietnam" selected>Vietnam</option>
							<option value="Nepal">Nepal</option>
							<option value="United Kingdom">United Kingdom</option>
							</select>
			<input type="submit" value="Check out"/>
	</pre></form>

<?php
	include("footer.php");
?>

