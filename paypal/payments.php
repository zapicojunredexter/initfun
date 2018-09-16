<?php

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
session_start();
$enableSandbox = true;

$db = mysqli_connect('localhost','root','','initfun');
// Database settings. Change these for your database configuration.
$dbConfig = [
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'name' => 'example_database'
];
// PayPal settings. Change these to your account details and the relevant URLs
// for your site.

$paypalConfig = [
	'email' => 'zapicojunredexter-facilitator@gmail.com',
	'return_url' => 'http://localhost/InitFun/paypal/cart.payment/cart_success.php',
	'cancel_url' => 'http://localhost/InitFun/paypal/cart.payment/cart_cancelled.php',
	'notify_url' => 'http://localhost/InitFun/paypal-test/mytestdb.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
$subTotal = (float)$_POST['tax'];
$taxRate = 0.13;
$taxAmt = $subTotal * $taxRate;
$grandTotal = $subTotal + $taxAmt;

// Include Functions
require 'functions.php';

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {


	$userId = $_SESSION['id'];
	
	$userDetails = mysqli_query($db, "SELECT * from customers WHERE id = $userId");
	$customerDetails = mysqli_fetch_array($userDetails);
	//print_r($customerDetails);
	if(!$customerDetails){
		echo "no logged in user records";
		return;
	}
	// Grab the post data so that we can set up the query string for PayPal.
	// Ideally we'd use a whitelist here to check nothing is being injected into
	// our post data.
	$data = [];
    $jsonData = $_POST['toDb'];
    $dates = json_decode($jsonData, true);
    
	foreach ($_POST as $key => $value) {
		if(is_string($value))
			$data[$key] = stripslashes($value);
	}
    
    $ndx = 1;
    for($i = 1 ; isset($_POST['item_'.strval($i)]) ; $i++){
        if($_POST['asd_'.strval($i)] != '0'){
            $lopsaz = strval($ndx);
            $data['item_name_'.$lopsaz] = $_POST['item_'.strval($i)];
            $data['amount_'.$lopsaz] = $_POST['price_'.strval($i)];
            $data['quantity_'.$lopsaz] = $_POST['asd_'.strval($i)];
            $data['item_number_'.$lopsaz] = $_POST['id_'.strval($i)];
            echo $data['item_name_'.$lopsaz].' '.$data['amount_'.$lopsaz].' '.$data['quantity_'.$lopsaz];
            $ndx++;
        }
    }
    
	$data['tax_cart'] = $taxAmt;
	$data['currency_code'] = 'PHP';
    
	// Set the PayPal account.
	$data['business'] = $paypalConfig['email'];

	// adding initial order record
	$orderDate = date('Y-m-d');
	$customerName = $customerDetails['first_name'].$customerDetails['last_name'];
	$customerPhoneNumber = $customerDetails['phone_number'];
	//$ownerId = $_POST['ownerId'];    
    
    
	$query = "INSERT INTO orders (
		order_date,
		client_name,
		client_contact,
		sub_total,
		vat,
		total_amount,
		discount,
		grand_total,
		paid,
		due,
		payment_type,
		payment_status,
		order_status,
		owner_id) VALUES (
			'$orderDate',
			'$customerName',
			'$customerPhoneNumber',
			'$subTotal',
			'$taxAmt',
			'$grandTotal',
			'-',
			'$grandTotal',
			'-',
			'-',
			3,
			0,
			0,
			10
		)";

	mysqli_query($db, $query);
	$orderId = mysqli_insert_id($db); 
    
	// Set the PayPal return addresses.
	$data['return'] = stripslashes($paypalConfig['return_url']."?orderId=".$orderId);
	$data['cancel_return'] = stripslashes($paypalConfig['cancel_url']."?orderId=".$orderId);
	$data['notify_url'] = stripslashes($paypalConfig['notify_url']);
	
	echo stripslashes($paypalConfig['notify_url']);
    
    foreach($dates as $blabla){
        $query = "INSERT INTO order_item (
            order_id,
            product_id,
            quantity,
            rate,
            total,
            order_item_status,
            scheduled_delivery) VALUES (
                $orderId,
                '".$blabla['itemId']."',
                '".$blabla['qty']."',
                1,
                1,
                1,
                '".$blabla['date']."'
            )";

        mysqli_query($db, $query);
    }
    
	// Add any custom fields for the query string.

	// Build the query string from the data.
	$queryString = http_build_query($data);
    
	// Redirect to paypal IPN
	header('location:' . $paypalUrl . '?' . $queryString);
	exit();
}