<?php

date_default_timezone_set('Europe/Istanbul');
include '../dbConfig.php';
error_reporting(0);


function fidal()
{

	global $conn;
    $litem = mysqli_query($conn , "SELECT * FROM kuponlar where islem = 0");
	while ($row = $litem->fetch_assoc()) {
		
		$gelen[] = $row['id'];
				
	}
	
	return $gelen;
	
}

function fsonuc($sid){

	global $conn;
	$durum = array();
    $litem = mysqli_query($conn , "SELECT * FROM maclar where kpnid = '$sid'");
	
	while($sn = mysqli_fetch_array($litem)){
		
		$durum[] = $sn['durum'];
		
	}

	if (in_array("Kaybetti", $durum)) {
     $query = mysqli_query($conn , "UPDATE kuponlar set durum = 'Kaybetti' , islem = 1 where id = '$sid'");
    }else if(in_array("Bekliyor", $durum) && in_array("Kazandı", $durum)){
	 $query = mysqli_query($conn , "UPDATE kuponlar set durum = 'Bekliyor' , islem = 0 where id = '$sid'");			
	}else if(!in_array("Bekliyor", $durum) && in_array("Kazandı", $durum)){
	 $query = mysqli_query($conn , "UPDATE kuponlar set durum = 'Kazandı' , islem = 1 where id = '$sid'");
	}
	
	print_r($durum);
	
}


$fidalid = fidal();

	
foreach($fidalid as $key){
	    
fsonuc($key);

}
	    
	
