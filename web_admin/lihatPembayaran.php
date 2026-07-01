<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailPembayaran($_GET['id_pembayaran'])) die ("Error: Id tidak ada");
    header("Location: dataPemesanan.php");
?>