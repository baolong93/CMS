<?php
include 'connect.php';

//Comeback to initialize some example product.
//Initialise some data in each table first time user.


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

//===========================CREATE CATEGORY TABLE===========================
$query = "CREATE TABLE IF NOT EXISTS Category(ID INT NOT NULL AUTO_INCREMENT,
          Name VARCHAR(20) NOT NULL,
          PRIMARY KEY (ID));";
if($mysqli->query($query))
{
  echo "Table Category has been create successfully!";
} else {
  echo "Error creating Category table:" . mysqli_error($mysqli);
}

$cat1 = $mysqli->query("INSERT INTO Category VALUES ('', 'Laptop')");
$cat2 = $mysqli->query("INSERT INTO Category VALUES ('', 'Stationery')");

//===========================CREATE PRODUCT TABLE===========================
$query = "CREATE TABLE IF NOT EXISTS Product(ID INT NOT NULL AUTO_INCREMENT,
          Name VARCHAR(20) NOT NULL,
          Price INT(5) NOT NULL,
          NumberofProduct INT(5) NOT NULL,
          Description VARCHAR(200) NOT NULL,
          CategoryID INT NOT NULL,
          Picture VARCHAR(50), 
          AddDate DATE NOT NULL,
          Active  Boolean NOT NULL,
          PRIMARY KEY (ID));";
// Execute query
if ($mysqli->query($query))
  {
  echo "Table Product created successfully";
  } else
  {
  echo "Error creating table: " . mysqli_error($mysqli);
  }



// initialize product.
$description = "Endeavor bachelor but add eat pleasure doubtful sociable. Earnest greater on no observe for";
$image = "picture/1/bag.jpeg";
$date = date("Y-m-d H:i:s");

  $query = "INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, CategoryID, AddDate, Active, Picture) 
                        VALUES ('', 'Bag', '15', '15', '$description', '2', '$date', '1', '$image' )";
  if ($mysqli->query($query))
    {
      echo "CREATE A Product successfully;";
    }
  else
    {
      echo "Something went wrong!";
    }

$image = "picture/2/macbook.jpeg";

  $query = "INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, CategoryID, AddDate, Active, Picture) 
                        VALUES ('', 'Macbook', '15', '1000', '$description', '1', '$date', '1', '$image' )";
  if ($mysqli->query($query))
    {
      echo "CREATE A PRODUCT successfully;";
    }
  else
    {
      echo "Something went wrong!";
    }


$description = "Endeavor bachelor but add eat pleasure doubtful sociable. Earnest greater on no observe for";
$image = "picture/3/pen.jpg";

  $query = "INSERT INTO Product (ID, Name, NumberofProduct, Price, Description, CategoryID, AddDate, Active, Picture) 
                        VALUES ('', 'pen', '15', '5', '$description', '2', '$date', '1', '$image' )";
  if ($mysqli->query($query))
    {
      echo "CREATE A PRODUCT successfully <br>";
    }
  else
    {
      echo "Something went wrong!";
    }



//===========================CREATE CUSTOMER TABLE===========================
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

  $customer1 = $mysqli->query("INSERT INTO Customer VALUES ('', 'Bao Long Ngo', 'rongvangufa@gmail.com', '0', '07554786673')");

//===========================CREATE ADDRESS TABLE===========================
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
$address1 = $mysqli->query("INSERT INTO Address VALUES ('', '82 Kings road', '', 'Southsea', 'Hampshire', 'PO5 4DN', 'UK')");

//===========================CREATE ORDERT TABLE===========================
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

  $Ordert1 = $mysqli->query("INSERT INTO OrderT VALUES ('', '$date', '1')");

//===========================CREATE ORDER-DETAIL TABLE===========================
  $query = "CREATE TABLE IF NOT EXISTS Order_Info (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  OrderID INT(11) NOT NULL,
  ProductID INT(11) NOT NULL,
  Quantity INT(11) NOT NULL,
  Price Float NOT NULL,
  PRIMARY KEY (ID))";
if ($mysqli->query($query)){
  echo "Table Order_Info has been created successfully <br>";
} else {
  echo "Error creating table: ".mysqli_error($mysqli);
}

$orderinfor1 = $mysqli->query("INSERT INTO Order_Info VALUES ('', '1', '1', '4', '60')");
$orderinfor2 = $mysqli->query("INSERT INTO Order_Info VALUES ('', '1', '2', '1', '1000' )");


  echo "ALL SET";
?>