<?php
require_once "../inc/function.php";


$target = "../assets/images/users/";

$email = @$_SESSION['email'];
$sql_login = tampil("SELECT `tbl_auth`.*, `tbl_user`.* FROM `tbl_auth` LEFT JOIN `tbl_user` ON `tbl_user`.`auth_id` = `tbl_auth`.`auth_id` WHERE tbl_auth.email='$email';");
$id_user ;

foreach ($sql_login as $user_login) {
    $id_user = $user_login['id_user'];
}

if ($id_user == $_GET['id']) { // jika akun yang di hapus adalah akun yang digunakan, maka ada pesan eror
    echo '<script language="javascript">
    window.alert("Akun ini sedang digunakan. Penghapusan tidak diizinkan! ");
    window.document.location.href="?inc=user_admin";
</script>

<meta http-equiv="refresh" content="1; url=index.php?inc=user_admin">';
die;
}

hapus_user($_GET, $target);

echo "Proses Hapus Data Berhasil...."





?>
<meta http-equiv="refresh" content="1; url=index.php?inc=user_admin">