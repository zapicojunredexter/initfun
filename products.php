<?php
//session_start();
require_once 'includes/header.php';
require_once 'Owner/php_action/db_connect.php'; 
require_once 'functions.php';
  $db= mysqli_connect('localhost','root','','initfun');
 
  if(isset($_GET['add'])){
      $id = $_GET['add'];
      $result = mysqli_query($db, "SELECT * from product WHERE id = $id");
      $row = mysqli_fetch_array($result);
      if ($row['quantity'] != $_SESSION['cart_'.$_GET['add']] &&$row['quantity'] > 0) {
        $_SESSION['cart_'.$_GET['add']]+='1';
        echo $row['quantity'];
            header("Location: products.php");
      }else{
        echo '<script language="javascript">alert("Stock products are not sufficient!"); document.location="products.php";</script>';
      }
  }
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

<!-- header -->
<header id="header" style="background: rgba(255, 93, 14, .8313725490196079);">
    <div class="container">
      <nav id="nav-menu-container">
        <ul class="nav-menu">
           <?php 
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
          
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
                <li><a href='index.php?id=" .$id ."'>Home</a></li>
                <li class='menu-active'><a href='products.php?id=" .$id ."'>Products</a></li>
                <li style='font-size: 20px; color: #fff;'>|</li>
                <li><a href='basket.php'><i class='fa fa-shopping-cart fa-2x'> ($i)</i></a></li>
                <li><a href='customerprofile.php?id=" .$id ."'>My Account( $wallet)</a></li>
                <li><a href='logout.php'>Log Out</a></li>";
          } else {  
                echo"
                <li><a href='index.php'>Home</a></li>
                <li class='menu-active'><a href='products.php'>Products</a></li>
                <li style='font-size: 20px; color: #fff;'>|</li>
                <li><a href='#' data-toggle='modal' data-target='#myModal_signin'>Sign in</a></li>
                <li><a href='#' data-toggle='modal' data-target='#myModal_signup'>Sign up</a></li>";
           } ?> 
         </ul>
      </nav><!-- #nav-menu-container -->
    </div>
</header><!-- modal sign in -->
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
          <button class="btn btn-sign-in"><a href="#">Signin as Owner</a></button>
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
          <button class="btn btn-sign-in"><a href="#">Signup as Owner</a></button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<br><br><br><br><br><br>
<!-- Products -->
<section id="product">
      <div class="container" style="margin-bottom: 40px;">
          <div class="category_content">
            <ul id="product-filter">
            <li><button class="btn"><a href='products.php'>All Products</a></button></li>

              <?php           
                getcategory();
              ?>

            </ul>
          </div>
          <div class="container" style="border: 1px solid; border-radius: 5px; width: 1000px; background: #FFC7002A;">
              <?php
              if(isset($_GET['cat'])){
                getcategoryproduct();
              }else{
                getallproducts();
              }
              ?>
          </div> 
      </div>
</section>

<?php
require_once 'includes/footer.php';
?>