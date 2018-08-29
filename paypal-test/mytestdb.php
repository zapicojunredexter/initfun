<?php

require_once '../Owner/php_action/db_connect.php'; 

echo "good to go";
$sql = "INSERT INTO categories (owner_id,categories_name,categories_active) values  (123,'test category name',1)";
if($connect->query($sql) === TRUE) {
        echo "naadd";
	} else {
        echo "wa maadd";
	}
?>