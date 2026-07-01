<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailBus($_GET['id_bus'])) die ("Error: Id tidak ada");
    if($obj->deleteBus($obj->id_bus)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: dataBus.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: dataBus.php");
    }

?>