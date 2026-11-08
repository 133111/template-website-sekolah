<!-- body <> n </> on caller && head on caller -->
<!-- main-wrapper of grid -->
<div class="wrapper">
<!-- side-bar -->
    <aside class="side-bar"> <!-- wrapper of side bar card -->
        <!-- content bellow -->
        <div class="main-side-bar"> <!-- card side bar on left page -->
            <div class="header">
                <div class="welcome-bar-dashboard">
                    <div class="absolute-content">
                        <div class="card-photo rounded-[22px] relative right-1">
                            <img src="../view/assets/logo2rev.png" width="20" alt="#" class="rounded-full">
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
                <div class="content-menu">
                    <div class="anchor">
                        <a href="../public/index.php" style="font-size:13px;">
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
                        <a href="../public/manajemen-guru/index.php" style="font-size:13px ;">
                            <div class="main-anchor-menu" style="display:flex; gap:4%;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="25">
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
                        <div class="main-anchor-menu" style="display:flex; gap:4%;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6" width="25">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                            </svg>
                            <p style="display:flex;  align-items:center;" class="relative left-[1px]">Profile Admin</p>
                        </div>
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
    <div class="container">
        <div class="wrapper-hero-header">
            <div class="float-not">
                <div class="hero-header">
                    <div class="content-hero-header flex justify-between gap-2">
                        <div class="hero-header-se1 flex">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="account-img-hero-header">
                            <div class="main-img-hero-header">
                                <img src="<?= BASE_URL ?>/view/assets/grcee.jpg" alt="#" width = 20;> 
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
                   </div>
                </div>
            </div>
        </div>
        <!-- div close on caller page, 2 </div> close needed on caller page/sc code && need 1 </div> for close from .container -->



<!-- end body content -->