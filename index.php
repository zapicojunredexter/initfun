<?php 
require_once 'includes/header.php';
 $i=-2;
  //if (!empty($_SESSION["cart_"]) && is_array($_SESSION["cart_"])) {
    foreach($_SESSION as $name => $value){
      if($value > 0)
      {
        $i++;
      }
    }
 // }
?>

<!-- Header -->
<header id="header">
    <div class="container">
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <?php 
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
              $db= mysqli_connect('localhost','root','','initfun');
              $id = $_SESSION['id'];
              $result = mysqli_query($db, "SELECT * from customers WHERE id = $id");
                while($row = mysqli_fetch_array($result)){
                    $first_name = $row['first_name'];
                    $middle_name = $row['middle_name'];
                    $last_name = $row['last_name'];
                    $gender = $row['gender'];
                    $phone_number = $row['phone_number'];
                    $date_of_birth = $row['date_of_birth'];
                    $email = $row['email'];
                    $city_address = $row['city_address'];
                    $permanent_address = $row['permanent_address'];
                    $wallet = $row['wallet'];
                }
                echo"
                <li class='menu-active'><a href='index.php?id=" .$id ."'>Home</a></li>
                <li><a href='products.php?id=" .$id ."'>Products</a></li>
                <li><a href='customer_order_history.php'>Order History</a></li>
                <li style='font-size: 20px; color: #fff;'>|</li>
                <li><a href='basket.php'><i class='fa fa-shopping-cart fa-2x'> ($i)</i></a></li>
                <li><a href='customerprofile.php?id=" .$id ."'>My Account($wallet)</a></li>
                <li><a href='logout.php'>Log Out</a></li>";
          } else {  
                echo"
                <li class='menu-active'><a href='index.php'>Home</a></li>
                <li><a href='products.php'>Products</a></li>
                <li style='font-size: 20px; color: #fff;'>|</li>
                <li><a href='#' data-toggle='modal' data-target='#myModal_signin'>Sign in</a></li>
                <li><a href='#' data-toggle='modal' data-target='#myModal_signup'>Sign up</a></li>";
           } ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
</header>

<main id="main">
<!-- About -->
<div class="containerl-fluid">
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
        <section id="about">
          <div class="about-container">
            <div class="carousel-caption">
              <img src="img/welcome_logo.png" width="300" height="200"></img>
              <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
              $db = mysqli_connect('localhost','root','','initfun');

              $result = mysqli_query($db, "SELECT * from customers WHERE id = $id");
                while($row = mysqli_fetch_array($result)){
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
              echo "<h1 style='margin-top: -1px;'>Welcome to InitFun, ". $first_name ."</h1>
              <h2>All your favorite local bakeshops all in one site. You can enjoy online shopping 
                  of your <br> favorite breads, cakes, pastries and even pasalubongs for your love ones ! <br>
                  Please do enjoy your stay here !</h2>";
                }else{
              echo "<h1 style='margin-top: -1px;'>Welcome to InitFun</h1>
                  <h2>All your favorite local bakeshops all in one site. You can enjoy online shopping 
                  of your <br> favorite breads, cakes, pastries and even pasalubongs for your love ones ! <br>
                  Please do enjoy your stay here !</h2>";
                }
              ?>
              <?php 
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ 
                echo " "; }
                  else { ?>  
                    <a href="#" class="btn-get-started" data-toggle="modal" data-target="#myModal_signin">Sign in</a>
                    <a href="#" class="btn-get-started" data-toggle="modal" data-target="#myModal_signup">Sign up</a>
                  <?php } ?>
              <br>
              <a href="#services" class="next-sect"><i class="fa fa-chevron-down fa-3x"></i></a>
            </div>
          </div>
        </section>
      </div>
      
      <div class="item">
         <section id="about">
            <div class="about-container">
              <div class="carousel-caption">
         
              </div>
            </div>
          </section>
      </div>

    
       <div class="item">
         <section id="about">
            <div class="about-container">
              <div class="carousel-caption">
         
              </div>
            </div>
          </section>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Products -->
<div class="containerl-fluid">
  <section id="product">
    <div class="product-container">
      
    </div>
  </section>
</div>

<!-- modal sign in -->
<div class="modal fade" id="myModal_signin" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModal_signin">Sign in</h4>
      </div>
      <div class="modal-body" style="padding: 15px 0px;">
        <div class="sign-in">
          <button class="btn btn-sign-in"><a href="login.php">Signin as Buyer</a></button> or
          <button class="btn btn-sign-in"><a href="Owner/index.php">Signin as Owner</a></button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- modal sign up -->
<div class="modal fade" id="myModal_signup" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModal_signin">Sign Up</h4>
      </div>
      <div class="modal-body" style="padding: 15px 0px;">
        <div class="sign-in">
          <button class="btn btn-sign-in"><a href="sign-up.php">Signup as Buyer</a></button> or
          <button class="btn btn-sign-in"><a href="sign-up-owner.php">Signup as Owner</a></button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</main>

<?php
  require_once 'includes/footer.php';
?>
