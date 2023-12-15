<?php

error_reporting(0);
date_default_timezone_set('Europe/Istanbul');
//header('Content-Type: application/json');
include '../dbConfig.php';
						
$json = file_get_contents("php://input");
$data = json_decode($json, true);

$id= $data['email'];
$ldate = date("d-m-Y");
$sdate = date("H:i");
$pday = date("d-m-Y" ,strtotime('+ 1 days'));

$b64license='MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmkjlIlMsxyKvLbjy79HUgYtqJDNR/FiTlXY9y2dtHDGukxS/W1Sqofd6Ogb6DzpyF1NpKM+w1wuiMWPGUinTy13HKKSR8gl3F0kMp3XI2V0P6Q9ShZLzXOdmTzcTx/rGekjdPuqTclui1gTUnGruh+MArPz7T1nfxRecGq7R2FwnmSt6075DMbVzrdJEbRrbiMK8A4xwT45lvYO+a0Xwl8Z3WHeoFHAE5U30WJ/Ko59ZkL9WUb+LUYpBzbKpwsIgQyh+pNQO8Nvlgs86T+E5G7KGEQAUe/BkzOWi/EEIGyOclgpwmRyndk1HOhOC3Be/d1gqA2eGAFjhy0ztwNEZfwIDAQAB';
$rsku = $data['is_sku'];
$rdata = $data['responsedata'];
//$token = $data['token'];
$rimza = $data['signature'];


$hafekle = date('d-m-Y', strtotime($pday .'+ 1 weeks'));
$sayekle  = date('d-m-Y', strtotime($pday . '+ 1 months'));
		
$yilekle = date('d-m-Y', strtotime($pday .'+ 12 months'));


function uguncelle($skuad){
	
global $conn;
global $ayekle;
global $sayekle;
global $yilekle;
global $ldate;
global $sdate;
global $id;
global $rsku;
global $price;
	
	
if($skuad == 'sub_1'){
	
$query = $conn->query("UPDATE users set pre = 'true' where email = '$id'");
	
$ulog = $conn->query("INSERT INTO ulog (tarih , saat , email, urun, miktar) VALUES ('$ldate' , '$sdate' , '$id', '$rsku', '$price')");	
	
}else if($skuad == 'sub_2'){
	
$query = $conn->query("UPDATE users set pre = 'true' where email = '$id'");
	
$ulog = $conn->query("INSERT INTO ulog (tarih , saat , email, urun, miktar) VALUES ('$ldate' , '$sdate' , '$id', '$rsku', '$price')");		
	
}else if($skuad == 'sub_3'){
	
$query = $conn->query("UPDATE users set pre = 'true' where email = '$id'");
	
$ulog = $conn->query("INSERT INTO ulog (tarih , saat , email, urun, miktar) VALUES ('$ldate' , '$sdate' , '$id', '$rsku', '$price')");		
	
}

	
}


function googleInAppVerify($signed_data, $signature, $public_key_base64){
        $key =  "-----BEGIN PUBLIC KEY-----\n".
            chunk_split($public_key_base64, 64,"\n").
            '-----END PUBLIC KEY-----';   
        //using PHP to create an RSA key
        $key = openssl_get_publickey($key);
        //$signature should be in binary format, but it comes as BASE64. 
        //So, I'll convert it.
        $signature = base64_decode($signature);   
        //using PHP's native support to verify the signature
        $result = openssl_verify(
                $signed_data,
                $signature,
                $key,
                OPENSSL_ALGO_SHA1);

        if(0 === $result){
            return false;
        }else if(1 !== $result){
            return false;
        }else{
            return true;
        }
}


if(googleInAppVerify(stripslashes($rdata), stripslashes($rimza), $b64license) != false){
		
uguncelle($rsku);
$satinal = $conn->query("INSERT INTO satin (email, sku, date ,saat,  imza, data, fake) VALUES ('$id', '$rsku', '$ldate', '$sdate' , '$rimza', '$rdata', 'Gerçek')");
	
$arr = array("status"=>"Success");
echo json_encode($arr);		
		
}else{
    
    
   
$query = $conn->query("UPDATE users set ban = '$pday' where email = '$id'");
		
$satinal = $conn->query("INSERT INTO satin (email, sku, date ,saat, imza, data, fake) VALUES ('$id', '$rsku', '$ldate', '$sdate' , '$rimza', '$rdata', 'Fake')");
	
$arr = array("status"=>"Failed");
echo json_encode($arr);			

}
	

	
?>
