<?php
//fitur registe only for superadmin
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
//set api data
try{
    //init
    $method = $_SERVER["REQUEST_METHOD"]; //check
    if($method !== "GET"){
        $apiWrap = [
            "message" => "method invalid, data tidak bisa ditampilkan",
            "code" => http_response_code(403)
        ];
        die;
    }else{
        $role = trim(strip_tags($_SESSION["role"] ?? "not found"));
        $userName = trim(strip_tags($_SESSION["username"] ?? "not found")) ;
        $idAccount = trim(strip_tags($_SESSION["admin_account"] ?? "not found"));
        $isStatus = trim(strip_tags($_SESSION["login"] ?? false));
        (array) $apiWrap = [
            "message" => "data admin terambil",
            "role" => $role , 
            "usernameAdmin" => $userName, 
            "idAdmin" => $idAccount, 
            "status_login" => $isStatus,
            "status" => http_response_code(200)
        ];
        if(!$apiWrap || !is_array($apiWrap) || !$isStatus)
        {
            $apiWrap = [
                "message" => "terdapat error invalid, api tidak mereturn data valid!",
                "status" => false,
                "code" => 404
            ];
            throw new Exception();
        }
    }
    $wrapFinal = json_encode($apiWrap, JSON_PRETTY_PRINT);
    echo $wrapFinal ;
}catch(Exception $e){
    $wrapFinal = json_encode($apiWrap, JSON_PRETTY_PRINT);
    echo $wrapFinal;
    exit ;
}
?>