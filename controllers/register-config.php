<?php
// ----------> Call config/functions Bellow<----------
require __DIR__ . '/../config/functions.php';
//end

//tidak butuh session
if(isset($_POST["submit"])){
    $registerStatus = register($_POST);
    if($registerStatus > 0){
        echo"
        <script>
            window.__neoModal = {
                type: 'success',
                title: 'Registrasi Berhasil',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Akun berhasil didaftarkan! Silakan login menggunakan akun baru Anda.',
                redirect: 'login.php'
            };
        </script>
        ";
    }else if($registerStatus === false){
        // Error modal sudah di-set oleh function register() di functions.php
    }else{
        echo"
        <script>
            window.__neoModal = {
                type: 'error',
                title: 'Registrasi Gagal',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Terjadi kesalahan pada server. Silakan coba lagi nanti.'
            };
        </script>
        ";
    }
}

?>