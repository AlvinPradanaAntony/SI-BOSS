<?php
    require ('koneksi.php');
    require ('query.php');
    $obj = new crud;

    $id_rute = $_POST['txt_id_rute'];
    $pemberangkatan = $_POST['txt_pemberangkatan'];
    $waktu_berangkat = $_POST['txt_waktu_berangkat'];
    $tujuan = $_POST['txt_tujuan'];
    $waktu_tiba = $_POST['txt_waktu_tiba'];
    if(!$obj->detailRute($id_rute)) die ("Error: Id tidak ada");
        if($obj->updateRute($pemberangkatan, $waktu_berangkat, $tujuan, $waktu_tiba, $id_rute)){
            echo '<div class="alert alert-success">Data Berhasil disimpan</div>';
            header("Location: sumberData.php");
        } else {
            echo '<div class="alert alert-success">Data gagal disimpan</div>';
            header("Location: sumberData.php");
        }
?>