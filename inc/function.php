<?php
date_default_timezone_set("asia/jakarta");
$tgl = date("Y-m-d H:i:s");

// koneksi database

$HOSTNAME = "localhost";
$DATABASE = "db_apk2_spp";
$USERNAME = "root";
$PASSWORD = "";


$KONEKSI = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
if (!$KONEKSI) {
    die("ERROR BANG!!...   BACA TUH EROR -->" . mysqli_connect_error($KONEKSI));
}


// auto numering
function  autonum($tabel, $kolom, $lebar = 0, $awalan)
{
    global $KONEKSI;

    $auto = mysqli_query($KONEKSI, "SELECT $kolom FROM $tabel  ORDER BY $kolom DESC LIMIT 1") or die(mysqli_error($KONEKSI));
    $jumlah_record = mysqli_num_rows($auto);

    if ($jumlah_record == 0) {
        $nomor = 1;
    } else {
        $row = mysqli_fetch_array($auto);
        $nomor = intval(substr($row[0], strlen($awalan))) + 1;
    }

    if ($lebar > 0) {
        $angka = $awalan . str_pad($nomor, $lebar, '0', STR_PAD_LEFT);
    } else {
        $angka = $awalan . $nomor;
    }
    return $angka;
}


// function register
function registrasi($DATA)
{
    global $KONEKSI;
    global $tgl;

    $nama = stripslashes($DATA["username"]); // untuk cek fOrm register dari input nama
    $email = strtolower(stripslashes($DATA["email"])); // memastikan fOrm register mengisi input email berupa huruf kecil
    $auth_id = stripslashes($DATA["auth_id"]);
    $password = mysqli_real_escape_string($KONEKSI, $DATA["password"]);
    $password2 = mysqli_real_escape_string($KONEKSI, $DATA["password2"]);


    //echo $nama . "|" . $email . "|" . $password . "|" . $password2;

    // cek email yang diinput sudah ada?
    $result = mysqli_query($KONEKSI, "SELECT email FROM tbl_auth WHERE email='$email'");

    if (mysqli_fetch_assoc($result)) {
        echo '<script>
                alert("email sudah digunakan");
            </script>';
        return false;
    }

    // cek pasword
    if ($password !== $password2) {
        echo '<script>
                alert("Password tidak sesuai");
                document.location.href="register.php";
            </script>';
        return false;
    }

    // encrypt password ke db
    $password_crypt = password_hash($password, PASSWORD_DEFAULT); // pakai algorithm default hash


    //tambah user baru ke tbl_users
    $SQL_USER = "INSERT INTO tbl_auth SET
    auth_id = '$auth_id',
    email = '$email',
    role = 'Admin',
    password = '$password_crypt',
    create_at = '$tgl'";

    mysqli_query($KONEKSI, $SQL_USER) or die("gagal menambah user -->" . mysqli_error($KONEKSI));

    //tambah user baru ke tbl_admin
    $SQL_ADMIN = "INSERT INTO tbl_user SET
    auth_id = '$auth_id',
    path_photo = 'user.jpg',
    nama_user = '$nama',
    create_at = '$tgl'";

    mysqli_query($KONEKSI, $SQL_ADMIN) or die("gagal menambah user -->" . mysqli_error($KONEKSI));

    echo '<script>
            document.location.href="login.php"
        </script>';

    return mysqli_affected_rows($KONEKSI);
}

function login($DATA)
{
    global $KONEKSI;

    $email = strtolower(stripslashes($_POST['email'])); // email diinput user
    $userpass = mysqli_real_escape_string($KONEKSI, $_POST['password']); //pw di input user

    // echo $email ." ". $userpass;
    // query ke db
    $sql = mysqli_query($KONEKSI, "SELECT password, role FROM tbl_auth WHERE email='$email'");

    list($paswd, $level) =  mysqli_fetch_array($sql);


    // jika data di db ditemukan , maka validasi dengan password_verify

    if (mysqli_num_rows($sql) > 0) {
        /* jika ada data (>0) maka kita lakukan validasi
        
        $userpass -> dari form
        $paswd -> dari db dalam bentuk hash
        */
        if (password_verify($userpass, $paswd)) {
            // kita buat session baru

            $_SESSION['email'] = $email;
            $_SESSION['level'] = $level;

            /* jika login berhasil, user akan di arahkan sesuai level user
            level admin --> admin/index.php
            level petugas --> petugas/index.php
            */

            if ($_SESSION['level'] == 'Admin') {
                header('location:../admin/index.php');
            } elseif ($_SESSION['level'] == 'Petugas') {
                header('location:../petugas/index.php');
            }
            die();
        } else {
            echo '<script language="javascript">
                window.alert("LOGIN GAGAL  --> email/pw salah");
                window.document.location.href="../index.php";
            </script>';
        }
    } else {
        echo '<script language="javascript">
            window.alert("LOGIN GAGAL  --> email tidak ditemukan");
            window.document.location.href="../index.php";
        </script>';
    }
}


function cek_role_user($email, $level)
{
    $current_path = $_SERVER['SCRIPT_NAME']; // Mendapatkan path file yang sedang diakses
    if ($email) {
        // Cek apakah file yang sedang diakses adalah register.php
        if (strpos($current_path, 'register.php') !== false) {
            // Hanya admin yang boleh mengakses halaman register.php
            if ($level != "Admin") {
                header("location: ../" . strtolower($level) . "/index.php"); // Redirect ke index user yang sesuai
                exit(); // Hentikan eksekusi skrip
            }
        }
        // strpos digunakan jika user sudah di path file yang sesuai maka kode tidak akan dikerjakan, berguna untuk mencegah redirect loop


        // Jika user level "Admin" dan saat ini tidak berada di folder admin
        elseif ($level == "Admin" && strpos($current_path, 'admin') === false) {
            header("location: ../admin/index.php"); // Arahkan ke halaman admin
            exit(); // Hentikan eksekusi skrip
        }

        // Jika user level "Petugas" dan saat ini tidak berada di folder petugas
        elseif ($level == "Petugas" && strpos($current_path, 'petugas') === false) {
            header("location: ../petugas/index.php"); // Arahkan ke halaman petugas
            exit(); // Hentikan eksekusi skrip

        }
    } elseif (!$email && strpos($current_path, 'login') === false) {

        // Jika email tidak ada atau user tidak memiliki level yang sesuai
        header("location: ../index.php");
        exit();
    }
}


// function tampil
function tampil($DATA)
{
    global $KONEKSI;

    $hasil = mysqli_query($KONEKSI, $DATA);
    $rows = []; // siapkan variable/wadah kosong untuk data dari db

    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row; // dimasukkan datanya disini    
    }
    return $rows;
}


function upload_file_new($data, $file, $target)
{

    // inisialisasi elemen dari file
    $namafile = $file['Photo']['name'];
    $sizefile = $file['Photo']['size'];
    $error = $file['Photo']['error'];
    $tmpname = $file['Photo']['tmp_name'];
    $ekstensi = $file['Photo']['type'];

    $KODE = htmlspecialchars($data["kode"]);

    echo "<pre>";
    print_r($data); // melihat data yang akan diterima
    print_r($file); // melihat file yang akan diterima
    echo "</pre>";

    // pastikan user mengupload file
    if ($error == UPLOAD_ERR_NO_FILE) {
        echo '<script language="javascript">
                window.alert("File Tidak Terdeteksi");
            </script>';
        return false;
    }

    // pastikan tipe file
    $ekstensi_valid = ['jpeg', 'png', 'jpg', 'bmp'];
    $ekstensi_file = (strtolower(pathinfo($namafile, PATHINFO_EXTENSION)));

    if (!in_array($ekstensi_file, $ekstensi_valid)) {
        echo '<script language="javascript">
                window.alert("Extensi File Tidak Di Dukung");
            </script>';
        return false;
    }

    // validasi ukuran maksimal gambar
    if ($sizefile > 2000000) {
        echo '<script language="javascript">
                window.alert("Ukuran File Melebihi 2MB");
            </script>';
        return false;
    }

    //membuat nama unik file yang baru
    $id_random = uniqid();
    $namaFileBaru = $KODE . "_" . $id_random . "." . $ekstensi_file;

    $file_path = $target . $namaFileBaru;

    //cek nama baru sudah terbuat? jika sudah langsung upload
    echo "menyalin file ke : " . $file_path;

    if (move_uploaded_file($tmpname, $file_path)) {
        echo '<script language="javascript">
                window.alert("File Berhasil Di Upload");
            </script>';
        return $namaFileBaru;
    } else {
        echo '<script language="javascript">
                window.alert("File Gagal Di Upload");
            </script>';
        return false;
    }
}

// fungsi tambah_petugas
function tambah_user($data, $file, $target)
{
    global $KONEKSI;
    global $tgl;

    $START ;
    $FINISH ;
    $STATUS = "Inactive";
    $redirect;
    $ROLE = "Admin";
    $ID = htmlspecialchars($data["kode"]);
    $NAMA = htmlspecialchars($data["name"]);
    $EMAIL = htmlspecialchars($data["email"]);
    $TELEPON = htmlspecialchars($data["telepon"]);
    if ($data["role"] == 1) {
        $START = htmlspecialchars($data["start"]);
        $FINISH = htmlspecialchars($data["finish"]);
        $STATUS = "Inactive";
        $ROLE = "Petugas";
    } else {
        $redirect = "_admin";
    }
    $PASSWORD1 = mysqli_real_escape_string($KONEKSI, $data["password"]);
    $PASSWORD2 = mysqli_real_escape_string($KONEKSI, $data["password2"]);



    // cek email
    $result = mysqli_query($KONEKSI, "SELECT email FROM tbl_auth WHERE email='$EMAIL'");

    if (mysqli_fetch_assoc($result)) {
        echo '<script language="javascript">
                window.alert("Email Sudah Digunakan");
                window.document.location.href="?inc=user'.$redirect.'";
            </script>';
        return false;
    }

    // konfirmasi password
    if ($PASSWORD1 !== $PASSWORD2) {
        echo '<script language="javascript">
            window.alert("Password tidak sesuai");
            window.document.location.href="?inc=user'.$redirect.'";
        </script>';
        return false;
    }

    // $GAMBAR = $_FILES['Photo']['tmp_name']; //tangkap data file

    // var_dump($_POST);
    // var_dump($_FILES);

    // die;
    // pastikan data gambar ter-upload
    $gambar_photo = upload_file_new($data, $file, $target);

    // var_dump($gambar_photo);
    // die;

    //jika gambar tidak di upload operasi di hentikan
    if (!$gambar_photo) {
        return false;
    }

    // enkripsi password 
    $password_crypt = password_hash($PASSWORD1, PASSWORD_DEFAULT);

    // masukkan data ke tbl_users
    $sql_auth = "INSERT INTO tbl_auth SET 
    auth_id='$ID',
    email='$EMAIL',
    password='$password_crypt',
    role='$ROLE',
    create_at = '$tgl'";

    mysqli_query($KONEKSI, $sql_auth) or die("gagal menambah user -->" . mysqli_error($KONEKSI));

    // masukkan data ke tbl_admin
    $sql = "INSERT INTO tbl_user SET 
    nama_user='$NAMA',
    telepon_user='$TELEPON',
    date_start='$START',
    date_finish='$FINISH',
    status='$STATUS',
    path_photo='$gambar_photo',
    auth_id='$ID',
    create_at = '$tgl'";

    mysqli_query($KONEKSI, $sql) or die("gagal menambah user -->" . mysqli_error($KONEKSI));

    return mysqli_affected_rows($KONEKSI);
}

// function edit petugas
function edit_user($data, $file, $target)
{
    global $KONEKSI;
    global $tgl;

    $START ;
    $FINISH ;
    $STATUS = "Inactive";
    $ID = htmlspecialchars($_POST["kode"]);
    $NAMA = htmlspecialchars($_POST["name"]);
    $TELEPON = htmlspecialchars($_POST["telepon"]);
    if ($data["role"] == 1) {
  
    $START = htmlspecialchars($_POST["start"]);
    $FINISH = htmlspecialchars($_POST["finish"]);
    $STATUS = htmlspecialchars($_POST["status"]);
    }
    $PHOTO_LAMA = htmlspecialchars($_POST["photo_db"]);


    //  echo $NAMA . " | ". $TELEPON . " | " . $DOMISILI . " | " . $KTP . " | " . $NOKTP . " | " . $JABATAN. " | " . $START . " | " . $FINISH . " | " . $STATUS . " | " . $target . " | ". $foto_lama . " | " . $ID . " | " . $JENKEL . " | " . $CABANG . " | " . $tgl;
    //  die;
    $cek_file_lama = $target . $PHOTO_LAMA; // lokasi file lama

    // cek apakah ada file yang diupload?
    if (isset($file['Photo']) && $file['Photo']['error'] !== UPLOAD_ERR_NO_FILE) {
        $foto_baru = upload_file_new($data, $file, $target);

        // pastikan file baru terupload (debugging)
        echo "File Baru berhasil di upload : " . $foto_baru;

        // pastikan file lama terhapus (unlink)
        //cek apakah file lama ada?
        if ($foto_baru &&  file_exists($cek_file_lama)) {
            if (unlink($cek_file_lama)) {
                echo "berhasil menghapus file lama";
            } else {
                echo "gagal hapus file lama";
            }
        } else {
            echo "gagal menghapus file lama";
        }
    } else {
        $foto_baru = $PHOTO_LAMA;
        echo '<script language="javascript">
                window.alert("menggunakan foto lama : ' . $PHOTO_LAMA . '");
            </script>';
    }


    // update data ke tbl_admin
    $sql_admin = "UPDATE tbl_user SET 
    nama_user='$NAMA',
    telepon_user='$TELEPON',
    date_start='$START',
    date_finish='$FINISH',
    status='$STATUS',
    path_photo='$foto_baru',
    update_at = '$tgl' WHERE tbl_user.id_user='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql_admin)) {
        echo '<script language="javascript">
                window.alert("Data Berhasil Di Update");
            </script>';
    } else {
        echo '<script language="javascript">
                window.alert("Data Gagal Di Update");
            </script>';
    }


    return mysqli_affected_rows($KONEKSI);
}

// funcsi hapus petugas
function hapus_user($data, $target)
{
    global $KONEKSI;
    $id_user = $data['id'];

    // hapus file gambar milik USER
    $sql = "SELECT * FROM tbl_user WHERE id_user='$id_user'";
    $hasil = mysqli_query($KONEKSI, $sql) or die('data tidak ditemukan -->' . mysqli_error($KONEKSI));
    $row = mysqli_fetch_assoc($hasil);

    $photo = $row['path_photo'];
    $auth_id = $row['auth_id'];
    
    if (!$photo == "") {
        unlink($target . $photo);
    }

    $query_admin = "DELETE FROM tbl_user WHERE id_user='$id_user'";

    $query_user = "DELETE FROM tbl_auth WHERE auth_id='$auth_id'";
    if (mysqli_query($KONEKSI, $query_admin) && mysqli_query($KONEKSI, $query_user)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}
