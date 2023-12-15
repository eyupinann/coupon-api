<?php

include '../dbConfig.php';
//error_reporting(0);
header('Content-type: application/json');
$siteurl="https://www.skormerkezi.com/fomoco_v1/"; 
$mevcutlariSil = $conn->query('DELETE FROM bulten where musabakatipi="futbol"');
$toplamcekilen=0;
$jsonData= json_decode(file_get_contents($siteurl."maclar/2"),true);

function tr_strtoupper($text)
{
    $search=array("ç","i","ı","ğ","ö","ş","ü");
    $replace=array("C","I","I","G","O","S","U");
    $text=str_replace($search,$replace,$text);
    $text=strtoupper($text);
    return $text;
}

function logoal($tr , $id){
	
$veri = file_get_contents('http://goapi.mackolik.com/livedata?date=' . $tr);

$dizi = json_decode($veri, true);
$maclar = $dizi['m'];
$tid = "";
$sayi = count($maclar);
for ($i=0; $i<$sayi; $i++)
{
 if (is_numeric($maclar[$i][6]))
 {
   unset($maclar[$i]);
 }
}

foreach($maclar as $key => $v){
		   
   
	if($id == $v[14]){
		
		$tid = $v[1] . "-" . $v[3];
	}	   
}
	
	return $tid;
	
}

foreach($jsonData as $veri){
$toplamcekilen++;
	$id = $veri["Kod"];
	$ekid = $veri["ekid"];
	$takims = $veri["Taraflar"];
	$saat = $veri["Tarih"][1];
	$gun    =   date("d-m-Y",$veri["Tarih"][2]);
	$lgs = logoal(date("d/m/Y",$veri["Tarih"][2]) , $veri["Kod"]);
	$ldizi = explode ("-",$lgs);
	$evl = $ldizi[0];
	$depl = $ldizi[1];;
	$lig    =   tr_strtoupper(mb_substr($veri["Lig"],0,3, 'UTF-8'));
	$zaman  =   $veri["Tarih"][2];
	$min    =   $veri["Mbs"];
	$tarih  =   $veri["Tarih"][0];
	//ORANLAR
	//maç sonucu
	$ms1 	= 	$veri["Oranlar"]["macsonucu"][1][0];
	$ms0 	= 	$veri["Oranlar"]["macsonucu"][2][0];
	$ms2 	= 	$veri["Oranlar"]["macsonucu"][3][0];
	//ilk yarı sonucu
	$iy1    =   $veri["Oranlar"]["ilkyarisonucu"][1][0];
	$iy0    =   $veri["Oranlar"]["ilkyarisonucu"][2][0];
	$iy2    =   $veri["Oranlar"]["ilkyarisonucu"][3][0];
	//2,5 alt üst
	$alt25    =   $veri["Oranlar"]["altust25"][1][0];
	$ust25    =   $veri["Oranlar"]["altust25"][2][0];	
	//karşılıklı gol
	$kgvar    =   $veri["Oranlar"]["kgvaryok"][1][0];
	$kgyok    =   $veri["Oranlar"]["kgvaryok"][2][0];	
	//1,5 alt üst
	$alt15    =   $veri["Oranlar"]["altust15"][1][0];
	$ust15    =   $veri["Oranlar"]["altust15"][2][0];
	//çifteşans
	$cf10    =   $veri["Oranlar"]["ciftesans"][1][0];
	$cf12    =   $veri["Oranlar"]["ciftesans"][2][0];
	$cf02    =   $veri["Oranlar"]["ciftesans"][3][0];	
	//toplamgol
	$tg01    =   $veri["Oranlar"]["toplamgol"][1][0];
	$tg23    =   $veri["Oranlar"]["toplamgol"][2][0];
	$tg45    =   $veri["Oranlar"]["toplamgol"][3][0];
	$tg6t    =   $veri["Oranlar"]["toplamgol"][4][0];
	//İlk yarı, Maç sonucu
	$im11  =   $veri["Oranlar"]["ilkyarimacsonucu"][1][0];
	$im10  =   $veri["Oranlar"]["ilkyarimacsonucu"][2][0];
	$im12  =   $veri["Oranlar"]["ilkyarimacsonucu"][3][0];
	$im01  =   $veri["Oranlar"]["ilkyarimacsonucu"][4][0];
	$im00  =   $veri["Oranlar"]["ilkyarimacsonucu"][5][0];
	$im02  =   $veri["Oranlar"]["ilkyarimacsonucu"][6][0];
	$im21  =   $veri["Oranlar"]["ilkyarimacsonucu"][7][0];
	$im20  =   $veri["Oranlar"]["ilkyarimacsonucu"][8][0];
	$im22  =   $veri["Oranlar"]["ilkyarimacsonucu"][9][0];

	$ft = 'futbol';
	
	
 $ok = $conn->prepare('INSERT INTO bulten (musabakatipi,macid,macekid,min,evl,depl,takimlar,saat,gun,lig,zaman,tarih,ms1,ms0,ms2,iy1,iy0,iy2,alt25,ust25,kgvar,kgyok,alt15,ust15,cf10,cf12,cf02,tg01,tg23,tg45,tg6t,im11,im10,im12,im01,im00,im02,im21,im20,im22) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
 $ok->bind_param("ssssssssssssssssssssssssssssssssssssssss",$ft,$id,$ekid,$min,$evl,$depl,$takims,$saat,$gun,$lig,$zaman,$tarih,$ms1,$ms0,$ms2,$iy1,$iy0,$iy2,$alt25,$ust25,$kgvar,$kgyok,$alt15,$ust15,$cf10,$cf12,$cf02,$tg01,$tg23,$tg45,$tg6t,$im11,$im10,$im12,$im01,$im00,$im02,$im21,$im20,$im22);
 $ok->execute();
}

echo "Toplam ".$toplamcekilen." Veri (Eklendi/Güncellendi)";
return;
