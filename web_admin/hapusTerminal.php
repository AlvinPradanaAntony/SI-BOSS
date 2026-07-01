<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailTerminal($_GET['id_terminal'])) die ("Error: Id tidak ada");
    if($obj->deleteTerminal($obj->id_terminal)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: sumberData.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: sumberData.php");
    }

?>