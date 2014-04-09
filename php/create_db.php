<?php
include 'connect.php';

//Comeback to initialize some example product.


if (mysqli_connect_errno($mysqli))
  {
  	echo "Fail to connect to the database!".$mysqli_connect_error();
  }

 // Change the database to cms. 
if ($mysqli->select_db("cms")) {
 }
// Create database
else{
	$sql = "CREATE DATABASE cms";
	if ($mysqli->query($sql))
  	{
  		echo "Database has been created successfully!";
  	}
	else
  	{
  		echo "Something went wrong!";
  	}
}

// create  Product table.
$table = "Product";
if(mysqli_num_rows($mysqli->query("SHOW TABLES LIKE '".$table."'"))==1) {} //Check existance of the table.
else {
$query = "CREATE TABLE Product(ID INT NOT NULL AUTO_INCREMENT,
          Name VARCHAR(20) NOT NULL,
          Price INT(5) NOT NULL,
          NumberofProduct INT(5) NOT NULL,
          Description VARCHAR(200) NOT NULL,
          Picture VARCHAR(50), 
          PRIMARY KEY (ID));";
// Execute query
if ($mysqli->query($query))
  {
  echo "Table user created successfully";
  } else
  {
  echo "Error creating table: " . mysqli_error($mysqli);
  }
}



?>