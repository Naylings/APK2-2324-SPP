<?php
@$pages = $_GET['aksi'];
switch ($pages) {
    case 'add':
        include "tambah.php";
        break;

    case 'edit':
        include "edit.php";
        break;

    default:
        include "add.php";
        break;
}
