<?php 
// ----------> Call Controllers Bellow<----------
include_once __DIR__ . '/../../controllers/manajemen-guru/update-guru.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Guru</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/view/manajemen-guru/update-guru.css"> <!-- conn to css -->
    <?php include_once __DIR__ . '/../../components/main-frame/header.php';?> <!-- call header component -->
</head>
<body>
    <!-- call components main grid bellow -->
    <?php include_once __DIR__ . '/../../components/main-frame/frame-grid.php';?>
    <div class="container2">
        <div class="header"> 
            <h2>UPDATE</h2>
            <div class="like-1">
                <p style="font-weight:bold; margin-top:11px;">Edit Data : <?= $guru["nama"]; ?> </p>
            </div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-content">
                <input type="hidden" name="id" required value="<?= $guru["id"]; ?>">
                <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($guru["gambar"] ?? ''); ?>">
            </div>

            <div class="input-content">
                <label for="nrp">NAMA <span style="color:red; opacity:1;">*</span></label>
                <input type="text" name="nama" id="nrp" required autocomplete="off" value="<?= htmlspecialchars($guru["nama"]); ?>" >
            </div>

            <div class="input-content">
                <label for="jenisK">JENIS KELAMIN <span style="color:red; opacity:1;">*</span></label>
                <input type="text" name="jenis_kelamin" id="jenisK" required autocomplete="off" value="<?= htmlspecialchars($guru["jenis_kelamin"]); ?>" >
            </div>

            <div class="input-content">
                <label for="penD">PENDIDIKAN <span style="color:red; opacity:1;">*</span></label>
                <input type="text" name="pendidikan" id="penD" required autocomplete="off" value="<?= htmlspecialchars($guru["pendidikan"]); ?>" >
            </div>

            <div class="input-content"> 
                <label for="nama">MATA PELAJARAN <span style="color:red; opacity:1;">*</span> </label>
                <input type="text" name="mata_pelajaran" id="nama" required autocomplete="off" value="<?= htmlspecialchars($guru["mata_pelajaran"]); ?>" >
            </div>
   
            <div class="input-content">
                <label for="email">KONTAK <span style="color:red; opacity:1;">*</span></label>
                <input type="text" name="kontak" id="email" required autocomplete="off" value="<?= htmlspecialchars($guru["kontak"]); ?>" >
            </div>

            <div class="input-content">
                <label for="jurusan">USIA <span style="color:red; opacity:1;">*</span></label>
                <input type="text" name="usia" id="jurusan" required autocomplete="off" value="<?= htmlspecialchars($guru["usia"]); ?>">
            </div>

            <div class="input-content">
                <label for="gambar">FOTO GURU</label>
                <?php if(!empty($guru["gambar"]) && file_exists(__DIR__ . '/../../asset/' . $guru["gambar"])): ?>
                    <div style="margin-bottom: 8px;">
                        <img src="<?= BASE_URL ?>/asset/<?= htmlspecialchars($guru["gambar"]); ?>" width="60" style="border-radius: 8px; border: 2px solid #08090B;">
                    </div>
                <?php endif; ?>
                <input type="file" name="gambar" id="gambar" accept="image/*">
            </div>

            <div class="button-submit-update">
                <a href="guru" style="border : 1px solid rgba(65, 55, 65, 0.23); background: text-decoration:none; ">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="30">
                       <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                   </svg>
                </a>
                <button type="submit" name="kirim" style="background: #004dff;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="30">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</body>
</html>