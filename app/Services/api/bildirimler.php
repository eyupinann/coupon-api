<?php

date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
header('Content-Type: application/json');

include '../dbConfig.php';

$response = array();

$result = $conn->query("SELECT * FROM notifi ORDER BY id DESC LIMIT 15");


    if ($result->num_rows > 0) {
    $response["bildirimler"] = array();
    while ($row = $result->fetch_assoc()) {

            array_push($response["bildirimler"], $row);
        
    }
    echo json_encode($response);
} else {
    $response["bildirimler"] = "bulunamadi";
    echo json_encode($response);
}


?>