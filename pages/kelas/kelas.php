<?php
@$pages = $_GET['aksi'];
switch ($pages) {
    case 'tampil':
        include "tampil.php";
        break;

    case 'add':
        include "tambah.php";
        break;

    case 'edit':
        include "edit.php";
        break;

    case 'delete':
        include "hapus.php";
        break;

        case 'proses delete':
            include "proses hapus.php";
            break;

            case 'view':
                include "view.php";
                break;


    default:
        include "tampil.php";
        break;
}
