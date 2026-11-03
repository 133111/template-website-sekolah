<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
// ----------> Call config/functions: <----------
require __DIR__ .'/../config/functions.php';
//end

//check is cookie has set or not [by checkbox key]
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = (int)$_COOKIE['id'];
    $key = $_COOKIE['key'];
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    if(!$row){
        $resultSuper = mysqli_query($conn, "SELECT username FROM superadmin WHERE id = $id");
        $row = mysqli_fetch_assoc($resultSuper);
    }
    if($row){
        $user = hash("sha256", $row['username']);
        if($key === $user){
            $_SESSION['login'] = true;
        }
    }
}

//if not check the checkbox list [remember me feature on form]
if(isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}


//validate credential from users
if(isset($_POST["login"])){
    //get data 
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check account in superadmin or users table
    $resultSuper = mysqli_query($conn, "SELECT * FROM superadmin WHERE username = '$username'");
    $resultUser = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    $account = null;
    $isSuper = false;

    if(mysqli_num_rows($resultSuper) === 1){
        $account = mysqli_fetch_assoc($resultSuper);
        $isSuper = true;
    } else if(mysqli_num_rows($resultUser) === 1){
        $account = mysqli_fetch_assoc($resultUser);
        $isSuper = false;
    }

    if(!$account){
        // Kondisi 1: Username Tidak Ditemukan
        echo"
        <script>
            window.__neoModal = {
                type: 'warning',
                title: 'Username Tidak Ditemukan',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Username yang Anda masukkan tidak terdaftar dalam sistem. Pastikan username yang digunakan benar.'
            };
        </script>
        ";
    } else if($account['email'] !== $email){
        // Kondisi 2: Email Salah / Tidak Sesuai
        echo"
        <script>
            window.__neoModal = {
                type: 'warning',
                title: 'Email Tidak Ditemukan',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Email yang Anda masukkan tidak sesuai dengan akun yang terdaftar. Pastikan email yang digunakan benar.'
            };
        </script>
        ";
    } else if(!password_verify($password, $account['pass'])){
        // Kondisi 3: Password Salah
        echo"
        <script>
            window.__neoModal = {
                type: 'error',
                title: 'Password Salah',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Password yang Anda masukkan tidak sesuai. Silakan periksa kembali dan coba lagi.'
            };
        </script>
        ";
    } else {
        // Kondisi 4 (Sukses): Login Berhasil
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if($isSuper){
            $_SESSION["role"] = "key_admin";
            $_SESSION["username"] = $account["username"];
            $_SESSION["admin_account"] = $account["id"];
        } else {
            $_SESSION["role"] = "user";
            $_SESSION["username"] = $account["username"];
            $_SESSION["admin_account"] = $account["id"];
        }
        $_SESSION["log_time"] = date("H:i:s");
        $_SESSION["login"] = true;

        // Remember me feature
        if(isset($_POST['remember'])){
            setcookie('id', $account['id'], time() + (86400 * 30), "/");
            setcookie('key', hash("sha256", $account['username']), time() + (86400 * 30), "/");
        }

        echo"
        <script>
            window.__neoModal = {
                type: 'success',
                title: 'Login Berhasil',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Selamat datang! Anda berhasil masuk ke sistem Admin. Mengarahkan ke dashboard...',
                redirect: 'index.php'
            };
        </script>
        ";
    }
}
?>
