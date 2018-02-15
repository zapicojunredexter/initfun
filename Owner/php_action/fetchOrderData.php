<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$valid = array('order' => array(), 'order_item' => array());

$sql = "SELECT * FROM orders
	WHERE orders.id = {$orderId}";

$result = $connect->query($sql);
$data = $result->fetch_object();
$valid['order'] = $data;

$connect->close();

echo json_encode($valid);
