<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paypal Integration Test</title>
	  <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
  <div class="container-full">
    <div class="container-full" style="color:white;background-color: rgba(255, 93, 14, 0.83);padding:30px;text-align:center;align-items:center">
              

      <img src="../../img/welcome_logo.png" style="float:left;" width="300" height="192" />

      <h2 style="text-shadow: 1.4px 1.4px #000;text-transform: uppercase;font-family:Poppins, sans-serif">All your favorite local bakeshops all in one site. You can enjoy online shopping 
          of your <br> favorite breads, cakes, pastries and even pasalubongs for your love ones ! <br>
      <a href="#services" class="next-sect"><i class="fa fa-chevron-down fa-3x"></i></a>
   
    </div>


      <form class="paypal" action="subscription_payments.php" method="post" id="paypal_form">
          <input type="hidden" name="cmd" value="_xclick" />
          <input type="hidden" name="upload" value="1">
          <input type="hidden" name="no_note" value="1" />
          <input type="hidden" name="lc" value="UK" />
          <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /><br>




          <div class="row" style="margin:40px 80px 40px 80px;">

            <div class="col-sm-4" style="color:#f2d8cb;background-color:#f99663;padding:0px;text-align:center;">
              <h2>STARTER</h2>
              <div style="background-color:#f9ad86;margin:0px;padding:10px;">
                <h1>PHP 6.00</h1>
              </div>
              <div style="background-color:white;color:black;">
              <br><input type="radio" name="item_name" value="3 Months Subscription"> 3 Months Subscription
              </div>
            </div>

            <div class="col-sm-4" style="color:#f2d8cb;background-color:#ff7d3a;padding:0px;text-align:center;">
              <h2>BASIC</h2>
              <div style="background-color:#ff8c51;margin:0px;padding:10px;">
                <h1>PHP 6.00</h1>
              </div>
              <div style="background-color:white;color:black;">
                <br><input type="radio" name="item_name" value="6 Months Subscription"> 6 Months Subscription
              </div>
            </div>


            <div class="col-sm-4" style="color:#f2d8cb;background-color:#f96213;padding:0px;text-align:center;">
              <h2>PREMIUM</h2>
              <div style="background-color:#f96f27;margin:0px;padding:10px;">
                <h1>PHP 6.00</h1>
              </div>
              <div style="background-color:white;color:black;">
              <br><input type="radio" name="item_name" value="12 Months Subscription"> 12 Months Subscription
              </div>
            </div>

            <div class="col-sm-12">
            <br><br>
              <input type="submit" class="btn form-control btn-warning" name="submit" value="Submit Payment"/>    
            </div>


            </div>


      </form>

  </div>
</body>
</html>
