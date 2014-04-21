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
				<li><a href="#" id ="addcat">Insert Category</a></li>
				<li><a href="#" id="Report">Report</a></li>
		</ul></nav>
	
	<div id="displaySearch">
			<form action="search.php" method='post' name="searchbox">
				<input type="text" name="search" value placeholder="Search" />
				<input type="submit" name="Submit" value="Search"/>
			</form>
		</div>
	<!-- <div id='cart'></div> -->
	<div class="maincontent">
		<div class="content" id="item">
			<article class="topcontent">
			<script src="../script/productScript.js"></script>
			<?php 
			include ('product.php');
			?>
			</article>
		</div>


	<aside class="top_sidebar">
		<article>
		</article>
	</aside>
</div>

<div id="mainpage"></div>

	<footer class="main_footer">
		<p>Copyright &copy: <a href="#" title="Bao Long Ngo">Ngo Bao Long</a></p>
	</footer>

</body>
</html>