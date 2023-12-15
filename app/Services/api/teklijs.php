<?php

date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
header('Content-Type: application/json');

include '../dbConfig.php';

$response = array();

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$tr = $data['tr'];
$date = date("d-m-Y");


if(isset($tr) || !empty($tr)){


       $result = $conn->query("SELECT * FROM maclar WHERE tarih = '$tr' and durum != 'Bekliyor' and (kpnid='f' or kpnid='p') ORDER BY id DESC");

    
}else{
    
    
    $result = $conn->query("SELECT * FROM maclar WHERE durum = 'Bekliyor' and (kpnid='f' or kpnid='p') ORDER BY id DESC LIMIT 100");
    
}

//function lal($mid){

//global $conn;
	
//$result = $conn->query("SELECT evl,depl FROM bulten WHERE macid='$mid'");
	
//$row = $result->fetch_assoc();	
//return $row['evl'] . "-" . $row['depl'];	
	
//}



    if ($result->num_rows > 0) {
    $response["teklimac"] = array();
    while ($row = $result->fetch_assoc()) {

            $category = array();
            $category["id"] = $row["id"];
            $date = new DateTime($row['tarih'] . " " . $row['saat']);
            //print_r($date);
			$category["tarih"]= $date->format('d.m.Y');
			$category["saat"]=  $date->format('H:i');
            $category["macid"]= $row['macid'];
            $category["mbs"]= $row['mbs'];
			$category["ev"]= $row['ev'];
			$category["konuk"]= $row['konuk'];
		    //$lgs = lal($row['macid']);
			//$ldizi = explode("-" , $lgs);		   
		    $category["evl"]= "https://im.cdn.md/img/logo/buyuk/" . $row['evl'];
			$category["depl"]= "https://im.cdn.md/img/logo/buyuk/" .$row['depl'];
		    $category["tahmin"]= $row['tahmin'];
			$category["oran"]= $row['oran'];
            $category["iy"]= $row['iy'];
            $category["ms"]= $row['ms'];
            $category["tip"]= $row['kpnid'];
		    $category["durum"]= $row['durum'];
            array_push($response["teklimac"], $category);
        
    }
    echo json_encode($response);
} else {
    $response["teklimac"] = "bulunamadi";
    echo json_encode($response);
}


?>