<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_restoran");

if (!$koneksi) {
    die("Koneksi database gagal");
}
?>
