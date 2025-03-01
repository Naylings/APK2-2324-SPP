<?php
@$pages = $_GET['inc'];
switch ($pages) {
    case 'dash':
        include "../pages/master/dashboard.php";
        break;

        case 'table':
            include "../pages/master/table.php";
            break;

            case 'user':
                include "../pages/user/user.php";
                break;

                case 'user_admin':
                    include "../pages/user admin/user.php";
                    break;

    default:
        include "../pages/master/dashboard.php";
        break;
}
