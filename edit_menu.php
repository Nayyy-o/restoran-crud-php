<?php
include 'koneksi.php';
include 'cek_login.php';
$id = $_GET['id'];

$data = mysqli_query($koneksi,
    "SELECT * FROM menu WHERE id_menu='$id'"
);
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $kat   = $_POST['kategori'];

    mysqli_query($koneksi,
        "UPDATE menu SET
         nama_menu='$nama',
         harga='$harga',
         id_kategori='$kat'
         WHERE id_menu='$id'"
    );

    header("Location: menu.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit Menu</h2>

<form method="post">
    <input type="text" name="nama"
           value="<?= $row['nama_menu'] ?>" required>

    <input type="number" name="harga"
           value="<?= $row['harga'] ?>" required>

    <select name="kategori">
        <?php
        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
        while ($k = mysqli_fetch_assoc($kat)) {
            $selected = ($k['id_kategori'] == $row['id_kategori'])
                        ? "selected" : "";
        ?>
        <option value="<?= $k['id_kategori'] ?>" <?= $selected ?>>
            <?= $k['nama_kategori'] ?>
        </option>
        <?php } ?>
    </select>

    <button name="u
