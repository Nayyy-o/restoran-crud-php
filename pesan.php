<?php
session_start();
include 'koneksi.php';

/* buat pesanan otomatis */
if (!isset($_SESSION['pelanggan_pesanan'])) {
    $tgl = date('Y-m-d');
    $nama = 'Pelanggan';

    mysqli_query($koneksi,
        "INSERT INTO pesanan VALUES (NULL,'$tgl','$nama',0)"
    );

    $_SESSION['pelanggan_pesanan'] = mysqli_insert_id($koneksi);
}

/* proses pesan */
if (isset($_POST['pesan'])) {
    $id_menu = $_POST['id_menu'];
    $id_pesanan = $_SESSION['pelanggan_pesanan'];

    $harga = mysqli_fetch_assoc(
        mysqli_query($koneksi,
            "SELECT harga FROM menu WHERE id_menu='$id_menu'")
    )['harga'];

    $subtotal = $harga;

    mysqli_query($koneksi,
        "INSERT INTO detail_pesanan 
         VALUES (NULL,'$id_pesanan','$id_menu',1,'$subtotal')"
    );

    mysqli_query($koneksi,
        "UPDATE pesanan SET total = (
            SELECT SUM(subtotal) FROM detail_pesanan
            WHERE id_pesanan='$id_pesanan'
        ) WHERE id_pesanan='$id_pesanan'"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesan Makanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>🛒 Pesan Makanan</h2>

<table>
<tr>
    <th>Menu</th>
    <th>Harga</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi, "SELECT * FROM menu");
while ($m = mysqli_fetch_assoc($q)) {
?>
<tr>
    <td><?= $m['nama_menu'] ?></td>
    <td>Rp <?= number_format($m['harga']) ?></td>
    <td>
        <form method="post">
            <input type="hidden" name="id_menu" value="<?= $m['id_menu'] ?>">
            <button name="pesan">Pesan</button>
        </form>
    </td>
</tr>
<?php } ?>
</table>

<?php
$total = mysqli_fetch_assoc(
    mysqli_query($koneksi,
        "SELECT total FROM pesanan 
         WHERE id_pesanan='".$_SESSION['pelanggan_pesanan']."'")
)['total'];
?>

<h3>Total: Rp <?= number_format($total) ?></h3>

</body>
</html>
