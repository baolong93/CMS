<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>CMS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewpoint" content="width=device-width initial-scale=1.0" /> <!-- Responsive site. -->
	<script src="../script/script.js"></script>
</head>

<body class="body">
	<header class="mainheader">
				<h1 class="logo">CMS For Webscrpt</h1>

		<nav><ul>
				<li><a href="../index.php" class="active" id = "homeButton">Home</a></li>
				<li><a href="product.php" id = "productButton">Product</a></li>
				<li><a href="insert.php" id="insertButton">Insert Product</a></li>
				<li><a href="#" id ="contactButton">Contact</a></li>
				<li><a href="php/shoppingCart/view_cart.php">Cart <div id='cart'></div></a></li>
		</ul></nav>
	</header>