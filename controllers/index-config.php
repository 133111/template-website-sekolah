<?php
//session section
date_default_timezone_set("Asia/Jakarta");
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
//otorisasi
if(isset($_SESSION["role"]) && $_SESSION["role"] == "superadmin"){
    $_SESSION["role"] = "key_admin" ; //unlock key_admin as superadmin
}// else $_SESSION["role"] = "user"
$today = date("d M Y"); //realtime crud status
if(!isset($_SESSION["tanggal_crud"])){
    $_SESSION["tanggal_crud"] = $today; //reset after 24h 
    $_SESSION["log_create"] = 0;
    $_SESSION["log_update"] = 0;
    $_SESSION["log_delete"] = 0;

    $_SESSION["clock-insert"] = "00:00:00";
    $_SESSION["clock-delete"] = "00:00:00";
    $_SESSION["clock-update"] = "00:00:00";
}
$active = $_GET["page"] ?? $_GET["page"] = 1 ;
// helpers caller
require_once __DIR__ . '/../config/functions.php';

$allData= query("SELECT * FROM mahasiswa");
$semuaData = count($allData) ; //fetched all data

//fetch data admin
$admin = [0];
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
    while($dataAdmin = mysqli_fetch_assoc($result)){
        $admin [] = $dataAdmin;
    }
    $totalAdmin = count($admin);

//pagination configure set  :
//init  :
$dataPerPage = (int) 15;
    $totalNavigate = (int) ceil(($semuaData/$dataPerPage)); //navigate totals
    $isActivePageRaw = $_GET["page"] ?? $_GET["page"] = 1;
    $isActivePage = htmlspecialchars($isActivePageRaw); //from url based
        $firstData = (int) ($dataPerPage * $isActivePage) - (int) $dataPerPage;
$allData2= query("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT $firstData, $dataPerPage"); //limit 15 fetch
    $mahasiswa = $allData2 ; 
    $jumlah = count($mahasiswa); //count all data from fetch

//Searching 
if(isset($_POST["cari"])){
    $mahasiswa = search($_POST["keyword"]); // put keyword from input here
}

?>