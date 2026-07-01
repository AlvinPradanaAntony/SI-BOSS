<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailJenisBus($_GET['id_jenis'])) die ("Error: Id tidak ada");
    if($obj->deleteJenisBus($obj->id_jenis)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: sumberData.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: sumberData.php");
    }

?>