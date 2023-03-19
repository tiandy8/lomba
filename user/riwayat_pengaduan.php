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
        <h3 class="h3">Riwayat Pengaduan</h3>
        
        <table class="table list">
            <tr>
                <th class="tlist">No.</th>
                <th class="tlist">Isi Pengaduan</th>
                <th class="tlist">Tanggal Pengaduan</th>
                <th class="tlist">Foto Pengaduan</th>
                <th class="tlist">Status</th>
                <th class="tlist">Tanggapan</th>
            </tr>
                <?php
                    $no = 1;
                    $nik = $_SESSION['user']['nik'];
                    $query = mysqli_query($kon, "SELECT pengaduan.*, masyarakat.* FROM pengaduan LEFT JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.status ='selesai' AND pengaduan.nik = '$nik' ");
                    while($data = mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <td class="tlist"><?php echo $no++ ?></td>
                        <td class="tlist"><?php echo $data['tgl_pengaduan'] ?></td>
                        <td class="tlist"><?php echo $data['isi_laporan'] ?></td>
                        <td class="tlist"><img src="gambar/<?php echo $data['foto'] ?>" alt="" width="200px"></td>
                        <td class="tlist"><?php echo $data['status'] ?></td>


                    </tr>

                <?php } ?>
        </table>
        
    </div>
</div>

</body>
</html>