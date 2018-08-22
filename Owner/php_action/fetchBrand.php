<?php 	

require_once 'core.php';

$sql = "SELECT * FROM users WHERE is_admin = 0";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

	$activeBrands = ""; 

	while($row = $result->fetch_object()) {
		$id = $row->id;
		// active 

		$button = '<!-- Single button -->
			<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			<li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$id.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
			<li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
			</div>';

		$output['data'][] = array(
			$row->id,
			$row->first_name, 		
			$row->middle_name,
			$row->last_name,
			$row->username,
			$row->gender,
			$row->address,
			$row->date_of_birth,
			$row->phone_number,
			$row->email,
			$button
		); 	
	} // /while 

} // if num_rows

$connect->close();

die(json_encode($output));
