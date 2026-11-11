<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
date_default_timezone_set('Asia/Jakarta');
//manajemen crud define
$today = date("d M Y");
if(!isset($_SESSION["tanggal_crud"])){
    $_SESSION["tanggal_crud"] = $today;
    $_SESSION["log_create"] = 0;
    $_SESSION["log_update"] = 0;
    $_SESSION["log_delete"] = 0;

    $_SESSION["clock-insert"] = "nothing";
    $_SESSION["clock-delete"] = "nothing";
    $_SESSION["clock-update"] = "nothing";
}


// ----------> Call config/functions Bellow<----------
require __DIR__ . '/../config/functions.php';
//end

//GET id
$id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($id) ? (int)$id : 0);
$mhs = $id > 0 ? (query("SELECT * FROM mahasiswa WHERE id = $id")[0] ?? []) : [];
$timestamp = date("H:i:s");
if(isset($_POST["submit"])){  
    if(update($_POST) > 0){ 
        $_SESSION["log_update"] += 1 ;
        unset($_SESSION["status_main"]);
        $_SESSION["clock-update"] = $timestamp;
        $_SESSION["status_update"] = 'sukses' ;
        $_SESSION["status_main"] = "success";
    }else{
        $_SESSION["status_update"] = 'gagal' ;
        $_SESSION["status_main"] = "error";
    }
}

?>