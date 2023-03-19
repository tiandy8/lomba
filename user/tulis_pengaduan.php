<?php
    session_start();
    include "../koneksi.php";

    if (!isset($_SESSION['user'])) {
        header('location:../index.php');
    }

   
?>


<?php

if (isset($_POST['nik'])) {
    $tgl = $_POST['tgl'];
    $nik = $_POST['nik'];
    $foto = $_POST['foto'];
    $isi = $_POST['isi'];

    $ekstensi = array('png','jpg','jpeg','gif');
    $filename = $_FILES['foto']['name'];
    $filesize = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (in_array($ext,$ekstensi) && $filesize < 10000000) {
        $rand = rand();
        $xx =  $rand . '_' . $filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $xx );
        mysqli_query($kon, "INSERT INTO pengaduan (tgl_pengaduan,nik,foto,isi_laporan) VALUES('$tgl','$nik','$xx','$isi')");
    }
    header('location:tulis_pengaduan.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'templates/head.php' ?>
<body>

<?php include 'templates/navbar.php'?>

    
<div class="card">
    <div class="card-body">
        <h3 class="h3">Form Tulis Pengaduan</h3>
        
        <table class="table">
            <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <input type="hidden" name="nik" value="<?php echo $_SESSION['user']['nik']; ?>">
                    <label for="">Tanggal Pengaduan :</label>
                    <input type="date" class="form-control mt-3" name="tgl" required>
                </td>
            </tr>
            <tr>
            <td>
                    <label for="">Foto Bukti :</label>
                    <input type="file"  class="form-control mt-3" name="foto" required>
                </td>
            </tr>
            <tr>
            <td>
                    <label for="">Isi Pengaduan</label>
                    <textarea name="isi"  required rows="10" placeholder="Masukkan Pengaduan anda disini" class="form-control mt-3"></textarea>
                </td>
            </tr>
            <tr>
                <td>
            <button class="form-control mt-3 btn btn-success" type="submit">Kirim Pengaduan</button>

                </td>
            </tr>
            </form>
        </table>
        
    </div>
</div>

</body>
</html>