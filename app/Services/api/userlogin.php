<?php

date_default_timezone_set('Europe/Istanbul');
include '../dbConfig.php';


//$json = file_get_contents("php://input");
//$data = json_decode($json, true);
$email= $_GET['email'];
$token= $_GET['token'];
$tr = date("d-m-Y");

$savedata = $conn->query("insert into ulogin (tarih) VALUES ('$tr')");

$userData = $conn->query("SELECT * FROM users WHERE email = '".$email."' and token = '".$token."'");
$userExist = mysqli_num_rows($userData);
$userData = mysqli_fetch_assoc($userData);
$nm = $userData['isim'];
$em = $userData['email'];
$pr = $userData['pre'];
$bn = $userData['ban'];
$tk = $userData['token'];


if ($userExist == "1"){
$arr = array("status"=>"Success", "u_name"=>"".$nm."" , "u_mail"=>"".$em."" , "u_abone"=>"".$pr."" , "u_ban"=>"".$bn."" , "u_token"=>"".$token."");
echo json_encode($arr);
}else{
$arr = array("status"=>"Failed");
echo json_encode($arr);
}

?>

