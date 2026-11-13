<?php 
// ----------> Call Controllers Bellow<----------
require_once __DIR__ . '/../controllers/update-config.php';
define("BASE_URL", "/school-dashboard-template"); //set const

if(isset($_SESSION["status_update"])){
    $dataNew = $_SESSION["status_update"];
    unset($_SESSION["status_update"]);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa - SIMS SMK</title>
    <link rel="stylesheet" href="../view/update.css"> <!-- conn to css -->
    <?php include_once __DIR__ . '/../components/main-frame-2/header.php';?> <!-- call header component -->
</head>
<body class="body">
    <!-- call components main grid bellow -->
    <?php include_once __DIR__ . '/../components/main-frame-2/frame-grid.php';?>

    <!-- Modal Notifikasi Neobrutalism -->
    <div id="modal-update" class="main-modal-update hidden fixed flex items-center justify-center inset-0 z-[9999]">
        <div class="main-content-modal-update">
            <div class="modal-header-neo">
                <div class="modal-icon-badge warning" id="iconStatus">
                    <svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="modal-title-wrap">
                    <h2 id="h2">Data Berhasil di Update</h2>
                    <p id="p">SIMS - SMK 1 NGAWI</p>
                </div>
            </div>
            <div class="modal-body-neo">
                <p id="p-long">Perubahan data siswa telah berhasil disimpan ke database.</p>
            </div>
            <div class="modal-actions-neo">
                <button id="cancel" type="button" class="btn-neo btn-neo-secondary cursor-pointer">Batal</button>
                <button id="ok-confirm1" type="button" class="btn-neo btn-neo-success cursor-pointer">OK</button>
            </div>
        </div>
    </div>

    <div class="container2">
        <div class="header"> 
            <div class="header-title-group">
                <h2>
                    Edit Data Siswa
                    <span class="header-badge-tag">MODE EDIT</span>
                </h2>
                <div class="header-subtitle">
                    <span>Memperbarui informasi untuk :</span>
                    <span class="target-name"><?= htmlspecialchars($mhs['nama'] ?? 'Siswa') ?></span>
                </div>
            </div>
            <div>
                <a href="index.php" class="btn-back-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Kembali
                </a>
            </div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Hidden inputs -->
            <input type="hidden" name="id" required value="<?= htmlspecialchars($mhs['id'] ?? '') ?>">
            <input type="hidden" name="gambar_lama" required value="<?= htmlspecialchars($mhs['gambar'] ?? '') ?>">

            <!-- Grid Baris 1: NRP & NAMA -->
            <div class="form-grid form-grid-2">
                <div class="input-content">
                    <label for="nrp">NRP / NIS <span class="required-star">*</span></label>
                    <input type="text" name="nrp" id="nrp" required autocomplete="off" placeholder="Contoh: 255-482-242" value="<?= htmlspecialchars($mhs['nrp'] ?? '') ?>">
                </div>

                <div class="input-content"> 
                    <label for="nama">NAMA LENGKAP <span class="required-star">*</span></label>
                    <input type="text" name="nama" id="nama" required autocomplete="off" placeholder="Masukkan nama lengkap siswa" value="<?= htmlspecialchars($mhs['nama'] ?? '') ?>">
                </div>
            </div>

            <!-- Grid Baris 2: USIA, JENIS KELAMIN & JURUSAN -->
            <div class="form-grid form-grid-3">
                <div class="input-content"> 
                    <label for="usia">USIA <span class="required-star">*</span></label>
                    <input type="number" name="usia" id="usia" required autocomplete="off" placeholder="Contoh: 17" value="<?= htmlspecialchars($mhs['usia'] ?? '') ?>">
                </div>

                <div class="input-content"> 
                    <label for="jk">JENIS KELAMIN <span class="required-star">*</span></label>
                    <select name="jenis_kelamin" id="jk" required>
                        <option value="" disabled <?= empty($mhs['jenis_kelamin']) ? 'selected' : '' ?>>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" <?= (($mhs['jenis_kelamin'] ?? '') === 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= (($mhs['jenis_kelamin'] ?? '') === 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="input-content">
                    <label for="jurusan">JURUSAN <span class="required-star">*</span></label>
                    <select name="jurusan" id="jurusan" required>
                        <option value="" disabled <?= empty($mhs['jurusan']) ? 'selected' : '' ?>>Pilih Jurusan</option>
                        <?php 
                        $jurusanList = ["TBSM", "TKJ", "TO", "TITL", "Tata Boga", "Akuntansi", "RPL", "Farmasi", "Arsitektur"];
                        foreach($jurusanList as $jurusanItem):
                        ?>
                            <option value="<?= $jurusanItem ?>" <?= (($mhs['jurusan'] ?? '') === $jurusanItem) ? 'selected' : '' ?>><?= $jurusanItem ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Grid Baris 3: EMAIL -->
            <div class="form-grid form-grid-2">
                <div class="input-content">
                    <label for="email">EMAIL SISWA <span class="required-star">*</span></label>
                    <input type="email" name="email" id="email" required autocomplete="off" placeholder="contoh: siswa@sekolah.sch.id" value="<?= htmlspecialchars($mhs['email'] ?? '') ?>">
                </div>
                <div class="input-content flex">
                    <label for="email">STATUS SISWA <span class="required-star">*</span></label>
                    <select name="status" id="statusMain">
                        <option value="" disabled <?= empty($mhs['status']) ? 'selected' : '' ?>>Pilih Status</option>
                        <option value="aktif" <?= (($mhs['status'] ?? '') === 'status') ? 'selected' : '' ?>>aktif</option>
                        <option value="nonaktif" <?= (($mhs['status'] ?? '') === 'status') ? 'selected' : '' ?>>nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- Grid Baris 4: FOTO COVER SISWA -->
            <div class="photo-upload-card">
                <div class="photo-preview-wrapper">
                    <div class="photo-preview-box">
                        <img src="../asset/<?= !empty($mhs['gambar']) ? htmlspecialchars($mhs['gambar']) : 'asset/default.jpg' ?>" id="gambarUtama" alt="Cover Siswa">
                    </div>
                    <span class="photo-badge-label">Foto Siswa</span>
                </div>
                <div class="photo-upload-details">
                    <label for="gambar_button" class="upload-title">Ubah Foto Cover Siswa</label>
                    <p class="upload-desc">Pilih foto baru jika ingin mengganti cover siswa. Format yang didukung: JPG, JPEG, PNG (Maks 2MB).</p>
                    <input type="file" name="gambar" id="gambar_button" accept="image/png, image/jpeg, image/jpg">
                </div>
            </div>

            <!-- Form Action Buttons -->
            <div class="button-submit-update">
                <a href="index.php" class="btn-neo btn-neo-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    Batal
                </a>
                <button type="submit" name="submit" class="btn-neo btn-neo-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div> <!-- closes container from frame-grid.php -->
</div> <!-- closes wrapper from frame-grid.php -->

<script>const dataNew = "<?= $dataNew ?? 'nothing' ?>";</script>
<script src="../js/returnUpdate.js"></script>
<script src="../js/previewImg.js"></script>
</body>
</html>