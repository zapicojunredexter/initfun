 <?php
	session_start();
	$errors= array();

	$db = mysqli_connect('localhost','root','','initfun');
		if(isset($_POST['change_pass'])){
			$id = $_GET['id'];	

      $password = mysqli_real_escape_string($db, $_POST['password']);
      $newPassword = mysqli_real_escape_string($db, $_POST['npassword']);
      $confirmNewPassword = mysqli_real_escape_string($db, $_POST['cnpassword']);


    			$query = "SELECT password from customers where id= $id";
    			$result = mysqli_query($db, $query);
          $row = mysqli_fetch_assoc($result);
    			if($row['password'] != $password){
            echo "<script>alert('Two passwords did not match! '); window.location='customerprofile.php?id=".$row['id']."'</script>";
              }else if($newPassword != $confirmNewPassword){
                echo "<script>alert('Update Sucessfully'); window.location='index.php?id=".$row['id']."'</script>";
      				  }else{
                  $updatequery = "UPDATE customers SET password = '$newPassword' where id = $id";
                  $updateresult = mysqli_query($db, $updatequery);
          		  }
      }
?>

