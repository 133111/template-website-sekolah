<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
header("Content-Type: application/json");
require_once __DIR__ . '/../config/functions.php';

$allData= query("SELECT * FROM mahasiswa");
$data = count($allData); // all Data

//init pagination of raw data
$dataPerPage = (int) 15;
$allNavigate = (int) ceil(($data / $dataPerPage)) ; //navigate amount totals
$active = $_GET["page"] ?? $_GET["page"] = 1 ;

$firstData = (int)($dataPerPage / $active) - (int)$dataPerPage ;
$result  = query("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT $firstData, $dataPerPage");
    $queryData = count($result);
//init && set data json
try{    
    $dataPagination = [
        "status" => http_response_code(200),
        "start" => 1,
        "pageActive" => $active,
        "navigate" => $allNavigate,
        "totalPerPage" => $dataPerPage,
        "dataAll" => $data,
        "dataQuery" => $queryData
    ];
}catch(Err){
    $dataPagination = [
        "status" => http_response_code(404),
        "content" => "data not found"
    ];
}

echo json_encode($dataPagination);

?>