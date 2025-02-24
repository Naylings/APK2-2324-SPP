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
