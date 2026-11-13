<?php 
// ----------> Call Controllers Bellow<----------
define("BASE_URL", "/Raihan-PHP/MATERI PHP/materi_php_sandhika/PERTEMUAN 18/project");
include_once __DIR__ . "/../../controllers/manajemen-guru/index.php";
//get data POST
if(isset($_POST["submit"])){
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $pendidikan = $_POST["pendidikan"];
    $mapel = $_POST["mata_pelajaran"];
    $kontak = $_POST["kontak"];
    $usia = $_POST["usia"];

    $gambar = upload();
    if($gambar){
        $guruAdd = new Guru;
        if($guruAdd->addGuru($nama, $jenis_kelamin, $pendidikan, $mapel, $kontak, $usia, $gambar) > 0){
            echo"
                <script>
                    alert('Data guru berhasil ditambah');
                    document.location.href = 'guru';
                </script>
            ";
        }else{
            echo"
                <script>
                    alert('Data guru gagal ditambah');
                    document.location.href = 'guru';
                </script>
            ";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Guru</title>
    <?php include_once __DIR__ . '/../../components/main-frame/header.php';?> <!-- call header component -->
    <link rel="stylesheet" href="<?= BASE_URL?>/view/manajemen-guru/tambah-guru.css"> <!-- conn to css -->
</head>
<body>
   <!-- call components main grid bellow -->
    <?php include_once __DIR__ . '/../../components/main-frame/frame-grid.php';?>
    <div class="main-wrapper">
        <div class="main-content">
            <div class="border-bottom-line"> <!-- not important -->
                <div class="header">
                    <div class="header-text">
                        <h3>Form Data Guru Baru</h3>
                    </div>
                    <div class="cancel-1">
                        <div class="wrapper-cancel-1">
                            <a href="guru"> Cancel </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="input-content">
                        <label for="nrp">NAMA <span style="color:red; opacity:1;">*</span></label>
                        <input type="text" name="nama" id="nrp" required autocomplete="off" placeholder="Masukan Nama Guru Baru">
                    </div>
                    <div class="input-content">
                        <label for="jenisK">JENIS KELAMIN <span style="color:red; opacity:1;">*</span></label>
                        <input type="text" name="jenis_kelamin" id="jenisK" required autocomplete="off" placeholder="Masukan Jenis Kelamin Guru Baru">
                    </div>
                    <div class="input-content">
                        <label for="penD">PENDIDIKAN <span style="color:red; opacity:1;">*</span></label>
                        <input type="text" name="pendidikan" id="penD" required autocomplete="off" placeholder="Masukan Pendidikan Guru Baru">
                    </div>
                    <div class="input-content">
                        <label for="nama">MENGAJAR <span style="color:red; opacity:1;">*</span> </label>
                        <input type="text" name="mata_pelajaran" id="nama" required autocomplete="off" placeholder="Masukan Mata Pelajaran">
                    </div>
                    <div class="input-content">
                        <label for="email">KONTAK <span style="color:red; opacity:1;">*</span></label>
                        <input type="text" name="kontak" id="email" required autocomplete="off" placeholder="Masukan Kontak Guru">
                    </div>
                    <div class="input-content">
                        <label for="jurusan">USIA <span style="color:red; opacity:1;">*</span></label>
                        <input type="text" name="usia" id="jurusan" required autocomplete="off" placeholder="Masukan Usia Guru">
                    </div>
                    <div class="input-content">
                        <label for="gambar">FOTO GURU <span style="color:red; opacity:1;">*</span></label>
                        <input type="file" name="gambar" id="gambar" required accept="image/*">
                    </div>
                    <!-- end feature -->    
                    <div class="wrapper-button">
                        <div class="cancel-2">
                            <div class="wrapper-cancel-2">
                                <a href="index.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                                </a>
                            </div>
                        </div>
                        <button type="submit" name="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>