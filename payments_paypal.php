<?php

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// Database settings. Change these for your database configuration.

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
	'return_url' => 'http://localhost/InitFun/paypal-test/payment-successful.html',
	'cancel_url' => 'http://localhost/InitFun/paypal-test/payment-cancelled.html',
	'notify_url' => 'http://localhost/InitFun/paypal-test/mytestdb.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
//$itemName = 'Test Item';
//$itemAmount = 5.00;

// Include Functions
require 'functions_paypal.php';

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {

	// Grab the post data so that we can set up the query string for PayPal.
	// Ideally we'd use a whitelist here to check nothing is being injected into
	// our post data.
	$data = [];
	foreach ($_POST as $key => $value) {
		$data[$key] = stripslashes($value);
	}

	// Set the PayPal account.
	$data['business'] = $paypalConfig['email'];

	// Set the PayPal return addresses.
	$data['return'] = stripslashes($paypalConfig['return_url']);
	$data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
	$data['notify_url'] = stripslashes($paypalConfig['notify_url']);
	
	echo stripslashes($paypalConfig['notify_url']);

	// Set the details about the product being purchased, including the amount
	// and currency so that these aren't overridden by the form data.
	//$data['item_name'] = $itemName[0];	
	//$data['amount'] = $itemAmount[0];
	$data['item_name'] = $_POST['item_name'];
	$data['amount'] = 5.00;
	$data['quantity'] = 10;
	$data['currency_code'] = 'PHP';

	echo $data['item_name'];
	echo $data['amount'];
	echo $data['quantity'];

	// Add any custom fields for the query string.
	//$data['custom'] = USERID;

	// Build the query string from the data.
	$queryString = http_build_query($data);

	// Redirect to paypal IPN
	//print_r($queryString);
	header('location:' . $paypalUrl . '?' . $queryString);
	//exit();
} else {
	// Handle the PayPal response.

	
    $fp = fopen('zzzzz.txt', 'w');
    fwrite($fp, '1');
    fwrite($fp, '23');
	fclose($fp);
	

	//Create a connection to the database.
	$db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

	//Assign posted variables to local data array.
	$data = [
		'item_name' => $_POST['item_name'],
		'item_number' => $_POST['item_number'],
		'payment_status' => $_POST['payment_status'],
		'payment_amount' => $_POST['mc_gross'],
		'payment_currency' => $_POST['mc_currency'],
		'txn_id' => $_POST['txn_id'],
		'receiver_email' => $_POST['receiver_email'],
		'payer_email' => $_POST['payer_email'],
		'custom' => $_POST['custom'],
	];
	// We need to verify the transaction comes from PayPal and check we've not
	// already processed the transaction before adding the payment to our
	// database.
	return;
	if (verifyTransaction($_POST) && checkTxnid($data['txn_id'])) {
		if (addPayment($data) !== false) {
			// successfully added.
		}
	}
}
