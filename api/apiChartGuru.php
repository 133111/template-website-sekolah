<?php
//not used rn, chartApi for->index manajemen guru
//check session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");
    // main data
    $dataDummy = [ // temporer
        "create" => 19,
        "update" => 12,
        "delete" => 14
    ];
    if($dataDummy && $dataDummy !== null){
        htmlspecialchars($final = json_encode($dataDummy));
        if($final && $final !== null){
            echo $final ;
            return ;
        }
    }
?>