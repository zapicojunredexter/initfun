<?php 
	session_start();

	// variable declaration
	$first_name = "";
	$middle_name = "";
	$last_name = "";
	$gender = "";
	$city_address = "";
	$permanent_address= "";
	$date_of_birth ="";
	$phone_number = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'initfun');

	// REGISTER USER
	if (isset($_POST['signup'])) {
		// receive all input values from the form
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$middle_name = mysqli_real_escape_string($db, $_POST['middle_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$date_of_birth = mysqli_real_escape_string($db, $_POST['date_of_birth']);
		$city_address = mysqli_real_escape_string($db, $_POST['city_address']);
		$permanent_address = mysqli_real_escape_string($db, $_POST['permanent_address']);
		$phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($first_name)) { array_push($errors, "Please enter your First name"); }
		if (empty($middle_name)) { array_push($errors, "Please enter your Middle name"); }
		if (empty($last_name)) { array_push($errors, "Please enter your Last name"); }
		if (empty($gender)) { array_push($errors, "Please specify your Gender"); }
		if (empty($date_of_birth)) { array_push($errors, "Please enter your Date of Birth"); }
		if (empty($city_address)) { array_push($errors, "Please enter your City Address"); }
		if (empty($permanent_address)) { array_push($errors, "Please enter your Permanent Address"); }
		if (empty($phone_number)) { array_push($errors, "Please enter your Phone number"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		$customer_check_query = "SELECT * FROM customers WHERE email='$email' OR phone_number='$phone_number' LIMIT 1";
		$result = mysqli_query($db, $customer_check_query);
		$customer = mysqli_fetch_assoc($result);
		  
		  if ($customer) { // if user exists
		    if ($customer['email'] === $email) {
		      array_push($errors, "Email already exists");
		    }

		    if ($customer['phone_number'] === $phone_number) {
		      array_push($errors, "Phone number already exists");
		    }
		  }

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);
			$query = "INSERT INTO customers (first_name, middle_name, last_name, gender, date_of_birth, city_address, permanent_address, phone_number, email, password) 
					  VALUES('$first_name', '$middle_name', '$last_name', '$gender', '$date_of_birth', '$city_address', '$permanent_address', '$phone_number', '$email', '$password')";
			mysqli_query($db, $query);

			header('location: index.php');
		}

	}

	// LOGIN USER
	if (isset($_POST['signin'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);
			$count = mysqli_num_rows($results);
			$row = mysqli_fetch_assoc($results);

			if ($count ==1 && $row['password'] == $password) {
				$_SESSION['email'] = $row['email'];
				$_SESSION['loggedin'] = true; 
				header('location: index.php?id='.$row['id'].'');

			}else {
				array_push($errors, "Wrong email/password combination");
			}
		}
	}

?>