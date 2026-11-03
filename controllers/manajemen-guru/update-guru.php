<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
// ----------> Call config/functions Bellow<----------
define("BASE_URL", "/Raihan-PHP/MATERI PHP/materi_php_sandhika/PERTEMUAN 18/project");
require __DIR__ . '/../../config/functions.php';
include_once __DIR__ . '/../manajemen-guru/index.php';
//end
// $id = $_GET['id']; //get id
$updateGuru = new Guru;
$guru = query("SELECT * FROM guru WHERE id = $id")[0]; // fetch the data where id

if(isset($_POST["kirim"])){  
    if($updateGuru->updateGuru($_POST) > 0){ 
        echo"
        <script>
            alert ('Data Berhasil Di Update');
            document.location.href = 'guru';
        </script>
        ";
    }else{
        echo"
        <script>
            alert ('Data Gagal Di Update');
            document.location.href = 'guru';
        </script>
        ";
    }
}


?>