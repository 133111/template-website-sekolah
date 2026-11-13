<?php
define("BASE_URL", "/school-dashboard-template");
include_once __DIR__ . '/../../public/routes.php';
include_once __DIR__ . '/../../controllers/profile-admin/index-config-profile.php';
$admin = new adminManajemen;
$id = $_SESSION["admin_account"] ?? '0';
    if($_SESSION["role"] === "key_admin"){
        $dataAdmin = $admin->query("SELECT * FROM superadmin WHERE id = $id")[0];
    }else{
        $dataAdmin = $admin->query("SELECT * FROM users WHERE id = $id")[0];
    }

// Retrieve profile update result from session (JSON object)
$profileResult = null;
if(isset($_SESSION["profile_update_result"])){
    $profileResult = $_SESSION["profile_update_result"];
    unset($_SESSION["profile_update_result"]);
}

if(isset($_POST["submit"])){
    $admin->updateAdmin($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../../view/profile-admin/style.css"><!--style connect -->
    <?php include_once __DIR__ . '/../../components/main-frame/header.php';?> <!-- call header component -->
    <!-- Import Font Space Grotesk, Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<!-- call components main grid bellow -->
    <?php include_once __DIR__ . '/../../components/main-frame/frame-grid.php';?>

    <!-- Modal Profile Result -->
    <div id="modal-profile" class="main-modal-profile !hidden fixed flex items-center justify-center inset-0 z-[100]">
        <div class="main-content-modal-profile">
            <div class="modal-header-neo">
                <div id="profile-icon-badge" class="modal-icon-badge success">
                    <svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="modal-title-wrap">
                    <h2 id="profile-modal-h2">Notifikasi</h2>
                    <p id="profile-modal-p">SIMS - SMK 1 NGAWI</p>
                </div>
            </div>
            <div class="modal-body-neo">
                <p id="profile-modal-p-long">Hasil operasi akan ditampilkan di sini.</p>
            </div>
            <div class="modal-actions-neo">
                <button id="profile-cancel" type="button" class="btn-neo btn-neo-secondary cursor-pointer">Tutup</button>
                <button id="profile-ok-confirm" type="button" class="btn-neo btn-neo-success cursor-pointer">OK</button>
            </div>
        </div>
    </div>

        <div class="profile-admin-wrapper w-full h-[635px] relative" style="padding:34px;">
            <div class=" w-full h-[550px] rounded-[12px]">
                <div class="hero-header-section overflow-hidden bg-[#FFFEFE] !text-black shadow-xl w-full h-[26%] rounded-[14px] grid grid-cols-[130px_1fr]" style="padding:16px;">
                    <div class="segment1 profile-img flex justify-center items-center">
                        <div class="rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-300 flex justify-center items-center w-[70%] h-[80%] shadow-xl shadow-emerald-500/20 shrink-0">
                            <span class="text-white font-semibold text-[36px]"><?= strtoupper(substr($dataAdmin["username"], 0, 1)) ;?></span>
                        </div>
                    </div>
                    <div class="segment2 h-[80%] relative top-3 flex flex-col gap-1">
                        <div class="flex gap-4">
                            <strong class="text-black !text-[20px]"><?= $dataAdmin["username"];?></strong>
                            <div class="bg-of-status !w-[14%] h-full bg-emerald-500/15 border border-emerald-600/80 rounded-[12px] text-center flex items-center">
                                <h2 class="text-black/85 font-semibold relative w-full !text-[14px]"><?= strtoupper($dataAdmin["role"]);?></h2>
                            </div>
                        </div>
                        <p class="text-black">email</p>
                        <div class="date-regist text-black/70 flex gap-1 flex justify-start items-center">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-[13px]">Terdaftar Sejak : <span><?= $dataAdmin["daftar"];?></span></p>
                        </div>
                    </div>
                </div>
                <!-- segment separator -->
                <div class="main-content relative top-6 w-full !h-[75%] flex gap-4 overflow-hidden">
                    <div class="segment-main1 w-[40%] h-full">
                        <div class="info-account bg-[#FFFEFE] w-full h-full rounded-[24px] shadow-md" style="padding:26px">
                            <strong class="!w-[100%] !h-[20%] ">Informasi Akun</strong>
                            <div class="info-account w-full h-full flex flex-col justify-between relative top-[0.8rem] border-t-1 border-black-500/40 ">
                                <ul class="flex flex-col gap-5 items-between relative top-4">
                                    <li>
                                        <p class="text-black font-bold text-[11px] opacity-55">USERNAME</p>
                                        <p class="text-[14px] font-medium"><?= $dataAdmin["username"];?></p>
                                    </li>
                                    <li>
                                        <p class="text-black font-semibold text-[11px] opacity-55">EMAIL TERDAFTAR</p>
                                        <p class="text-[14px] font-medium"><?= $dataAdmin["email"];?></p>
                                    </li>
                                    <li>
                                        <p class="text-black font-semibold text-[11px] opacity-55">HAK AKSES</p>
                                        <p class="text-[16px] font-semibold uppercase text-emerald-600"><?= strtoupper($dataAdmin["role"]);?></p>
                                    </li>
                                    <li>
                                        <p class="text-black font-semibold text-[11px] opacity-55">TERDAFTAR PADA</p>
                                        <p class="text-[14px] font-medium"><?= $dataAdmin["daftar"];?></p>
                                    </li>
                                    <li>
                                        <p class="text-black font-semibold text-[11px] opacity-55">WAKTU SESI LOGIN</p>
                                        <p class="text-[14px] font-medium"><?= $_SESSION["tanggal_crud"];?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="segment-main2 w-[60%] h-full">
                        <div class="edit-account bg-[#FFFEFE] w-full h-full rounded-[26px] shadow-md" style="padding:26px">
                            <form action=""method="POST" enctype="multipart/form-data">
                                <strong class="!w-[100%] !h-[26%]  w-full">Pengaturan dan Keamanan</strong>
                                <div class="edit-account border-t-1 relative top-[0.8rem] border-black-500/30 w-full h-full flex flex-col justify-between">
                                    <ul class="flex flex-col items-between relative top-[2rem]">
                                        <li>
                                            <input type="hidden" name = "id" required  value = "<?= $dataAdmin['id'];?>"> <!-- input hidden (user not see this) -->
                                        </li>
                                        <li class="text-[13px] font-semibold"><span class="relative bottom-2">Email Pengguna</span>
                                            <input type="text" name="email" id="email" required value="<?= $dataAdmin["email"];?>" required>
                                        </li>
                                        <li class="text-[13px] font-semibold"><span class="relative bottom-2">Password saat ini</span> <span style="color:red;">*</span>
                                            <input type="text" name="now_pass" id="old_pass" required>
                                        </li>
                                        <li class="text-[13px] font-semibold" ><span class="relative bottom-2">Password Baru (Kosongkan jika tidak ingin ganti)</span>
                                            <input type="text" name="new_pass" id="new_pass" required >
                                        </li>
                                        <li>
                                            <button type="submit" name="submit" class="bg-emerald-600/70 hover:bg-emerald-600 cursor pointer transition-bg duration-300 cursor-pointer rounded-[9px] h-[2.4rem] w-[35%] text-white font-semibold text-[14px]">Simpan Perubahan</button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- closing div -->
</body>

<!-- Pass PHP result data as JS object -->
<script>
    const dataProfile = <?= $profileResult ? $profileResult : 'null' ?>;
</script>
<script src="../../js/returnProfile.js"></script>
<script src="../../js/sorotan.js"></script>
</body>
</html>