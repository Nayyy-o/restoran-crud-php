<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $tgl  = date('Y-m-d');

    mysqli_query($koneksi,
        "INSERT INTO pesanan VALUES (NULL,'$tgl','$nama',0)"
    );

    $id = mysqli_insert_id($koneksi);
    header("Location: detail_pesanan.php?id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Pesanan Baru</h2>

<form method="post">
    <input type="text" name="nama" placeholder="Nama Pelanggan" required>
    <button name="simpan">Lanjut</button>
</form>

</body>
</html>
