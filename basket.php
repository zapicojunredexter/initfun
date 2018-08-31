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
	            header("Location: basket.php");
	      }else{
	        echo '<script language="javascript">alert("Stock products are not sufficient!"); document.location="basket.php";</script>';
	      }
	 }
	if(isset($_GET['remove'])){
	    $_SESSION['cart_'.$_GET['remove']]--;
	    header("Location: basket.php");
	}
	if(isset($_GET['delete'])){
	    $_SESSION['cart_'.$_GET['delete']]='0';
	    header("Location: basket.php");
	}
   $i=-2;
  //if (!empty($_SESSION["cart_"]) && is_array($_SESSION["cart_"])) {
    foreach($_SESSION as $name => $value){
      if($value > 0)
      {
        $i++;
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
<br><br><br><br><br>
		<!-- 	<div class="row" style="margin-top: 70px">
				<div class="col"> -->
					<div class="container" style="margin-top: 50px;">
					<p class="text-muted"><strong>You currently have <?php echo '<font style = "color:orange;">'.$i. '</font>';?> item(s) in your cart.</strong></p>
			        </div>
					<div class="container" style="border:2px solid; border-radius: 5px;">
					<table class="table">
						<tr>
							<th>Product Photo</th>
							<th>Product name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Action</th>
						</tr>
						
							<?php
								$i=0;
								$total = 0;
								$itemqty = 0;
							    foreach($_SESSION as $name => $value){
							        if($value > 0) {
							        	if(substr($name, 0, 5) == 'cart_'){
                                            $id = substr($name, 5, (strlen($name)-5));
              //                               $query3="SELECT * FROM tbl_product where product_id = '".$id."'";
		    								// $data3=selectById($query3);
		    								$query3 = mysqli_query($db, "SELECT * from product WHERE id = $id");
      											$data3 = mysqli_fetch_array($query3);
		    								$total = $total + $data3['rate'] * $value;
		    								echo "<tr>";
		    								echo "<td>
		    								<img width='50' height='35'src='Owner/".substr($data3['product_image'],3)."'>
		    								</td>";
		    								echo "<td>".$data3['product_name']."</td>";
		    								echo "<td>".$data3['rate']."</td>";
		    								echo "<td>".$value."</td>";
		    								echo '<td><a href="basket.php?add='.$data3['id'].'"><i class="fa fa-plus"></i></a> | <a href="basket.php?remove='.$data3['id'].'"><i class="fa fa-minus"></i></a> | <a href="basket	.php?delete='.$data3['id'].'"><i class="fa fa-times"></i></a></td>';
											echo "</tr>";
											$itemqty = $value;
                                        }
							        	
							        }
							    }
							?>
							
							<!-- <td>adsfsd</td>
							<td>adsfsd</td>
							<td>adsfsd</td>
							<td><a href=""><i class="fa fa-plus"></i></a> | <a href=""><i class="fa fa-minus"></i></a> | <a href=""><i class="fa fa-times"></i></a></td> -->
						
						<tr>
							<td></td>
							<th >Total:</th>
							<th style="color: #fe4c50"> P <?php echo $total?></th>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<th >Vat (13%):</th>
							<th style="color: #fe4c50"> P <?php echo $total * .13?></th>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<th >Grand Total:</th>
							<th style="color: #fe4c50"> P <?php echo $total + ($total * .13)?></th>
							<td></td>
							<td></td>
						</tr>
					</table>
					<?php 
						if($total != 0){
							
							echo '
							<div style="padding-bottom:10px;">
							<form class="paypal" action="paypal-test/payments.php" method="post" id="paypal_form">
							<!--
							<input type="hidden" name="cmd" value="_xclick" />
							-->
       						<input type="hidden" name="upload" value="1">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="no_note" value="1" />
							<input type="hidden" name="lc" value="UK" />
							<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
							<input type="hidden" name="first_name" value="Customer first" />
							<input type="hidden" name="last_name" value="Customer last" />
							<input type="hidden" name="payer_email" value="zapicojunredexter-buyer@gmail.com" />
							<input type="hidden" name="item_name" value="'.$data3['product_name'].'" />
							<input type="hidden" name="item_number" value="123456" / >
							<input type="submit" name="submit" value="Submit justine"/>
						</form>
							</div>';
						}
						
					?>
					
					<form class="paypal" action="paypal-test/payments.php" method="post" id="paypal_form">
							<!--
							<input type="hidden" name="cmd" value="_xclick" />
							-->
        <input type="hidden" name="upload" value="1">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="no_note" value="1" />
							<input type="hidden" name="lc" value="UK" />
							<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
							<input type="hidden" name="first_name" value="Customer First Name" />
							<input type="hidden" name="last_name" value="Customer Last Name" />
							<input type="hidden" name="payer_email" value="zapicojunredexter-buyer@gmail.com" />
							<input type="hidden" name="item_name" value="dataddssss" />
							<input type="hidden" name="item_number" value="123456" / >
							<input type="submit" name="submit" value="Submit zxc"/>


						</form>
			
							<form class="paypal" action="paypal-test/payments.php" method="post" id="paypal_form">
        <!--
        <input type="hidden" name="cmd" value="_xclick" />
        -->
        <input type="hidden" name="upload" value="1">

        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="lc" value="UK" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" name="first_name" value="Customer's First Name" />
        <input type="hidden" name="last_name" value="Customer's Last Name" />
        <input type="hidden" name="payer_email" value="zapicojunredexter-buyer@gmail.com" />
        <input type="hidden" name="item_number" value="123456" / >
        <input type="hidden" name="item_number_1" value="234567" / >
        <input type="hidden" name="item_number_2" value="234567" / >
        <input type="submit" name="submit" value="working" />
    </form>
					</div>
					</div>
			<!-- 	</div>
			</div> -->

<?php
require_once 'includes/footer.php';
?>
