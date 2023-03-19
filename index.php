<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['user']['level'])) {
        header('location:admin/dashboard.php');
    } else {
        header('location:user/dashboard.php');
    }
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek_petugas = mysqli_query($kon, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");

    if (mysqli_num_rows($cek_petugas) > 0) {
        $_SESSION['user'] = mysqli_fetch_array($cek_petugas);
        echo '<script>alert("selamat, anda berhasil login"); location.href="admin/dashboard.php"</script>';
    } else {
        $cek_masyarakat = mysqli_query($kon, "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password'");

        if (mysqli_num_rows($cek_masyarakat) > 0) {
            $_SESSION['user'] = mysqli_fetch_array($cek_masyarakat);
            echo '<script>alert("selamat, anda berhasil login"); location.href="user/dashboard.php"</script>';
        } else {
            echo '<script>alert("anda gagal login");</script>';
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | APLIKASI PENGADUAN MASYARAKAT</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h3 class="h3 text-center">LOGIN APLIKASI PENGADUAN MASYARAKAT</h3>
    <div class="card">
        <div class="card-body">
        <form method="post">
        <tr>
            <td>
            <label for="">Username</label>
            <input class="form-control mt-3" type="text" name="username" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Password</label>
                <input class="form-control mt-3" type="password" name="password" required>
            </td>
        </tr>
        <tr>
            <button class="form-control mt-3 btn btn-success" type="submit">Login</button>
        </tr>
        <tr >
            <td>
                <p class="text-center">Jika anda belum memiliki akun, <a href="register.php" class="link">Registrasi Disini</a></p>
            </td>
        </tr>
    </form>
        </div>
    </div>
</body>
</html>