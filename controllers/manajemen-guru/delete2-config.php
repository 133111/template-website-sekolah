<?php
//----------> Call config/functions Bellow<----------
include_once __DIR__ . '/../manajemen-guru/index.php';
//end
$deleteGuru = new Guru;
    // $id = $_GET["id"];
        if ($deleteGuru->hapusGuru($id) > 0){  
            echo"
                <script>
                    alert ('Data Berhasil Dihapus');
                    document.location.href = 'guru';
                </script>";
            }else{
            echo"
                <script>
                    alert ('Data Gagal Dihapus');
                    document.location.href = 'guru';
                </script>";
                }



?>