<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$date_of_birth = $_POST['date_of_birth'];
	$phone_number = $_POST['phone_number'];
	$email    = $_POST['email']; 

	$sql = "INSERT INTO users (is_admin, first_name, middle_name, last_name, username, gender, address, date_of_birth, phone_number, email, password) VALUES (0, '$first_name','$middle_name','$last_name','$username','$gender','$address','$date_of_birth', '$phone_number', '$email', '$password')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST