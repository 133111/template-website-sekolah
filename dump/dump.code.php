<?php 
class ManajemenGuru {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect("localhost", "root", "", "sekolah_db");
    }

    public function registrasiGuruComplete($username, $password, $nama, $mapel) {
        // =================================================================
        // CONCEPT 1: DATABASE TRANSACTION (Mulai Mode Draf)
        // =================================================================
        mysqli_begin_transaction($this->conn);

        try {
            // -------------------------------------------------------------
            // CONCEPT 2: PREPARED STATEMENT 1 (Tambah Akun ke Tabel Users)
            // -------------------------------------------------------------
            $queryUser = "INSERT INTO users (username, password, role) VALUES (?, ?, 'guru')";
            $stmtUser  = mysqli_prepare($this->conn, $queryUser);
            
            mysqli_stmt_bind_param($stmtUser, "ss", $username, $password);
            mysqli_stmt_execute($stmtUser);

            // Ambil ID user yang baru saja otomatis terbuat untuk relasi tabel
            $idUserBaru = mysqli_insert_id($this->conn);

            // -------------------------------------------------------------
            // CONCEPT 2: PREPARED STATEMENT 2 (Tambah Detail ke Tabel Guru)
            // -------------------------------------------------------------
            $queryGuru = "INSERT INTO guru (id_user, nama_lengkap, mapel) VALUES (?, ?, ?)";
            $stmtGuru  = mysqli_prepare($this->conn, $queryGuru);
            
            // "iss" -> id_user (Integer), nama_lengkap (String), mapel (String)
            mysqli_stmt_bind_param($stmtGuru, "iss", $idUserBaru, $nama, $mapel);
            mysqli_stmt_execute($stmtGuru);

            // =================================================================
            // TRANSACTION: COMMIT (Semua sukses? Simpan Permanen!)
            // =================================================================
            mysqli_commit($this->conn);
            echo "Data Guru berhasil didaftarkan secara utuh dan aman!";

        } catch (Exception $e) {
            // =================================================================
            // TRANSACTION: ROLLBACK (Ada 1 saja yang eror? Batalkan Semua!)
            // =================================================================
            mysqli_rollback($this->conn);
            echo "Gagal mendaftarkan guru. Seluruh perubahan dibatalkan: " . $e->getMessage();
        }
    }

    public function __destruct() {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
}

?>