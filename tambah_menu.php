<?php
include 'koneksi.php';
include 'cek_login.php';
if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $harga  = $_POST['harga'];
    $kat    = $_POST['kategori'];

    mysqli_query($koneksi,
        "INSERT INTO menu VALUES (NULL,'$kat','$nama','$harga')"
    );

    header("Location: menu.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Tambah Menu</h2>

<form method="post">
    <input type="text" name="nama" placeholder="Nama Menu" required>
    <input type="number" name="harga" placeholder="Harga" required>

    <select name="kategori">
        <?php
        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
        while ($k = mysqli_fetch_assoc($kat)) {
        ?>
        <option value="<?= $k['id_kategori'] ?>">
            <?= $k['nama_kategori'] ?>
        </option>
        <?php } ?>
    </select>

    <button name="simpan">Simpan</button>
</form>

</body>
</html>
