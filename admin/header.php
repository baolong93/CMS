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
	<script src="../script/script.js">
</script>
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
				<li><a href="report/stockreport.php" id="Report">Report</a></li>
		</ul></nav>
	
