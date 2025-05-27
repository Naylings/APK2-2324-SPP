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

    $START = '';
    $FINISH = '';
    $STATUS = "Inactive";
    $redirect = '';
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
                window.document.location.href="?inc=user' . $redirect . '";
            </script>';
        return false;
    }

    // konfirmasi password
    if ($PASSWORD1 !== $PASSWORD2) {
        echo '<script language="javascript">
            window.alert("Password tidak sesuai");
            window.document.location.href="?inc=user' . $redirect . '";
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

    $START = '';
    $FINISH = '';
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

// function update_sekolah
function update_sekolah($DATA)
{
    global $KONEKSI;
    global $tgl;

    $NAMA = htmlspecialchars($DATA["name"]);
    $EMAIL = htmlspecialchars($DATA["email"]);
    $KONTAK = htmlspecialchars($DATA["kontak"]);
    $ALAMAT = htmlspecialchars($DATA["alamat"]);
    $ID = htmlspecialchars($DATA["id"]);





    // update data ke tbl_admin
    $sql_admin = "UPDATE tbl_sekolah SET 
    nama_sekolah='$NAMA',
    kontak_sekolah='$KONTAK',
    alamat_sekolah='$ALAMAT',
    email_sekolah = '$EMAIL' WHERE id_sekolah='$ID' ";



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

// function update_sekolah
function update_logo($file, $target)
{
    global $KONEKSI;

    $namafile = $file['Photo']['name'];
    $sizefile = $file['Photo']['size'];
    $error = $file['Photo']['error'];
    $tmpname = $file['Photo']['tmp_name'];

    // Periksa apakah ada error
    if ($error != 0) {
        echo '<script>alert("Terjadi kesalahan saat mengunggah file.");</script>';
        return false;
    }

    // Validasi ekstensi file
    $ekstensi_valid = ['jpeg', 'png', 'jpg', 'bmp'];
    $ekstensi_file = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi_file, $ekstensi_valid)) {
        echo '<script>alert("Ekstensi file tidak didukung!");</script>';
        return false;
    }

    // Validasi ukuran file
    if ($sizefile > 2000000) {
        echo '<script>alert("Ukuran file melebihi 2MB!");</script>';
        return false;
    }


    $file_path1 = $target . 'favicon.ico';
    $file_path2 = $target . 'logo.png';
    $file_path3 = $target . 'logo-dark.png';


    if (move_uploaded_file($tmpname, $file_path1)) {
        copy($file_path1, $file_path2);
        copy($file_path1, $file_path3);
        echo '<script language="javascript">
                window.alert("File Berhasil Di Upload");
            </script>';
        return true;
    } else {
        echo '<script language="javascript">
                window.alert("File Gagal Di Upload");
            </script>';
        return false;
    }
}

function tambah_tahun($data)
{

    global $KONEKSI;
    global $tgl;


    $NAMA = htmlspecialchars($data["tahun"]);
    $SIMBOL = htmlspecialchars($data["tahun2"]);

    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel

    $sql = "INSERT INTO tbl_tahun SET
    tahun='$NAMA',
    simbol='$SIMBOL'    ";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_tahun($data)
{
    global $KONEKSI;
    global $tgl;

    $TAHUN = htmlspecialchars($_POST["tahun"]);
    $SIMBOL = htmlspecialchars($_POST["tahun2"]);
    $ID = htmlspecialchars($_POST["id"]);


    // update data ke tbl_branch
    $sql = "UPDATE tbl_tahun SET 
    tahun='$TAHUN',
    simbol='$SIMBOL' WHERE id_tahun='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_tahun($data)
{
    global $KONEKSI;
    $id = $data['id'];


    $query = "DELETE FROM tbl_tahun WHERE id_tahun='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}

function tambah_bulan($data)
{

    global $KONEKSI;
    global $tgl;


    $NO = htmlspecialchars($_POST["bulan"]);
    $BULAN = htmlspecialchars($_POST["bulan2"]);

    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel

    $sql = "INSERT INTO tbl_bulan SET
    no_bulan='$NO',
    nama_bulan='$BULAN' ";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_bulan($data)
{
    global $KONEKSI;
    global $tgl;

    $NO = htmlspecialchars($data["bulan"]);
    $BULAN = htmlspecialchars($data["bulan2"]);
    $ID = htmlspecialchars($data["id"]);


    // update data ke tbl_branch
    $sql = "UPDATE tbl_bulan SET 
    no_bulan='$NO',
    nama_bulan='$BULAN' WHERE id_bulan='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_bulan($data)
{
    global $KONEKSI;
    $id = $data['id'];


    $query = "DELETE FROM tbl_bulan WHERE id_bulan='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}

function tambah_tahun_ajaran($data)
{

    global $KONEKSI;
    global $tgl;


    $TAHUN1 = htmlspecialchars($data["tahun"]);
    $TAHUN2 = htmlspecialchars($data["tahun2"]);
    $START = htmlspecialchars($data["start"]);
    $FINISH = htmlspecialchars($data["finish"]);

    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";   

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel

    $tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN1'");
    foreach ($tahun as $key) {
        $ganjil = $key['tahun'];
        $simbol1 = $key['simbol'];
    }
    $tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN2'");
    foreach ($tahun as $key) {
        $genap = $key['tahun'];
        $simbol2 = $key['simbol'];
    }
    $SIMBOL = $simbol1 . $simbol2;

    $sql1 = "UPDATE tbl_tahun_ajaran SET 
    status='Inactive'  ";
    mysqli_query($KONEKSI, $sql1);

    $sql = "INSERT INTO tbl_tahun_ajaran SET
    semester_ganjil='$ganjil',
    semester_genap='$genap',
    tgl_start='$START',
    tgl_finish='$FINISH',
    status='Active',
    simbol_tahun_ajaran='$SIMBOL'";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_tahun_ajaran($data)
{
    global $KONEKSI;
    global $tgl;

    $TAHUN1 = htmlspecialchars($data["tahun"]);
    $TAHUN2 = htmlspecialchars($data["tahun2"]);
    $ID = htmlspecialchars($data["id"]);
    $STATUS = htmlspecialchars($data["status"]);
    $START = htmlspecialchars($data["start"]);
    $FINISH = htmlspecialchars($data["finish"]);


    $tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN1'");
    foreach ($tahun as $key) {
        $ganjil = $key['tahun'];
        $simbol1 = $key['simbol'];
    }
    $tahun = tampil("SELECT * FROM `tbl_tahun` WHERE id_tahun =  '$TAHUN2'");
    foreach ($tahun as $key) {
        $genap = $key['tahun'];
        $simbol2 = $key['simbol'];
    }
    $SIMBOL = $simbol1 . $simbol2;
    if ($STATUS == "Active") {
        $sql1 = "UPDATE tbl_tahun_ajaran SET 
    status='Inactive'  ";
        mysqli_query($KONEKSI, $sql1);
    }


    // update data ke tbl_branch
    $sql = "UPDATE tbl_tahun_ajaran SET 
    simbol_tahun_ajaran='$SIMBOL',
    semester_ganjil='$ganjil',
    semester_genap='$genap',
    tgl_start='$START',
    tgl_finish='$FINISH',
    status='$STATUS' WHERE id_tahun_ajaran='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_tahun_ajaran($data)
{
    global $KONEKSI;
    $id = $data['id'];


    $query = "DELETE FROM tbl_tahun_ajaran WHERE id_tahun_ajaran='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}

function tambah_guru($data, $file, $target)
{

    global $KONEKSI;
    global $tgl;


    $ID = htmlspecialchars($data["kode"]);
    $NAMA = htmlspecialchars($data["name"]);
    $TELEPON = htmlspecialchars($data["telepon"]);
    $START = htmlspecialchars($data["start"]);
    $FINISH = htmlspecialchars($data["finish"]);

    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel
    $gambar_photo = upload_file_new($data, $file, $target);

    // var_dump($gambar_photo);
    // die;

    //jika gambar tidak di upload operasi di hentikan
    if (!$gambar_photo) {
        return false;
    }

    $sql = "INSERT INTO tbl_guru SET
    nip='$ID',
    nama_guru='$NAMA',
    telepon_guru='$TELEPON',
    path_photo='$gambar_photo',
    status='Inactive',
    date_start='$START',
    date_finish='$FINISH',
    create_at='$tgl' ;";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_guru($data, $file, $target)
{
    global $KONEKSI;
    global $tgl;

    $ID = htmlspecialchars($_POST["kode"]);
    $NAMA = htmlspecialchars($_POST["name"]);
    $TELEPON = htmlspecialchars($_POST["telepon"]);
    $START = htmlspecialchars($_POST["start"]);
    $FINISH = htmlspecialchars($_POST["finish"]);
    $STATUS = htmlspecialchars($_POST["status"]);
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



    // update data ke tbl_branch
    $sql = "UPDATE tbl_guru SET 
    nama_guru='$NAMA',
    telepon_guru='$TELEPON',
    path_photo='$foto_baru',
    status='$STATUS',
    date_start='$START',
    date_finish='$FINISH',
    update_at='$tgl' WHERE nip='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_guru($data, $target)
{
    global $KONEKSI;
    $id = $data['id'];


    // hapus file gambar milik USER
    $sql = "SELECT * FROM tbl_guru WHERE nip='$id'";
    $hasil = mysqli_query($KONEKSI, $sql) or die('data tidak ditemukan -->' . mysqli_error($KONEKSI));
    $row = mysqli_fetch_assoc($hasil);

    $photo = $row['path_photo'];

    if (!$photo == "") {
        unlink($target . $photo);
    }
    $query = "DELETE FROM tbl_guru WHERE nip='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}

function tambah_kelas($data)
{

    global $KONEKSI;
    global $tgl;


    $TINGKAT = htmlspecialchars($data["tingkat"]);
    $TAHUN = htmlspecialchars($data["tahun"]);
    $JURUSAN = htmlspecialchars($data["jurusan"]);


    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel

    $sql = "INSERT INTO tbl_kelas SET
    id_tahun_ajaran='$TAHUN',
    tingkat='$TINGKAT',
    jurusan='$JURUSAN'";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_kelas($data)
{
    global $KONEKSI;
    global $tgl;


    $TINGKAT = htmlspecialchars($data["tingkat"]);
    $TAHUN = htmlspecialchars($data["tahun"]);
    $JURUSAN = htmlspecialchars($data["jurusan"]);
    $ID = htmlspecialchars($data["kode"]);


    // update data ke tbl_branch
    $sql = "UPDATE tbl_kelas SET 
    id_tahun_ajaran='$TAHUN',
    tingkat='$TINGKAT',
    jurusan='$JURUSAN' WHERE id_kelas='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_kelas($data)
{
    global $KONEKSI;
    $id = $data['id'];


    $query = "DELETE FROM tbl_kelas WHERE id_kelas='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}

function tambah_jurusan($data)
{

    global $KONEKSI;
    global $tgl;


    $NAMA = htmlspecialchars($data["jurusan"]);
    $SIMBOL = htmlspecialchars($data["jurusan2"]);

    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel

    $sql = "INSERT INTO tbl_jurusan SET
    nama_jurusan='$NAMA',
    simbol_jur='$SIMBOL' ";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_jurusan($data)
{
    global $KONEKSI;
    global $tgl;

    $NAMA = htmlspecialchars($data["jurusan"]);
    $SIMBOL = htmlspecialchars($data["jurusan2"]);
    $ID = htmlspecialchars($data["id"]);


    // update data ke tbl_branch
    $sql = "UPDATE tbl_jurusan SET 
    simbol_jur='$SIMBOL',
    nama_jurusan='$NAMA' WHERE id_jurusan='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_jurusan($data)
{
    global $KONEKSI;
    $id = $data['id'];


    $query = "DELETE FROM tbl_jurusan WHERE id_jurusan='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}


function tambah_siswa($data, $file, $target)
{

    global $KONEKSI;
    global $tgl;


    $ID = htmlspecialchars($data["kode"]);
    $NAMA = htmlspecialchars($data["name"]);
    $ALAMAT = htmlspecialchars($data["alamat"]);
    $TELEPON = htmlspecialchars($data["telepon"]);
    $KELAS = !empty($data["kelas"]) ? "'" . htmlspecialchars($data["kelas"]) . "'" : "null";
    $JENKEL = htmlspecialchars($data["jenkel"]);

    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel
    $gambar_photo = upload_file_new($data, $file, $target);

    // var_dump($gambar_photo);
    // die;

    //jika gambar tidak di upload operasi di hentikan
    if (!$gambar_photo) {
        return false;
    }

    $sql = "INSERT INTO tbl_siswa SET
    nis='$ID',
    nama_siswa='$NAMA',
    telepon_siswa='$TELEPON',
    path_photo='$gambar_photo',
    status='Inactive',
    alamat_siswa='$ALAMAT',
    id_kelas=$KELAS,
    jenkel='$JENKEL',
    create_at='$tgl' ;";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_siswa($data, $file, $target)
{
    global $KONEKSI;
    global $tgl;

    $ID = htmlspecialchars($data["kode"]);
    $NAMA = htmlspecialchars($data["name"]);
    $TELEPON = htmlspecialchars($data["telepon"]);
    $ALAMAT = htmlspecialchars($data["alamat"]);
    $KELAS = !empty($data["kelas"]) ? "'" . htmlspecialchars($data["kelas"]) . "'" : "null";
    $JENKEL = htmlspecialchars($data["jenkel"]);
    $STATUS = htmlspecialchars($data["status"]);
    $PHOTO_LAMA = htmlspecialchars($data["photo_db"]);




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



    // update data ke tbl_branch
    $sql = "UPDATE tbl_siswa SET 
    nama_siswa='$NAMA',
    telepon_siswa='$TELEPON',
    path_photo='$foto_baru',
    status='$STATUS',
    jenkel='$JENKEL',
    id_kelas=$KELAS,
    alamat_siswa='$ALAMAT',
    update_at='$tgl' WHERE nis='$ID' ";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_siswa($data, $target)
{
    global $KONEKSI;
    $id = $data['id'];


    // hapus file gambar milik USER
    $sql = "SELECT * FROM tbl_siswa WHERE nis='$id'";
    $hasil = mysqli_query($KONEKSI, $sql) or die('data tidak ditemukan -->' . mysqli_error($KONEKSI));
    $row = mysqli_fetch_assoc($hasil);

    $photo = $row['path_photo'];

    if (!$photo == "") {
        unlink($target . $photo);
    }
    $query = "DELETE FROM tbl_siswa WHERE nis='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}

function tambah_wali_kelas($data)
{

    global $KONEKSI;
    global $tgl;


    $WALI = htmlspecialchars($data["wali"]);
    $TAHUN = htmlspecialchars($data["tahun"]);
    $KELAS = htmlspecialchars($data["kelas"]);


    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel

    $sql = "INSERT INTO tbl_wali_kelas SET
    id_tahun_ajaran='$TAHUN',
    id_kelas='$KELAS',
    wali_kelas='$WALI'";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_wali_kelas($data)
{
    global $KONEKSI;
    global $tgl;


    $WALI = htmlspecialchars($data["wali"]);
    $TAHUN = htmlspecialchars($data["tahun"]);
    $KELAS = htmlspecialchars($data["kelas"]);


    // update data ke tbl_branch
    $sql = "UPDATE tbl_wali_kelas SET 
    id_tahun_ajaran='$TAHUN',
    wali_kelas='$WALI' WHERE id_kelas='$KELAS'";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_wali_kelas($data)
{
    global $KONEKSI;
    $id = $data['id'];


    $query = "DELETE FROM tbl_wali_kelas WHERE id_kelas='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}

function  tambah_jenis($data)
{

    global $KONEKSI;
    global $tgl;


    $BULANAN = htmlspecialchars($data["bulanan"]);
    $TAHUN = htmlspecialchars($data["tahun"]);
    $NAME = htmlspecialchars($data["name"]);
    $TUNAI = htmlspecialchars($data["tunai"]);


    // echo "<pre>";
    // print_r($data); // melihat data yang akan diterima
    // print_r($file); // melihat file yang akan diterima
    // echo "</pre>";

    // input data ke tabel

    // jika upload berhasil maka insert data ke tabel

    $sql = "INSERT INTO tbl_jenis_pembayaran SET
    nama_jenis='$NAME',
    id_tahun_ajaran='$TAHUN',
    tunai='$TUNAI',
    bulanan='$BULANAN'";

    // cek apakah query berhasil
    if (mysqli_query($KONEKSI, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        return true;
    } else {
        echo "<script>alert('Data gagal ditambahkan (" . mysqli_error($KONEKSI) . ")');</script>";
        return false;
    }
}

function edit_jenis($data)
{
    global $KONEKSI;
    global $tgl;


    $BULANAN = htmlspecialchars($data["bulanan"]);
    $TAHUN = htmlspecialchars($data["tahun"]);
    $NAME = htmlspecialchars($data["name"]);
    $TUNAI = htmlspecialchars($data["tunai"]);
    $ID = htmlspecialchars($data["id"]);


    // update data ke tbl_branch

    $sql = "UPDATE tbl_jenis_pembayaran SET
    nama_jenis='$NAME',
    id_tahun_ajaran='$TAHUN',
    tunai='$TUNAI',
    bulanan='$BULANAN' WHERE id_jenis='$ID'";



    // cek query update
    if (mysqli_query($KONEKSI, $sql)) {
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

function hapus_jenis($data)
{
    global $KONEKSI;
    $id = $data['id'];


    $query = "DELETE FROM tbl_jenis_pembayaran WHERE id_jenis='$id'";

    if (mysqli_query($KONEKSI, $query)) {
        echo '<script language="javascript">
    window.alert("Data Berhasil Di Hapus");
    </script>';
    }
}


function tambah_pembayaran($data)
{
    global $KONEKSI;
    $ID = htmlspecialchars($data["id"]);
    $SEKALI = isset($data["data_pembayaran"]) ? array_map('htmlspecialchars', $data["data_pembayaran"]) : [];
    $BULANAN = isset($data["data_pembayaran_bulan"]) ? array_map('htmlspecialchars', $data["data_pembayaran_bulan"]) : [];

    // Hapus dulu data lama, cek error
    if (!mysqli_query($KONEKSI, "DELETE FROM tbl_pembayaran WHERE nis = '$ID' AND status = 0;")) {
        return false; // gagal delete
    }

    // Insert data sekali, cek error tiap insert
    foreach ($SEKALI as $id_jenis) {
        if (!mysqli_query($KONEKSI, "INSERT INTO tbl_pembayaran (nis, id_jenis, status) VALUES ('$ID', '$id_jenis', 0)")) {
            return false; // gagal insert
        }
    }

    // Insert data bulanan, cek error tiap insert
    foreach ($BULANAN as $item) {
        list($id_jenis, $id_bulan) = explode('-', $item);
        if (!mysqli_query($KONEKSI, "INSERT INTO tbl_pembayaran (nis, id_jenis, id_bulan, status) VALUES ('$ID', '$id_jenis', '$id_bulan', 0)")) {
            return false; // gagal insert
        }
    }

    // Semua query berhasil
    return true;
}

function import_kelas($data)
{
    global $KONEKSI;
    global $tgl;

    $sheetIndex = (int) $data['sheet_index'];
    $id_kelas = (int) $data['id_kelas'];
    $filePath = $data['uploaded_file'];



    try {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheet($sheetIndex);
        $rows = $sheet->toArray();

        $headers = array_shift($rows);

        $rows = array_map(function ($row) {
            if (isset($row[0])) {
                $row[0] = ucwords(strtolower($row[0]));
            }
            return $row;
        }, $rows);

        usort($rows, fn($a, $b) => strcasecmp($a[0] ?? '', $b[0] ?? ''));
        array_unshift($rows, $headers);
    } catch (Exception $e) {
        return [
            'success' => false,
            'errors' => ['File "' . $filePath . '" tidak ditemukan.']
        ];
    }

    $tahun = tampil("SELECT simbol_tahun_ajaran FROM tbl_tahun_ajaran WHERE status = 'Active'");
    $last_kid = tampil("SELECT nis FROM tbl_siswa ORDER BY nis DESC LIMIT 1");
    $last_kid = substr($last_kid[0]['nis'], 4);

    $errors = [];

    // Tahap 1: Validasi semua baris dulu
    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];
        $nama     = trim($row[0] ?? '');
        $telepon  = trim($row[1] ?? '');
        $alamat   = trim($row[2] ?? '');
        $jenkel   = trim($row[3] ?? '');

        if ($nama === '' || $telepon === '' || $alamat === '' || $jenkel === '') {
            $previewNama = implode(' | ', array_filter($row));
            $errors[] = "Baris ke-" . ($i + 1) . " tidak lengkap. Data: \"$previewNama\"";
        }
    }

    // Jika ada error, tampilkan semua sekaligus
    if (!empty($errors)) {
        if (file_exists($filePath)) unlink($filePath);
        return [
            'success' => false,
            'errors' => $errors
        ];
    }

    // Tahap 2: Semua valid, lakukan insert
    $berhasil = 0;
    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];
        $nama     = mysqli_real_escape_string($KONEKSI, trim($row[0] ?? ''));
        $telepon  = mysqli_real_escape_string($KONEKSI, trim($row[1] ?? ''));
        $alamat   = mysqli_real_escape_string($KONEKSI, trim($row[2] ?? ''));
        $jenkel   = mysqli_real_escape_string($KONEKSI, trim($row[3] ?? ''));

        $last_kid++;
        $nis = $tahun[0]['simbol_tahun_ajaran'] . str_pad($last_kid, 6, "0", STR_PAD_LEFT);

        $query = "INSERT INTO tbl_siswa (
            nis, nama_siswa, telepon_siswa, alamat_siswa, jenkel, status, id_kelas, create_at, update_at
        ) VALUES (
            '$nis', '$nama', '$telepon', '$alamat', '$jenkel', 'Active', '$id_kelas', '$tgl', '$tgl'
        )";

        if (mysqli_query($KONEKSI, $query)) {
            $berhasil++;
        }
    }

    //  Hapus file setelah selesai
    if (file_exists($filePath)) {
        unlink($filePath);
    }



    return [
        'success' => true,
        'count' => $berhasil
    ];
}
