<?php
include_once 'connect.php';

	if (isset($_POST['delete']) && isset($_POST['id']))
	{
		$id = get_post('id');
		$query = "DELETE FROM product WHERE id='$id'";
	}

	$query = "SELECT * FROM product";
	$result = mysql_query($query); 

	if (!$result) die ("Database access failed: " . mysql_error());

	$rows = mysql_num_rows($result);

	for ($i=0; $i < $rows; $i++) 
	{ 
		$row = mysql_fetch_row($result);
		echo <<<_END

		<pre>
		ID:  $row[0]
		Name:  $row[1]
		Number of Product:  $row[2]					
		Price:  $row[3]$
		</pre>

		<form action="product.php" method="post">
		<input type="hidden" name="delete" value="yes"/>
		<input type="hidden" name="id"    value="$row[0]" />
		<input type="submit" value="DELETE PRODUCT"	/></form>
_END;
	}

	function get_post($var)
	{
		return mysql_real_escape_string($_POST($var));
	}
?>