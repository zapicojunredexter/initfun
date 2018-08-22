<?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    header('location: index.php');
  }
  require_once "includes/header.php";
  require_once "server.php";

?>
<style type="text/css">
  
  .login-block{
  background: #DE6262;
  /*background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);*/
  background: linear-gradient(to bottom, #ffd099, rgba(255, 93, 14, .8313725490196079));  
  width:100%;
  padding : 50px 0;
  height: 100vh;
  }
  .banner-sec{background-size:cover; height:84.9vh; border-radius: 0 10px 10px 0; padding:0;}
  .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1); height: 84.9vh;}
  .login-sec{padding: 50px 30px; position:relative;}
  .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
  .login-sec .copy-text i{color:#FEB58A;}
  .login-sec .copy-text a{color:#E36262;}
  .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: rgba(255, 93, 14, .8313725490196079);}
  .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px;margin-left:auto;margin-right:auto}
  .btn-login{background: #fff; color: rgba(255, 93, 14, .8313725490196079); font-weight:600; border: 1px solid rgba(255, 93, 14, .8313725490196079); transition: 0.5s all;}
  .btn-login:hover{color:#fff; background: rgba(255, 93, 14, .8313725490196079); transition: 0.5s all;} 
</style>




<section class="login-block">
  <div class="container">
    <div class="row">
        <div class="col-md-4 login-sec">
          <h2 class="text-center">Sign in as Customer</h2>
          <form method="post" class="login-form" action="login.php">
            <?php include('errors.php'); ?>
            <div class="form-group">
              <label for="exampleInputEmail1" class="text-uppercase">Email</label>
              <input type="text" class="form-control" placeholder="" name="email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="text-uppercase">Password</label>
              <input type="password" class="form-control" placeholder="" name="password">
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                <small>Remember Me</small>
              </label><br><br><br>
              <button type="submit" class="btn btn-login float-right" name="signin">Sign In</button>
              <button type="button" class="btn btn-login float-right"><a href="index.php?">Cancel</a></button>
            </div>
          </form>
        </div>

    <div class="col-md-8 banner-sec">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
   
    <div class="carousel-inner">
      <div class="item active">
        <section id="about" style="height:84.9vh; border-radius: 0 10px 10px 0;">
          <div class="about-container" style="border-radius: 0 10px 10px 0;">
            <div class="carousel-caption">
              <img src="img/welcome_logo.png" width="250" height="150"></img>
              <h1 style="margin-top: -1px;">Welcome to InitFun</h1>
              <h3>All your favorite local bakeshops all in one site. You can enjoy online shopping 
                  of your <br> favorite breads, cakes, pastries and even pasalubongs for your love ones ! <br>
                  Please do enjoy your stay here !</h3>
            </div>
          </div>
        </section>
      </div>
      
      <div class="item">
         <section id="about" style="background: url(img/baker-bg.jpg); height:84.9vh; border-radius: 0 10px 10px 0;">
            <div class="about-container" style="border-radius: 0 10px 10px 0;">
              <div class="carousel-caption">
         
              </div>
            </div>
          </section>
      </div>

    
       <div class="item">
         <section id="about" style="height:84.9vh; border-radius: 0 10px 10px 0;">
            <div class="about-container" style="border-radius: 0 10px 10px 0;">
              <div class="carousel-caption">
         
              </div>
            </div>
          </section>
      </div>
    </div>
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