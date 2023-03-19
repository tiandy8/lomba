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

<?php include 'templates/nav.php'?>

    
<div class="card">
    <div class="card-body">
        <h3 class="h3">Selamat Datang <?php echo $_SESSION['user']['nama_petugas']; ?></h3>
        <p>Level : <?php echo $_SESSION['user']['level'] ?></p>
        <p>Nomor Telepon : <?php echo $_SESSION['user']['telp'] ?></p>
        <p>Tanggal Login : <?php echo date('d-m-Y'); ?> </p>        
        
        
    </div>
</div>

</body>
</html>