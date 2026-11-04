<?php
// ----------> Call Controllers Bellow<----------
include __DIR__ . '/../controllers/login-config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../view/style.css" >
    <link rel="stylesheet" href="../dist/output.css">
    <!-- Import Font Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<!-- Modal  -->
<div id="neo-modal-overlay" class="neo-modal-overlay"> <!-- main wrapper modal --> 
    <div class="neo-modal-card">
        <div class="neo-modal-header">
            <div id="neo-modal-icon-wrapper" class="neo-modal-icon info">
                <span id="neo-modal-icon"></span>
            </div>
            <div>
                <h2 id="neo-modal-title" class="neo-modal-title">Notifikasi</h2>
                <p id="neo-modal-subtitle" class="neo-modal-subtitle">SIMS - SMK 1 NGAWI</p>
            </div>
        </div>
        <div class="neo-modal-body">
            <p id="neo-modal-message" class="neo-modal-message">Pesan notifikasi...</p>
        </div>
        <div class="neo-modal-footer">
            <button id="neo-modal-ok" class="neo-modal-btn neo-modal-btn-primary">OK</button>
        </div>
    </div>
</div>

<div class="main-wrapper"> <!-- main wrapper of all -->
    <aside class="main-content-card">
        <div class="container">
            <div class="header-text">
                <div class="foto-wrap">
                    <img src="../view/assets/logo2rev.png" alt="Logo Sekolah">
                </div>
                <strong>Selamat Datang</strong>
                <p style="font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;">Login untuk masuk ke sistem Admin</p>
            </div>
    
            <form action="" method="POST">
                <div class="input-box">
                    <label for="username" class="font-medium">Username</label>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input type="text" id="username" autocomplete="off" required placeholder="Masukan Username anda" name="username">
                    </div>
                </div>
                <div class="input-box">
                    <label for="email" class="font-medium">Email</label>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="email" autocomplete="off" required placeholder="Masukan Email anda" name="email">
                    </div>
                </div>
                <div class="input-box">
                    <label for="password" class="font-medium">Password</label>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="password" autocomplete="off" required placeholder="Masukan Password anda" name="password">
                    </div>
                </div>
                    <!-- Remember Me feature bellow -->
                <div class="remember">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>
  
                <button type="submit" name="login" class="font-medium">Masuk</button>
            
                <div class="bottom">
                    <p>Belum punya Akun? <a href="registrasi.php" class="font-medium">Daftar Sekarang</a> </p> 
                </div>  
            </form>
        </div>
    </aside>

    <div class="side-content">
        <div class="card-content relative">
            <div class="card-main-content"> <!-- main content of card-content -->
                <div class="header-text-content">
                    <div class="ring-card1 w-[45%] h-[45%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 bottom-[70%] left-[75%] z-5"></div>
                    <div class="ring-card1 w-[24%] h-[25%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 top-[10%] right-[85%] z-5"></div>
                    <div class="ring-card1 w-[38%] h-[39%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 top-[110%] right-[80%] z-5"></div>
                    <h4 class="font-semibold z-10">Hello, Administrator!</h4>
                    <h6 class="relative text-[13px] opacity-80">Kelola manajemen sekolah dengan mudah dan efisien</h6>
                    <div class="kartu-login-info flex flex-col gap-6 w-full h-[250px] relative top-[1rem]">
                        <div class="kartu-ke w-full h-[45%] rounded-[12px]">
                            <div class="carder w-full h-[4.2rem] rounded-[12px] text-[12px]">
                                <div class="katalog relative flex flex-col justify-center h-full w-full" style="padding-left:60px;">
                                    <div class="wrapper-svg-on-1 w-[11%] h-[55%] rounded-[9px] absolute right-[85%] flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="25" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                    </div>
                                    <strong class="text-start text-[14px]">Katalog Manajemen</strong>
                                    <p class="text-start">Kelola Sekolah</p>
                                </div>
                            </div>
                        </div>
                        <div class="kartu-ke  w-full h-[45%] rounded-[12px] overflow-hidden">
                            <div class="carder w-full h-[4.2rem] rounded-[12px] text-[12px]">
                                <div class="katalog relative flex flex-col justify-center h-full w-full" style="padding-left:60px;">
                                    <div class="wrapper-svg-on-1 w-[11%] h-[55%] absolute right-[85%] rounded-[9px] absolute right-[85%] flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                                    </div>    
                                    <strong class="text-start text-[14px]">Laporan</strong>
                                    <p class="text-start">Kelola Laporan</p>
                                </div>
                            </div>
                        </div>
                        <div class="kartu-ke w-full h-[45%] rounded-[12px] overflow-hidden">
                            <div class="carder w-full h-[4.2rem] rounded-[12px] text-[12px]">
                                <div class="katalog relative flex flex-col justify-center h-full w-full" style="padding-left:60px;">
                                    <div class="wrapper-svg-on-1 w-[11%] h-[55%] absolute right-[85%] rounded-[9px] absolute right-[85%] flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                                    </div>    
                                    <strong class="text-start text-[14px]">Landing Page</strong>
                                    <p class="text-start">Kelola Landing Page</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-register-side">
                    <div class="payload-button">
                        <a href="registrasi.php">DAFTAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>


<script src="../js/modal/neo-modal.js"></script>
</body>
</html>