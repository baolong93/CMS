<?php
if(isset($_SESSION["products"]))
	{
		$total = 0;
		foreach ($_SESSION["products"] as $item)
		{
		$subtotal = $item["qty"];
		$total += $subtotal;
		}
	}
	else 
	{
		$total="0";
	}
?>
<head>
	<title>CMS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<meta name="viewpoint" content="width=device-width initial-scale=1.0" /> <!-- Responsive site. -->
	<script src="../script/script.js">
</script>
</head>

<body class="body">
	<!-- ==================== Header ============================-->
	<header class="mainheader">
		<h1 id="logo">Bao Long Shop</h1>
		<!-- ==================== Shopping cart display ============================-->
		<div id="cartWrapper">
			<a href="view_cart.php">Cart </a>
				<div id='cart'><?php echo $total; ?></div>
		</div>
		<!-- ==================== Search box ============================-->
		<div id="displaySearch">
			<form action="" method='post' name="searchbox">
				<input type="text" name="search" value placeholder="Search" />
				<input type="submit" name="Submit" />
			</form>
		</div>
	</header>
		<nav><ul>
				<li><a href="../../index.php" class="active" id="homeButton">Home</a></li>
				<li><a href="#" id="Category">Category</a></li>
				<li><a href="#" id ="contactButton">Contact</a></li>
		</ul></nav>