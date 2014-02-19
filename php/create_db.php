<?php
include 'connect.php';


if (mysqli_connect_errno())
  {
  	echo "<script>console.log('Failed to connect to MySQL: ' . mysqli_connect_error();</script>";
  }

//echo "<script>console.log('this is a test');</script>"; writes to console

// Changes to 'shop_db'
if (mysql_select_db("cms")) {
	//echo "<script>console.log('connected to shop_db');</script>";
 }
// Create database
else{
	$sql = "CREATE DATABASE cms";
	if (mysql_query($sql))
  	{
  		echo "<script>console.log('Database INSE created successfully');</script>";
  	}
	else
  	{
  		echo "<script>console.log('Error creating database: ' . mysqli_error($con));</script>";
  	}
}

// create  table
$table = "product";
if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'"))==1) {}
else {
$query = "CREATE TABLE Product(ID INT NOT NULL AUTO_INCREMENT,
          Name VARCHAR(20) NOT NULL,
          Price INT(5) NOT NULL,
          NumberofProduct INT(5) NOT NULL,
          Description VARCHAR(200) NOT NULL,
          Picture VARCHAR(20), 
          PRIMARY KEY (user_id));";
// Execute query
if (mysql_query($query))
  {
  echo "Table user created successfully";
  } else
  {
  echo "Error creating table: " . mysql_error($connection);
  }
}

?>