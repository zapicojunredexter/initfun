<?php 	

require_once 'core.php';

$sql = "SELECT * FROM brands WHERE brand_active = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

	$activeBrands = ""; 

	while($row = $result->fetch(PDO::FETCH_OBJ)) {
		$brandId = $row->id;
		// active 
		if($row->brand_active == 1) {
			// activate member
			$activeBrands = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$activeBrands = "<label class='label label-danger'>Not Available</label>";
		}

		$button = '<!-- Single button -->
			<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			<li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
			<li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
			</div>';

		$output['data'][] = array( 		
			$row[1], 		
			$activeBrands,
			$button
		); 	
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
