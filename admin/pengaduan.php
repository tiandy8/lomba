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
                <th class="tlist">Aksi</th>
            </tr>
                <?php
                    $no = 1;
                    $query = mysqli_query($kon, "SELECT pengaduan.*, masyarakat.* FROM pengaduan LEFT JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.status = 'proses' OR pengaduan.status = '0' " );
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
                            if ($data['status'] == '0') {
                                echo "Belum Diproses";
                            } elseif($data['status'] == 'proses') {
                                echo "Data sedang diproses";
                            }

                        ?></td>
                    <td class="tlist">
                            <?php 
                                if ($data['status'] == '0') {
                                    echo '<a href="status.php?id=' . $data['id_pengaduan'] . '" class="btn btn-sm btn-warning">Proses Data</a>';
                                } elseif($data['status'] == 'proses') {
                                    echo '<a href="tanggapi.php?id='.   $data['id_pengaduan']  . '" class="btn btn-sm" >Tanggapi</a>';
                                }
                            ?>
                    </td>
            </tr>

                <?php } ?>
        </table>
        
    </div>
</div>

</body>
</html>