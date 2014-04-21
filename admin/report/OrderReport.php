<h1> Order Report </h1>
<table style="width:700px">
<tr>
  <th>Order ID</th>
  <th>Order Customer</th> 
  <th>Order Description</th>
  <th>Order Date</th>
  <th>Order Total</th>
</tr>
<?php
include_once('../../include/connect.php');
$query = "SELECT * FROM OrderT";
$orders = $mysqli->query($query);
if ($orders) {  
      //fetch results set as object and output HTML
       while($order = $orders->fetch_object() )
       {
          $customerResult = $mysqli->query("SELECT * FROM Customer WHERE ID='$order->CustomerID'");
          $customer = $customerResult->fetch_object();
          $orderDetailResult = $mysqli->query("SELECT * FROM Order_Info WHERE OrderID='$order->ID'");
          $totalPrice = 0;
          $description = "";
          if($orderDetailResult) {
            while ($orderDetail = $orderDetailResult->fetch_object()) {
              $totalPrice+=$orderDetail->Price;
              $query="SELECT Name FROM Product WHERE ID = '$orderDetail->ProductID'";
              $result = $mysqli->query($query);
              $product = $result->fetch_object();
              $description .= $product->Name.$orderDetail->Quantity.",";
            }
          }//End if statement.
        $orderDate = $order->OrderDate;
        echo '<tr>';
        echo '<td>'.$order->ID.'</td>';
        echo '<td>'.$customer->Name.'</td>';
        echo '<td>'.$description.'</td>';
        echo '<td>'.$orderDate.'</td>';
        echo '<td>'.$totalPrice.'</td>';
        echo '</tr>';
       }
}
?>
</table>








<?php 
	




// 	// Fetch Record from Database

// $output = "";
// $table = "Product"; // Enter Your Table Name 
// $result = $mysqli->query("SELECT * FROM Product");
// $columns_total = mysqli_num_fields($result);

// // Get The Field Name



// for ($i = 0; $i < $columns_total; $i++) {
// $heading = $result->fetch_field_direct($i);
// $output .= '"'.$heading->name.'",';
// }
// $output .="\n";

// // Get Records from the table

// while ($row = mysqli_fetch_array($result)) {
// for ($i = 0; $i < $columns_total; $i++) {
// $output .='"'.$row["$i"].'",';
// }
// $output .="\n";
// }

// // Download the file

// $filename = "myFile.csv";
// header('Content-type: application/csv');
// header('Content-Disposition: attachment; filename='.$filename);

// echo $output;
// exit;
	
?>