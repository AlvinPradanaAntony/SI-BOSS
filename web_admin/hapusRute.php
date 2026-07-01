<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailRute($_GET['id_rute'])) die ("Error: Id tidak ada");
    if($obj->deleteRute($obj->id_rute)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: sumberData.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: sumberData.php");
    }

?>