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
		<div id="displaySearchAdmin">
			<form method='post' name="searchbox">
				<input type="text" name="search" id="search" value placeholder="Search" onkeydown="searchProductAdmin()" />
				<input type="submit" name="Submit" value="Search"/>
			</form>
		</div>
	</header>
		<nav><ul>
				<li><a href="index.php" class="active" id="homeButton">Dashboard</a></li>
				<li><a href="insert.php" id="insert">Insert Product</a></li>
				<li><a href="addCategory.php" id ="addcat">Insert Category</a></li>
				<li><a href="report/orderReport.php" id="Report">Report</a></li>
		</ul></nav>
	
	
