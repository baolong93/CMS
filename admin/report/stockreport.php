<h1> Stock Report </h1>
<table style="width:700px">
<tr>
  <th>Product ID</th>
  <th>Product Name</th> 
  <th>Product Quantity</th>
</tr>
<?php
include_once('../../include/connect.php');
$query = "SELECT * FROM Product";
$products = $mysqli->query($query);
if ($products) {  
      //fetch results set as object and output HTML
       while($product = $products->fetch_object() )
       {
        echo '<tr>';
        echo '<td>'.$product->ID.'</td>';
        echo '<td>'.$product->Name.'</td>';
        echo '<td>'.$product->NumberofProduct.'</td>';
        echo '</tr>';
       }
}
?>
</table>
