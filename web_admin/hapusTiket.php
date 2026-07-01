<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailTiket($_GET['id_tiket'])) die ("Error: Id tidak ada");
    if($obj->deleteTiket($obj->id_tiket)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: dataPemesanan.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: dataPemesanan.php");
    }

?>