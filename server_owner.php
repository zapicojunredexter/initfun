<?php 
	// variable declaration
	$first_name = "";
	$middle_name = "";
	$last_name = "";
	$username = "";
	$gender = "";
	$address="";
	$date_of_birth = "";
	$phone_number = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'initfun');

	// REGISTER USER
	if (isset($_POST['signupowner'])) {
		// receive all input values from the form
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$middle_name = mysqli_real_escape_string($db, $_POST['middle_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$date_of_birth = mysqli_real_escape_string($db, $_POST['date_of_birth']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($first_name)) { array_push($errors, "Please enter your First name"); }
		if (empty($middle_name)) { array_push($errors, "Please enter your Middle name"); }
		if (empty($last_name)) { array_push($errors, "Please enter your Last name"); }
		if (empty($username)) { array_push($errors, "Please enter your Username"); }
		if (empty($gender)) { array_push($errors, "Please specify your Gender"); }
		if (empty($date_of_birth)) { array_push($errors, "Please enter your Date of Birth"); }
		if (empty($address)) { array_push($errors, "Please enter your Address"); }
		if (empty($phone_number)) { array_push($errors, "Please enter your Phone number"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		$user_check_query = "SELECT * FROM users WHERE email='$email' OR phone_number='$phone_number' OR username = '$username' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		  
		  if ($user) { // if user exists
		    if ($user['email'] === $email) {
		      array_push($errors, "Email already exists");
		    }
		    if ($user['phone_number'] === $phone_number) {
		      array_push($errors, "Phone number already exists");
		    }
		    if ($user['username'] === $username) {
		      array_push($errors, "Username already exists");
		    }
		  }

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);
			$query = "INSERT INTO users (is_admin, first_name, middle_name, last_name, username ,gender, date_of_birth, address, phone_number, email, password) 
					  VALUES(0, '$first_name', '$middle_name', '$last_name', '$username', '$gender', '$date_of_birth', '$address', '$phone_number', '$email', '$password')";
			mysqli_query($db, $query);

			header('location: index.php');
		}

	}

?>