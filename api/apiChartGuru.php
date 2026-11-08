<?php
//check session
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
header("Content-Type: application/json");
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