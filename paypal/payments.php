<?php

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
session_start();
$enableSandbox = true;

$db = mysqli_connect('localhost','root','','initfun');

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
/*
$paypalConfig = [
	'email' => 'zapicojunredexter-facilitator@gmail.com',
	'return_url' => 'http://localhost/paypal-example/payment-successful.html',
	'cancel_url' => 'http://localhost/paypal-example/payment-cancelled.html',
	'notify_url' => 'http://localhost/paypal-example/payments.php'
];
*/

$paypalConfig = [
	'email' => 'zapicojunredexter-facilitator@gmail.com',
	'return_url' => 'http://localhost/InitFun/paypal/cart.payment/cart_success.php',
	'cancel_url' => 'http://localhost/InitFun/paypal/cart.payment/cart_cancelled.php',
	'notify_url' => 'http://localhost/InitFun/paypal-test/mytestdb.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

$counter = (int)$_POST['counter'];
$tax = (float)$_POST['tax'];

// Include Functions
require 'functions.php';

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {


	$userId = $_SESSION['id'];
	
	$userDetails = mysqli_query($db, "SELECT * from customers WHERE id = $userId");
	$customerDetails = mysqli_fetch_array($userDetails);
	print_r($customerDetails);
	if(!$customerDetails){
		echo "no logged in user records";
		return;
	}
	// Grab the post data so that we can set up the query string for PayPal.
	// Ideally we'd use a whitelist here to check nothing is being injected into
	// our post data.
	$data = [];
	foreach ($_POST as $key => $value) {
		if(is_string($value))
			$data[$key] = stripslashes($value);
	}

	// Set the PayPal account.
	$data['business'] = $paypalConfig['email'];
	$totalAmount = 0;
	for($i = 0 ; $i < $counter ; $i++){

		$amount = $_POST['amount_'.strval($i+1)];
		$quantity = $_POST['amount_'.strval($i+1)];
		echo $amount."**".$quantity."--";
		$data['item_name_'.strval($i+1)] = $_POST['item_name_'.strval($i+1)];
		$data['amount_'.strval($i+1)] = $_POST['amount_'.strval($i+1)];
		$data['quantity_'.strval($i+1)] = $_POST['quantity_'.strval($i+1)];

		$totalAmount += $data['amount_'.strval($i+1)];

	}

	// adding initial order record
	$orderDate = date('Y-m-d');
	$customerName = $customerDetails['first_name'].$customerDetails['last_name'];
	$customerPhoneNumber = $customerDetails['phone_number'];
	$ownerId = $_POST['ownerId'];
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
			'-',
			'-',
			'$totalAmount',
			'-',
			'$totalAmount',
			'-',
			'-',
			3,
			0,
			0,
			$ownerId
		)";

	mysqli_query($db, $query);
	$orderId = mysqli_insert_id($db); 

	// Set the PayPal return addresses.
	$data['return'] = stripslashes($paypalConfig['return_url']."?orderId=".$orderId);
	$data['cancel_return'] = stripslashes($paypalConfig['cancel_url']."?orderId=".$orderId);
	$data['notify_url'] = stripslashes($paypalConfig['notify_url']);


	$i = 1;
	foreach($_POST['item_names'] as $name){
		$data['item_name_'.$i] = $name;
		$data['amount_'.$i] = $_POST['amount'][$i];
		echo $data['item_name_'.$i]."costs".$_POST['amount'][$i];
		$i++;
	}

	$totalAmount = 0;
	for($i = 0 ; $i < $counter ; $i++){

		$amount = $_POST['amount_'.strval($i+1)];
		$quantity = $_POST['amount_'.strval($i+1)];
		$itemId = $_POST['item_id_'.strval($i+1)];
		
		echo $amount."**".$quantity."--";
		$data['item_name_'.strval($i+1)] = $_POST['item_name_'.strval($i+1)];
		$data['amount_'.strval($i+1)] = $_POST['amount_'.strval($i+1)];
		$data['quantity_'.strval($i+1)] = $_POST['quantity_'.strval($i+1)];

		$totalAmount += $data['amount_'.strval($i+1)];

		// adding detailed items to db
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
				$itemId,
				$quantity,
				$amount,
				$amount,
				1,
				'$orderDate'
			)";

		mysqli_query($db, $query);
	
	}

	$data['tax_cart'] = $tax * 0.13;
	$data['currency_code'] = 'PHP';

	// Add any custom fields for the query string.
	//$data['custom'] = USERID;

	// Build the query string from the data.
	$queryString = http_build_query($data);

	// Redirect to paypal IPN
	
	header('location:' . $paypalUrl . '?' . $queryString);
	exit();
}