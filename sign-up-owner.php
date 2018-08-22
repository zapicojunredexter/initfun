<?php
  require_once "includes/header.php";
  require_once "server_owner.php"
?>

<style type="text/css">
  
  .sign-up-block{
  background: #DE6262;
  background: linear-gradient(to bottom, #ffd099, rgba(255, 93, 14, .8313725490196079));  
  width:100%;
  padding : 50px 90px;
  height: 1200px;
  }
  .banner-sec{background-size:cover; height:84.9vh; border-radius: 0 10px 10px 0; padding:0;}
  .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1); height: 1100px; width: 50%;}
  h2{margin:30px 0px; font-weight:800; font-size:30px; color: rgba(255, 93, 14, .8313725490196079);}
  .btn-signup{background: #fff; border:1px solid rgba(255, 93, 14, .8313725490196079); color: rgba(255, 93, 14, .8313725490196079); width: 120px; transition: 0.5s all;}
  .btn-signup:hover{background: rgba(255, 93, 14, .8313725490196079); border:1px solid rgba(255, 93, 14, .8313725490196079); color: #fff; transition: 0.5s all;}

  .form-control{
    width: 400px;
    margin-left: 90px;
  }
  .text-uppercase{
    margin-left: 90px;
  }

  .radio-inline{
    margin-left: 90px;
  }
  
</style>

<div class="sign-up-block">
  <div class="container">
      <div class="sign-up-sec">
        <h2 class="text-center"> <img src="img/welcome_logo.png" width="130" height="100" style="background:cover;"></img> Sign up as Owner</h2>

        <form method="post" class="sign-up-form" action="sign-up-owner.php">
          <?php include('errors.php');?>
          <div class="form-group">
              <label for="" class="text-uppercase">Last Name</label>
              <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $last_name; ?>">
          </div>
          <div class="form-group">
              <label for="" class="text-uppercase">First Name</label>
              <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $first_name; ?>">
          </div>
          <div class="form-group">
              <label for="" class="text-uppercase">Middle Name</label>
              <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="<?php echo $middle_name; ?>">
          </div>
          <div class="form-group">
              <label for="" class="text-uppercase">Please Select Desired Username</label>
              <input type="text" class="form-control" placeholder="Name of Store" name="username" value="<?php echo $username; ?>">
          </div>

          <div>
            <label class="text-uppercase">Gender</label><br>
                  <label class="radio-inline"><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male")?>>Male</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female")?>>Female</label>
          </div>
          <div class="form-group">
              <label for="" class="text-uppercase">Phone Number</label>
              <input type="text" class="form-control" placeholder="09** *** ****" name="phone_number" value="<?php echo $phone_number; ?>">
          </div>
          <div class="form-group"> 
                  <label class="text-uppercase">Date of Birth</label>
                  <input type="date" class="form-control" placeholder="Date of Birth" name="date_of_birth">
          </div>
          <div class="form-group">
                  <label for="" class="text-uppercase">Email</label>
                  <input type="email" class="form-control" placeholder="example@email.com" name="email" value="<?php echo $email; ?>">
          </div>
          <div class="form-group">
                  <label for="" class="text-uppercase">Address of Establishment</label>
                  <input type="text" class="form-control" placeholder="House/Building/Street Number | Street Name | Barangay | City" name="address" value="<?php echo $address; ?>">
          </div>
          <div class="form-group">
                  <label for="" class="text-uppercase">Password</label>
                  <input type="password" class="form-control" placeholder="***********" name="password_1">
          </div>
          <div class="form-group">
                  <label for="" class="text-uppercase">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="***********" name="password_2" >
          </div>

          <div class="form-group">
            <br><br>
            <div>
                <button type="submit" class="btn btn-signup" style ="margin-left: 130px;" name="signupowner">Sign up</button>
                <button type="button" class="btn btn-signup" style ="margin-left: 50px;"><a href="index.php">Cancel</a></button>
            </div>
          </div>
        </form>  
    </div>
  </div>
</div>




<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/jquery/jquery-migrate.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/easing/easing.min.js"></script>
<script src="assets/wow/wow.min.js"></script>
<script src="assets/waypoints/waypoints.min.js"></script>
<script src="assets/counterup/counterup.min.js"></script>
<script src="assets/superfish/hoverIntent.js"></script>
<script src="assets/superfish/superfish.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="contactform/contactform.js"></script>
<script src="js/main.js"></script>