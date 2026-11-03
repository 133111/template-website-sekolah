<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// ----------> Call config/functions Bellow<----------
require_once __DIR__ . '/../../config/functions.php';

trait helperLetter{
    public function lowerCase(string $raw): string{
        $input = $raw;
        strtolower($raw);
        return $raw;
    }
}
class adminManajemen {
    private $conn ;
    //CRUD: 
    public function __construct(){
        $this->conn = mysqli_connect("localhost", "root", "", "phpdasar");
    }

    //crud : get, delete, update(soon)
    public function updateAdmin($data){
        //var data
        $id = (int) $data["id"]; 
        $email = htmlspecialchars(stripslashes($data["email"]));
        //table check : 
        $table = ($_SESSION["role"] === "key_admin") ? "superadmin" : "users";
        //logic data raw
        $password = $data["now_pass"];
        $passwordNew = $data["new_pass"];
        $dataDb = mysqli_query($this->conn, "SELECT pass FROM $table WHERE id = $id");
            $row = mysqli_fetch_assoc($dataDb);
        mysqli_begin_transaction($this->conn);
        try{
            if(!empty($id) && !empty($email) && !empty($password) && !empty($passwordNew)){
                if($password === $passwordNew){
                    // Pass result object via session to JS modal
                    $_SESSION["profile_update_result"] = json_encode([
                        "status" => "error",
                        "title" => "Password Tidak Boleh Sama",
                        "message" => "Password baru tidak boleh sama dengan password lama. Silakan masukkan password yang berbeda.",
                        "type" => "danger"
                    ]);
                    header("Location: index.php");
                    exit;
                }
                if(!password_verify($password, $row["pass"])){
                    // Pass result object via session to JS modal
                    $_SESSION["profile_update_result"] = json_encode([
                        "status" => "error",
                        "title" => "Password Lama Salah",
                        "message" => "Password lama yang Anda masukkan tidak sesuai. Silakan periksa kembali.",
                        "type" => "danger"
                    ]);
                    header("Location: index.php");
                    exit;
                }
                $passwordNewToDB = password_hash($passwordNew, PASSWORD_DEFAULT);
                $query = "UPDATE $table SET 
                    email = ?,
                    pass = ?
                    WHERE id = $id
                    ";
                $stmt = mysqli_prepare($this->conn, $query);
                $exe = mysqli_stmt_bind_param($stmt, "ss", $email, $passwordNewToDB);
                mysqli_stmt_execute($stmt);
                    mysqli_commit($this->conn);
                
                // Pass result object via session to JS modal
                $_SESSION["profile_update_result"] = json_encode([
                    "status" => "sukses",
                    "title" => "Data Berhasil Diubah",
                    "message" => "Email dan password berhasil diperbarui di database.",
                    "type" => "success"
                ]);
                header("Location: index.php");
                exit;
            }
        }catch(Exception $e){
            mysqli_rollback($this->conn);
            // Pass result object via session to JS modal
            $_SESSION["profile_update_result"] = json_encode([
                "status" => "error",
                "title" => "Gagal Mengubah Data",
                "message" => "Terjadi kesalahan saat memperbarui data. Silakan coba lagi.",
                "type" => "danger"
            ]);
            header("Location: index.php");
            exit;
        }
    }

    public function query(string $query){
        $result  = mysqli_query($this->conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows [] = $row;
        }
        return $rows;   
    }
    public function getAdmin(): array{
        $result = mysqli_query($this->conn, "SELECT * FROM users");
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows; //return all data 
    }
    public function delete($id){
        mysqli_query($this->conn, "DELETE FROM users WHERE id = $id");
        return mysqli_affected_rows($this->conn);
    }
    
    public function __destruct(){
        if($this->conn){
            mysqli_close($this->conn);
        }
    }
}
?>