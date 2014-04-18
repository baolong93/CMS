<?php 
	include_once("../connect.php");
	session_start();
?>

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
		$mysqli->query($query);
		if (!$result) {
			echo "something went wrong!!".mysqli_error($mysqli)."<br>";
		}
		$customerID = $mysqli->insert_id;//get the customer id.

		//


	}
?>

<h2>Customer Information</h2>
		<form method="post" action="checkout.php" ><pre>    <!--pre tag for keep the form in fix width-->
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