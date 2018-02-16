<?php 
require_once 'includes/header.php'; 
require_once 'owner/php_action/db_connect.php'	
?>

<?php 
$db = mysqli_connect('localhost', 'root', '', 'initfun');

$id = $_GET['id'];

$results = mysqli_query($db, "SELECT * FROM customers WHERE id = $id");
while($row = mysqli_fetch_array($results)){
  $first_name = $row['first_name'];
  $middle_name = $row['middle_name'];
  $last_name = $row['last_name'];
  $gender = $row['gender'];
  $phone_number = $row['phone_number'];
  $date_of_birth = $row['date_of_birth'];
  $email = $row['email'];
  $city_address = $row['city_address'];
  $permanent_address = $row['permanent_address'];
}
?>

<style type="text/css">
  .sign-up-block{background: linear-gradient(to bottom, #ffd099, rgba(255, 93, 14, .8313725490196079));width:100%;padding: 50px 90px; height: 850px ;}
  .containerl-fluid{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1); height: auto; padding-bottom:20px;margin-bottom: 40px;}
  h2{margin:30px 0px; font-weight:800; font-size:30px; color: rgba(255, 93, 14, .8313725490196079);}
  .btn-signup{background: #fff; border:1px solid rgba(255, 93, 14, .8313725490196079); color: rgba(255, 93, 14, .8313725490196079); width: 120px; transition: 0.5s all;}
  .btn-signup:hover{background: rgba(255, 93, 14, .8313725490196079); border:1px solid rgba(255, 93, 14, .8313725490196079); color: #fff; transition: 0.5s all;}
</style>

<div class="sign-up-block">
  <div class="col-md-12 containerl-fluid">
    <div class="row">
      <div class="col-md-12 sign-up-sec" style="">
        <h2 class="text-center"> <img src="img/welcome_logo.png" width="130" height="100" style="background:cover;"></img>Update your Profile</h2>
        <form action= "editProfile.php" method="post" class="sign-up-form" action="sign-up.php">
          <div class="col-md-4 form-group">
              <label for="" class="text-uppercase">Last Name</label>
              <input type="text" class="form-control" placeholder="" name="last_name" value="<?php echo $last_name ; ?>">
          </div>
          <div class="col-md-4 form-group">
              <label for="" class="text-uppercase">First Name</label>
              <input type="text" class="form-control" placeholder="John" name="first_name" value="<?php echo $first_name ; ?>">
          </div>
          <div class="col-md-4 form-group">
              <label for="" class="text-uppercase">Middle Name</label>
              <input type="text" class="form-control" placeholder="Else" name="middle_name" value="<?php echo $middle_name; ?>">
          </div>

          <div class="col-md-2">
            <label class="text-uppercase">Gender</label><br>
                  <label class="radio-inline"><input type="radio" name="gender" value="Male" <?php if($gender == "Male") echo 'checked="checked"';?>>Male</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="Female" <?php if($gender == "Female") echo 'checked="checked"';?>>Female</label>
          </div>
          <div class="col-md-2 form-group">
              <label for="" class="text-uppercase">Phone Number</label>
              <input type="text" class="form-control" placeholder="09** *** ****" name="phone_number" value="<?php echo $phone_number; ?>">
          </div>
          <div class="col-md-2 form-group"> 
                  <label>Date of Birth</label>
                  <input type="date" class="form-control" placeholder="" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
          </div>

          <div class="col-md-4 form-group">
                  <label for="" class="text-uppercase">Email</label>
                  <input type="email" class="form-control" placeholder="" name="email" value="<?php echo $email; ?>">
          </div>
          <div class="col-md-6 form-group">
                  <label for="" class="text-uppercase">City Address</label>
                  <input type="text" class="form-control" placeholder="" name="city_address" value="<?php echo $city_address; ?>">
          </div>
          <div class="col-md-6 form-group">
                  <label for="" class="text-uppercase">Permanent Address</label>
                  <input type="text" class="form-control" placeholder="" name="permanent_address" value="<?php echo $permanent_address; ?>">
          </div>

          <div class="col-md-12 form-group" style="margin-top:5px;">
            <br>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success" name="update_prof">Update Profile</button>
            </div>
          </div>
        </form>
      </div>  
    </div>
  </div>
      <!-- changepass -->
        <div class="col-md-12 containerl-fluid" style="padding-top: 40px">
            <form method="post" action="changePass.php?id=$id">
                <div class="col-md-6 form-group">
                        <label for="" class="text-uppercase">Current Password</label>
                        <input type="password" class="form-control" placeholder="***********" name="password">
                </div>
                <div class="col-md-6 form-group">
                        <label for="" class="text-uppercase">New Password</label>
                        <input type="password" class="form-control" placeholder="***********" name="npassword">
                </div>
                <div class="col-md-6 form-group">
                        <label for="" class="text-uppercase">Confirm New Password</label>
                        <input type="password" class="form-control" placeholder="***********" name="cnpassword">
                </div>

                <div class="col-md-6 form-group" style="margin-top:5px;">
                  <br>
                  <div class="col-md-3">
                      <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>" /> 
                      <button type="submit" class="btn btn-success" name="change_pass">Change Password</button>
                  </div>
                </div>
            </form>
          </div>
</div>
