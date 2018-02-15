<?php 	

require_once 'core.php';

$productId = $_GET['i'];

$sql = "SELECT product_image FROM product WHERE id = {$productId}";
$data = $connect->query($sql);
$result = $data->fetch_object();

$connect->close();

echo "initfun/" . $result[0];
