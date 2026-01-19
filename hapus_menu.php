<?php
include 'koneksi.php';
include 'cek_login.php';
$id = $_GET['id'];

mysqli_query($koneksi,
    "DELETE FROM menu WHERE id_menu='$id'"
);

header("Location: menu.php");
?>
