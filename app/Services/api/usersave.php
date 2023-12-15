<?php

date_default_timezone_set('Europe/Istanbul');
include '../dbConfig.php';


$json = file_get_contents("php://input");
$data = json_decode($json, true);

$email = $data['email'];
$name = $data['name'];
$token = $data['token'];
$tr = date("d-m-Y");

$savedata = $conn->query("insert into ulogin (tarih) VALUES ('$tr')");


$userData = $conn->query("SELECT * FROM users WHERE email = '".$email."'");
$userExist = mysqli_num_rows($userData);
$userDatas = mysqli_fetch_assoc($userData);
$nm = $userDatas['isim'];
$em = $userDatas['email'];
$pr = $userDatas['pre'];
$bn = $userDatas['ban'];
$tk = $userDatas['token'];


if ($userExist == "1"){
$arr = array("status"=>"Success", "u_name"=>"".$nm."" , "u_mail"=>"".$em."" , "u_abone"=>"".$pr."" , "u_ban"=>"".$bn."" , "u_token"=>"".$token."");
//Egemen start.
$savedata = $conn->query("UPDATE users SET token='".$token."' WHERE email = '".$email."'");
//Egemen end.
echo json_encode($arr);
}else{
$savedata = $conn->query("insert into users (ktarih,isim,email,pre,ban,token) VALUES ('$tr','$name','$email','false','false','$token')");
if($savedata){
$arr = array("status"=>"Success", "u_name"=>"".$name."" , "u_mail"=>"".$email."" , "u_abone"=>"false" , "u_ban"=>"false" , "u_token"=>"".$token."");
echo json_encode($arr);
die();
}else{
$arr = array("status"=>"Failed");
echo json_encode($arr);
}
}

?>

