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
        <h3 class="h3">Data Pengaduan</h3>
        
        <table class="table list">
            <tr>
                <th class="tlist">No.</th>
                <th class="tlist">Tgl Pengaduan</th>
                <th class="tlist">Nama</th>
                <th class="tlist">NIK</th>
                <th class="tlist">Isi Pengaduan</th>
                <th class="tlist">Foto Pengaduan</th>
                <th class="tlist">Status</th>
            </tr>
                <?php
                    $no = 1;
                    $id = $_GET['id'];
                    $query = mysqli_query($kon, "SELECT pengaduan.*, masyarakat.* FROM pengaduan LEFT JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE id_pengaduan = '$id' " );
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
                            echo $data['status']

                        ?></td>
                    
            </tr>

                <?php } ?>
        </table>
        <h3 class="h3">Hasil Tanggapan</h3>

        <?php

            mysqli_query($kon, "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan = '$id'");
        
            if (isset($_POST['id_petugas'])) {
                $id_pengaduan = $_POST['id_pengaduan'];
                $tgl = $_POST['tgl'];
                $isi = $_POST['isi'];
                $id_petugas = $_POST['id_petugas'];
                $query = mysqli_query($kon, "INSERT INTO tanggapan (id_pengaduan,tgl_tanggapan,tanggapan,id_petugas) VALUES ('$id_pengaduan','$tgl','$isi','$id_petugas')");

                if ($query) {
                    echo "<script>alert('berhasil memberi tanggapan'), location.href='tanggapan.php'</script>";
                }
            }

        ?>

            <table class="table list">
                <tr>
                    <th class="tlist">Petugas</th>
                    <th class="tlist">Tanggal Tanggapan</th>
                    <th class="tlist">Isi tanggapan</th>
                </tr>
                <?php
                    $id = $_GET['id'];
                    $query = mysqli_query($kon, "SELECT petugas.*,tanggapan.* FROM tanggapan LEFT JOIN petugas ON petugas.id_petugas=tanggapan.id_petugas WHERE tanggapan.id_pengaduan = '$id'  ");
                    while($data = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td class="tlist"><?php echo $data['nama_petugas'] ?></td>
                    <td class="tlist"><?php echo $data['tgl_tanggapan'] ?></td>
                    <td class="tlist"><?php echo $data['tanggapan'] ?></td>
                </tr>

                <?php } ?>
            </table>
    </div>
</div>

</body>
</html> 