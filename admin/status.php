<?php

include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($kon, "UPDATE pengaduan SET status='proses' WHERE id_pengaduan = '$id'");

if ($query) {
    header('location:pengaduan.php');
}