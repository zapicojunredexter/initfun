<?php
//session_start();
require_once 'includes/header.php';
require_once 'Owner/php_action/db_connect.php'; 
require_once 'functions.php';
$db= mysqli_connect('localhost','root','','initfun');

?>


<?php
	$i=0;
	$total = 0;
    foreach($_SESSION as $name => $value){
        if($value > 0) {
        	if(substr($name, 0, 5) == 'cart_'){
                $id = substr($name, 5, (strlen($name)-5));
				$query3 = mysqli_query($db, "SELECT * from product WHERE id = $id");
				$data3 = mysqli_fetch_array($query3);
				$total = $total + ($data3['rate'] * $value + (($data3['rate'] * $value) * .13));
				
            }
        	
        }
    }
    $id = $_SESSION['id'];
    $result = mysqli_query($db, "SELECT * from customers WHERE id = $id");
    $row2 = mysqli_fetch_array($result);
    if($row2['wallet'] >= $total + ($total * .13)){
    	$clientName = $row2['first_name'] . ' ' .$row2['last_name'];
    	$orderDate        = date('Y-m-d');
		$clientContact    = $row2['phone_number'];
		
    	foreach($_SESSION as $name => $value){
    		$id2 = $_SESSION['id'];
    		$result = mysqli_query($db, "SELECT * from customers WHERE id = $id2");
    		$row = mysqli_fetch_array($result);
	        if($value > 0) {
	        	if(substr($name, 0, 5) == 'cart_'){
	        		
	                $id2 = substr($name, 5, (strlen($name)-5));
					$query3 = mysqli_query($db, "SELECT * from product WHERE id = $id2");
					$data3 = mysqli_fetch_array($query3);
					$subTotalValue    = $data3['rate'] * $value;
					$vatValue         = ($subTotalValue * .13);
					$totalAmountValue = ($subTotalValue + $vatValue);
					$discount         = 0;
					$grandTotalValue  = $totalAmountValue + $discount;
				
					$paid             = $row['wallet'];
					$dueValue         = $row['wallet'] - $grandTotalValue;
					$paymentType      = 3;
					$paymentStatus    = 1;
					//$total = $total + $data3['rate'] * $value;

					$proid = $data3["brand_id"];
					$query = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status, owner_id) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1, '$proid')";

						 mysqli_query($db, $query);

						$last_id = mysqli_insert_id($db);

						$query4 = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) VALUES ('$last_id', '$id2', '$value', '$subTotalValue', '$grandTotalValue', 1)";
						mysqli_query($db, $query4);

						$owid = $_SESSION['id'];
						$query2 = "UPDATE customers SET wallet = wallet - '$grandTotalValue' WHERE id = '$owid'";
						//echo $query2.'<br>';
						mysqli_query($db, $query2);
							
						//$q = $_SESSION['cart_'.$id];
					$query3 = "UPDATE product SET quantity = quantity - '$value' WHERE id = '$id2'";	
						mysqli_query($db, $query3);

					    foreach($_SESSION as $name => $value){
					        if($value > 0) {
					        	if(substr($name, 0, 5) == 'cart_'){
                                    $id = substr($name, 5, (strlen($name)-5));
                                    $_SESSION['cart_'.$id]='0';
                                   
                                }
					        }

					    }
					 echo '<script language="javascript">alert("Transaction Made"); document.location="basket.php";</script>';
	            }
	        	
	        }
	    }
    }else{
    	echo '<script language="javascript">alert("Insufficient Wallet!"); document.location="basket.php";</script>';
    }
    
?>
							
