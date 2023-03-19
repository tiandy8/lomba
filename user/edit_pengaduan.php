<?php
    session_start();
    include "../koneksi.php";

    if (!isset($_SESSION['user'])) {
        header('location:../index.php');
    }

   



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
        $xx = rand() . '_' . $filename;
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
        <h3 class="h3">Form Edit Pengaduan</h3>
        
        <?php         
        $no = 1;
        $id = $_GET['id'];
        $query = mysqli_query($kon, "SELECT * FROM pengaduan WHERE id_pengaduan = '$id' ");
        while($data = mysqli_fetch_array($query)){
        ?>
        <table class="table">
            <form method="post" action="ubah_pengaduan.php" enctype="multipart/form-data">
            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $data['id_pengaduan'] ?>">
                    <input type="hidden" name="nik" value="<?php echo $_SESSION['user']['nik']; ?>">
                    <label for="">Tanggal Pengaduan :</label>
                    <input type="date" value="<?php echo $data['tgl_pengaduan'] ?>" class="form-control mt-3" name="tgl" required>
                </td>
            </tr>
            <tr>
            <td>
                    <label for="">Foto Bukti :</label>
                    <img src="gambar/<?php echo $data['foto'] ?>" width="250px" alt="">
                    <input type="file" class="form-control mt-3" name="foto" >
                </td>
            </tr>
            <tr>
            <td>
                    <label for="">Isi Pengaduan</label>
                    <textarea name="isi" required rows="10" placeholder="Masukkan Pengaduan anda disini" class="form-control mt-3"><?php echo $data['isi_laporan']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
            <button class="form-control mt-3 btn btn-success" type="submit">Update Pengaduan</button>

                </td>
            </tr>
            </form>
        </table>
<?php } ?>
        
    </div>
</div>
</body>
</html>