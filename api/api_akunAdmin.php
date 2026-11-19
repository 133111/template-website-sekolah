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
            "message" => "method invalid",
            "code" => http_response_code(403)
        ];
    }else{
        $role = trim(strip_tags($_SESSION["role"]));
        $userName = trim(strip_tags($_SESSION["username"]));
        $idAccount = trim(strip_tags($_SESSION["admin_account"]));
        $isStatus = trim(strip_tags($_SESSION["login"]));
        $apiWrap = [
            "role" => $role , 
            "usernameAdmin" => $userName, 
            "idAdmin" => $idAccount, 
            "status_login" => $isStatus,
            "status" => http_response_code(200)
        ];
        if(!$apiWrap || !is_array($apiWrap))
        {
            throw new Exception("error" . http_response_code(404));
        }
    }
    $wrapFinal = json_encode($apiWrap);
    echo $wrapFinal ;
}catch(Exception $e){
    print_r("error:".$e->getMessage());
    exit ;
}
?>