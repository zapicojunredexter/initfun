<?php
session_start();
//http://localhost/InitFun/paypal/subscription/subscription_success.php?duration=12%20Months%20Subscription

    $duration = $_GET['duration'];
    $db = mysqli_connect('localhost','root','','initfun');
    $userId = $_SESSION['userId'];

    $currentExpiration = $_SESSION['account_expiration'];

    switch($duration){
		case '3 Months Subscription':
            $newExpiration = date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d"))));
            break;
        case '6 Months Subscription':
            $newExpiration = date('Y-m-d', strtotime("+6 months", strtotime(date("Y-m-d"))));
			break;
		case '12 Months Subscription':
            $newExpiration = date('Y-m-d', strtotime("+12 months", strtotime(date("Y-m-d"))));
			break;
		default:
            $newExpiration = $currentExpiration;
	}
    $_SESSION['account_expiration'] = $newExpiration;
    $query = "UPDATE users SET account_expiration='$newExpiration' where id='$userId'"; 
    mysqli_query($db, $query);
    echo "success";
?>