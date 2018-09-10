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
                <li><a href='products.php?id=" .$id ."'>Products</a></li>
                <li class='menu-active'><a href='customer_order_history.php'>Order History</a></li>
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
</header>   
<br><br><br><br><br><br>
<!-- Products -->
<section id="product">
      <div class="container" style="margin-bottom: 40px;">
          
        <div class="container">
            <table class="table">
					<thead>
						<tr>							
							<th>OrderId</th>
							<th>Ordered Item</th>
							<th>Quantity</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
						</tr>
					</thead>
                    <tbody>
              <?php
                $orderSpecific = mysqli_query($db, "SELECT oi.order_id, oi.id, p.product_name, oi.quantity, oi.scheduled_delivery, oi.order_item_status from order_item oi, product p WHERE p.id = oi.product_id ORDER by oi.order_id");
                $orderResult = array();
                while($record = mysqli_fetch_assoc($orderSpecific)){
                    $orderResult[] = $record;
                }

                $rowCountArray = array();
                for($i = 0 ; $i<sizeof($orderResult);$i++){
                    $counter = 0;
                    for($j = $i; $j<sizeof($orderResult);$j++){
                        if($orderResult[$i]['order_id']!==$orderResult[$j]['order_id']){
                            break;
                        }
                        $counter++;
                    }
                    $rowCountArray[$i] = $counter;
                }
                
                $lastPrintedId = "";
                for($i = 0 ; $i<sizeof($orderResult);$i++){
                    ?>
                        <tr>
                            <?php
                                if($lastPrintedId !== $orderResult[$i]['order_id']){
                                    echo "<td rowspan='$rowCountArray[$i]'>";
                                    $lastPrintedId = $orderResult[$i]['order_id'];
                                    echo $orderResult[$i]['order_id'];
                                    echo "</td>";
                                }
                            ?>
                            
                            <td><?php echo $orderResult[$i]['product_name']?></td>
                            <td><?php echo $orderResult[$i]['quantity']?></td>
                            <td><?php echo $orderResult[$i]['scheduled_delivery']?></td>
                            <td><?php echo $orderResult[$i]['order_item_status']?></td>
                        </tr>
                    <?php
                    }
                ?>
                    </tbody>
				</table>
				
        </div> 
      </div>
</section>
<?php
require_once 'includes/footer.php';
?>