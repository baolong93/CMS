
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
$TotalCash = 0;
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
              $description .= $product->Name.": ".$orderDetail->Quantity.", ";
            }
          }//End if statement.
        $orderDate = $order->OrderDate;
        echo '<tr>';
        echo '<td>'.$order->ID.'</td>';
        echo '<td><a href=addressReport.php?id='.$customer->AddressID.'>'.$customer->Name.'</a></td>';
        echo '<td>'.$description.'</td>';
        echo '<td>'.$orderDate.'</td>';
        echo '<td>'.$totalPrice.'</td>';
        echo '</tr>';
        $TotalCash += $totalPrice;
       }
}
echo "Total Income: ".$TotalCash;
?>
</table>

<h1> Stock Report </h1>
<table style="width:700px">
<tr>
  <th>Product ID</th>
  <th>Product Name</th> 
  <th>Product Quantity</th>
</tr>
<?php
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


