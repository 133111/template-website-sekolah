<?php
// ----------> Call Controllers Bellow<----------
include_once __DIR__ . '/../controllers/register-config.php' ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="../view/style.css" >
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<!-- Modal Notifikasi Neobrutalism (Hidden by default, textContent diisi via JS) -->
<div id="neo-modal-overlay" class="neo-modal-overlay">
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

<div class="main-wrapper">
    <aside class="main-content-card">
        <div class="container container-register">
            <div class="header-text">
                <div class="foto-wrap-registerPage">
                    <img src="../view/assets/logo2rev.png" alt="Logo Sekolah">
                </div>
                <strong>Selamat Datang!</strong>
                <p style="font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;">Silahkan lakukan pendaftaran</p>
            </div>
    
            <form action="" method="POST">
                <div class="input-box">
                    <label for="username" class="font-medium">Username</label>
                    <div class="svg-apply">
                        <svg class="feather feather-user" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input type="text" id="username" autocomplete="off" placeholder="Masukan Username" name="username" required>
                    </div>
                </div>
                <div class="input-box">
                    <label for="pass" class="font-medium">Password</label>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="pass" autocomplete="off" placeholder="Masukan Password" name="pass" required>
                    </div>
                </div>
                <div class="input-box">
                    <label for="pass2" class="font-medium">Confirm Password</label>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="pass2" placeholder="Konfirmasi Password" name="pass2" required>
                    </div>
                </div>
                <div class="input-box">
                    <label for="email" class="font-medium">Email</label>
                    <div class="svg-apply">
                        <svg class="feather feather-mail" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="email" autocomplete="off" placeholder="Masukan Email" name="email" required>
                    </div>
                </div>
  
                <button type="submit" name="submit" class="font-medium">Daftar</button>
            
                <div class="bottom">
                    <p>Sudah punya Akun? <a href="login.php" class="font-medium">Login Sekarang</a></p> 
                </div>  
            </form>
        </div>
    </aside>

    <div class="side-content">
        <div class="card-content relative">
            <div class="card-main-content">
                <div class="header-text-content">
                    <div class="ring-card1 w-[45%] h-[45%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 bottom-[70%] left-[75%] z-5"></div>
                    <div class="ring-card1 w-[24%] h-[25%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 top-[10%] right-[85%] z-5"></div>
                    <div class="ring-card1 w-[38%] h-[39%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 top-[110%] right-[80%] z-5"></div>
                    <div class="linear-line w-[2px] h-[45%] border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 top-[45%] left-[11%] z-1"></div>
                    <h4 class="font-semibold z-10">Selamat Datang!</h4>
                    <h6 class="relative text-[13px] opacity-80">Daftar untuk kelola manajemen sekolah dengan mudah dan efisien</h6>
                    <div class="kartu-login-info flex flex-col gap-6 w-full h-[250px] relative top-[1rem]">
                        <div class="kartu-ke w-full h-[45%] rounded-[12px]">
                            <div class="carder w-full h-[4.2rem] rounded-[12px] text-[12px]">
                                <div class="katalog relative flex flex-col justify-center h-full w-full" style="padding-left:60px;">
                                    <div class="wrapper-svg-on-1 w-[11%] h-[55%] rounded-[9px] absolute right-[85%] flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="22" height="22" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                    </div>
                                    <strong class="text-start text-[14px]">Isi Data Diri</strong>
                                    <p class="text-start">Username, Password, Email</p>
                                </div>
                            </div>
                        </div>
                        <div class="kartu-ke  w-full h-[45%] rounded-[12px] overflow-hidden">
                            <div class="carder w-full h-[4.2rem] rounded-[12px] text-[12px]">
                                <div class="katalog relative flex flex-col justify-center h-full w-full" style="padding-left:60px;">
                                    <div class="wrapper-svg-on-1 w-[11%] h-[55%] absolute right-[85%] rounded-[9px] flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="22" height="22" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                                    </div>    
                                    <strong class="text-start text-[14px]">Verifikasi Akun</strong>
                                    <p class="text-start">Konfirmasi oleh Admin</p>
                                </div>
                            </div>
                        </div>
                        <div class="kartu-ke w-full h-[45%] rounded-[12px] overflow-hidden">
                            <div class="carder w-full h-[4.2rem] rounded-[12px] text-[12px]">
                                <div class="katalog relative flex flex-col justify-center h-full w-full" style="padding-left:60px;">
                                    <div class="wrapper-svg-on-1 w-[11%] h-[55%] absolute right-[85%] rounded-[9px] flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                                    </div>    
                                    <strong class="text-start text-[14px]">Mulai Kelola</strong>
                                    <p class="text-start">Akses Penuh Admin ke Dashboard utama</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-register-side">
                    <div class="payload-button">
                        <a href="login.php">LOGIN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<script src="../js/modal/neo-modal.js"></script>
</body>
</html>