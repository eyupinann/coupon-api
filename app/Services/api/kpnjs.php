<?php

date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
header('Content-Type: application/json');

include '../dbConfig.php';

$response = array();

$tr = $_POST['tr'];


if(isset($tr) || !empty($tr)){
    
    $result = $conn->query("SELECT * FROM kuponlar where tarih = '$tr' and durum = 'Bekliyor' ORDER BY id DESC LIMIT 100");
    
}else{
   
    $result = $conn->query("SELECT * FROM kuponlar where durum = 'Bekliyor' ORDER BY id DESC LIMIT 100");
    
}



    if ($result->num_rows > 0) {
    $response["kuponlar"] = array();
    while ($row = $result->fetch_assoc()) {

            $category = array();
            $category["id"] = $row["id"];
            $date = new DateTime($row['tarih'] . " " . $row['saat']);
			$category["tarih"]= $date->format('d.m.Y');
			$category["saat"]=  $date->format('H:i');
			$category["toran"]= $row['toran'];
			$category["macs"]= $row['macs'];
		    $category["durum"]= $row['durum'];
            array_push($response["kuponlar"], $category);
        
    }
    echo json_encode($response);
} else {
    $response["kuponlar"] = "bulunamadi";
    echo json_encode($response);
}


?>