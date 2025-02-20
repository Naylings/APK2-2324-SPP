<?php
@session_start();
require_once "function.php";

// admin already login check


// cek_role_user(@$_SESSION['email'], @$_SESSION['level']);

// registrasi

if (isset($_POST["registrasi"])) {
    if (registrasi($_POST) > 0) {
        echo '
            <script>
                alert("userbaru berhasil ditambahkan");
                document.location.href="login.php"
            </script>
        ';
    } else {
        echo mysqli_error($KONEKSI);
    }
}


?>

<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true">


<!-- Mirrored from coderthemes.com/hyper/modern/pages-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Apr 2024 07:52:02 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Register | Aplikasi SPP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="../assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="../assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
        <svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
            <g fill-opacity='0.22'>
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100' />
            </g>
        </svg>
    </div>

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <!-- Logo-->
                        <div class="card-header py-4 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="../assets/images/logo.png" alt="logo" height="22"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 fw-bold">Sign Up</h4>
                                <p class="text-muted mb-4">Belum Punya Akun? Buatlah Akun mu Sendiri </p>
                            </div>

                            <form method="post">

                                <input type="hidden" class="" name="auth_id" value="<?php echo autonum("tbl_auth", "auth_id", 6, "AUTH"); ?>">

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" id="username" name="username" placeholder="Masukkan Username" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="text" id="email" name="email" placeholder="Masukkan Email" required>
                                </div>

                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password2" name="password2" class="form-control" placeholder="Masukkan Ulang Password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- <input type="radio" name="role" id="" value="Admin"> Admin
                                <input type="radio" name="role" id="" value="Petugas"> Petugas -->

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" required id="checkbox-signup">
                                        <label class="form-check-label" for="checkbox-signup">I accept <a href="#" class="text-muted">Terms and Conditions</a></label>
                                    </div>
                                </div>

                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary" type="submit" name="registrasi"> Sign Up </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Sudah Punya Akun? <a href="login.php" class="text-muted ms-1"><b>Log In</b></a></p>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        2024 - <script>
            document.write(new Date().getFullYear())
        </script> © Example - Copyright
    </footer>

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

</body>

<!-- Mirrored from coderthemes.com/hyper/modern/pages-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Apr 2024 07:52:02 GMT -->

</html>