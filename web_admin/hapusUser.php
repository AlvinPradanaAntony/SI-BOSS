<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailUser($_GET['nik_user'])) die ("Error: Id tidak ada");
    if($obj->deleteUser($obj->nik_user)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: dataAkun.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: dataAkun.php");
    }

?>