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
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $password =  md5($_POST['password']);

    $query = mysqli_query($kon, "INSERT INTO masyarakat(nik,nama,username,telp,password) VALUES ('$nik','$nama','$username','$telp','$password')");

    if ($query) {
        echo "<script>alert('Berhasil Registrasi, silahkan login'), location.href='index.php'</script>";
    } else {
        echo "<script>alert('Gagal Registrasi')</script>";
        
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRASI | APLIKASI PENGADUAN MASYARAKAT</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h3 class="h3 text-center">REGISTRASI AKUN APLIKASI PENGADUAN MASYARAKAT</h3>
    <div class="card">
        <div class="card-body">
        <form method="post">
        <tr>
            <td>
            <label for="">NIK</label>
            <input class="form-control mt-3" type="text" name="nik" required>
            </td>
        </tr>
        <tr>
            <td>
            <label for="">Nama Lengkap</label>
            <input class="form-control mt-3" type="text" name="nama" required>
            </td>
        </tr>
        <tr>
            <td>
            <label for="">Username</label>
            <input class="form-control mt-3" type="text" name="username" required>
            </td>
        </tr>
        <tr>
            <td>
            <label for="">No Telepon</label>
            <input class="form-control mt-3" type="text" name="telp" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Password</label>
                <input class="form-control mt-3" type="password" name="password" required>
            </td>
        </tr>
        <tr>
            <button class="form-control mt-3 btn btn-warning" type="submit">Register</button>
        </tr>
        <tr >
            <td>
                <p class="text-center">Jika anda sudah memiliki akun, <a href="index.php" class="link">Login Disini</a></p>
            </td>
        </tr>
    </form>
        </div>
    </div>
</body>
</html>