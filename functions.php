<?php

require_once 'Owner/php_action/db_connect.php';

function getcategory(){

	global $connect;
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            $id = $_SESSION['id'];
           	$cat_query = "SELECT * from categories";
			$cat_result = mysqli_query($connect,$cat_query);

            $db= mysqli_connect('localhost','root','','initfun');
            $result = mysqli_query($db, "SELECT * from customers WHERE id = $id");

		while($row = mysqli_fetch_array($result)){
			while($row_cat= mysqli_fetch_array($cat_result)){

				$categories_name = $row_cat['categories_name'];
        		$categories_id = $row_cat['id'];
           		
           		echo"<li><button class='btn'><a href='products.php?id=".$id."&cat=".$categories_id."'>$categories_name</a></button></li>";
    		}
    	}
    	}else{
			$cat_query = "SELECT * from categories";
			$cat_result = mysqli_query($connect,$cat_query);
			while($row_cat=mysqli_fetch_array($cat_result)){
				$categories_name = $row_cat['categories_name'];
        		$categories_id = $row_cat['id'];

        		echo"<li><button class='btn'><a href='products.php?cat=".$categories_id."'>$categories_name</a></button></li>";
			}    		
    	}
}

function getcategoryproduct(){


	if(isset($_GET['cat'])){

			$categories_id = $_GET['cat'];

			global $connect;		

			$query = "SELECT * from product WHERE categories_id = '$categories_id' and active = '1' ORDER by id ASC";

		                $result = mysqli_query($connect, $query);

		                $count_row = mysqli_num_rows($result);

		                if(mysqli_num_rows($result) > 0)
		                {
		                    while($row = mysqli_fetch_array($result))
		                    {

		                    	$product_id = $row['id'];
		                    	$product_image = substr($row['product_image'], 3);
		                    	$product_name = $row['product_name'];
		                    	$rate = $row['rate'];

		              echo "
		                <div class='col-md-3'>
		                  <form method='post' action='products.php?action=add&product_id=$product_id'>
		                    <div style='border: 1px solid; background-color: #f1f1f1; border-radius: 5px; padding: 12px; margin: 10px;' align='center'>
		                      <img src= 'Owner/$product_image' class='image-responsive' style='width: 140px;  height: 100px; border-radius: 5px; margin-bottom: 10px;'/><br/>              
			                      <p class='text-info' style='margin: 0px;'>$product_name</p>
			                      <p class='text-danger' style='margin-bottom: 0px;'>$rate PHP</p>
			                      <input type='text' name='quantity' class='form-control' value='1'/>
			                      <input type='hidden' name='hidden_name' value='$product_name'/>
			                      <input type='hidden' name='hidden_price' value='$rate'/> 
			                      <div class='row'>
				                      <div class='separator clear-left'>
					                      <a class='btn btn-success' 
				                      	href='products.php?add=$product_id' >Add to cart</a>
				                      </div>
			                      </div>
		                    </div>
		                  </form>
		                </div>
		                <div class='modal fade' id='myModal_details' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
						  <div class='modal-dialog'>
						    <div class='modal-content'>
						      <div class='modal-header'>
						        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						        <h4 class='modal-title' id='myModal_details'>$product_name</h4>
						      </div>
						      <div class='modal-body' style='padding: 15px 0px;'>
						        <div class='sign-in'>
						       	
						        </div>
						      </div>
						      <div class='modal-footer'>
						        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
						      </div>
						    </div>
						  </div>
						</div>";
		                    }
		                }else 
		                	echo "
		                	<div class='col-md-4'></div>	
		                	<div class='col-md-4' style='padding: 20px;'><h2>No Stock Available</h2></div>	
		                	<div class='col-md-4'></div>
		                	</br>";
	}
}

function getallproducts(){
	global $connect;
	$query = "SELECT * from product";
    $result = mysqli_query($connect, $query);
    
    while($row = mysqli_fetch_array($result)){

        $product_id = $row['id'];
        $product_name = $row['product_name']; 
        $rate = $row['rate'];
        $product_image = $row['product_image'];

		                     // <input type='text' name='quantity' class='form-control' value='1'/>

				                      // <input type='submit' name='add_to_cart' style='margin-top: 5px; font-size: 10px' class='btn btn-success' value='Add to cart' />
        echo "<div class='col-md-3'>
	                  <form method='post' action='products.php?action=add&product_id=$product_id'>
	                    <div style='border: 1px solid; background-color: #f1f1f1; border-radius: 5px; padding: 12px; margin: 10px;' align='center'>
	                      <img src= 'Owner$product_image' class='image-responsive' style='width: 140px;  height: 100px; border-radius: 5px; margin-bottom: 10px;'/><br />              
		                      <p class='text-info' style='margin: 0px;'>$product_name</p>
		                      <p class='text-danger' style='margin-bottom: 0px;'>$rate PHP</p>
		                      <input type='hidden' name='hidden_name' value='$product_name' />
		                      <input type='hidden' name='hidden_price' value='$rate' /> 
		                      <div class='row'>
			                      <div class='separator clear-left'>
				                      <a class='btn btn-success' 
				                      href='products.php?add=$product_id' >Add to cart</a>
			                      </div>
		                      </div>
	                    </div>
	                  </form>
	                </div>
	                <div class='modal fade' id='myModal_details' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
						  <div class='modal-dialog'>
						    <div class='modal-content'>
						      <div class='modal-header'>
						        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						        <h4 class='modal-title' id='myModal_details'>$product_name details</h4>
						      </div>
						      <div class='modal-body' style='padding: 15px 0px;'>
						        <div class='sign-in'>
						        //
						        </div>
						      </div>
						      <div class='modal-footer'>
						        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
						      </div>
						    </div>
						  </div>
						</div>";	    
	}
}

?>
