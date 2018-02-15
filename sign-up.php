<?php
  require_once "includes/header.php";
  require_once "server.php"
?>

<style type="text/css">
  
  .sign-up-block{
  background: #DE6262;
  background: linear-gradient(to bottom, #ffd099, rgba(255, 93, 14, .8313725490196079));  
  width:100%;
  padding : 50px 90px;
  height: 100vh;
  }
  .banner-sec{background-size:cover; height:84.9vh; border-radius: 0 10px 10px 0; padding:0;}
  .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1); height: 84.9vh;}
  h2{margin:30px 0px; font-weight:800; font-size:30px; color: rgba(255, 93, 14, .8313725490196079);}
  .btn-signup{background: #fff; border:1px solid rgba(255, 93, 14, .8313725490196079); color: rgba(255, 93, 14, .8313725490196079); width: 120px; transition: 0.5s all;}
  .btn-signup:hover{background: rgba(255, 93, 14, .8313725490196079); border:1px solid rgba(255, 93, 14, .8313725490196079); color: #fff; transition: 0.5s all;}
</style>

<section class="sign-up-block">
  <div class="col-md-12 container">
    <div class="row">
      <div class="col-md-12 sign-up-sec" style="">
        <h2 class="text-center"> <img src="img/welcome_logo.png" width="130" height="100" style="background:cover;"></img> Sign up as Customer</h2>
        <form method="post" class="sign-up-form" action="sign-up.php">
          <?php include('errors.php');?>
          <div class="col-md-4 form-group">
              <label for="" class="text-uppercase">Last Name</label>
              <input type="text" class="form-control" placeholder="Doe" name="last_name" value="<?php echo $last_name; ?>">
          </div>
          <div class="col-md-4 form-group">
              <label for="" class="text-uppercase">First Name</label>
              <input type="text" class="form-control" placeholder="John" name="first_name" value="<?php echo $first_name; ?>">
          </div>
          <div class="col-md-4 form-group">
              <label for="" class="text-uppercase">Middle Name</label>
              <input type="text" class="form-control" placeholder="Else" name="middle_name" value="<?php echo $middle_name; ?>">
          </div>

          <div class="col-md-2">
            <label class="text-uppercase">Gender</label><br>
                  <label class="radio-inline"><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male")?>>Male</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female")?>>Female</label>
          </div>
          <div class="col-md-2 form-group">
              <label for="" class="text-uppercase">Phone Number</label>
              <input type="text" class="form-control" placeholder="09** *** ****" name="phone_number" value="<?php echo $phone_number; ?>">
          </div>
          <div class="col-md-2 form-group"> 
                  <label>Date of Birth</label>
                  <input type="date" class="form-control" placeholder="Date of Birth" name="date_of_birth">
          </div>

          <div class="col-md-4 form-group">
                  <label for="" class="text-uppercase">Email</label>
                  <input type="email" class="form-control" placeholder="example@email.com" name="email" value="<?php echo $email; ?>">
          </div>
          <div class="col-md-6 form-group">
                  <label for="" class="text-uppercase">City Address</label>
                  <input type="text" class="form-control" placeholder="House/Building/Street Number | Street Name | Barangay | City" name="city_address" value="<?php echo $city_address; ?>">
          </div>
          <div class="col-md-6 form-group">
                  <label for="" class="text-uppercase">Permanent Address</label>
                  <input type="text" class="form-control" placeholder="House/Building/Street Number | Street Name | Barangay | City" name="permanent_address" value="<?php echo $permanent_address; ?>">
          </div>
          <div class="col-md-6 form-group">
                  <label for="" class="text-uppercase">Password</label>
                  <input type="password" class="form-control" placeholder="***********" name="password_1">
          </div>
          <div class="col-md-6 form-group">
                  <label for="" class="text-uppercase">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="***********" name="password_2">
          </div>

          <div class="col-md-6 form-group">
            <br><br>
            <div class="col-md-3">
                <button type="submit" class="btn btn-signup" name="signup">Sign up</button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-signup">Cancel</button>
            </div>
          </div>
        </form>
      </div>  
    </div>
  </div>
</section>




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