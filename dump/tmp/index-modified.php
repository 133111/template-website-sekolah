<?php 
//routes caller
include_once __DIR__ . '/../public/routes.php';

// ----------> Call Controllers Bellow<----------
require_once __DIR__ . '/../controllers/index-config.php';
$conn = mysqli_connect('localhost', 'root', '', 'phpdasar');
$result = mysqli_query($conn, "SELECT * FROM guru");
$rows = [];
while($row = mysqli_fetch_assoc($result)){
    $rows [] = $row ;
}
$allGuruD = count($rows);

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
    <!-- import dist tailwind -->
    <link rel="stylesheet" href="../dist/output.css">
</head>

<!-- body below -->
<body>
<!-- main-wrapper of grid -->
<div class="wrapper">
<!-- side-bar -->
    <aside class="side-bar"> <!-- wrapper of side bar card -->
        <!-- content bellow -->
        <div class="main-side-bar"> <!-- card side bar on left page -->
            <div class="header">
                <div class="welcome-bar-dashboard">
                    <div class="absolute-content">
                        <div class="card-photo">
                            <img src="../view/assets/logosekolah.png" width="20" alt="#">
                        </div>
                        <div class="admin-text">
                            <p>Panel Admin</p>
                            <div class="general-text">
                                <p>Manajemen Sekolah</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="button-menu">
                <div class="content-header-menu">
                    <p>MENU UTAMA</p>
                </div>
                <div class="content-menu">
                    <div class="anchor">
                        <a href="siswa" style="font-size:13px;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                <p style="display:flex;  align-items:center;">Manajemen Siswa</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content-menu">
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
                <div class="content-menu">
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
                <div class="content-menu">
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
                <div class="content-menu">
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
                <div class="content-menu">
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
                <div class="content-menu">
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
                    <div class="logout">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>

        </div>

    </aside>

<!-- SEPARATE CONTENT -->

<!-- main container-->
    <div class="container">
        <div class="wrapper-hero-header">
            <div class="float-not">
                <div class="hero-header">
                    <div class="content-hero-header">
                        <div class="hero-header-se1">
                            <div class="svg-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="25">
                                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-[1.2rem] relative bottom-[3px] font-semibold" style="font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;">Main Dashboard </h3>
                        </div>
                    </div>
                    <div class="account-hero-header">
                        <div class="notif-icons-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="account-img-hero-header">
                            <div class="main-img-hero-header">
                                <img src="../view/assets/grcee.jpg" alt="#" width = 20;> 
                            </div>
                            <div class="hero-text-img">
                                <div class="main-hero-text-img">
                                    <p class="font-semibold">SMK N 1 NGAWI <span> &#8964</span></p>
                                </div>
                                <div class="second-hero-text-img">
                                    <p>Administrator</p>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="header">
                <div class="wrapper-text-header relative top-[8px] h-[50%] w-full flex justify-between">
                    <div class="content-wrapper-text-header w-[55%] z-5">
                        <h2 style="font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;" class="text-left opacity-85">Selamat datang Admin</h2>
                        <h3 style="font-family: 'Sora', 'Plus Jakarta Sans', sans-serif; font-size:26px;" class="!font-bold text-left">Sistem Manajemen Sekolah</h3>
                        <h4 style="font-family : 'sora', 'Plus Jakarta Sans', sans-serif;" class="text-[13px] text-left relative opacity-80">Kelola siswa, guru, dan manajemen lain dalam satu tempat.</h4>
                    </div>
                    <div class="card-of-wrapper-text-header w-[25%] rounded-[1rem] h-[7rem] overflow-hidden relative right-[1%]">
                        <div class="content-wrapper-1 flex justify-between">
                            <div class="tanggal-wrapper bg-[rgba(237,236,236,0.21)] relative flex justify-center items-center p-[8px] w-[32%] h-[1.6rem] rounded-[1rem] relative left-[8%] top-[11px]">
                                <div class="dot-content flex justify-center items-center relative w-[16px] h-[13px] rounded-full"><div class="dot-sub w-[6px] h-[6px] rounded-full"></div></div>
                                <p class="text-center h-full w-full text-[12px] font-semibold opacity-85">DATE</p>
                            </div>
                            <div class="tanggal-text-wrapper relative right-[10%] top-[11px] text-[13px] opacity-75">
                                <?= date("d M Y") ;?>
                            </div>
                        </div>
                        <div class="content-wrapper-2 flex justify-between relative top-[1.2rem]">
                            <strong class="relative left-5 top-[5%]">Manajemen Siswa Aktif</strong>
                        </div>
                        <div class="content-wrapper-3 relative left-5 top-[1.2rem]"><p class="opacity-75 text-[12px] text-start font-[family-name:'sora','Plus Jakarta Sans',sans-serif]">Sistem manajemen berjalan normal</p></div>
                    </div>
                </div>
                <div class="card-x relative top-[2.5rem] flex gap-[1rem] h-[3.2rem] w-full justify-between">
                    <div class="card-x-1 bg-red-500 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="svg-1 !bg-[rgba(238,234,234,0.160)] w-[30px] h-[30px] flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6" width="20">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="main-content-text-status h-full w-[70%]">
                                <div class="main-content-text-status-content  h-full [w-70%]">
                                    <strong class="relative top-[5px] text-[14px]">10</strong>
                                    <p class="relative bottom-[4px] text-[11px]">Total Siswa Terdata</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-x-1 bg-red-500 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="svg-1 bg-[rgb(37,216,100)] w-[30px] h-[30px] flex justify-center items-center opacity-75">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
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
                    <div class="card-x-1 bg-red-500 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="svg-1 bg-[rgb(186,118,118)] w-[30px] h-[30px] flex justify-center items-center opacity-75">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
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
                    <div class="card-x-1 bg-red-500 w-[25%] rounded-[12px] overflow-hidden text-start text-[9px]">
                        <div class="card-content-1 flex w-full h-full">
                            <div class="main-img-1a h-full w-[30%] flex justify-center items-center">
                                <div class="svg-1 bg-[rgb(153,121,194)] w-[30px] h-[30px] flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                   <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6" width="20">
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
            <!-- items card above search bar -->
            <div class="all-items gap-[5px]">
                <div class="card-section-items">
                    <div class="first-section">
                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.3s ease-out forwards;">
                            <div class="card-items" >
                                <h6>Total Siswa</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img bg-[rgba(119,163,221,0.3)]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="rgba(45, 114, 205, 0.8)" width="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="none" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                                    </div>
                                </div>
                                <p style="font-weight : bold; position:relative; font-size:19px; " class="p-font-change"><?= $semuaData ?></p>
                                <p style="position:absolute; bottom:1rem; left:17px; font-size:11px; color: rgb(74, 150, 120); font-weight:bold;" class="p-font-change">Total murid</p>
                            </div>
                        </div>

                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.4s ease-out forwards;">
                            <div class="card-items" >
                                <h6>Total Jurusan</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img">
                                        <img src="../view/assets/tools.png" alt="#" width="30">
                                    </div>
                                </div>
                                <p style="font-weight : bold; position:relative; font-size:19px;" class="p-font-change" >9</p>
                                <p style="position:absolute; bottom:1rem; left:17px;  font-size:12px; color:#6f7bb5; font-weight:bold;" class="p-font-change">Total jurusan</p>
                            </div>
                        </div>
                    </div>
                    <div class="second-section">
                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.5s ease-out forwards;">
                            <div class="card-items" >
                                <h6>Total Guru</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img">
                                        <img src="../view/assets/totalguru.png" alt="#" width="30">
                                    </div>
                                </div>
                                <p style="font-weight : bold; position:relative; font-size:19px;" class="p-font-change" ><?= $allGuruD ?></p>
                                <p style="position:absolute; bottom:1rem; left:17px; font-size:12px; color: #241b88d1; font-weight:bold;" class="p-font-change">Total guru</p>
                            </div>
                        </div>

                        <div class="slider-card" style="transform:translateY(120%); opacity : 0; animation: kartu1 0.4s 0.7s ease-out forwards;">
                            <div class="card-items" >
                                <h6>Total Admin</h6>
                                <div class="card-items-img">
                                    <div class="main-text-img bg-[rgba(220,34,56,0.15)]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 24 24" fill="rgba(220, 34, 56, 0.8)" stroke="none" stroke-width="0.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    </div>
                                </div>
                                <p style="font-weight : bold; position:relative; font-size:19px;" class="p-font-change" ><?= $totalAdmin ; ?></p>
                                <p style="position:absolute; bottom:1rem; left:17px;  font-size:12px; color: rgba(230, 11, 37, 0.83); font-weight:bold;" class="p-font-change">Total admin</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="second-section-card-items p-4 rounded-[12px] overflow-hidden relative left-[6px]"> <!-- main-wrapper -->
                    <div class="main-wrapper-section-card flex gap-[1%] w-full h-full">
                        <div class="kartu-1 !w-[50%] h-full ml-[5px] rounded-[12px] overflow-hidden">
                            <div class="konten-kartu1 h-full w-full !p-[5px]">
                                <div class="tanggal-wrapper bg-[rgba(237,236,236,0.21)] flex flex-row items-center p-[8px] w-[40%] h-[1.6rem] rounded-[1rem] relative left-[5%] top-[11px]">
                                    <div class="dot-content flex justify-center items-center relative w-[14px] h-[13px] rounded-full"><div class="dot-sub w-[6px] h-[6px] rounded-full"></div></div>
                                    <p class="text-center !flex text-[11px] font-medium opacity-85 text-white relative left-[0.6rem]">HARI INI</p>
                                </div>
                                <h1 class="relative top-[0.8rem] text-white font-semibold left-[5%] text-[1rem]">Status Manajemen</h1>
                                <p class="text-white text-[12px] font-normal relative top-[5%] left-[5%] opacity-90">Activity in 24h</p>
                                <div class="wrapper-4card relative flex justify-center items-center flex-col top-4 w-full h-[12rem] p-4 gap-3">
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-white text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg relative left-[5%] bg-teal-500 w-[2rem] h-[75%] rounded-[8px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] opacity-85" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-white text-start text-[14px] relative left-[1rem] top-[2px]">Create <?= $_SESSION["log_create"]; ?></strong>
                                            <p class="text-white text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Masuk hari ini</p>    
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-white text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg relative left-[5%] bg-blue-500 w-[2rem] h-[75%] rounded-[8px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] opacity-85" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-white text-start text-[14px] relative left-[1rem] top-[2px]">Update <?= $_SESSION["log_update"]; ?></strong>
                                            <p class="text-white text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Update hari ini</p>    
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-white text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg relative left-[5%] bg-rose-500 w-[2rem] h-[75%] rounded-[8px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] opacity-85" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-white text-start text-[14px] relative left-[1rem] top-[2px]">Delete <?= $_SESSION["log_delete"]; ?></strong>
                                            <p class="text-white text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Delete hari ini</p>    
                                        </div>
                                    </div>
                                    <div class="card-of-1 overflow-hidden bg-[rgba(238,234,234,0.180)] text-white text-[14px] px-[6px] flex items-center h-[35%] w-[90%] rounded-[8px]">
                                        <div class="wrapper-bg-svg relative left-[5%] bg-green-500 w-[2rem] h-[75%] rounded-[8px] flex justify-center items-center">
                                            <svg class="w-[20px] h-[20px] opacity-85" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                        <div class="card-info-wrap flex flex-col">
                                            <strong class="text-white text-start text-[14px] relative left-[1rem] top-[2px]">Success</strong>
                                            <p class="text-white text-[10px] text-start relative left-[1rem] bottom-[2px] opacity-85">Operasi berjalan sukses</p>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kartu-2 w-[50%] h-full rounded-[12px] overflow-hidden rounded-[12px]">
                            <div class="konten-kartu2 h-full !p-[5px] bg-[#FFFEFE]">
                                <p>hello job</p>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="main-table">
                <div class="header-table-content">
                    <div class="text-section">
                        <!-- <img src="../view/assets/student.png" alt="#" width="44" height="45"> -->
                        <div class="text-section-h3">
                            <h3 style="color:black; opacity: 0.8;">Data Siswa</h3>
                        </div>
                        <div class="text-section-status">
                            <div class="text-section-status-box">
                                <p><?= $semuaData ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="search-section">
                        <!-- Searching here -->
                        <div class="search">
                            <form action="" method="POST"> <!-- Send to This Page -->
                                <div class="cari-data">
                                    <input type="text" placeholder="  Cari Data" name="keyword" autocomplete="off" style="padding-left : 18px;">
                                    <button type="submit" name="cari">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="add-data">
                            <div class="wrapper-add-data">
                                <a href="tambah-siswa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-table">
                    <table border="0" cellpadding="10" cellspacing="0"> 
                        <tr>
                            <th style="width:2%; color:black;">No.</th>
                            <th style="width:6%; color:black;">Aksi</th>
                            <th style="width:10%; color:black;">Gambar</th>
                            <th style="width:8%; color:black;">NIS</th>
                            <th style="width:9%; color:black;">Nama</th>
                            <th style="width:4%; color:black;">Usia</th>
                            <th style="width:8%; color:black;">Jenis Kelamin</th>
                            <th style="width:9%; color:black;">Email</th>
                            <th style="width:9%; color:black;">Jurusan</th>   <!-- 7 FIELD -->
                        </tr>
                        <!-- start loop -->
                        <?php $i=1;?>
                        <?php foreach($mahasiswa as $mhs):?>
                        <tr>
                            <td style="text-align:center; font-size:13px; border-bottom: 1px solid rgba(96, 93, 93, 0.110);"><?= $i ;?></td>
                            <td style="border-bottom: 1px solid rgba(96, 93, 93, 0.110);">
                                <div class="wrapper-action">
                                    <div class="actn-btn1">
                                        <a href="update-siswa?id= <?= $mhs['id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>   
                                    </div>
                                    <div class="actn-btn2">
                                        <a href ="hapus-siswa?id=<?= $mhs['id']?>" onclick = "return confirm('Apakah Anda Yakin?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </div>
                           </td>
                            <td style="border-bottom: 1px solid rgba(96, 93, 93, 0.110);">
                    
                                <img src="../asset/<?= $mhs["gambar"]?>" width="50">
                   
                            </td>
                            <td style="font-family :'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, sans-serif; font-weight:bold; opacity : 1; border-bottom: 1px solid rgba(96, 93, 93, 0.110); color:#7854FF; font-size:14px;"><?= $mhs["nrp"]?></td>
                            <td style="font-size:13px; font-weight:bold; opacity : 0.7; border-bottom: 1px solid rgba(96, 93, 93, 0.110);"><?= $mhs["nama"];?></td>
                            <td style="font-size:13px; font-weight:bold; opacity : 0.7; border-bottom: 1px solid rgba(96, 93, 93, 0.110);"><?= $mhs["usia"];?></td>
                            <td style="font-size:13px; font-weight:bold; opacity : 0.7; border-bottom: 1px solid rgba(96, 93, 93, 0.110);"><?= $mhs["jenis_kelamin"]?></td>
                            <td style="border-bottom: 1px solid rgba(96, 93, 93, 0.110); overflow-x : auto; font-family : sans-serif ; font-weight:400; font-size:12px; font-weight:bold; opacity : 0.7;"><?= $mhs["email"]?></td>
                            <td style="border-bottom: 1px solid rgba(96, 93, 93, 0.110); font-family : sans-serif ; font-size:14px; font-weight:bold; opacity : 0.4;"><?= $mhs["jurusan"]?></td>
                        </tr>
                        <?php $i++;?>
                        <?php endforeach;?>
                        <!-- end loop -->
                    </table>
                </div>
            </div>
        
            <footer class="footer-main">
                <div class="main-content-footer">
                    <div class="brief-profile">
                        <h4>SIMS - SMK N 1 NGAWI</h4>
                        <p>Sistem Informasi Manajemen Sekolah berbasis Web-Site Manajemen Sekolah terpadu untuk pengelolaan data-data penting sekolah secara efisien dan aman.</p>
                    </div>
                    <div class="fast-link">
                        <h3>TAUTAN CEPAT</h3>
                        <div class="list-link">
                            <ul>
                                <li><a href="../public/"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="12" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>Dashboard Siswa </a></li>
                                <li><a href="../public/manajemen-guru/"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="12" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>Dashboard Guru </a></li>
                                <li><a href="../public/profile-admin/"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="12" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>Profile Admin </a></li>
                                <li><a href="../public/pengaturan/"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="12" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>Pengaturan </a></li>
                                <li><a href="../public/#"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="12" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>Home Page Sekolah </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="contact-footer">
                    <h3 style="margin-bottom:16px;">KONTAK</h3>
                    <div class="contact-footer-sub">
                        <div class="contact-1" style="margin-bottom:11px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <p>Jl. Ngawi putih no.02 Sebelah Timur, Ngawi, Jawa Timur</p>
                        </div>
                        <div class="contact-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <p>adminsmkn1ngawi.gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="copyright-content" style="text-align:start; font-size:13px;font-weight:normal;">
                    <p>© 2026 <span>Ahnaf Fathir Raihan</span>. Crafting ideas into code. All rights reserved.</p>
                </div>
            </footer>
            
        </div> <!-- main content bellow main container -->
    </div>
    
    <script src="../view/js/modal-pop-up.js"></script>
</body>
</html>