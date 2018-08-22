<?php 

//session_start();

if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header('location: index.php');  
}

$db = mysqli_connect('localhost','root','','initfun');

$errors = array();

$id = $_GET['id'];
if(isset($_POST['change_pass'])){
  $old_password = md5($_POST['old_password']);
  $new_password = md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);


  $query = "SELECT * from customers where id = '$id'";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);

  $password = $row['password'];

  if($old_password == $password){
    if($new_password == $confirm_password){
      $old_passworddb = md5($new_password);
      $updatequery = "UPDATE customers SET password = '$new_password' where id = '$id'";
      $results = mysqli_query($db, $updatequery);
      header('location: customerprofile.php?id='.$row['id'].'');
    }else{array_push($errors, "Two Passwords do not match");}
  }else{echo array_push($errors, "Incorrect Password");}
}

