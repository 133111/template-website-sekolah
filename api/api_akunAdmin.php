<?php
if(session_start() === PHP_SESSION_NONE){
    session_start();
}
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");
//set api data
try{
    //init
    $role = $_SESSION["role"];
    $userName = $_SESSION["username"];
    $idAccount = $_SESSION["admin_account"];
    $isStatus = $_SESSION["login"];

    $apiWrap = [
        "role" => $role , 
        "usernameAdmin" => $userName, 
        "idAdmin" => $idAccount, 
        "status_login" => $isStatus
    ];
    if(!$apiWrap)
    {
        throw new Exception("error" . http_response_code(404));
    }
    $wrapFinal = json_encode($apiWrap);
    echo $wrapFinal ;

}catch(Exception $e){
    print_r("error:".$e->getMessage());
    return false ;
}
?>