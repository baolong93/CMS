<?php
	include_once "../include/connect.php"; //prevent from loading the file multiple times.
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>CMS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewpoint" content="width=device-width initial-scale=1.0" /> <!-- Responsive site. -->
	<script src="../script/script.js"></script>
	<script src="../script/validation.js"></script>
</head>

<body class="body">
	<!-- ==================== Header ============================-->
	<header class="mainheader">
		<h1 id="logo">Admin Page</h1>
		<!-- ==================== Shopping cart display ============================-->
	</header>
		<nav><ul>
				<li><a href="index.php" class="active" id="homeButton">Dashboard</a></li>
				<li><a href="insert.php" id="insert">Insert Product</a></li>
				<li><a href="addCategory.php" id ="addcat">Insert Category</a></li>
				<li><a href="#" id="Report" onclick="changeReport()">Report</a></li>
				
		</ul></nav>
	
	<div class="maincontent">

		<div class="content">
			<div class="topcontent" id="item">
			<script src="../script/productScript.js"></script>
			<?php 
			include ('product.php'); //Include product file for output list of product.
			?>
			</div>
		</div>


	<aside class="top_sidebar">
		<div id="displaySearchAdmin">
			<form method='post' name="searchbox">
				<input type="text" name="search" id="search" value placeholder="Search" onkeydown="searchProductAdmin()" />
				<input type="submit" name="Submit" value="Search"/>
			</form>
			</div>
	</aside>
</div>

<div id="mainpage"></div>

	<footer class="main_footer">
		<p>Copyright &copy: <a href="#" title="Bao Long Ngo">Ngo Bao Long</a></p>
		<a href="../index.php" class="linkadmin">Shop page</a>
	</footer>

</body>
</html>