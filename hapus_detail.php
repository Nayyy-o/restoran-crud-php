<?php
include 'koneksi.php';

$id_detail = $_GET['id'];
$id_pesanan = $_GET['pesanan'];

mysqli_query($koneksi,
    "DELETE FROM detail_pesanan WHERE id_detail='$id_detail'"
);

mysqli_query($koneksi,
    "UPDATE pesanan 
     SET total = (SELECT IFNULL(SUM(subtotal),0) 
                  FROM detail_pesanan WHERE id_pesanan='$id_pesanan')
     WHERE id_pesanan='$id_pesanan'"
);

header("Location: detail_pesanan.php?id=$id_pesanan");
