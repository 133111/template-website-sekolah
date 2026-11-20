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
            <div class="header-text !relative !bottom-[20px]">
                <div class="foto-wrap gap-2">
                    <div class="fotoWrap-svg !h-[35px] flex justify-center items-center !w-[35px] bg-[#fef3c7] border border-[#fde68a] rounded-[12px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="26" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 10l10-5 10 5-10 5z"/><path d="M6 12.5v4.5c3 2.5 9 2.5 12 0v-4.5"/><circle cx="12" cy="10" r="1" fill="#D97706"/><path d="M12 10c4 0 9 2 9 6v3"/></svg>
                    </div>
                    <div class="fotoWrap-text">
                        <h2 class="font-bold !text-[13px] relative top-1 flex items-center">SMK NEGERI 1 NGAWI <div class="!bg-[#F1F5F9] border border-[#E2E8F0] !relative !left-2 !w-[45px] text-center rounded-[8px]"><span class="!w-[15px] !h-[15px] !text-[9px] rounded-[2px]  !font-semibold">SIAKAD</span></div></h2>
                        <p class="!text-[10px]">Portal masuk menu manajemen utama</p>
                    </div>
                </div>
                <strong tyle="font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;" class="!text-[18px] !font-bold relative top-1">Selamat Datang Kembali</strong>
                <p style="font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;" class="!text-[9px] !tracking-wide relative top-[2px]">Silahkan masukan kredensial untuk masuk ke sistem manajemen dan administrasi</p>
            </div>
    
            <form action="" method="POST" class="!relative !bottom-[32px]">
                <div class="input-box">
                    <label for="username">Username</label>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input type="text" id="username" autocomplete="off" required placeholder="Masukan Username anda" name="username">
                    </div>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="email" autocomplete="off" required placeholder="Masukan Email anda" name="email">
                    </div>
                </div>
                <div class="input-box">
                    <div class="passwordText flex items-center justify-between">
                        <label for="password">Password</label>
                        <a href="siswa" class="!text-[10px] !text-[#d4a800]">Lupa Sandi?</a>
                    </div>
                    <div class="svg-apply">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="password" autocomplete="off" required placeholder="Masukan Password anda" name="password">
                    </div>
                </div>
                    <!-- Remember Me feature bellow -->
                <div class="remember flex !justify-start items-center">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="!text-[10px] tracking-tight">Ingat sesi saya selama 24 jam di perangkat ini</label>
                </div>
                <button type="submit" name="login" class="font-medium flex items-center gap-1">Masuk <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" /></svg></button> 
                <div class="!flex items-center justify-between relative top-[5%]">
                    <div class="!bg-slate-300 !w-[30%] !h-[1px] rounded-[6px]"></div>
                        <span class="text-[9px] font-medium">atau masuk dengan</span>
                    <div class="!bg-slate-300 !w-[30%] !h-[1px] rounded-[6px]"></div>
                </div>
                <div class="wrapperContentAuthSSO cursor-pointer !bg-[#F1F5F9] border border-[#E2E8F0] w-full h-[10%] relative top-[6%] rounded-[6px] flex items-center justify-center">
                    <a href="https://google.com" target="blank">
                        <div class="googleIcon !pl-[20px] flex items-center justify-between gap-1">
                            <svg width="18px" height="18px" viewBox="-0.5 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>Google-color</title><desc>Created with Sketch.</desc><defs></defs><g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Color-" transform="translate(-401.000000, -860.000000)"><g id="Google" transform="translate(401.000000, 860.000000)"><path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"></path><path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"></path><path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"></path><path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"></path></g></g></g></svg>
                            <span class="spanOfSSOText text-[8px] font-medium">Akun Admin/Google Institusi</span>
                        </div>
                    </a> 
                </div>
            </form>
        </div>
    </aside>

    <div class="side-content">
        <div class="card-content relative bg-[#0A0F1D] bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-slate-800/40 via-slate-950 to-[#0A0F1D]">
            <div class="card-main-content"> <!-- main content of card-content -->
                <div class="header-text-content">
                    <div class="ring-card1 w-[45%] h-[45%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 bottom-[70%] left-[75%] z-5"></div>
                    <div class="ring-card1 w-[24%] h-[25%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 top-[10%] right-[85%] z-5"></div>
                    <div class="ring-card1 w-[38%] h-[39%] rounded-full border-none bg-[rgba(237,236,236,0.096)] absolute opacity-75 top-[110%] right-[80%] z-5"></div>
                    <div class="isActiveCardItems !bg-[#132238]  w-[62%] h-[7%] rounded-[12px] absolute left-0 !bottom-[105%] flex items-center !pl-[6px] gap-1">
                        <div class="activeButton bg-emerald-500 w-[8px] h-[8px] rounded-full"></div>
                        <span class="text-[8px] font-lighter">Server SIMS: Berjalan Normal</span>
                    </div>
                    <h5 class="font-semibold z-10 text-start !text-[18px]">Pusat Manajemen & Layanan Terpadu sekolah</h5>
                    <div class="kartu-login-info flex flex-col gap-6 w-full h-[250px] relative top-[1rem]">
                        <div class="kartu-ke w-full h-[45%] rounded-[12px]">
                            <div class="carder w-full h-[4.2rem] rounded-[12px] text-[12px]">
                                <div class="katalog relative flex flex-col justify-center h-full w-full" style="padding-left:60px;">
                                    <div class="wrapper-svg-on-1 w-[15%] h-[55%] rounded-[9px] absolute right-[80%] flex justify-center items-center">
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
                                    <div class="wrapper-svg-on-1 w-[15%] h-[55%] absolute right-[80%] rounded-[9px] absolute flex justify-center items-center">
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
                                    <div class="wrapper-svg-on-1 w-[15%] h-[55%] absolute right-[80%] rounded-[9px] absolute flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                                    </div>    
                                    <strong class="text-start text-[14px]">Landing Page</strong>
                                    <p class="text-start">Kelola Landing Page</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-[110%] h-[15%] !relative !top-[15%] gap-4 flex items-center relative right-4">
                        <div class="w-[75%] !h-full">
                            <div class="text-1 text-start flex flex-col ">
                                <p class="text-[8px] text-[#94a3b8]">Belum memiliki akun petugas?</p>
                                <p class="text-[9px]">Hubungi Unit IT dan Administrasi Sekolah</p>
                            </div>
                        </div>
                        <div class="w-[150px] !h-[60%]">
                            <a href="https://wa.me/6287778031996?text=halo admin, saya butuh bantuan SIMS" target="_blank">
                                <div class="text-1 !p-[4px] text-start gap-1 !bg-[#132238] cursor-pointer h-full w-full rounded-[8px] flex items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-headset"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 14v-3a8 8 0 1 1 16 0v3" /><path d="M18 19c0 1.657 -2.686 3 -6 3" /><path d="M4 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3" /><path d="M15 14a2 2 0 0 1 2 -2h1a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-1a2 2 0 0 1 -2 -2v-3" /></svg>
                                    </div>
                                    <div>
                                        <p class="!text-[8px] font-semibold">Bantuan Petugas</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>  
</div>


<script src="../js/modal/neo-modal.js"></script>
</body>
</html>