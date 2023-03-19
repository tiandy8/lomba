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
        <h3 class="h3">List Pengaduan</h3>
        
        <table class="table list">
            <tr>
                <th class="tlist">No.</th>
                <th class="tlist">Isi Pengaduan</th>
                <th class="tlist">Tanggal Pengaduan</th>
                <th class="tlist">Foto Pengaduan</th>
                <th class="tlist"> Status</th>
                <th class="tlist">Aksi</th>
            </tr>
                <?php
                    $no = 1;
                    $nik = $_SESSION['user']['nik'];
                    $query = mysqli_query($kon, "SELECT pengaduan.*, masyarakat.* FROM pengaduan LEFT JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.status = 'proses' OR pengaduan.status = '0' AND pengaduan.nik = '$nik' " );
                    while($data = mysqli_fetch_array($query)){
                ?>
            <tr>
                        <td class="tlist"><?php echo $no++ ?></td>
                        <td class="tlist"><?php echo $data['tgl_pengaduan'] ?></td>
                        <td class="tlist"><?php echo $data['isi_laporan'] ?></td>
                        <td class="tlist"><img src="gambar/<?php echo $data['foto'] ?>" alt="" width="200px"></td>
                        <td class="tlist"><?php
                            if ($data['status'] == '0') {
                                echo "Belum Diproses";
                            } elseif($data['status'] == 'proses') {
                                echo "Data sedang diproses";
                            }

                        ?></td>
                        <td class="tlist">
                            <div class="wrap">
                            <a href="edit_pengaduan.php?id=<?php echo $data['id_pengaduan']  ?>" class="btn btn-warning btn-sm">Edit</a> 
                            <a href="delete_pengaduan.php?id=<?php echo $data['id_pengaduan']  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"  class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </td>


            </tr>

                <?php } ?>
        </table>
        
    </div>
</div>

</body>
</html>