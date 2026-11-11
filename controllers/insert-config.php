<?php
date_default_timezone_set("Asia/Jakarta");
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
//manajemen crud define
$today = date("d M Y");
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
require __DIR__ . '/../config/functions.php'; //merge string
//end

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

//konversi POST
$pm_post = $_POST;
$timestamp = date("H:i:s");
if(isset($pm_post["submit"])){  //if submit has "submit"
    //notification of result
       //inisialisasi argumen fungsi
    if(tambah($pm_post) > 0){ //inisialisasi fungsi dan argumen untuk parameter langsung di dalam if
        //$pm_post sebagai argumen dari parameter $datainsert    
        unset($_SESSION["status_main"]);
        $_SESSION["log_create"] += 1;
        $_SESSION["clock-insert"] = $timestamp;
        $_SESSION["insert_status"] = 'true';
        $_SESSION["status_main"] = "success";
    }else{
        $_SESSION["insert_status"] = 'false';
        $_SESSION["status_main"] = "error";
    }
}

?>