<?php

include 'koneksi.php';
include 'cek_login.php';

$no = 1;
$sql = "
SELECT menu.id_menu, menu.nama_menu, kategori.nama_kategori, menu.harga
FROM menu
JOIN kategori ON menu.id_kategori = kategori.id_kategori
";
$query = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Restoran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>🍽️ Menu Restoran</h2>
<a href="tambah_menu.php">+ Tambah Menu</a>

<table>
    <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama_menu'] ?></td>
        <td><?= $row['nama_kategori'] ?></td>
        <td>Rp <?= number_format($row['harga']) ?></td>
        <td>
            <?php
            echo "<a href='edit_menu.php?id=".$row['id_menu']."'>Edit</a> ";
            echo "<a href='hapus_menu.php?id=".$row['id_menu']."' 
                  onclick=\"return confirm('Hapus menu ini?')\">Hapus</a>";
            ?>
        </td>
    </tr>
    <?php } ?>
<p>
    Login sebagai <b><?= $_SESSION['username'] ?></b> |
    <a href="logout.php">Logout</a>
</p>

</table>

</body>
</html>
