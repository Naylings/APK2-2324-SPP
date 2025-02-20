<?php
@session_start();
require_once 'function.php';


cek_role_user(@$_SESSION['username'], @$_SESSION['level']);



if (isset($_POST['login'])) {
    login($_POST);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>X RPL Naya | form css</title>
    <link rel="stylesheet" type="text/css" href="../assets/mystyle.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder=" Isi Username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder=" Isi Password">
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>