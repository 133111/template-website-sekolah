<?php 
//helpers call
include_once __DIR__ . '/../public/routes.php';
require_once __DIR__ . '/../controllers/delete-config.php';
require_once __DIR__ . '/../config/functions.php'; //helpers 
// ----------> Call Controllers Bellow<----------
require_once __DIR__ . '/../controllers/index-config.php';
$conn = mysqli_connect('localhost', 'root', '', 'phpdasar');
$result = mysqli_query($conn, "SELECT * FROM guru");
$rows = [];
while($row = mysqli_fetch_assoc($result)){
    $rows [] = $row ;
}
$allGuruD = count($rows);
if(isset($_SESSION["delete_status"])){
    $resultDelete = $_SESSION["delete_status"];
    unset($_SESSION["delete_status"]);
}
$createTotal = (int) $_SESSION["log_create"];
$updateTotal = (int) $_SESSION["log_update"];
$deleteTotal = (int) $_SESSION["log_delete"];
$chartTotalOperations = $createTotal + $updateTotal + $deleteTotal;
$i = (int) 1;
$id = $_SESSION["admin_account"] ?? '0';
    if($_SESSION["role"] === "key_admin"){
        $dataAdmin = query("SELECT * FROM superadmin WHERE id = $id")[0];
    }else{
        $dataAdmin = query("SELECT * FROM users WHERE id = $id")[0];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa</title>
    <link rel="stylesheet" href="../view/index.css"><!--style connect -->
    <!-- Import Font Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- import dist tailwind -->
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- chart of crud statistic -->
</head>

<!-- body below -->
<body class="overflowBody">
<!-- modal -->
<!-- delete -->
<div id="modal-delete" class="main-modal-delete  opacity-0 transition-opacity duration-500 pointer-events-none fixed flex items-center justify-center z-[200] bg-[#08090B]/65 inset-0" >
    <div class="main-content-modal-delete bg-white w-[90%] max-w-[420px] rounded-[16px] border-2 border-[#08090B] shadow-[6px_6px_0px_#08090B] flex flex-col gap-4" style="padding:24px 26px">
        <div class="modal1 flex items-center gap-[14px]">
            <div class="svg-notif-icons-delete flex justify-center items-center shrink-0">
                <div id="bg-svg" class="bg-[#FF4D6D] flex items-center justify-center w-12 h-12 rounded-[10px] border-2 border-[#08090B] shadow-[1px_1px_0px_#08090B]">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" id="svg_delete" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
            </div>
            <div class="header">
                <h2 id="h2" class="text-[17px] font-extrabold text-[#08090B]">Konfirmasi Hapus</h2>
                <p id="p" class="text-[11px] font-semibold text-[#6B7280] uppercase tracking-[0.5px]">SIMS- SMK 1 NGAWI</p>
            </div>
        </div>
        <div class="modal2 bg-[#F8F9FA] border border-[#08090B] rounded-[8px] flex items-center !h-[5rem] !p-[8px] px-[14px] py-[10px]">
            <p class="text-[13.5px] leading-[1.5] font-medium text-[#374151]" id="p-long">Yakin menghapus <strong id="span-name">this</strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal3 button-section !h-[2rem] flex justify-end gap-[10px] mt-1">
            <button id="cancel" class="cursor-pointer btn-cancel bg-white hover:bg-[#F8F9FA] border-2 border-[#08090B] shadow-[3px_3px_0px_#08090B] hover:shadow-[4px_5px_0px_#08090B] hover:-translate-x-px hover:-translate-y-px active:shadow-[1px_1px_0px_#08090B] active:translate-x-px active:translate-y-px transition-all duration-150 text-[#08090B] font-bold text-[13px] rounded-[8px] px-5 py-[9px] min-w-[6rem]">Batal</button>
            <button id="delete" class="cursor-pointer btn-hapus bg-[#EF4444] hover:bg-[#DC2626] border-2 border-[#08090B] shadow-[3px_3px_0px_#08090B] hover:shadow-[4px_5px_0px_#08090B] hover:-translate-x-px hover:-translate-y-px active:shadow-[1px_1px_0px_#08090B] active:translate-x-px active:translate-y-px transition-all duration-150 text-white font-bold text-[13px] rounded-[8px] px-5 py-[9px] min-w-[6rem]">Hapus</button>
        </div>
    </div>
</div>




<!-- main-wrapper of grid -->
<div id="wrapper" class="wrapper">
<!-- side-bar -->
    <aside class="side-bar"> <!-- wrapper of side bar card -->
        <!-- content bellow -->
        <div id="main-sidebar" class="main-side-bar"> <!-- card side bar on left page -->
            <div class="header">
                <div class="welcome-bar-dashboard">
                    <div class="absolute-content">
                        <div class="card-photo relative right-1">
                            <img class="rounded-[90px]" src="../view/assets/logo2rev.png"  alt="#">
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
                <div id="content-menu" class="content-menu active">
                    <div class="anchor">
                        <a href="siswa" style="font-size:13px;" onclick="window.__sorotan='siswa'">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                <p style="display:flex;  align-items:center;">Manajemen Siswa</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="guru" style="font-size:13px ;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="20">
                                    <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                    <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                </svg>
                                <p style="display:flex;  align-items:center;">Manajemen Guru</p>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- center text for separator -->
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
                                <p style="display:flex;  align-items:center;" class="relative left-[1px]">Profile Admin</p>
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
                                <p style="display:flex;  align-items:center;" class="relative left-[5px]">Daftar Admin</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="laporan" style="font-size:13px; ">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg class="relative left-[2px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="20">
                                    <path fill-rule="evenodd" d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 0 1-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0 1 13.5 1.5H15a3 3 0 0 1 2.663 1.618ZM12 4.5A1.5 1.5 0 0 1 13.5 3H15a1.5 1.5 0 0 1 1.5 1.5H12Z" clip-rule="evenodd" />
                                    <path d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 0 1 9 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0 1 16.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625v-12Z" />
                                    <path d="M10.5 10.5a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963 5.23 5.23 0 0 0-3.434-1.279h-1.875a.375.375 0 0 1-.375-.375V10.5Z" />
                                </svg>
                                <p style="display:flex;  align-items:center;" class="relative left-[5px]">Laporan</p>
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
                                <p style="display:flex;  align-items:center;" class="relative left-[5px]">Pengaturan</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="content-menu" class="content-menu">
                    <div class="anchor">
                        <a href="home" target="_blank"style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg class="relative left-[3px]" xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <p style="display:flex;  align-items:center;" class="relative left-[5px]">Home</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer">
                <!-- logout button -->
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
                                <p class="text-[11px] text-red-400/85 relative left-2 font-semibold opacity-90 ">Log out</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </aside>

<!-- SEPARATE CONTENT -->

<!-- main container-->
    <div class="main-container">
        <div class="wrapper-hero-header">
            <div class="float-not">
                <div class="hero-header">
                    <div class="content-hero-header flex justify-between gap-2">
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
                            <p class="font-medium hover:text-[#08090B] transition-all duration-300 cursor-pointer">Siswa</p>
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
                                <div class="main-img-hero-header flex justify-center items-center relative border border-[#08090B] shadow-[-2px_2px_#08090B] relative right-[5px] rounded-[25px]">
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
                                    <a href="logout.php" class="flex justify-start items-center relative top-2 w-full h-full p-2">
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

        <div class="main-content">
        <div class="header-wrapper-l w-full flex justify-center">
            <div class="header">
                <div class="wrapper-text-header relative top-[8px] h-[50%] w-full flex justify-between">
                    <div class="content-wrapper-text-header w-[55%] z-5">
                        <h2 class="text-left opacity-85 text-[22px]">Selamat datang Admin</h2>
                        <h3 class="font-bold text-left text-[28px]">Sistem Manajemen Sekolah</h3>
                        <h4 class="text-[13px] text-left relative opacity-80">Kelola siswa, guru, dan manajemen lain dalam satu tempat.</h4>
                    </div>
                    <div class="card-of-wrapper-text-header w-[25%]  grid grid-cols-[35%_65%] items-center rounded-[1rem] h-[7rem] overflow-hidden relative right-5">
                        <div class="wrap-con-1 flex justify-center items-center">
                            <div class=" flex justify-center items-center rounded-full bg- w-[45px] h-[45px]">
                                <svg class="w-[40px] h-[40px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="wrap-con-2 flex flex-col items-start justify-between relative h-[70%]">
                            <h2 class="text-[12px] font-semibold text-start relative">WAKTU LOGIN</h2>
                            <strong class="text-start text-[24px] border-b border-[#08090B]" id="clock">00:00:00</strong>
                            <p class="text-[9px] relative bottom-[6px] font-semibold"><?= date("d M Y") ;?></p>
                        </div>
                    </div>
                    <div class="card-of-wrapper-text-header w-[25%] rounded-[1rem] h-[7rem] overflow-hidden z-30 relative right-[1%]">
                        <div class="content-wrapper-1 flex justify-between">
                            <div class="tanggal-wrapper relative bg-[#FDE047] transition-all duration-300 ease-in-out shadow-[2px_3px_#08090B] hover:shadow-[1px_1px_13px_rgba(8,9,11,0.08)] rounded-[8px] flex justify-center items-center border border-[#08090B] p-[8px] w-[40%] h-[1.6rem]  relative left-[8%] top-[11px]">
                                <p class="text-center h-full w-full text-[11px] font-semibold opacity-85">LOG TIME</p>
                            </div>
                            <div class="tanggal-text-wrapper flex items-center relative right-[10%] top-[11px] text-[13px] opacity-75">
                                <?= $_SESSION["log_time"];?>
                            </div>
                        </div>
                        <div class="content-wrapper-2 overflow-hidden flex justify-between relative top-[1.2rem]">
                            <strong class="relative left-3 top-[5%]">Selamat datang <span class="border-b border-[#08090B]"><?= $_SESSION["username"];?>!</span></strong>
                        </div>
                        <div class="content-wrapper-3 overflow-hidden relative left-5 top-[1.2rem]">
                            <p class="dot-class flex items-center justify-center gap-1 relative right-6 text-[9px] text-slate-750 uppercase w-fit !h-[20px] rounded-[8px] text-center tracking-[0.8px] font-semibold" style="padding:8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                <?= $_SESSION["role"];?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-x relative top-[2.5rem] flex gap-[1rem] h-[3.2rem] w-full justify-between">
                    <div class="card-x-1 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="svg-1 w-[30px] h-[30px] flex justify-center items-center rounded-[7px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="w-[30px] h-[30px]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="main-content-text-status h-full w-[70%]">
                                <div class="main-content-text-status-content  h-full [w-70%]">
                                    <strong class="relative top-[5px] text-[14px]">HAK AKSES</strong>
                                    <p class="relative bottom-[4px] text-[11px]">Izin Sistem </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-x-1 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="flex justify-center items-center opacity-75 rounded-[7px]">
                                    <svg class="w-[30px] h-[30px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="main-content-text-status h-full w-[70%]">
                                <div class="main-content-text-status-content  h-full [w-70%]">
                                    <strong class="relative top-[5px] text-[14px]">Anggota</strong>
                                    <p class="relative bottom-[4px] text-[11px]">Siswa Terdaftar Aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-x-1 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="svg-1 w-[30px] h-[30px] flex justify-center items-center opacity-75 rounded-[7px]">
                                    <svg class="w-[30px] h-[30px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </div>
                            </div>
                            <div class="main-content-text-status h-full w-[70%]">
                                <div class="main-content-text-status-content  h-full [w-70%]">
                                    <strong class="relative top-[5px] text-[14px]">Pegawai</strong>
                                    <p class="relative bottom-[4px] text-[11px]">Pegawai Terdaftar Aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-x-1 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="svg-1 w-[30px] h-[30px] flex justify-center opacity-85 items-center rounded-[7px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[30px] h-[30px]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="main-content-text-status h-full w-[70%]">
                                <div class="main-content-text-status-content  h-full [w-70%]">
                                    <strong class="relative top-[5px] text-[14px]">Super Admin</strong>
                                    <p class="relative bottom-[4px] text-[11px]">Anonym</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
            <!-- items card above search bar -->
        <div class="wrapper-allitems w-full flex justify-center">
            <div class="all-items flex justify-center items-center w-[95%] gap-[5px]">
                <div class="card-section-items">
                    <div class="first-section">
                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.3s ease-out forwards;">
                            <div class="card-items" >
                                <h6 class="font-semibold text-[11px]">TOTAL SISWA</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img bg-[#A7F3D0]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="25" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                                    </div>
                                </div>
                                <p class="!text-[24px] !font-extrabold !text-slate-800 !font-sora"><?= $semuaData ?></p>
                                <p style="position:absolute; bottom:1rem; left:17px; font-size:11px;" class="text-[0,0,0] font-semibold">Total murid</p>
                            </div>
                        </div>

                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.4s ease-out forwards;">
                            <div class="card-items" >
                                <h6 class="font-semibold text-[11px]">TOTAL JURUSAN</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img bg-[#FDE047] ">
                                        <svg class="text-[0,0,0]-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                    </div>
                                </div>
                                <p class="!text-[24px] !font-extrabold !font-sora text-[0,0,0]" >9</p>
                                <p style="position:absolute; bottom:1rem; left:17px;  font-size:12px;" class="text-[0,0,0] font-semibold">Total jurusan</p>
                            </div>
                        </div>
                    </div>
                    <div class="second-section">
                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.5s ease-out forwards;">
                            <div class="card-items" >
                                <h6 class="font-semibold text-[11px]">TOTAL GURU</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img bg-[#7DD3FC]">
                                        <svg class="text-[0,0,0]-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                                    </div>
                                </div>
                                <p class="!text-[24px] !font-extrabold !text-slate-800 !font-sora" ><?= $allGuruD ?></p>
                                <p style="position:absolute; bottom:1rem; left:17px; font-size:12px;" class="text-[0,0,0] font-semibold">Total guru</p>
                            </div>
                        </div>

                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.7s ease-out forwards;">
                            <div class="card-items" >
                                <h6 class="font-semibold text-[11px]">TOTAL ADMIN</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img bg-[#DDD6FE] text-purple-600 ">
                                        <svg class="text-[0,0,0]-600" xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    </div>
                                </div>
                                <p class="!text-[24px] !font-extrabold !text-slate-800 !font-sora" ><?= $totalAdmin ; ?></p>
                                <p style="position:absolute; bottom:1rem; left:17px;  font-size:12px;" class="text-[0,0,0] font-semibold">Total admin</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="second-section-card-items p-4 rounded-[12px] overflow-hidden relative"> <!-- main-wrapper -->
                    <div class="main-wrapper-section-card flex gap-[1%] relative left-[5px] w-full !h-full gap-2" style="padding:8px;">
                        <div class="kartu-1 !w-[48%] h-full ml-[5px] rounded-[12px] overflow-hidden animate-slider-kartu2 relative">
                            <div class="konten-kartu1 h-full w-full !p-[5px]">
                                <h1 class="relative top-[0.8rem] text-black font-semibold left-[5%] text-[1rem]">Status Manajemen</h1>
                                <div class="day-status flex justify-between items-center relative top-3">
                                    <p class="text-black text-[12px] font-normal relative top-[5%] left-[5%] opacity-90">Activity in 24h</p>
                                    <p class="text-[12px] text-black relative right-2"><?= date("d/m/y") ;?></p>
                                </div>
                                <div class="wrapper-4card relative flex justify-center items-center flex-col top-4 w-full h-[12rem] p-4 gap-3">
                                    <div class="card-of-1 overflow-hidden text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#00F59B] shadow-[-1px_2px_#08090B] relative left-[5%] w-[2rem]  h-[75%] border border-[#08090B] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex justify-between w-[80%]">
                                            <div class="sep-1">
                                                <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Create</strong>
                                                <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Last at : <?= $_SESSION["clock-insert"]; ?></p> 
                                            </div>   
                                            <div class="sep-2 flex items-center">
                                                <div class="bg-[rgba(237,236,236,0.096)] rounded-[8px] w-[30px] text-center">
                                                    <span class="text-[rgba(22,208,90,0.65)] text-[16px] font-extrabold flex items-center justify-center text-center">
                                                        <div class="relative bottom-[1px] text-center">+</div>
                                                        <?= $_SESSION["log_create"]; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#EF4444] shadow-[-1px_2px_#08090B] relative left-[5%] w-[2rem] h-[75%] border border-[#08090B] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex justify-between w-[80%]">
                                            <div class="sep-1">
                                                <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Delete</strong>
                                                <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Last at : <?= $_SESSION["clock-delete"]; ?></p> 
                                            </div>   
                                            <div class="sep-2 flex items-center">
                                                <div class="w-[30px] rounded-[8px] text-center bg-[rgba(237,236,236,0.096)] ">
                                                    <span class="text-[rgba(222,64,64,0.85)] text-[16px] font-extrabold flex items-center justify-center">
                                                        <div class="relative bottom-[1px]">-</div>
                                                        <?= $_SESSION["log_delete"]; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#F59E0B] shadow-[-1px_2px_#08090B] relative left-[5%] w-[2rem] h-[75%] border border-[#08090B] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-rose-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex justify-between w-[80%]">
                                            <div class="sep-1">
                                                <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Update</strong>
                                                <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Last at : <?= $_SESSION["clock-update"]; ?></p> 
                                            </div>   
                                            <div class="sep-2 flex items-center">
                                                <div class="w-[30px] rounded-[8px] text-center bg-[rgba(237,236,236,0.096)] ">
                                                    <span class="text-[#E6B900] text-[16px] font-extrabold flex items-center justify-center">
                                                        <div class="relative bottom-[1px]"></div>
                                                        <?= $_SESSION["log_update"]; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#22C55E] shadow-[-1px_2px_#08090B] relative left-[5%] w-[2rem] h-[75%] border border-[#08090B] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Success</strong>
                                            <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Operasi berjalan sukses</p>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kartu-2 w-[48%] h-full rounded-[12px] overflow-hidden rounded-[12px] animate-slider-kartu">
                            <div class="konten-kartu2 h-full !p-[5px]">
                                <h1 class="relative top-[0.8rem] text-black font-semibold left-[5%] text-[1rem]">Status Sekolah</h1>
                                <div class="day-status flex justify-between items-center relative top-3">
                                    <p class="text-black text-[12px] font-normal relative top-[5%] left-[5%] opacity-90">Snapshot today</p>
                                    <p class="text-[10px] text-black relative right-4 bg-[#FDE047] transition-all duration-300 ease-in-out shadow-[2px_2px_#08090B] hover:shadow-[1px_1px_#08090B] rounded-[6px] relative bottom-1 cursor-pointer font-semibold border border-[#08090B;]" style="padding:4px;"><?= "HARI INI" ;?></p>
                                </div>
                                <div class="wrapper-4card relative flex justify-center items-center flex-col top-4 w-full h-[12rem] p-4 gap-3">
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#FDE047] relative left-[5%] w-[2rem]  h-[75%] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-sky-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Siswa aktif <?= $semuaData; ?></strong>
                                            <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Aktif sekolah</p>    
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#7DD3FC] relative left-[5%] w-[2rem]  h-[75%] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-violet-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Guru aktif <?= $allGuruD; ?></strong>
                                            <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Aktif mengajar</p>    
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#DDD6FE] relative left-[5%] w-[2rem]  h-[75%] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Jurusan aktif <?= 9; ?></strong>
                                            <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Program keahlian berjalan</p>    
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-black text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg bg-[#FF7A00] relative left-[5%] w-[2rem]  h-[75%] rounded-[6px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#08090B">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-black text-start text-[13px] relative left-[1rem] top-[2px]">Update kegiatan</strong>
                                            <p class="text-black text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Agenda : <?= "tanggal" ;?></p>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="chart-of-status-crud w-full h-[15%] !p-[3%]"> <!-- chart of crud for while 24h session active -->
            <div class="main-chart-content !p-[12px] flex justify-between items-center w-full h-[300px] border-2 border-black rounded-[12px] shadow-[3px_4px_#08090B] !p[2rem] !pl-[2rem] !pr-[2rem] overflow-hidden bg-[#FFFEFE]">
                <canvas id="canvas-chart" class="relative top-[4%] rounded-[4px] !h-full !w-[60%]">
                    <!-- chartjs -->
                </canvas>
                <div class="side-hero-chart h-full w-[35%] relative left-[2%] flex flex-col items-center overflow-hidden !p-[11px]">
                    <div class="header-content-greeting-text relative right-[5%]">
                        <h2 class="font-bold">Analitik Perubahan Data Hari Ini</h2>
                        <span class="text-[11px]">Informasi Data Baru dalam 24 Jam Terakhir</span>
                    </div>
                    <div class="card-chart-info-1 flex flex-col items-center w-full h-[115%] gap-3 overflow-hidden !pt-[8px] !pb-[8px]">
                        <div id="total-operasi" class="info-card-chart-1 relativecursor-pointer border-2 border-[#08090B] w-[90%] h-[55px] bg-white transition-all duration-300 ease-in-out shadow-[3px_3px_#08090B] hover:shadow-[1px_1px_#08090B] hover:translate-x-[2px] hover:translate-y-[2px] rounded-[8px] flex items-center gap-[10px] px-3">
                            <div class="relative left-[1rem] bg-[#A7F3D0] w-[30px] h-[30px] min-w-[30px] rounded-[6px] border border-[#08090B] shadow-[1px_1px_#08090B] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08090B" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="18" y="3" width="4" height="18" rx="1"></rect><rect x="10" y="9" width="4" height="12" rx="1"></rect><rect x="2" y="13" width="4" height="8" rx="1"></rect></svg>
                            </div>
                            <div class="relative left-[1rem] flex flex-col leading-tight overflow-hidden">
                                <span class="text-[9px] font-semibold text-[#6B7280] uppercase tracking-[0.5px]">Total Operasi</span>
                                <strong class="text-[17px] font-extrabold text-[#08090B]"><?= $chartTotalOperations ?></strong>
                            </div>
                        </div>
                        <div id="status-sistem" class="info-card-chart-1 cursor-pointer border-2 border-[#08090B] w-[90%] h-[55px] bg-white transition-all duration-300 ease-in-out shadow-[3px_3px_#08090B] hover:shadow-[1px_1px_#08090B] hover:translate-x-[2px] hover:translate-y-[2px] rounded-[8px] flex items-center gap-[10px] px-3">
                            <div class="relative left-[1rem] bg-[#7DD3FC] w-[30px] h-[30px] min-w-[30px] rounded-[6px] border border-[#08090B] shadow-[1px_1px_#08090B] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08090B" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                            </div>
                            <div class="relative left-[1rem] flex flex-col leading-tight overflow-hidden">
                                <span class="text-[9px] font-semibold text-[#6B7280] uppercase tracking-[0.5px]">Status Sistem</span>
                                <div class="flex items-center gap-[5px]">
                                    <div class="w-[6px] h-[6px] rounded-full bg-[#22C55E]"></div>
                                    <strong class="text-[13px] font-bold text-[#08090B]">Aktif</strong>
                                </div>
                            </div>
                        </div>
                        <div id="laporan-print" class="info-card-chart-1 cursor-pointer border-2 border-[#08090B] w-[90%] h-[55px] bg-white transition-all duration-300 ease-in-out shadow-[3px_3px_#08090B] hover:shadow-[1px_1px_#08090B] hover:translate-x-[2px] hover:translate-y-[2px] rounded-[8px] flex items-center justify-between px-3">
                            <div class="flex items-center gap-[10px]">
                                <div class="relative left-[1rem] bg-[#FDE047] w-[30px] h-[30px] min-w-[30px] rounded-[6px] border border-[#08090B] shadow-[1px_1px_#08090B] flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#08090B" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                </div>
                                <div class="relative left-[1rem] flex flex-col leading-tight overflow-hidden">
                                    <span class="text-[9px] font-semibold text-[#6B7280] uppercase tracking-[0.5px]">Cetak Laporan</span>
                                    <strong class="text-[12px] font-bold text-[#08090B]">Export PDF</strong>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <div class="wrap-main-table w-full flex justify-center">
                <div class="main-table flex flex-col !pl-[8px]">
                    <div class="header-table-content relative top-[5px]  flex justify-between ">
                        <div class="text-section">
                            <div class="text-section-h3 w-[320px]">
                                <h3 style="color:black; opacity: 0.8;" class="font-medium text-[13px]"">Showing <?=$firstData + (int) + 1;?>-<?=$firstData + (int) 15;?> of <?= $semuaData; ?></h3>
                            </div>
                            <div class="pagination-section absolute z-50 flex justify-between items-center border border-[#08090B] shadow-[-2px_2px_#08090B] shadow-[2px_2px_#08090B] !w-[180px] h-[80%] rounded-[8px] !gap-1 !p-[6px] left-[20rem]" id="pagination-main"></div> <!-- handler full of js --> 
                        </div>
                        <div class="search-section">
                            <!-- Searching here -->
                            <div class="search">
                                <form action="" method="POST"> <!-- Send to This Page -->
                                    <div class="cari-data">
                                        <div class="input-searchData flex items-center">
                                            <svg class="w-[16px] h-[16px] relative left-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="rgba(25, 25, 25, 0.75)" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                            <input type="text" placeholder="Cari Data" name="keyword" autocomplete="off" style="padding-left:1.8rem;">
                                        </div>
                                        <button type="submit" name="cari">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="add-data">
                                <div class="wrapper-add-data flex items-center bg-[#4ADE80] rounded-[8px]">
                                    <a href="tambah-siswa" class="flex justify-center items-center text-center">
                                        <p class="text-[10px] font-medium">TAMBAH</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="wrap-table !overflow-x-auto relative top-[5px] ">
                        <table border="0" cellpadding="10" cellspacing="0"> 
                            <tr>
                                <th style="width:4%; color:black;">NO</th>
                                <th style="width:8%; color:black;">Gambar</th>
                                <th style="width:8%; color:black;">NIS</th>
                                <th style="width:8%; color:black;">Nama</th>
                                <th style="width:4%; color:black;" class="relative right-[10px]">Usia</th>
                                <th style="width:8%; color:black;">Gender</th>
                                <th style="width:9%; color:black;">Email</th>
                                <th style="width:8%; color:black;">Jurusan</th>
                                <th style="width:7%; color:black;" class="text-center">Status</th>
                                <th style="width:8%; color:black;" class="relative left-3">Aksi</th>   <!-- 7 FIELD -->
                            </tr>
                            <!-- start loop -->
                            <?php $i = 1; ?>
                            <?php foreach($mahasiswa as $mhs):?>
                            <tr class="hover:bg-[rgba(8,9,11,0.05)] transition-all duration-300 ease-out cursor-pointer">
                                <td style="opacity : 0.7; color:black; font-size:14px;" class="flex justify-center items-center relative top-[15px] font-semibold"><?= $i ;?></td>
                                <td>
                                    <div class="img-behind w-fit rounded-full">
                                        <img class="!rounded-full" src="../asset/<?= $mhs["gambar"]?>" width="40">
                                    </div>
                                </td>
                                <td style="font-weight:bold; opacity : 0.85; border-bottom:1px solid #08090B; font-size:14px;" class="text-[rgba(17,15,15,0.7)]"><?= $mhs["nrp"]?></td>
                                <td style="font-size:14px;  opacity : 0.9; border-bottom:1px solid #08090B;"><?= $mhs["nama"];?></td>
                                <td style="font-size:14px;  opacity : 0.9; border-bottom:1px solid #08090B;"><?= $mhs["usia"];?></td>
                                <td style="font-size:14px;  opacity : 0.9; border-bottom:1px solid #08090B;"><?= $mhs["jenis_kelamin"]?></td>
                                <td style="border-bottom:1px solid #08090B; overflow-x : auto; font-size:14px;  opacity : 0.9;"><?= $mhs["email"]?></td>
                                <td style="border-bottom:1px solid #08090B; font-size:13px; opacity : 0.7;"><?= $mhs["jurusan"]?></td>
                                <td style="color:black; border-bottom:1px solid #08090B;">
                                    <div class="status-td border border-[#08090B] w-fit rounded-[8px] text-center text-[12px] text-[0,0,0] font-bold transition-bg duration-200" id="statusMainTable" style="padding:4px 8px 4px 8px;"><?= $mhs["status"]?></div>
                                </td>
                                <td style="border-bottom: 1px solid #08090B;">
                                    <div class="wrapper-action gap-2">
                                        <div style="padding:5px;" class="actn-btn1 p-2  !bg-amber-500 hover:bg-amber-600 text-white rounded-xl shadow-sm transition-all">
                                            <a href="update-siswa?id= <?=$mhs['id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg"width="20" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </a>   
                                        </div>
                                        <div id="deleteLink" style="padding:5px;" class="actn-btn1 p-2 !bg-rose-500 hover:bg-rose-600 text-white rounded-xl shadow-sm transition-all">
                                            <a href="?id=<?= $mhs['id'] ?>&nama=<?= urlencode($mhs['nama']) ?>" onclick="openDeleteModal(event, this.href, <?= $mhs['id'] ?>, '<?= htmlspecialchars($mhs['nama'], ENT_QUOTES) ?>')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <?php $i++; ?>
                            </tr>
                            <?php endforeach;?>
                            <!-- end loop -->
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- main content bellow main container -->
    </div>
</div>
<div class="modal-pagination" id="modal-Pg"></div>
<script src="../js/chart.js"></script>
<script src="../js/pagination.js"></script>
<script src="../js/sidebar-toggle.js"></script>
<script src="../js/sorotan.js"></script>
<script src="../js/dropdown-index.js"></script>
<script src="../js/modalDelete.js"></script>
<script src="../js/clock.js"></script>
<script> 
    const hasilDelete = '<?= $resultDelete ?? 0 ?>' ;
    showReturn(hasilDelete);
    //status highlight 
    const mainStatusEl = document.querySelectorAll("#statusMainTable");
    if(mainStatusEl && mainStatusEl !== "undefined"){
        mainStatusEl.forEach(item => { 
            item.classList.remove("bg"); //reset states
            //checking
            if(item.textContent === "aktif" && item.textContent.includes("aktif")){
                item.classList.add("bg-[#00F59B]");
            }else{
                item.classList.add("bg-red-500");
            }
        })
    }
</script>
</body>
</html>