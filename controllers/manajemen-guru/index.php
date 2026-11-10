<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

//define session
$date = date("d M Y");
if(!$_SESSION["tanggal_crud"]){
    $_SESSION["tanggal_crud"] = $today ; //reset after 24h
    $_SESSION["guru_add"] = 0 ;
    $_SESSION["guru_delete"] = 0 ;
    $_SESSION["guru_update"] = 0 ;
    //clock operate
    $_SESSION["clock_insert_guru"] = 0; 
    $_SESSION["clock_update_guru"] = 0; 
    $_SESSION["clock_delete_guru"] = 0; 
}
// ----------> Call config/functions Bellow<----------
require_once __DIR__ . '/../../config/functions.php';
class Guru{
    private $conn ;
    private $pdo;
    public function __construct(){
        $this->conn = mysqli_connect("localhost", "root", "", "phpdasar"); //set conn for state value in
    }
    // CRUD :
    public function addGuru($nama, $jenisK, $edu, $mapel, $kontak, $usia, $gambar = null){
        //get data 
        $name = stripslashes(trim(mysqli_real_escape_string($this->conn, $nama)));
        $jenisK = stripslashes(trim(mysqli_real_escape_string($this->conn, $jenisK)));
        $penD = stripslashes(trim(mysqli_real_escape_string($this->conn, $edu)));
        $lesson = stripslashes(trim(mysqli_real_escape_string($this->conn, $mapel)));
        $contact = stripslashes(trim(mysqli_real_escape_string($this->conn, $kontak)));
        $age = (int)$usia;
        $image = $gambar ? stripslashes(trim(mysqli_real_escape_string($this->conn, $gambar))) : '';

        //set database transaction
        mysqli_begin_transaction($this->conn);

        try{
            $query= "INSERT INTO guru (nama, jenis_kelamin, pendidikan, mata_pelajaran, kontak, usia, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssis", $name, $jenisK, $penD, $lesson, $contact, $age, $image);
            mysqli_stmt_execute($stmt);
       
            mysqli_commit($this->conn);
            return mysqli_stmt_affected_rows($stmt);
        }catch(Exception $e){
            mysqli_rollback($this->conn);
            return 0;
        }
    }

    public function lihatGuru(){ //Read -> khusus tabel guru
        $result = mysqli_query($this->conn, "SELECT * FROM guru ORDER BY id DESC LIMIT 0,15");
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
           $rows [] = $row;
        }
        return $rows;
    }

    public function hapusGuru($id){ //Delete -> khusus tabel guru
        $id = (int)$id;
        mysqli_query($this->conn, "DELETE FROM guru WHERE id = $id");
        return mysqli_affected_rows($this->conn);
    }

    public function updateGuru($data){ 
        $conn = $this->conn;
        //get data
        $id = (int)$data["id"];
        $nama = htmlspecialchars(mysqli_real_escape_string($conn, trim($data["nama"])));
        $jenisK = htmlspecialchars(mysqli_real_escape_string($conn, trim($data["jenis_kelamin"])));
        $pendidikan = htmlspecialchars(mysqli_real_escape_string($conn, trim($data["pendidikan"])));
        $mapel = htmlspecialchars(mysqli_real_escape_string($conn, trim($data["mata_pelajaran"])));
        $kontak = htmlspecialchars(mysqli_real_escape_string($conn, trim($data["kontak"])));
        $usia = (int)$data["usia"];
        $gambarLama = htmlspecialchars(mysqli_real_escape_string($conn, trim($data["gambar_lama"] ?? '')));

        if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== 4){
            $gambar = upload();
            if(!$gambar) {
                return false;
            }
        }else{
            $gambar = $gambarLama;
        }

        mysqli_query($conn, "UPDATE guru SET 
            nama = '$nama',
            jenis_kelamin = '$jenisK',
            pendidikan = '$pendidikan',
            mata_pelajaran = '$mapel',
            kontak = '$kontak',
            usia = '$usia',
            gambar = '$gambar'
                WHERE id = $id");
        
        return mysqli_affected_rows($conn);
    }

    public function fetchAll($query){ //for -> dataUmum
        $result = mysqli_query($this->conn, $query);
        $admin  = [];
        while($result2 = mysqli_fetch_assoc($result)) {
            $admin [] = $result2;
        }
        return $admin;
    }

    //end class section  : 
    public function __destruct(){ //destruct conn of DB 
        if($this->conn){
            mysqli_close($this->conn);
        }
    }
}
//search config
function search2($keyword){ 
    $query  =   "SELECT * FROM guru
                WHERE nama LIKE '%$keyword%' OR
                        jenis_kelamin LIKE '%$keyword%' OR
                        pendidikan LIKE '%$keyword%' OR
                        mata_pelajaran LIKE '%$keyword%' OR
                        kontak LIKE '%$keyword%' OR 
                        usia LIKE '%$keyword%'
                "; 
        return query($query); 
}

$result= query("SELECT * FROM mahasiswa ORDER BY id DESC "); //Get Data
    $mahasiswa = $result ; 
    $jumlah = count($mahasiswa); 

//add pagination feature soon

?>