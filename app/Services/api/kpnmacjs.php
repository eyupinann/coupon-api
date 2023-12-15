<?php

date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
header('Content-Type: application/json');

include '../dbConfig.php';

$response = array();

$json = file_get_contents("php://input");
$data = json_decode($json, true);
$id = $data["id"];

$result = $conn->query("SELECT * FROM maclar WHERE kpnid='$id' ORDER BY id DESC");





    if ($result->num_rows > 0) {
    $response["kpnmac"] = array();
    while ($row = $result->fetch_assoc()) {

            $category = array();
            $category["id"] = $row["id"];
            $date = new DateTime($row['tarih'] . " " . $row['saat']);
            //print_r($date);
			$category["tarih"]= $date->format('d.m');
			$category["saat"]=  $date->format('H:i');
            $category["macid"]= $row['macid'];
            $category["mbs"]= $row['mbs'];
			$category["ev"]= $row['ev'];
			$category["konuk"]= $row['konuk'];   
		    $category["evl"]= "https://im.cdn.md/img/logo/buyuk/" . $row['evl'] . ". jpg";
			$category["depl"]= "https://im.cdn.md/img/logo/buyuk/" . $row['depl'] . ".jpg";
		    $category["tahmin"]= $row['tahmin'];
			$category["oran"]= $row['oran'];
            $category["iy"]= $row['iy'];
            $category["ms"]= $row['ms'];
		    $category["durum"]= $row['durum'];
            array_push($response["kpnmac"], $category);
        
    }
    echo json_encode($response);
} else {
    $response["kpnmac"] = "bulunamadi";
    echo json_encode($response);
}


?>