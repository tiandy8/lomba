<?php
session_start();
include "../koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($kon, "DELETE FROM pengaduan WHERE id_pengaduan = '$id'");
if ($query) {
    echo "<script>alert('Data berhasil dihapus '), location.href='pengaduan.php'</script>";
}