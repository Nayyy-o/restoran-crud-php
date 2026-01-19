<?php
include 'koneksi.php';
include 'cek_login.php';
$id = $_GET['id'];

// ambil data pesanan
$pesanan = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pesanan='$id'")
);

// tambah item
if (isset($_POST['tambah'])) {
    $menu   = $_POST['menu'];
    $jumlah = $_POST['jumlah'];

    $harga = mysqli_fetch_assoc(
        mysqli_query($koneksi, "SELECT harga FROM menu WHERE id_menu='$menu'")
    )['harga'];

    $subtotal = $harga * $jumlah;

    mysqli_query($koneksi,
        "INSERT INTO detail_pesanan VALUES (NULL,'$id','$menu','$jumlah','$subtotal')"
    );

    mysqli_query($koneksi,
        "UPDATE pesanan 
         SET total = (SELECT SUM(subtotal) FROM detail_pesanan WHERE id_pesanan='$id')
         WHERE id_pesanan='$id'"
    );

    header("Location: detail_pesanan.php?id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Detail Pesanan</h2>
<p>
<b>Nama:</b> <?= $pesanan['nama_pelanggan'] ?><br>
<b>Tanggal:</b> <?= $pesanan['tanggal'] ?>
</p>

<form method="post">
    <select name="menu">
        <?php
        $m = mysqli_query($koneksi, "SELECT * FROM menu");
        while ($menu = mysqli_fetch_assoc($m)) {
        ?>
        <option value="<?= $menu['id_menu'] ?>">
            <?= $menu['nama_menu'] ?> - Rp <?= number_format($menu['harga']) ?>
        </option>
        <?php } ?>
    </select>

    <input type="number" name="jumlah" min="1" value="1">
    <button name="tambah">Tambah</button>
</form>

<br>

<table>
<tr>
    <th>No</th>
    <th>Menu</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$q = mysqli_query($koneksi,
    "SELECT detail_pesanan.id_detail, menu.nama_menu, menu.harga,
            detail_pesanan.jumlah, detail_pesanan.subtotal
     FROM detail_pesanan
     JOIN menu ON detail_pesanan.id_menu = menu.id_menu
     WHERE detail_pesanan.id_pesanan='$id'"
);

while ($d = mysqli_fetch_assoc($q)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama_menu'] ?></td>
    <td>Rp <?= number_format($d['harga']) ?></td>
    <td><?= $d['jumlah'] ?></td>
    <td>Rp <?= number_format($d['subtotal']) ?></td>
    <td>
        <a href="hapus_detail.php?id=<?= $d['id_detail'] ?>&pesanan=<?= $id ?>"
           onclick="return confirm('Hapus item?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<h3>Total: Rp <?= number_format($pesanan['total']) ?></h3>

<a href="pesanan.php">Selesai</a>

</body>
</html>
