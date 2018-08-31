<?php 	

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "initfun";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  //echo date("Y-m-d")."<br>";
  //echo date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d"))))."<br>";
  //echo date("Y-m-d") > date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d"))))."<br>";
  //echo $_SESSION['account_expiration'];
  //echo "Successfully connected";
}

