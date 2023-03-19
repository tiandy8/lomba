<?php

include "../koneksi.php";

$id = $_POST['id'];
$tgl = $_POST['tgl'];
$isi = $_POST['isi'];
$nik = $_POST['nik'];

$ekstensi = array('png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$filesize = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext,$ekstensi)) {
    mysqli_query($kon,"UPDATE pengaduan SET tgl_pengaduan = '$tgl', isi_laporan = '$isi' , nik='$nik' WHERE id_pengaduan = '$id' ");

} else {

    if (in_array($ext,$ekstensi) && $filesize < 10000000) {
        $xx = rand() . '_' . $filename;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $xx);
        mysqli_query($kon,"UPDATE pengaduan SET tgl_pengaduan = '$tgl', isi_laporan = '$isi' , nik='$nik' , foto='$xx' WHERE id_pengaduan = '$id' ");
    }
}
header('location:pengaduan.php');