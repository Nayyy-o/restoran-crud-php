<?php
include 'koneksi.php';
include 'cek_login.php';
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM pesanan ORDER BY id_pesanan DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>🧾 Data Pesanan</h2>
<a href="tambah_pesanan.php">+ Pesanan Baru</a>

<table>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Nama Pelanggan</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['tanggal'] ?></td>
    <td><?= $row['nama_pelanggan'] ?></td>
    <td>Rp <?= number_format($row['total']) ?></td>
    <td>
        <a href="detail_pesanan.php?id=<?= $row['id_pesanan'] ?>">Detail</a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
