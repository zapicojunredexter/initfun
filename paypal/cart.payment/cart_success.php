<?php
$orderId = $_GET['orderId'];
$db = mysqli_connect('localhost','root','','initfun');
$updateOrderItemsQuery ="UPDATE orders SET payment_status = 1 where id = $orderId";
mysqli_query($db, $updateOrderItemsQuery);
echo "order submitted";
?>