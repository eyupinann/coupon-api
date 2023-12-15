<?php

include '../dbConfig.php';
error_reporting(0);

$begin = new DateTime( "-1 day" );
$end   = new DateTime();

function sisle($mid , $hskr , $askr , $ihskr , $iaskr){

	global $conn;
    $litem = $conn->query("SELECT * FROM maclar where macid = '$mid' and islem = 0");
	$row = $litem->fetch_assoc();
	$tahmin = $row['tahmin'];
    $iys = $ihskr . ":" . $iaskr;
    $mss = $hskr . ":" . $askr;

    $durum = array();

    if($litem->num_rows >= 1){

    
    if($hskr > $askr){			
        $durum[] = 'MS 1';
        $durum[] = 'ÇŞ 1/0';
        $durum[] = 'ÇŞ 1/2';
    }else if($hskr == $askr){			
        $durum[] = 'MS 0';
        $durum[] = 'ÇŞ 1/0';
        $durum[] = 'ÇŞ 0/2';
    }else if($hskr < $askr){			
        $durum[] = 'MS 2';
        $durum[] = 'ÇŞ 1/2';
        $durum[] = 'ÇŞ 0/2';
    }

    if($ihskr > $iaskr){			
        $durum[] = 'İY 1';
    }else if($ihskr == $iaskr){			
        $durum[] = 'İY 0';
    }else if($ihskr < $iaskr){			
        $durum[] = 'İY 2';
    }

    if($hskr > 0 && $askr > 0){			
        $durum[] = 'KG Var';
    }else if($homeskr <= 0 || $awayskr <= 0){
        $durum[] = 'KG Yok';
    }

    if($hskr + $askr > 5){			
        $durum[] = '5.5 Üst';
        $durum[] = '4.5 Üst';
        $durum[] = '3.5 Üst';
        $durum[] = '2.5 Üst';
        $durum[] = '1.5 Üst';
        $durum[] = '0.5 Üst';
        $durum[] = 'Toplam Gol 0-1';
        $durum[] = 'Toplam Gol 2-3';
        $durum[] = 'Toplam Gol 4-5';
        $durum[] = 'Toplam Gol 6+';
    }else if($hskr + $askr > 4){			
        $durum[] = '4.5 Üst';
        $durum[] = '3.5 Üst';
        $durum[] = '2.5 Üst';
        $durum[] = '1.5 Üst';
        $durum[] = '0.5 Üst';
        $durum[] = 'Toplam Gol 0-1';
        $durum[] = 'Toplam Gol 2-3';
        $durum[] = 'Toplam Gol 4-5';
     }else if($hskr + $askr > 3){			
        $durum[] = '3.5 Üst';
        $durum[] = '2.5 Üst';
        $durum[] = '1.5 Üst';
        $durum[] = '0.5 Üst';
        $durum[] = 'Toplam Gol 0-1';
        $durum[] = 'Toplam Gol 2-3';
        $durum[] = 'Toplam Gol 4-5';
    }else if($hskr + $askr > 2){			
        $durum[] = '2.5 Üst';
        $durum[] = '1.5 Üst';
        $durum[] = '0.5 Üst';
        $durum[] = 'Toplam Gol 0-1';
        $durum[] = 'Toplam Gol 2-3';  
    }else if($hskr + $askr > 1){			
        $durum[] = '1.5 Üst';
        $durum[] = '0.5 Üst';
        $durum[] = 'Toplam Gol 0-1';
        $durum[] = 'Toplam Gol 2-3'; 
    }else if($hskr + $askr > 0){			
        $durum[] = '0.5 Üst';
        $durum[] = 'Toplam Gol 0-1';
    }

    if($hskr + $askr < 1){			
        $durum[] = '5.5 Alt';
        $durum[] = '4.5 Alt';
        $durum[] = '3.5 Alt';
        $durum[] = '2.5 Alt';
        $durum[] = '1.5 Alt';
        $durum[] = '0.5 Alt';
    }else if($hskr + $askr < 2){
        $durum[] = '5.5 Alt';
        $durum[] = '4.5 Alt';
        $durum[] = '3.5 Alt';
        $durum[] = '2.5 Alt';
        $durum[] = '1.5 Alt';
    }else if($hskr + $askr < 3){	
        $durum[] = '5.5 Alt';
        $durum[] = '4.5 Alt';
        $durum[] = '3.5 Alt';
        $durum[] = '2.5 Alt';
    }else if($hskr + $askr < 4){
        $durum[] = '5.5 Alt';
        $durum[] = '4.5 Alt';
        $durum[] = '3.5 Alt';
    }else if($hskr + $askr < 5){
        $durum[] = '5.5 Alt';
        $durum[] = '4.5 Alt';
    }else if($hskr + $askr < 6){
        $durum[] = '5.5 Alt';
    }

      if($ihskr > $iaskr && $hskr == $askr){			
        $durum[] = 'İY/MS 1/0';
      }else if($ihskr > $iaskr && $hskr > $askr){			
        $durum[] = 'İY/MS 1/1';
      }else if($ihskr > $iaskr && $hskr < $askr){			
        $durum[] = 'İY/MS 1/2';
      }else if($ihskr == $iaskr && $hskr == $askr){			
        $durum[] = 'İY/MS 0/0';
      }else if($ihskr == $iaskr && $hskr < $askr){			
        $durum[] = 'İY/MS 0/2';
      }else if($ihskr == $iaskr && $hskr > $askr){			
        $durum[] = 'İY/MS 0/1';
      }else if($ihskr < $iaskr && $hskr < $askr){			
        $durum[] = 'İY/MS 2/2';
      }else if($ihskr < $iaskr && $hskr > $askr){			
        $durum[] = 'İY/MS 2/1';
      }else if($ihskr < $iaskr && $hskr == $askr){			
        $durum[] = 'İY/MS 2/0';
      }

      print_r($durum);

      $buldum = false;
      for ($k = 0; $k < count($durum); $k++) {
    
         if($tahmin == $durum[$k]) {
            $query = $conn->query("UPDATE maclar set durum = 'Kazandı' , iy ='$iys', ms='$mss' , islem = 1 where macid = '$mid'");
            $buldum = true;
         }else if(!$buldum){
             $query = $conn->query("UPDATE maclar set durum = 'Kaybetti' , iy ='$iys', ms='$mss' , islem = 1 where macid = '$mid'");
          }
    
      }
	
    }

}

function getir($url){
    $ch = curl_init();
    $user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch,CURLOPT_USERAGENT,$user_agent);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


for($i = $begin; $i <= $end; $i->modify('+1 day')){

            
		$ix = $i->format('Y-m-d');
		
		$url    = "https://www.birebin.com/api/stats/GetFinalResults?StartDate=$ix";
        $urlget = getir($url);
		$data   = json_decode($urlget);
				

        if($data->Success == true){

            foreach($data->Result as $key => $value){

                if($value->sportId == 1 && $value->results[0]->code == 'FT'){

                    $mtid = $value->eventId;
                    $fth = $value->results[0]->scoreParticipant1;
                    $fta = $value->results[0]->scoreParticipant2;

                    $hth = $value->results[1]->scoreParticipant1;
                    $hta = $value->results[1]->scoreParticipant2;

                    sisle($mtid , $fth , $fta , $hth , $hta);


                }
            }
        }
        //print_r($data);
       

}

		
		
