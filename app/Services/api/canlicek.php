<?php

include '../dbConfig.php';
//header('Content-type: application/json');
error_reporting(0);

$veri = file_get_contents("http://goapi.mackolik.com/livedata?group=0");
$dizi = json_decode($veri, true);
$maclar = $dizi['m'];
$v = "0";
$sayi = count($maclar);
for ($i=0; $i<$sayi; $i++)
{
    if (empty($maclar[$i][6]) || $maclar[$i][6] == "MS" || $maclar[$i][6] == "Hük." || $maclar[$i][6] == "YrdK" || $maclar[$i][6] == "Ert." || $maclar[$i][6]=="UZ" || $maclar[$i][6]=="Pen" || $maclar[$i][36][11] !=1 || $maclar[$i][36][9] =="HAZ")
    {
        unset($maclar[$i]);
    }
    else
    {
        $mac[$v] = $maclar[$i];
        $v++;
    }
}



$conn->query('TRUNCATE TABLE cmaclar');


foreach($maclar as $key=>$value){

 $tip = $value[36][11];

 if($tip == '1'){
 
 $macid = $value[14];
 $st = $value[16];
 $lig = $value[36][1] . "-" . $value[36][3];
 $ligl = $value[36][0];
 $ev = $value[2];
 $konuk = $value[4];
 $dk = $value[6];
 $evg = $value[12];
 $kog = $value[13];
 $half = $value[7];
 $full = $value[12] . "-" . $value[13];
 
 $stmt = $conn->query("insert into cmaclar(macid,saat,lig,ligl,ev,konuk,dk,evgol,konukgol,half,full) values ('$macid' , '$st' ,'$lig', '$ligl' , '$ev' ,'$konuk', '$dk','$evg' ,'$kog' , '$half','$full')");

}

}

//echo json_encode($maclar);
	
echo "Toplam ".count($maclar)." Veri (Eklendi/Güncellendi)";

