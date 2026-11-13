<?php
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$cleaner = explode("/", rtrim($url));
$main_url = end($cleaner);
//routes logic-1 -for all navigation on sidebar
switch ($main_url){
    case "guru" :
        require __DIR__ . "/../dashboard/manajemen-guru/index.php";
        exit();
    case "profile-admin" :
        require __DIR__ . "/../dashboard/profile-admin/index.php";
        exit();
    case "daftar-admin" :
        require __DIR__ . "/../dashboard/daftar-admin/index.php";
        exit();
    case "laporan" :
        require __DIR__ . "/../dashboard/laporan/index.php";
        exit();
    case "pengaturan" :
        require __DIR__ . "/../dashboard/pengaturan/index.php";
        exit();
    case "home" :
        require __DIR__ . "/../dashboard/home/index.php";
        exit();
    case "logout" : 
        require __DIR__ . "/../dashboard/logout.php";
        exit();
}
//routes 2
$url2 = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$cleaner2 = rtrim($url2, "/");
$path = explode("/", $cleaner2);
$main_url2 = end($path);
//engine :
switch ($main_url2){
    case "update-siswa" :
        //get url
        $id = $_GET["id"] ?? "index";
        if($id == $_GET["id"]){
            include_once __DIR__ . "/../dashboard/update.php";
        }
        exit();
    case "hapus-siswa" :
        //get id hapus ;
        $hasil = $_GET["id"];
        if($hasil == $_GET["id"]){
            include_once __DIR__ . "/../dashboard/hapus.php";
        }
        exit();
    case "tambah-siswa" :
        include_once  __DIR__ . "/../dashboard/tambah.php";
        exit();
}
//routes 3
//get section merge on routes 2
//routes engine for update and delete-guru. direction [3-case]:
switch ($main_url2){
    case "update-guru" :
        //get url
        $id = $_GET["id"] ?? "index";
        if($id == $_GET["id"]){
            include_once __DIR__ . "/../dashboard/manajemen-guru/update-guru.php";
        }
        exit();
    case "hapus-guru" :
        //get id hapus ;
        $id = $_GET["id"];
        if($id == $_GET["id"]){
            include_once __DIR__ . "/../dashboard/manajemen-guru/hapus.php";
        }
        exit();
    case "tambah-guru" :
        include_once  __DIR__ . "/../dashboard/manajemen-guru/tambah.php";
        exit();
}
//has fixed
?>