<?php
@$pages = $_GET['inc'];
switch ($pages) {
    case 'dash':
        include "../pages/master/dashboard.php";
        break;

        case 'table':
            include "../pages/master/table.php";
            break;

        case 'setting':
            include "../pages/setting/setting.php";
            break;

    default:
        include "../pages/master/dashboard.php";
        break;
}
