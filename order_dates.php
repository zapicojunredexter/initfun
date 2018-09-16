<?php
    require_once 'includes/header.php';
    require_once 'Owner/php_action/db_connect.php'; 
    $itemIds = $_POST['itemId'];
    $itemNames = $_POST['itemName'];
    $itemImgs = $_POST['itemImg'];
    $itemPrices = $_POST['itemPrice'];
    $temp = $_POST['dates'];
    $dates = explode(',', $temp);
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
               }
            ?> 
         </ul>
      </nav><!-- #nav-menu-container -->
    </div>
    </header><!-- modal sign in -->
    <br><br><br><br><br>

    <div class="container" style="margin-top: 50px;">
        <h3>Set your orders on each date</h3>
    </div>
    <div class="container" style="border:2px solid; border-radius: 5px;">
        <h4>You ordered:</h4>
        <div class="row" style="margin:20px">
            <?php
                $c = array_combine($itemNames, $itemImgs);
                foreach($c as $data => $value){
                    echo '
                            <div class="column">
                                <p style="margin-bottom:0;">'.$data.'</p>
                                <img width="100" height="75" src="Owner/'.$value.'">
                            </div>
                         ';
                }
            ?>
        </div>
        <table class="table">
            <tr>
                <th>Dates</th>
                <th>Order/s</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Confirm</th>
                <th style="text-align:center;">Total</th>
            </tr>
        <?php
            $idx = 0;
            foreach($dates as $date){
                echo '<tr>';
                echo '<td id="'.$idx.'">'.$date.'</td>
                      <td>
                        <table>';
                         $i = 0;
                         foreach($itemNames as $names){
                             echo '
                                <tr>
                                    <td style="padding-bottom:11px"><input type="checkbox" id="'.$idx.'.chckbox_'.$i.'" value="'.$names.'"> '.$names.'</td>
                                </tr>
                              ';
                             $i++;
                         }
                echo '</table>
                      </td>
                      <td>
                        <table>';
                        $j = 0;
                        foreach($itemPrices as $prices){
                            echo '
                                 <tr>
                                    <td style="padding-bottom:11px"><strong id="'.$idx.'.price_'.$j.'" value="'.$prices.'"> P'.$prices.'</strong></td>
                                 </tr>
                                 ';
                            $j++;
                        }
                echo    '</table>
                        </td>
                        <td>
                        <table>';
                        $k = 0;
                        foreach($itemNames as $names){
                            echo '
                                <tr>
                                    <td style="padding-bottom:8px"><input class="qtyInp" type="number" id="'.$idx.'.qty_'.$k.'" style="cursor:not-allowed;" disabled/></td>
                                </tr>
                              ';
                            $k++;
                        }
                echo '</table>
                      </td>
                      <td style="vertical-align:baseline;">
                        <button id="'.$idx.'.confPurchase_'.$i.'" class="btn btn-primary purchasing">SET
                      </td>
                      <td align="center">
                        <strong id="'.$idx.'_total">P0</strong> 
                      </td>
                      </tr>';
                $idx++;
            }
        ?>
            <tr>
                <td colspan="4"></td>
                <td align="right"><strong>Grand Total w/ VAT(13%):</strong></td>
                <td align="center" style="border-top-width:2px; border-top-color: #000000;">
                    <strong id="grand_total" style="color:#fe4c50">P0</strong>
                </td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td>
                    <form class="paypal checkout" action="paypal/payments.php" method="post" id="paypal_form">
                        <input type="hidden" name="upload" value="1">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="no_note" value="1" />
                        <input type="hidden" name="lc" value="UK" />
                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                        <input type="hidden" name="first_name" value="Customer's First Name" />
                        <input type="hidden" name="last_name" value="Customer's Last Name" />
                        <input type="hidden" name="payer_email" value="zapicojunredexter-buyer@gmail.com" />
                        <input type="hidden" name="toDb" id="toDb" value="" />
                    <?php
                        $i = 1;
                        $nameWithPrices = array_combine($itemNames, $itemPrices);
                        foreach($nameWithPrices as $names => $prices){
                            echo '<input type="hidden" name="item_'.$i.'" value="'.$names.'" />';
                            echo '<input type="hidden" name="price_'.$i.'" value="'.$prices.'" />';
                            echo '<input type="hidden" id="asd_'.$i.'" name="asd_'.$i.'" value="" />';
                            $i++;
                        }
                        $j = 1;
                        foreach($itemIds as $ids){
                            echo '<input type="hidden" name="id_'.$j.'" value="'.$ids.'" />';
                            $j++;
                        }
                    ?>
                        <input type="hidden" name="tax" id="tax" value="" />
                        <input type="hidden" name="asd" value="<?php echo $dates; ?>" />
                        <input type="submit" name="submit" value="Checkout" class="btn btn-primary" id="checkout"/>
                    </form>
                </td>
            </tr>
        </table>
    </div>
<?php
require_once 'includes/footer.php';
?>