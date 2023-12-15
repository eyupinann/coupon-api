<?php

date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
header('Content-Type: application/json');

include '../dbConfig.php';

$response = array();

$result = $conn->query("SELECT * FROM setting where id = 1");


    if ($result->num_rows > 0) {
    $response["ayarlar"] = array();
    while ($row = $result->fetch_assoc()) {

            $category = array();
            $category["version"] = $row["version"];
			$category["duyuru"] =  $row["duyuru"];
			$category["iletisim"] =  $row["iletisim"];

            
        
    }
    echo json_encode($category);
} else {
    $response["ayarlar"] = "bulunamadi";
    echo json_encode($response);
}


?>