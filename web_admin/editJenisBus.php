<?php
    require ('koneksi.php');
    require ('query.php');
    $obj = new crud;

    $id_jenis = $_POST['txt_id_jenis'];
    $jenis = $_POST['txt_jenis'];
    $fasilitas = $_POST['txt_fasilitas'];
    if(!$obj->detailJenisBus($id_jenis)) die ("Error: Id tidak ada");
        if($obj->updateJenisBus($jenis, $fasilitas, $id_jenis)){
            echo '<div class="alert alert-success">Data Berhasil disimpan</div>';
            header("Location: sumberData.php");
        } else {
            echo '<div class="alert alert-success">Data gagal disimpan</div>';
            header("Location: sumberData.php");
        }
?>