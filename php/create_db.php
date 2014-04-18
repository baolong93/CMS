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
$query = "CREATE TABLE IF NOT EXISTS Product(ID INT NOT NULL AUTO_INCREMENT,
          Name VARCHAR(20) NOT NULL,
          Price INT(5) NOT NULL,
          NumberofProduct INT(5) NOT NULL,
          Description VARCHAR(200) NOT NULL,
          CategoryID INT NOT NULL,
          Picture VARCHAR(50), 
          AddDate DATE NOT NULL,
          PRIMARY KEY (ID));";
// Execute query
if ($mysqli->query($query))
  {
  echo "Table Product created successfully";
  } else
  {
  echo "Error creating table: " . mysqli_error($mysqli);
  }

//create Category table.
$query = "CREATE TABLE IF NOT EXISTS Category(ID INT NOT NULL AUTO_INCREMENT,
          Name VARCHAR(20) NOT NULL,
          PRIMARY KEY (ID));";
if($mysqli->query($query))
{
  echo "Table Category has been create successfully!";
} else {
  echo "Error creating Category table:" . mysqli_error($mysqli);
}

// initialize product.
$productname = "Bag";
$description = "Endeavor bachelor but add eat pleasure doubtful sociable. Earnest greater on no observe for";
$price = "15";
$numberOfProduct = "14";
$image = "picture/bag.jpeg";
$query = "SELECT ID FROM Product WHERE Name = '$productname' LIMIT 1";
$length = mysqli_num_rows($mysqli->query($query));
if ( $length == 0){
  $query = "INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, Picture) 
                        VALUES ('', '$productname', '$numberOfProduct', '$price', '$description', '$image')";
  if ($mysqli->query($query))
    {
      echo "CREATE A Product successfully;";
    }
  else
    {
      echo "Something went wrong!";
    }
}

$productname = "MacBook";
$description = "Endeavor bachelor but add eat pleasure doubtful sociable. Earnest greater on no observe for";
$price = "15";
$numberOfProduct = "14";
$image = "picture/macbook.jpeg";
$query = "SELECT ID FROM Product WHERE Name = '$productname' LIMIT 1";
$length = mysqli_num_rows($mysqli->query($query));
if ( $length == 0){
  $query = "INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, Picture) 
                        VALUES ('', '$productname', '$numberOfProduct', '$price', '$description', '$image')";
  if ($mysqli->query($query))
    {
      echo "CREATE A PRODUCT successfully;";
    }
  else
    {
      echo "Something went wrong!";
    }
}

$productname = "noimage";
$description = "Endeavor bachelor but add eat pleasure doubtful sociable. Earnest greater on no observe for";
$price = "15";
$numberOfProduct = "14";
$image = "picture/noimage.jpeg";
$query = "SELECT ID FROM Product WHERE Name = '$productname' LIMIT 1";
$length = mysqli_num_rows($mysqli->query($query));
if ( $length == 0){
  $query = "INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, Picture) 
                        VALUES ('', '$productname', '$numberOfProduct', '$price', '$description', '$image')";
  if ($mysqli->query($query))
    {
      echo "CREATE A PRODUCT successfully <br>";
    }
  else
    {
      echo "Something went wrong!";
    }
}


//CREATE CUSTOMER TABLE FOR CHECK-OUT.
$query = "CREATE TABLE IF NOT EXISTS Customer (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  Name VARCHAR(20) NOT NULL,
  Email VARCHAR(80) NOT NULL,
  AddressID VARCHAR(80) NOT NULL,
  Phone VARCHAR(20) NOT NULL,
  PRIMARY KEY  (ID))"; 
if ($mysqli->query($query))
  {
  echo "Table user created successfully <br>";
  } else
  {
  echo "Error creating table: " . mysqli_error($mysqli);
  }

//CREATE ADDRESS TABLE FOR CHECKOUT.
  $query = "CREATE TABLE IF NOT EXISTS Address (
    ID INT(11) NOT NULL AUTO_INCREMENT, 
    AddressLine1 VARCHAR(20) NOT NULL,
    AddressLine2 VARCHAR(20),
    Town         VARCHAR(20) NOT NULL,
    County       VARCHAR(20) NOT NULL,
    PostCode     VARCHAR(7) NOT NULL,
    Country      VARCHAR(20) NOT NULL,
    PRIMARY KEY (ID))";
  if ($mysqli->query($query))
  {
  echo "Table Address created successfully <br>";
  } else
  {
  echo "Error creating table: " . mysqli_error($mysqli);
  }

//CREATE ORDER TABLE FOR CHECKOUT.
$query = "CREATE TABLE IF NOT EXISTS OrderT ( 
  ID INT(11) NOT NULL AUTO_INCREMENT,
  OrderDate DATE NOT NULL,
  CustomerID INT(11) NOT NULL,
  PRIMARY KEY  (ID))";
if ($mysqli->query($query))
  {
  echo "Table user created successfully <br>";
  } else
  {
  echo "Error creating table: " . mysqli_error($mysqli);
  }

//CREATE ORDER-DETAIL FOR CHECKOUT.
  $query = "CREATE TABLE IF NOT EXISTS Order_Info (
  ID int(11) NOT NULL AUTO_INCREMENT,
  Product_ID int(11) NOT NULL,
  Quantity int(11) NOT NULL,
  Price Float NOT NULL)";
if ($mysqli->query($query)){
  echo "Table Order_Info has been created successfully <br>";
} else {
  echo "Error creating table: ".mysqli_error($mysqli);
}




  echo "ALL SET";
?>