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
        <h3 class="h3">List Pengaduan</h3>
        
        <table class="table list">
            <tr>
                <th class="tlist">No.</th>
                <th class="tlist">Tgl Pengaduan</th>
                <th class="tlist">Nama</th>
                <th class="tlist">NIK</th>
                <th class="tlist">Isi Pengaduan</th>
                <th class="tlist">Foto Pengaduan</th>
                <th class="tlist">Status</th>
                <th class="tlist">Tanggapan</th>
            </tr>
                <?php
                    $no = 1;
                    $query = mysqli_query($kon, "SELECT pengaduan.*, masyarakat.* FROM pengaduan LEFT JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.status = 'selesai' " );
                    while($data = mysqli_fetch_array($query)){
                ?>
            <tr>
                        <td class="tlist"><?php echo $no++ ?></td>
                        <td class="tlist"><?php echo $data['tgl_pengaduan'] ?></td>
                        <td class="tlist"><?php echo $data['nama'] ?></td>
                        <td class="tlist"><?php echo $data['nik'] ?></td>
                        <td class="tlist"><?php echo $data['isi_laporan'] ?></td>
                        <td class="tlist"><img src="../user/gambar/<?php echo $data['foto'] ?>" alt="" width="200px"></td>
                        <td class="tlist"><?php
                           echo $data['status'];
                        ?></td>
                    <td class="tlist">
                                    <a href="detail.php?id=<?php echo $data['id_pengaduan']  ?> " class="btn btn-sm" >Lihat</a>
                                
                    </td>
            </tr>

                <?php } ?>
        </table>
        
    </div>
</div>

</body>
</html>