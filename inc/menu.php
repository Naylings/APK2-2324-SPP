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
    
        case 'setting':
            include "../pages/setting/setting.php";
            break;
    
            case 'tahun':
                include "../pages/tahun/tahun.php";
                break;
    
                case 'bulan':
                    include "../pages/bulan/bulan.php";
                    break;
    
            case 'tahun_ajaran':
                include "../pages/tahun_ajaran/tahun_ajaran.php";
                break;
    
                case 'jurusan':
                    include "../pages/jurusan/jurusan.php";
                    break;
    
                case 'guru':
                    include "../pages/guru/guru.php";
                    break;
    
                case 'kelas':
                    include "../pages/kelas/kelas.php";
                    break;
    
                case 'wali_kelas':
                    include "../pages/wali_kelas/wali_kelas.php";
                    break;
    
                case 'siswa':
                    include "../pages/siswa/siswa.php";
                    break;

    
                case 'jenis_pem':
                    include "../pages/jenis_pem/jenis_pem.php";
                    break;
    
                case 'pem':
                    include "../pages/pembayaran/pembayaran.php";
                    break;
    
                case 'import':
                    include "../pages/import/import.php";
                    break;
    default:
        include "../pages/master/dashboard.php";
        break;
}
