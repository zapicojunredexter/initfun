<?php 

session_start();

if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header('location: index.php');  
}

$db = mysqli_connect('localhost','root','','initfun');

$id = $_GET['id'];
if(isset($_POST['update_prof'])){

  $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
  $middle_name = mysqli_real_escape_string($db, $_POST['middle_name']);
  $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $date_of_birth = mysqli_real_escape_string($db, $_POST['date_of_birth']);
  $city_address = mysqli_real_escape_string($db, $_POST['city_address']);
  $permanent_address = mysqli_real_escape_string($db, $_POST['permanent_address']);
  $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
  $email = mysqli_real_escape_string($db, $_POST['email']);


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
      $query = "UPDATE customers SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', gender='$gender', date_of_birth='$date_of_birth', city_address='$city_address', permanent_address='$permanent_address', phone_number='$phone_number', email='$email' WHERE id = '$id'";
      mysqli_query($db, $query);

      header('location: customerprofile.php?id='.$id.'');
    }
}

