<?php
/// Need to complete the validation.
include_once('connect.php');

if (isset($_POST['submitted'])) {
	
		$catname 			= $_POST['catName'];
		$sql					="INSERT INTO Category (ID, Name) 
								VALUES ('', '$catname')";
		$results = $mysqli->query($sql);
		if (!$results) {
			die('error inserting new product!');
		} //end of nested statement.
} //end of if statement.
?>

<body>
<h2>Insert New Product</h2>
		<form method="post" action="addCategory.php" ><pre>    <!--pre tag for keep the form in fix width-->
			<input type="hidden" name="submitted" value="yes"/>
			Name:             <input type="text" name="catName"/>
			<input type="submit" value="Add Category"/>
	</pre></form>

</body>