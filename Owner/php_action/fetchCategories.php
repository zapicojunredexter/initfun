<?php 	

require_once 'core.php';

$sql = "SELECT * FROM categories WHERE categories_active = 1 AND owner_id = '".$_SESSION['userId']."'";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

	// $row = $result->fetch_array();
	$activeCategories = ""; 

	while($row = $result->fetch_array()) {
		$categoriesId = $row[0];
		// active 
		if($row[3] == 1) {
			// activate member
			$activeCategories = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$activeCategories = "<label class='label label-danger'>Not Available</label>";
		}

		$button = '<!-- Single button -->
			<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			<li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
			<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
			</div>';

		$output['data'][] = array( 		
			$row[2], 		
			$activeCategories,
			$button 		
		); 	
	} // /while 

}// if num_rows

$connect->close();

echo json_encode($output);
