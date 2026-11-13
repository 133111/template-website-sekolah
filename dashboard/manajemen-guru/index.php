<?php
// session section
date_default_timezone_set("Asia/Jakarta");
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION["login"])){
    header("Location: ../login.php");
    exit;
}
define("BASE_URL", "/school-dashboard-template"); //set const
// call helpers and controllers
include_once __DIR__ . '/../../public/routes.php';
require_once __DIR__ . '/../../config/functions.php';
include_once __DIR__ . '/../../controllers/manajemen-guru/index.php';

// initialize realtime crud status if not set
$today = date("d M Y");
$timestamp = date("H:i:s");
if(!isset($_SESSION["tanggal_crud"])){
    $_SESSION["tanggal_crud"] = $today;
    $_SESSION["log_create"] = 0;
    $_SESSION["log_update"] = 0;
    $_SESSION["log_delete"] = 0;

    $_SESSION["clock-insert"] = "nothing";
    $_SESSION["clock-delete"] = "nothing";
    $_SESSION["clock-update"] = "nothing";
}

// Handle delete via GET if triggered by modal
if(isset($_GET["id"]) && !empty($_GET["id"])){
    $idHapus = (int)$_GET["id"];
    $guruObj = new Guru;
    if($guruObj->hapusGuru($idHapus) > 0){
        $_SESSION["log_delete"] += 1;
        $_SESSION["clock-delete"] = $timestamp;
        $_SESSION["delete_status"] = "sukses";
    }else{
        $_SESSION["delete_status"] = "gagal";
    }
}

$resultDelete = '';
if(isset($_SESSION["delete_status"])){
    $resultDelete = $_SESSION["delete_status"];
    unset($_SESSION["delete_status"]);
}

$Guru = new Guru;
// Fetch teachers data
$dataGuru = $Guru->lihatGuru();

// Search Component
if(isset($_POST["cari"]) && !empty(trim($_POST["keyword"] ?? ''))){
    $keyword = htmlspecialchars(trim($_POST["keyword"]));
    $dataGuru = search2($keyword); 
}

// Counts for dashboard cards
$allGuruAll = $Guru->fetchAll("SELECT * FROM guru");
$allGuruD = count($allGuruAll);
$jumlah = count($dataGuru);

$allMahasiswa = $Guru->fetchAll("SELECT * FROM mahasiswa");
$semuaData = count($allMahasiswa);

$allAdmins = $Guru->fetchAll("SELECT * FROM users");
$totalAdmin = count($allAdmins);

$idAdmin = (int) ($_SESSION["admin_account"] ?? 0);
if(($_SESSION["role"] ?? "") === "key_admin"){
    $adminRows = query("SELECT * FROM superadmin WHERE id = $idAdmin");
}else{
    $adminRows = query("SELECT * FROM users WHERE id = $idAdmin");
}
$dataAdmin = $adminRows[0] ?? ["username" => "Admin"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Guru</title>
    <link rel="stylesheet" href="../view/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- chart of crud statistic -->
</head>

<body>
<!-- Modal Konfirmasi Hapus (Neobrutalism) -->
<div id="modal-delete" class="main-modal-delete opacity-0 transition-opacity duration-500 pointer-events-none fixed flex items-center justify-center z-[200] bg-[#08090B]/65 inset-0">
    <div class="main-content-modal-delete bg-white w-[90%] max-w-[420px] rounded-[16px] border-2 border-[#08090B] shadow-[6px_6px_0px_#08090B] flex flex-col gap-4" style="padding:24px 26px">
        <div class="modal1 flex items-center gap-[14px]">
            <div class="svg-notif-icons-delete flex justify-center items-center shrink-0">
                <div id="bg-svg" class="bg-[#FF4D6D] flex items-center justify-center w-12 h-12 rounded-[10px] border-2 border-[#08090B] shadow-[1px_1px_0px_#08090B]">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" id="svg_delete" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
            </div>
            <div class="header">
                <h2 id="h2" class="text-[17px] font-extrabold text-[#08090B]">Konfirmasi Hapus</h2>
                <p id="p" class="text-[11px] font-semibold text-[#6B7280] uppercase tracking-[0.5px]">SIMS - SMK 1 NGAWI</p>
            </div>
        </div>
        <div class="modal2 bg-[#F8F9FA] border border-[#08090B] rounded-[8px] flex items-center !h-[5rem] !p-[8px] px-[14px] py-[10px]">
            <p class="text-[13.5px] leading-[1.5] font-medium text-[#374151]" id="p-long">Apakah Anda yakin ingin menghapus data guru <strong id="span-name">ini</strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal3 button-section !h-[2rem] flex justify-end gap-[10px] mt-1">
            <button id="cancel" class="cursor-pointer btn-cancel bg-white hover:bg-[#F8F9FA] border-2 border-[#08090B] shadow-[3px_3px_0px_#08090B] hover:shadow-[4px_5px_0px_#08090B] hover:-translate-x-px hover:-translate-y-px active:shadow-[1px_1px_0px_#08090B] active:translate-x-px active:translate-y-px transition-all duration-150 text-[#08090B] font-bold text-[13px] rounded-[8px] px-5 py-[9px] min-w-[6rem]">Batal</button>
            <button id="delete" class="cursor-pointer btn-hapus bg-[#EF4444] hover:bg-[#DC2626] border-2 border-[#08090B] shadow-[3px_3px_0px_#08090B] hover:shadow-[4px_5px_0px_#08090B] hover:-translate-x-px hover:-translate-y-px active:shadow-[1px_1px_0px_#08090B] active:translate-x-px active:translate-y-px transition-all duration-150 text-white font-bold text-[13px] rounded-[8px] px-5 py-[9px] min-w-[6rem]">Hapus</button>
        </div>
    </div>
</div>

<!-- Main Wrapper of Grid -->
<div id="wrapper" class="wrapper">
    <!-- Sidebar -->
    <aside class="side-bar">
        <div id="main-sidebar" class="main-side-bar">
            <div class="header">
                <div class="welcome-bar-dashboard">
                    <div class="absolute-content">
                        <div class="card-photo rounded-[22px] relative right-1">
                            <img class="rounded-[90px]" src="../view/assets/logo2rev.png" alt="#">
                        </div>
                        <div class="admin-text">
                            <p>Panel Admin</p>
                            <div class="general-text !text-[13px]">
                                <p>Manajemen Sekolah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-menu">
                <div class="content-header-menu relative !top-1">
                    <p>MENU UTAMA</p>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="siswa" style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                <p style="display:flex; align-items:center;">Manajemen Siswa</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu active">
                    <div class="anchor">
                        <a href="guru" style="font-size:13px ;" onclick="window.__sorotan='guru'">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="20">
                                    <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                    <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                </svg>
                                <p style="display:flex; align-items:center;" class="!font-['poppins', sans-serif]">Manajemen Guru</p>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Separator -->
                <div class="content-header-menu">
                    <p>PENGATURAN</p>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="profile-admin" style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="20">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                </svg>
                                <p style="display:flex; align-items:center;" class="relative left-[1px]">Profile Admin</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="daftar-admin">
                        <a href="daftar-admin" style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg class="relative left-[3px]" xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <p style="display:flex; align-items:center;" class="relative left-[5px]">Daftar Admin</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="laporan" style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg class="relative left-[2px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="20">
                                    <path fill-rule="evenodd" d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 0 1-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0 1 13.5 1.5H15a3 3 0 0 1 2.663 1.618ZM12 4.5A1.5 1.5 0 0 1 13.5 3H15a1.5 1.5 0 0 1 1.5 1.5H12Z" clip-rule="evenodd" />
                                    <path d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 0 1 9 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0 1 16.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625v-12Z" />
                                    <path d="M10.5 10.5a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963 5.23 5.23 0 0 0-3.434-1.279h-1.875a.375.375 0 0 1-.375-.375V10.5Z" />
                                </svg>
                                <p style="display:flex; align-items:center;" class="relative left-[5px]">Laporan</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="pengaturan" style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg class="relative left-[3px]" xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                    <circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>
                                <p style="display:flex; align-items:center;" class="relative left-[5px]">Pengaturan</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="home" target="_blank" style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg class="relative left-[3px]" xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <p style="display:flex; align-items:center;" class="relative left-[5px]">Home</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="logout-section">
                    <div class="logout flex flex-col justify-start gap-2">
                        <div class="main-logout-svg flex justify-between items-center relative right-[2%]">
                            <a href="logout" class="flex justify-start items-center w-full h-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" lass="opacity-80" width="22" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                                <p class="text-[11px] text-white relative left-2 font-medium opacity-90">Help & information</p>
                            </a>
                        </div>
                        <div class="main-logout-svg flex justify-between items-center relative right-[1%]">
                            <a href="logout" class="flex justify-start items-center relative top-2 w-full h-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="opacity-80 relative left-[1px]" width="20" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <p class="text-[11px] text-red-400/85 relative left-2 font-semibold opacity-90">Log out</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Hero Header -->
        <div class="wrapper-hero-header">
            <div class="float-not">
                <div class="hero-header">
                    <div class="content-hero-header flex justify-between gap-2"">
                        <div class="hero-header-se1">
                            <div id="toggle-sidebar" class="svg-1 relative left-[4px] border border-[#08090B] shadow-[-2px_2px_#08090B] hover:bg-[rgba(239,232,239,0.8)] cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="pointerPage flex w-[220px] flex items-center gap-2">
                            <h3 class="text-[16px] relative font-semibold left-2">Dashboard</h3>
                            <span class="relative left-1">
                                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            </span>
                            <p class="font-medium hover:text-[#08090B] transition-all duration-300 cursor-pointer">Guru</p>
                        </div>
                    </div>
                    <div class="account-hero-header">
                        <div class="notif-icons-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="account-img-hero-header cursor-pointer rounded-full transition-colors duration-400 ease-in-out">
                            <div id="main-menu" class="main-menu flex">
                                <div class="main-img-hero-header flex justify-center items-center bg-[#4ADE80] relative border border-[#08090B] shadow-[-2px_2px_#08090B] relative right-[5px] rounded-[25px]">
                                    <div class="img-profileOnHeader w-[45px] text-center">
                                        <strong class="text-[26px] text-[#08090B]"><?= strtoupper(substr($dataAdmin["username"] ?? "Admin", 0, 1)) ;?></strong>
                                    </div>
                                </div>
                                <div class="hero-text-img">
                                    <div class="main-hero-text-img">
                                        <p class="font-semibold flex items-center">SMK N 1 NGAWI 
                                        <span class="flex items-center relative top-1 left-[3px]">
                                            <svg class="w-[20px] h-[20px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </p>
                                    </div>
                                    <div class="second-hero-text-img">
                                        <p>Administrator</p>
                                    </div>
                                </div>
                            </div>
                            <div id="sub-menu" class="sub-menuMain1 hidden sub-menu absolute top-[3.4rem] left-[20%] z-20 bg-[#FFFEFE] !backdrop-blur rounded-b-[8px] shadow-[-2px_3px_#08090B] w-[80%] h-[30px]">
                                <div class="main-logout-svg flex justify-between items-center relative right-[1%]">
                                    <a href="logout" class="flex justify-start items-center relative top-2 w-full h-full p-2">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="relative left-3" width="16" height="18" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                       <p class="text-[11px] text-red-600 relative left-4 font-semibold ">Log out</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Body -->
        <div class="main-content">
            <div class="hyperlinkOverview w-full h-[75px] relative left-4 bottom-2 gap-4 !font-poppins">
                <div class="mainContentOverview h-[50%] w-[30%] ">
                    <h2 class="text-[24px] font-medium">Manajemen Guru</h2>
                </div>
                <div class="paragraph h-[40%] w-[80%]">
                    <p class="text-[14px]">Halaman menu manajemen guru, mengatur data guru sekolah.</p>
                </div>
            </div>
            <!-- Items Card Above Search Bar --> 
            <div class="wrapper-allitems w-full flex justify-center relative bottom-2">
                <div class="all-items flex justify-center items-center w-[95%] gap-[5px]">
                    <div class="card-section-items">
                        <div class="first-section">
                            <div class="slider-card">
                                <div class="card-items">
                                    <h6 class="!text-[11px] font-semibold">TOTAL SISWA</h6>
                                    <div class="main-text-img bg-[#A7F3D0]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                                    </div>
                                    <p class="!text-[24px] !font-extrabold !text-slate-800 !font-sora"><?= $semuaData ?></p>
                                    <p style="position:absolute; bottom:0.8rem; left:18px; font-size:11px;" class="text-black font-semibold">Total murid</p>
                                </div>
                            </div>

                            <div class="slider-card">
                                <div class="card-items">
                                    <h6 class="!text-[11px] font-semibold">TOTAL JURUSAN</h6>
                                    <div class="main-text-img bg-[#FDE047]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                    </div>
                                    <p class="!text-[24px] !font-extrabold !font-sora text-black">9</p>
                                    <p style="position:absolute; bottom:0.8rem; left:18px; font-size:11px;" class="text-black font-semibold">Total keahlian</p>
                                </div>
                            </div>
                        </div>

                        <div class="second-section">
                            <div class="slider-card">
                                <div class="card-items">
                                    <h6 class="!text-[11px] font-semibold">TOTAL GURU</h6>
                                    <div class="main-text-img bg-[#7DD3FC]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                                    </div>
                                    <p class="!text-[24px] !font-extrabold !text-slate-800 !font-sora"><?= $allGuruD ?></p>
                                    <p style="position:absolute; bottom:0.8rem; left:18px; font-size:11px;" class="text-black font-semibold">Total pengajar</p>
                                </div>
                            </div>

                            <div class="slider-card">
                                <div class="card-items">
                                    <h6 class="!text-[11px] font-semibold">TOTAL ADMIN</h6>
                                    <div class="main-text-img bg-[#DDD6FE]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    </div>
                                    <p class="!text-[24px] !font-extrabold !text-slate-800 !font-sora"><?= $totalAdmin; ?></p>
                                    <p style="position:absolute; bottom:0.8rem; left:18px; font-size:11px;" class="text-black font-semibold">Total admin</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="second-section-card-items p-2 rounded-[12px] overflow-hidden relative">
                        <div class="main-wrapper-section-card flex items-center gap-3 w-full h-full">
                            <!-- Card Status Manajemen -->
                            <div class="kartu-1 w-[40%] h-[96%] rounded-[12px] overflow-hidden relative">
                                <div class="konten-kartu1 h-full w-full !p-2">
                                    <h1 class="text-black font-bold text-[14px]">Status Manajemen</h1>
                                    <div class="day-status flex justify-between items-center mt-1">
                                        <p class="text-black text-[11px] font-medium opacity-80">Activity in 24h</p>
                                        <p class="text-[11px] text-black font-semibold"><?= date("d/m/y"); ?></p>
                                    </div>
                                    <div class="wrapper-4card relative flex justify-center items-center flex-col !mt-4 w-full gap-3">
                                        <div class="card-of-1 overflow-hidden text-black text-[13px] !p-2 flex items-center h-[38px] w-full rounded-[8px]">
                                            <div class="wrapper-bg-svg bg-[#00F59B] w-6 h-6 rounded-[6px] flex justify-center items-center shrink-0">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#08090B">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                                </svg>
                                            </div>
                                            <div class="card-info-wrap flex justify-between w-full ml-2">
                                                <div class="relative left-1">
                                                    <strong class="text-black text-[12px]">Create</strong>
                                                    <span class="text-black text-[9px] opacity-75 ml-1">Last: <?= $_SESSION["clock-insert"] ?? 'nothing'; ?></span> 
                                                </div>   
                                                <span class="text-emerald-600 font-extrabold text-[13px]">+<?= $_SESSION["log_create"] ?? 0; ?></span>
                                            </div>
                                        </div>
                                        <div class="card-of-1 overflow-hidden text-black text-[13px] !p-2 flex items-center h-[38px] w-full rounded-[8px]">
                                            <div class="wrapper-bg-svg bg-[#EF4444] w-6 h-6 rounded-[6px] flex justify-center items-center shrink-0">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#08090B">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                            </div>
                                            <div class="card-info-wrap flex justify-between w-full ml-2">
                                                <div class="relative left-1">
                                                    <strong class="text-black text-[12px]">Delete</strong>
                                                    <span class="text-black text-[9px] opacity-75 ml-1">Last: <?= $_SESSION["clock-delete"] ?? 'nothing'; ?></span> 
                                                </div>   
                                                <span class="text-rose-600 font-extrabold text-[13px]">-<?= $_SESSION["log_delete"] ?? 0; ?></span>
                                            </div>
                                        </div>
                                        <div class="card-of-1 overflow-hidden text-black text-[13px] !p-2 flex items-center h-[38px] w-full rounded-[8px]">
                                            <div class="wrapper-bg-svg bg-[#F59E0B] w-6 h-6 rounded-[6px] flex justify-center items-center shrink-0">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#08090B">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                </svg>
                                            </div>
                                            <div class="card-info-wrap flex justify-between w-full ml-2">
                                                <div class="relative left-1">
                                                    <strong class="text-black text-[12px]">Update</strong>
                                                    <span class="text-black text-[9px] opacity-75 ml-1">Last: <?= $_SESSION["clock-update"] ?? 'nothing'; ?></span> 
                                                </div>   
                                                <span class="text-amber-600 font-extrabold text-[13px]"><?= $_SESSION["log_update"] ?? 0; ?></span>
                                            </div>
                                        </div>
                                        <div class="card-of-1 overflow-hidden text-black text-[13px] !p-2 flex items-center h-[38px] w-full rounded-[8px]">
                                            <div class="wrapper-bg-svg bg-[#22C55E] w-6 h-6 rounded-[6px] flex justify-center items-center shrink-0">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#08090B">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </div>
                                            <div class="card-info-wrap flex justify-between w-full ml-2">
                                                <strong class="text-black text-[12px] relative left-1">Status</strong>
                                                <span class="text-emerald-700 font-semibold text-[10px]">Sistem Normal</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Status Sekolah -->
                            <div class="kartu-1 w-[50%] h-[96%] !p-2 rounded-[12px] overflow-hidden relative flex flex-col border-1 gap-2 !bg-[#FFFEFE]">
                                <div class="heroTextCanvas relative top-2 border-b border-[#08090b40] !p-1">
                                    <div class="wrapperSvg flex items-center gap-1 relative bottom-2">
                                        <div class="wrapperSvgChart bg-[#60A5FA] !p-2 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-contract"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 21h-2a3 3 0 0 1 -3 -3v-1h5.5" /><path d="M17 8.5v-3.5a2 2 0 1 1 2 2h-2" /><path d="M19 3h-11a3 3 0 0 0 -3 3v11" /><path d="M9 7h4" /><path d="M9 11h4" /><path d="M18.42 12.61a2.1 2.1 0 0 1 2.97 2.97l-6.39 6.42h-3v-3l6.42 -6.39" /></svg>
                                        </div>    
                                        <div class="textChartHeroHeader flex flex-col">
                                            <h2 class="text-[15px] font-semibold">Grafik Manajemen</h2>
                                            <p class="text-[11px]">Total aktivitas admin hari ini </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrapperMainChart-feature h-full">
                                    <canvas id="graphCrud-guru" class="!w-[130px] !h-[120px] relative left-18 top-6 relative"> <!-- chart.js --></canvas>
                                    <div class="contentAbsolute-chart absolute bottom-[35%] left-[42%] rounded-full w-[75px] h-[65px] !z-40 flex flex-col text-center">
                                        <p class="text-[11px] font-light h-[30%] relative top-2">Total</p>
                                        <h4 class="font-semibold text-[26px] h-[50%]">16</h4>
                                    </div>
                                    <span class="absolute left-[75%] top-[75%] z-50 w-[60px] h-[30px] text-[10px] !font-medium">Data Baru 10</span>
                                    <span class="absolute left-[12%] top-[35%] z-50 w-[60px] h-[30px] text-[10px] !font-medium">Data Hapus 5</span>
                                    <span class="absolute left-[15%] top-[70%] z-50 w-[60px] h-[30px] text-[10px] !font-medium">Data Ubah 5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- separator content -->
            <!-- Data Table Section -->
            <div class="wrap-main-table w-full flex justify-center relative top-[2rem]">
                <div class="main-table flex flex-col">
                    <div class="header-table-content">
                        <div class="text-section">
                            <h3 class="text-[#08090B] font-bold text-[14px]">
                                Showing <?= min(1, $jumlah); ?>-<?= $jumlah; ?> of <?= $allGuruD; ?> Data Guru
                            </h3>
                        </div>
                        <div class="search-section">
                            <div class="search">
                                <form action="" method="POST">
                                    <div class="cari-data relative flex items-center">
                                        <svg class="w-[16px] h-[16px] absolute left-3 z-10 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>
                                        <input type="text" placeholder="Cari Data Guru..." name="keyword" autocomplete="off">
                                        <button type="submit" name="cari">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="add-data">
                                <div class="wrapper-add-data">
                                    <a href="tambah-guru" class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        TAMBAH
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="wrap-table overflow-x-auto">
                        <table border="0" cellpadding="10" cellspacing="0"> 
                            <thead>
                                <tr>
                                    <th style="width:5%; text-align:center;">NO</th>
                                    <th style="width:8%;">FOTO</th>
                                    <th style="width:18%;">NAMA</th>
                                    <th style="width:10%;">GENDER</th>
                                    <th style="width:10%;">PENDIDIKAN</th>
                                    <th style="width:16%;">MENGAJAR</th>
                                    <th style="width:14%;">KONTAK</th>
                                    <th style="width:7%; text-align:center;">USIA</th>
                                    <th style="width:12%; text-align:center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($dataGuru)): ?>
                                <tr>
                                    <td colspan="9" class="text-center py-8 text-gray-500 font-medium">
                                        Tidak ada data guru yang ditemukan.
                                    </td>
                                </tr>
                                <?php else: ?>
                                    <?php $i = 1; ?>
                                    <?php foreach($dataGuru as $teach): ?>
                                    <?php 
                                        $imgSrc = BASE_URL . "/view/assets/grcee.jpg";
                                        if(!empty($teach["gambar"]) && file_exists(__DIR__ . "/../../asset/" . $teach["gambar"])){
                                            $imgSrc = BASE_URL . "/asset/" . htmlspecialchars($teach["gambar"]);
                                        }
                                    ?>
                                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                                        <td class="text-center font-bold text-gray-700 text-[13px]"><?= $i; ?></td>
                                        <td>
                                            <div class="img-behind">
                                                <img class="w-[38px] h-[38px] rounded-full object-cover" src="<?= $imgSrc; ?>" alt="<?= htmlspecialchars($teach["nama"]); ?>">
                                            </div>
                                        </td>
                                        <td class="font-bold text-[#08090B] text-[13.5px]"><?= htmlspecialchars($teach["nama"]); ?></td>
                                        <td class="text-gray-700 text-[13px]"><?= htmlspecialchars($teach["jenis_kelamin"]); ?></td>
                                        <td class="text-gray-700 text-[13px] font-medium"><?= htmlspecialchars($teach["pendidikan"]); ?></td>
                                        <td class="text-gray-800 text-[13px] font-semibold"><?= htmlspecialchars($teach["mata_pelajaran"]); ?></td>
                                        <td class="text-indigo-600 font-bold text-[13px]"><?= htmlspecialchars($teach["kontak"]); ?></td>
                                        <td class="text-center text-gray-700 font-medium text-[13px]"><?= htmlspecialchars($teach["usia"]); ?> thn</td>
                                        <td>
                                            <div class="wrapper-action justify-center">
                                                <div class="actn-btn1 p-1.5 bg-amber-400 hover:bg-amber-500 text-black cursor-pointer">
                                                    <a href="update-guru?id=<?= $teach['id'] ?>" title="Edit Guru">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </a>   
                                                </div>
                                                <div class="actn-btn1 p-1.5 bg-rose-500 hover:bg-rose-600 text-white cursor-pointer">
                                                    <a href="?id=<?= $teach['id'] ?>&nama=<?= urlencode($teach['nama']) ?>" onclick="openDeleteModal(event, this.href, <?= $teach['id'] ?>, '<?= htmlspecialchars(addslashes($teach['nama']), ENT_QUOTES) ?>')" title="Hapus Guru">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/js/sidebar-toggle.js"></script>
<script src="<?= BASE_URL ?>/js/sorotan.js"></script>
<script src="<?= BASE_URL ?>/js/dropdown-index.js"></script>
<script src="<?= BASE_URL ?>/js/modalDelete.js"></script>
<script src="<?= BASE_URL ?>/js/manajemenGuru/chart.js"></script>
<script>
    const hasilDelete = '<?= $resultDelete ?>';
    if(hasilDelete && typeof showReturn === 'function'){
        showReturn(hasilDelete);
    }
</script>
</body>
</html>