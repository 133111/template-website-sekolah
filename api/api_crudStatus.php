<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
header("Content-Type: application/json");
//api configure set init
//session data get
try{
    $all = [
        "create" => $_SESSION["log_create"],
        "update" => $_SESSION["log_update"],
        "delete" => $_SESSION["log_delete"]
    ];
    if(!$all){
        throw new Exception("no data found", http_response_code(404));
    }
}catch(Exception $e){
    echo"<script>console.log('error api crud status');</script>";
        $all = [
            "create" => 0,
            "update" => 0,
            "delete" => 0
        ];
}

echo json_encode($all);
?>