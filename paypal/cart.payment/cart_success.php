<?php
$orderId = $_GET['orderId'];
$db = mysqli_connect('localhost','root','','initfun');
$quantity = 1;
$amount = 1;
$orderDate = date('Y-m-d');
$query = "INSERT INTO order_item (
    order_id,
    product_id,
    quantity,
    rate,
    total,
    order_item_status,
    scheduled_delivery) VALUES (
        $orderId,
        123,
        $quantity,
        $amount,
        $amount,
        1,
        '$orderDate'
    )";

mysqli_query($db, $query);
?>