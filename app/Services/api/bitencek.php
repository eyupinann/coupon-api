<?php


header('Content-type: application/json');
error_reporting(0);
$response = array();

if(empty($_POST['tarih'])){
   $tarih= date('d/m/Y'); 
}else{
   $tarih= $_POST['tarih'];
}


$veri = file_get_contents('http://goapi.mackolik.com/livedata?date='.$tarih);

$dizi = json_decode($veri, true);
$maclar = $dizi['m'];
$v = "0";
$sayi = count($maclar);
for ($i=0; $i<$sayi; $i++)
{
    if (is_numeric($maclar[$i][6]))
    {
        unset($maclar[$i]);
    }
    else
    {
        $mac[$v] = $maclar[$i];
        $v++;
    }
}


$response["bmaclar"] = array();

foreach($maclar as $key=>$value){


 $category = array();
 
 $category['macid'] = $value[14];
 $category['saat'] = $value[16];
 $category['lig'] = $value[36][1] . "-" . $value[36][3];
 $category['ligl'] = 'http://im.cdn.md/img/groups/' . $value[36][0] . '.gif';
 $category['ev'] = $value[2];
 $category['dep'] = $value[4];
 $category['iy'] = $value[7];
 $category['ms'] = $value[12] . "-" . $value[13];
 //$category['macid'] = $value[14];
 //$category['macid'] = $value[14];
 //$category['macid'] = $value[14];
    


array_push($response["bmaclar"], $category);


}

echo json_encode($response);
	

