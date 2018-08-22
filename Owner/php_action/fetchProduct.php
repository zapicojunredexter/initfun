<?php 	

require_once 'core.php';

if($_SESSION['is_admin'] == 1){
	$sql = "SELECT product.id, product.product_name, product.product_image, product.categories_id, product.quantity, product.rate, product.active, categories.categories_name FROM product INNER JOIN categories ON product.categories_id = categories.id  
	WHERE product.active = 1";
}else{
	$sql = "SELECT product.id, product.product_name, product.product_image, product.categories_id, product.quantity, product.rate, product.active, categories.categories_name FROM product INNER JOIN categories ON product.categories_id = categories.id  
	WHERE product.active = 1 AND product.brand_id = '".$_SESSION['userId']."' ";
}

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

	// $row = $result->fetch_array();
	$active = ""; 

	while($row = $result->fetch_object()) {
		$productId = $row->id;
		// active 
		if($row->active == 1 AND $row->quantity > 0) {
			// activate member
			$active = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$active = "<label class='label label-danger'>Not Available</label>";
		} // /else

		$button = '<!-- Single button -->
			<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			<li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
			<li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
			</div>';

		$productImage = "<img class='img-round' src='".substr($row->product_image, 3)."' style='height:30px; width:50px;'  />";

		$output['data'][] = array( 		
			// image
			$productImage,
			// product name
			$row->product_name, 
			// rate
			$row->rate,
			// quantity 
			$row->quantity,
			// category 		
			$row->categories_name,
			// active
			$active,
			// button
			$button 		
		);
	} // /while 

}// if num_rows

$connect->close();

echo json_encode($output);
