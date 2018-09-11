<?php 	

require_once 'core.php';

$sql = "SELECT * FROM orders WHERE order_status = 1 AND owner_id =  '".$_SESSION['userId']."' ";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) {
	$paymentStatus = ""; 
	$x = 1;

	while($row = $result->fetch_object()) {
		$orderId = $row->id;

		$countOrderItemSql = "SELECT count(*) as count FROM order_item WHERE order_id = $orderId";
		$itemCountResult = $connect->query($countOrderItemSql);
		$itemCountRow = $itemCountResult->fetch_object()->count;

		// active 
		if($row->payment_status == 1) {
			$paymentStatus = "<label class='label label-success'>Full Payment</label>";
		} else if($row->payment_status == 2) {
			$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
		} else {
			$paymentStatus = "<label class='label label-warning'>No Payment</label>";
		} // /else

		if ($row->payment_type == 1){
			$paymentMethod = "Cheque";
		}else if($row->payment_type == 2){
			$paymentMethod = "Cash";
		}else if($row->payment_type == 3){
			$paymentMethod = "Online Payment";
		}else{
			$paymentMethod = "Credit Card";
		}
		$button = '<!-- Single button -->
			<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			<li><a href="orders.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>

			<li><a type="button" onclick="printOrder('.$orderId.')"> <i class="glyphicon glyphicon-print"></i> Print </a></li>

			<li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
			</div>';		

		$output['data'][] = array( 		
			// image
			$x,
			// order date
			$row->order_date,
			// client name
			$row->client_name, 
			// client contact
			$row->client_contact, 		 	
			$itemCountRow, 		 	
			$paymentMethod,
			$paymentStatus,
			// button
			$button 		
		); 	
		$x++;
	} // /while 

}// if num_rows

$connect->close();

echo json_encode($output);


			// <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>