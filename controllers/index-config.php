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
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$urlClean = explode("/", rtrim($url));
$mainUrl = end($urlClean);
//set page
$_SESSION["page_dst"] = $mainUrl;
if(!isset($_SESSION["tanggal_crud"])){
    //status main
    $_SESSION["status_main"] = "belum ada";
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
//Searching set
if(isset($_POST["cari"])){
    $mahasiswa = search($_POST["keyword"]); // put keyword from input here
}


//management main index.php set config code
$conn = mysqli_connect('localhost', 'root', '', 'phpdasar');
$result = mysqli_query($conn, "SELECT * FROM guru");
$rows = [];
while($row = mysqli_fetch_assoc($result)){
    $rows [] = $row ;
}
$allGuruD = count($rows);
if(isset($_SESSION["delete_status"])){
    $resultDelete = (string) $_SESSION["delete_status"];
    unset($_SESSION["delete_status"]);
}
$createTotal = (int) $_SESSION["log_create"];
$updateTotal = (int) $_SESSION["log_update"];
$deleteTotal = (int) $_SESSION["log_delete"];
$chartTotalOperations = $createTotal + $updateTotal + $deleteTotal;
$i = (int) 1;
$id = $_SESSION["admin_account"] ?? 0;
    $dataRole = $_SESSION["role"] ?? "";
    if($dataRole === "" || $dataRole === "undefined" || $id === 0){
        header("Location: login.php");//auth checked
        exit;
    }
    if($dataRole === "key_admin"){
        $dataAdmin = query("SELECT * FROM superadmin WHERE id = $id")[0] ?? "";
    }else{
        $dataAdmin = query("SELECT * FROM users WHERE id = $id")[0] ?? "";
    }

?>