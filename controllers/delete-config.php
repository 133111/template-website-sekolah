<?php
//session section
date_default_timezone_set("Asia/Jakarta");
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION["login"])){
    //redirect to login page 
    header("Location: login.php");
    exit;
}
//end
//crud status manajemen :
$today = date("d M Y");
$timestamp = date("H:i:s");
if(!isset($_SESSION["tanggal_crud"])){
    $_SESSION["tanggal_crud"] = $today;
    $_SESSION["log_create"] = 0;
    $_SESSION["log_update"] = 0;
    $_SESSION["log_delete"] = 0;

    $_SESSION["clock-insert"] = "00:00:00";
    $_SESSION["clock-delete"] = "00:00:00";
    $_SESSION["clock-update"] = "00:00:00";
}

// ----------> Call config/functions Bellow<----------
require __DIR__ . '/../config/functions.php';
//end

if(isset($_GET["id"]) ?? ''){
    $hasil = $_GET["id"];

    // $hasil = $_GET["id"];
        if (hapus($hasil) > 0){  
            unset($_SESSION["status_main"]);
            $_SESSION["log_delete"] += 1;
            $_SESSION["clock-delete"] = $timestamp;
            $_SESSION["delete_status"] = "sukses";
            $_SESSION["status_main"] = "success";
            }else{
                $_SESSION["delete_status"] = "gagal";
                $_SESSION["status_main"] = "error";
                error_log("false delete" . PHP_EOL, 3, "log_service_insert.log");
                }
}
?>
