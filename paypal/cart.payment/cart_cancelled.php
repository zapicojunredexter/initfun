
<?php
$orderId = $_GET['orderId'];
$db = mysqli_connect('localhost','root','','initfun');

$query = "DELETE FROM `order_item` WHERE order_id = $orderId";
mysqli_query($db, $query);
$query = "DELETE FROM `orders` WHERE id = $orderId";
mysqli_query($db, $query);

echo "order cancelled"
?>