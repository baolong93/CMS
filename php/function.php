<?php
include('connect.php');

function getProducts() {
	$query = "SELECT * FROM product";
	$result = mysql_query($query); 

	if (!$result) die ("Database access failed: " . mysql_error());

	$rows = mysql_num_rows($result);

	for ($i=0; $i < $rows; $i++) 
	{ 
		$row = mysql_fetch_row($result);
		echo "ID: "      				.     $row[0] 		. '<br />';
		echo "Name: "      				.     $row[1] 		. '<br />';
		echo "Number of Product: "    	.     $row[2] 		. '<br />';
		echo "Price: "      			.     $row[3]   	. '<br />';
		echo "Description: "       		.     $row[4]   	. '<br /><br />';	
	}
?>