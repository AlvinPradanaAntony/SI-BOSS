<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailPenumpang($_GET['nik_penumpang'])) die ("Error: Id tidak ada");
    if($obj->deletePenumpang($obj->nik_penumpang)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: sumberData.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: sumberData.php");
    }

?>