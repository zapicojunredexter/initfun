<?php

// Database settings. Change these for your database configuration.
$dbConfig = [
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'name' => 'example_database'
];
require 'functions.php';

    echo "success";

    $fp = fopen('data.txt', 'w');
    fwrite($fp, '1');
    fwrite($fp, '23');
    fclose($fp);
    
    $data = [
		'item_name' => 'testma,e',
		'item_number' => 'testma,e',
		'payment_status' => 'testma,e',
		'payment_amount' => 120.5,
		'payment_currency' => 'testma,e',
		'txn_id' => 'testma,e',
		'receiver_email' => 'testma,e',
		'payer_email' => 'testma,e',
		'custom' => 'testma,e',
	];

    /*
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
    */

    print_r($_POST);
    print_r($data);
    echo "middle";
    print_r($_REQUEST);


    $db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

    // Assign posted variables to local data array.
    /*
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
*/
	// We need to verify the transaction comes from PayPal and check we've not
	// already processed the transaction before adding the payment to our
	// database.
	// if (verifyTransaction($_POST) && checkTxnid($data['txn_id'])) {
		if (addPayment($data) !== false) {
            // Payment successfully added.
            echo "ok na man";
		}
    //}

    echo "end";
?>