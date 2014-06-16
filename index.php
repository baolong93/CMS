<?php
	session_start(); // start session cookies.
	include_once "include/connect.php"; //prevent from loading the file multiple times.
?>
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
<!DOCTYPE html>
<html lang="en">

<head>
	<title>CMS</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewpoint" content="width=device-width initial-scale=1.0" /> <!-- Responsive site. -->
	<script src="script/script.js">
</script>
</head>

<body class="body">
	<!-- ==================== Header ============================-->
	<header class="mainheader">
		<h1 id="logo">EasyCart</h1>
		<!-- ==================== Shopping cart display ============================-->
		<div id="cartWrapper">
			<a href="customer/view_cart.php">Cart </a>
				<div id='cart'><?php echo $total; ?></div>
		</div>
		<!-- ==================== Search box ============================-->
		<div id="displaySearch">
			<form action="" method='post' name="searchbox">
				<input type="text" name="search" id="search" value placeholder="Search" onkeydown="searchProduct()"/>
				<button name"submit" id="searchButton">Search</button>
			</form>
		</div>
	</header>
		<nav><ul>
				<li><a href="index.php" class="active" id="homeButton">Home</a></li>
				<li><a href="#" id="Category">Category</a></li>
				<li><a href="#" id ="contactButton">Contact</a></li>
		</ul></nav>
	

	<!-- <div id='cart'></div> -->
	<div class="maincontent">
		<div class="content" >
			<div class="topcontent" id="item">
			<?php
		    //query for get product from the database.
			$results = $mysqli->query("SELECT * FROM Product ORDER BY id ASC");
		    if ($results) { 
			
		        //fetch results set as object and output HTML
		        while($prob = $results->fetch_object() )
		        {
		        	if ( $prob->Active == 1)  //check active state.
			        {
						echo '<div class="product">'; 
			            echo '<form method="post">';
						echo '<div class="proPicture"><a href="#" onclick ="changeProductView('. $prob->ID. ')"><img src="admin/'.$prob->Picture.'" height="auto" width="100px"></a></div>';
			            echo '<div class="Name"><h3>'.$prob->Name.'</h3></div>';
			            echo '<div class="product-info"></div>';
						echo 'Price £'.$prob->Price.' | ';
						echo 'Stock:'.$prob->NumberofProduct;
			            echo '</form>';
			            echo '</div>';
			        }
		        }
		    }
		    ?>

			</div>
		</div>


	<aside class="top_sidebar">
		<h2>Category</h2>
		<?php 
			$query = 'SELECT * FROM Category';
			$result = $mysqli->query($query);
			echo '<ul>';
			if ($result) {
				while($cat = $result->fetch_object())
				{
					echo '<li>'.$cat->Name.'</li>';
				}
			}
			echo '</ul>';
		?>
	</aside>
</div>

<div id="mainpage"></div>

	<footer class="main_footer">
		<p>Copyright &copy: <a href="#" title="Bao Long Ngo">Ngo Bao Long</a></p>
		<a href="admin/index.php" class="linkadmin">Admin page</a>
	</footer>

</body>
</html>