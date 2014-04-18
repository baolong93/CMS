<?php 
	include_once('connect.php');



	// Fetch Record from Database

$output = "";
$table = "Product"; // Enter Your Table Name 
$result = $mysqli->query("SELECT * FROM Product");
$columns_total = mysqli_num_fields($result);

// Get The Field Name



for ($i = 0; $i < $columns_total; $i++) {
$heading = $result->fetch_field_direct($i);
$output .= '"'.$heading->name.'",';
}
$output .="\n";

// Get Records from the table

while ($row = mysqli_fetch_array($result)) {
for ($i = 0; $i < $columns_total; $i++) {
$output .='"'.$row["$i"].'",';
}
$output .="\n";
}

// Download the file

$filename = "myFile.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;
	
?>