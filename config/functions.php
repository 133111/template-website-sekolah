<?php
$conn = mysqli_connect("localhost","root","","phpdasar"); 
//Fungsi Query untuk READ data dalam database ke php
function query($query){ //CRUD READ
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows [] = $row ;
    }
    return $rows;
}

//Tambah/Insert data dari PHP ke DataBase
function tambah($datainsert){ //$datainsert sebagai parameter/wadah data
    global $conn;
    $nrp = htmlspecialchars($datainsert["nrp"]);    // $datainsert = $pm_post
    $nama = htmlspecialchars($datainsert["nama"]);  //  $nama = $datainsert["nama"]; ==  $nama = $pm_post["nama"];
    $usia = htmlspecialchars($datainsert["usia"]);
    $jenisK = htmlspecialchars($datainsert["jenis_kelamin"]);
    $email = htmlspecialchars($datainsert["email"]);
    $jurusan = htmlspecialchars($datainsert["jurusan"]);
    //upload gambar
    $gambar = upload();
    //cek gambar :
    if(!$gambar){
        return false ; // == die this function or stop the proccess
    }
        //insert section
        $queryinsert = "INSERT INTO mahasiswa VALUES (
            '', '$nama','$usia', '$jenisK', '$nrp', '$jurusan', '$email', '$gambar' 
            )"; //data dari form 
        try{
            mysqli_query($conn, $queryinsert); //berhasil insert
                return mysqli_affected_rows($conn);//return value
                //fungsi mengembalikan nilai > 0 (data affected rows di tabel di database)
        }catch(Exception $e){
            return false ;
        }
}


//Upload function
    function upload(){
        //get the $_FILES for manipulation
        $name = $_FILES['gambar']['name'];
        $size = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmp = $_FILES['gambar']['tmp_name']; //multi array

    //<--- Checking Section --->
        // check = ada gambar yang diupload or !
        if($error == 4){ // 4 == no data uploaded 
            return false; //if true and die; execute (if this "if" is "true")
        }
        // check = yang diupload benar" gambar or not (cek berdasar extension)
        $valid_extension = ['jpg', 'jpeg', 'png'] ; //haystack
        $get_last_ext = explode('.', $name); // delimitter and argue
        $get_last_ext = strtolower(end($get_last_ext));
            // checking proccess :
            if(!in_array($get_last_ext, $valid_extension)){ // needle & haystack
                return false;
            }
        // check = size sesuai atau oversize
        $pict_size = $size;
        if($pict_size > 2000000){ //1 million byte == 1Mb
            return false;
        }
        //hash the name of pict before return the $name/pict_name into database
        $new_name = uniqid("HAN-"); // refers to the name of pict
        $new_name .= '.';
        $new_name .= $get_last_ext;
        //last check = if pass the checking section of 3 checking == upload section
        move_uploaded_file($tmp, __DIR__ . '/../asset/'. $new_name); // default params -> filename, destination
        return $new_name; 

    }

//Hapus data/Delete dari PHP ke DataBase
function hapus($id){
    global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
            return mysqli_affected_rows($conn);
}

function hapus2($id){
    global $conn;
        mysqli_query($conn, "DELETE FROM guru WHERE id = $id");
            return mysqli_affected_rows($conn);
}


//Update data
function update($data){
    global $conn;
    $id = $data["id"];
    $nrp = htmlspecialchars($data["nrp"]);    
    $nama = htmlspecialchars($data["nama"]);  
    $usia = htmlspecialchars($data["usia"]); 
    $jenisK = htmlspecialchars($data["jenis_kelamin"]); 
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $status = htmlspecialchars($data["status"]);
    //old pict below : 
    $gambarLama = htmlspecialchars($data["gambar_lama"]); 

    //check condition [new pict uploaded or still on old pict]
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload(); //if error = 4 or the user do an upload file in update section
    }
        $queryupdate = "UPDATE mahasiswa SET
                            id = $id,
                            nama = '$nama',
                            usia = '$usia',
                            jenis_kelamin = '$jenisK',
                            nrp = '$nrp',
                            email = '$email',
                            jurusan = '$jurusan',
                            gambar = '$gambar',
                            status = '$status'
                                WHERE id = $id
                            ";
                            //data dari form 
        //update
        mysqli_query($conn, $queryupdate); 
            return mysqli_affected_rows($conn);
}

// search data
function search($keyword){ //post will be put here (keyword)
    $query  =   "SELECT * FROM mahasiswa
                WHERE nama LIKE '%$keyword%' OR
                         usia LIKE '%$keyword%' OR
                         jenis_kelamin LIKE '%$keyword%' OR
                         nrp LIKE '%$keyword%' OR
                         email LIKE '%$keyword%' OR 
                         jurusan LIKE '%$keyword%'
                "; // OR LOGIC [just need 1 'true' input of data]
                // detect pattern of $keyword 
        return query($query); // SELECT * FROM mahasiswa WHERE nama LIKE [not =]'%$_POST["keyword]'%'
}


//register user
function register($data){
    global $conn;
    //get data from $_POST
    $username = strtolower(stripslashes($data["username"])) ;
    $pass = mysqli_real_escape_string($conn, $data["pass"]) ; 
    $pass2 =  mysqli_real_escape_string($conn, $data["pass2"]); 
    $email = mysqli_real_escape_string($conn, $data["email"]);

//CHECKING SECTION:
    //check the username 
    $result1 = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' ");
    $resultSuper1 = mysqli_query($conn, "SELECT username FROM superadmin WHERE username = '$username' ");
    if(mysqli_fetch_assoc($result1) || mysqli_fetch_assoc($resultSuper1)){ //check here -> if true == data exist
        echo"
        <script>
            window.__neoModal = {
                type: 'warning',
                title: 'Username Sudah Tersedia',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Username yang Anda masukkan sudah digunakan. Silakan gunakan username lain.'
            };
        </script>
        ";
        return false;
    }

    //checking pass 1 & pass 2
    if($pass !== $pass2){
        echo"
        <script>
            window.__neoModal = {
                type: 'error',
                title: 'Password Tidak Sesuai',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Konfirmasi password tidak cocok dengan password yang Anda masukkan. Silakan periksa kembali.'
            };
        </script>
        ";
        return false;
    }

    //checking email
    $result2 = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email' ");
    $resultSuper2 = mysqli_query($conn, "SELECT email FROM superadmin WHERE email = '$email' ");
    if(mysqli_fetch_assoc($result2) || mysqli_fetch_assoc($resultSuper2)){
        echo"
        <script>
            window.__neoModal = {
                type: 'warning',
                title: 'Email Sudah Terdaftar',
                subtitle: 'SIMS - SMK 1 NGAWI',
                message: 'Email yang Anda masukkan sudah terdaftar dalam sistem. Gunakan email lain atau lakukan login.'
            };
        </script>
        ";
        return false;
    } 
    //end checking section

    //hash password
    $password = password_hash($pass, PASSWORD_DEFAULT);
    //insert section
    mysqli_query($conn, "INSERT INTO superadmin (username, pass, email) VALUES('$username', '$password', '$email')");
    return mysqli_affected_rows($conn); //if true = return 1 and the alert is done and true result

}


?>