<?php

include '../dbConfig.php';

function lal($mid){

global $conn;
	
$result = $conn->query("SELECT evl,depl FROM bulten WHERE macid='$mid'");
	
$row = mysqli_fetch_assoc($result);
	
return $row['evl'];	
	
}

echo lal(747205);


?>