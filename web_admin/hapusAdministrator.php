<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!$obj->detailAdministrator($_GET['id_user_admin'])) die ("Error: Id tidak ada");
    if($obj->deleteAdministrator($obj->id_user_admin)){
        echo '<div class="alert alert-success">Data Berhasil dihapus</div>';
        header("Location: dataAkun.php");
    } else {
        echo '<div class="alert alert-success">Data gagal dihapus</div>';
        header("Location: dataAkun.php");
    }

?>