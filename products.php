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
      
      $_SESSION['cart_'.$_GET['add']]='1';
      echo $row['quantity'];
      /*
      if ($row['quantity'] != $_SESSION['cart_'.$_GET['add']] &&$row['quantity'] > 0) {
        $_SESSION['cart_'.$_GET['add']]='1';
        echo $row['quantity'];
            // header("Location: products.php");
      }else{
        echo '<script language="javascript">alert("Stock products are not sufficient!"); document.location="products.php";</script>';
      }
      */
  }
  $i=0;
    foreach($_SESSION as $name => $value){
      $shouldUnset = false;
      if(isset($_GET['unsetCart'])){
        $shouldUnset = true;
      }
      echo "tuara".$shouldUnset;
      if(substr($name, 0, 5) == 'cart_')
      {
        if($shouldUnset){
          unset($_SESSION[$name]);
        }else{
          $i++;
        }
      }
    }
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
          <!--
            <li><button class="btn"><a href='products.php'>All Products</a></button></li>
          -->
              <?php           
                // getcategory();
                $today = date("Y-m-d");
                $activeBakeshops = mysqli_query($db, "SELECT * from users u where (u.account_expiration) <> '-' AND (u.account_expiration) > $today");
                
                while($bakeshop=mysqli_fetch_array($activeBakeshops)){
                  echo"<li class='active'><button class='btn'><a href='products.php?unsetCart=1&bakeshop=".$bakeshop['id']."'>".$bakeshop['username']."</a></button></li>";
                }    	
              ?>

            </ul>
          </div>
          <div class="container" style="border: 1px solid; border-radius: 5px; width: 1000px; background: #FFC7002A;">
              <?php
              if(isset($_GET['bakeshop'])){
                $bakeshopId = $_GET['bakeshop'];
                $result = mysqli_query($db, "SELECT p.id,p.product_name,p.product_image,p.rate from users u,categories c,product p WHERE u.id = $bakeshopId AND u.id = c.owner_id AND c.id = p.categories_id");
                while($row = mysqli_fetch_array($result)){
                  ?>
                    <div class='col-md-3'>
		                  <form method='post' action='products.php?bakeshop=<?php echo $bakeshopId;?>&action=add&product_id=<?php echo $row['id']?>'>
		                    <div style='border: 1px solid; background-color: #f1f1f1; border-radius: 5px; padding: 12px; margin: 10px;' align='center'>
                        <img src= 'Owner<?php echo $row['product_image']?>' class='image-responsive' style='width: 140px;  height: 100px; border-radius: 5px; margin-bottom: 10px;'/><br/>              
                            <p class='text-info' style='margin: 0px;'><?php echo $row['product_name']?></p>
			                      <p class='text-danger' style='margin-bottom: 0px;'><?php echo $row['rate']?> PHP</p>
			                      <input type='hidden' name='quantity' class='form-control' value='1'/>
			                      <div class='row'>
				                      <div class='separator clear-left'>
					                      <a class='btn btn-success' 
				                      	href='products.php?bakeshop=<?php echo $bakeshopId;?>&add=<?php echo $row['id']?>' >Add to cart</a>
				                      </div>
			                      </div>
		                    </div>
		                  </form>
		                </div>
                  <?php
                }
                
              }  
                
              ?>
          </div> 
      </div>
</section>

<?php
require_once 'includes/footer.php';
?>