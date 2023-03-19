<?php
    session_start();
    include "../koneksi.php";

    if (!isset($_SESSION['user'])) {
        header('location:../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/head.php' ?>
<body>

<?php include 'templates/navbar.php'?>

    
<div class="card">
    <div class="card-body">
        <h3 class="h3">Selamat Datang <?php echo $_SESSION['user']['nama']; ?></h3>
        <p>NIK : <?php echo $_SESSION['user']['nik'] ?></p>
        <p>Nomor Telepon : <?php echo $_SESSION['user']['telp'] ?></p>
        <p>Disini anda dapat Melaporkan, Melakukan Pengaduan </p>
        
        <table class="table">
            <tr>
                <td><p>Tanggal Login</p></td>
                <td><p>:</p></td>
                <td><p><?php echo date('d-m-Y'); ?></p></td>
            </tr>
        </table>
        
    </div>
</div>

</body>
</html>