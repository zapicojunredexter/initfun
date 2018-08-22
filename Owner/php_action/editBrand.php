<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$id = $_POST['id'];
	$first_name = $_POST['editFirst_name'];
	$middle_name = $_POST['editMiddle_name'];
	$last_name = $_POST['editLast_name'];
	$username = $_POST['editUsername'];
	$gender = $_POST['editGender'];
	$address = $_POST['editAddress'];
	$date_of_birth = $_POST['editDate_of_birth'];
	$phone_number = $_POST['editPhone_number'];
	$email    = $_POST['editEmail']; 

	$sql = "UPDATE users SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name' , username = '$username', gender = '$gender', address ='$address', date_of_birth = '$date_of_birth', phone_number = '$phone_number', email = '$email' WHERE id = '$id'";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}

	$connect->close();

	echo json_encode($valid);

} // /if $_POST
