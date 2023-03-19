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
                            if ($data['status'] == '0') {
                                echo "Belum Diproses";
                            } elseif($data['status'] == 'proses') {
                                echo "Data sedang diproses";
                            }

                        ?></td>
                    
            </tr>

                <?php } ?>
        </table>
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

            <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <input type="hidden" name="id_pengaduan" value="<?php echo $_GET['id'] ?>">
                    <input type="hidden" name="id_petugas" value="<?php echo $_SESSION['user']['id_petugas'] ?>">
                    <label for="">Tanggal Tanggapan :</label>
                    <input type="date" class="form-control mt-3" name="tgl" required>
                </td>
            </tr>
            
            <tr>
            <td>
                    <label for="">Isi Tanggapan</label>
                    <textarea name="isi"  required rows="10" placeholder="Masukkan Pengaduan anda disini" class="form-control mt-3"></textarea>
                </td>
            </tr>
            <tr>
                <td>
            <button class="form-control mt-3 btn btn-success" type="submit">Kirim Tanggapan</button>

                </td>
            </tr>
            </form>
    </div>
</div>

</body>
</html>