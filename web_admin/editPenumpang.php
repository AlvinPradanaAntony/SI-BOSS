<?php
    require ('koneksi.php');
    require ('query.php');
    $obj = new crud;

    $nik_penumpang = $_POST['txt_nik_penumpang'];
    $nama_penumpang = $_POST['txt_nama_penumpang'];
    $jenis_kelamin_penumpang = $_POST['txt_jenis_kelamin_penumpang'];
    $no_hp_penumpang = $_POST['txt_no_hp_penumpang'];
    if(!$obj->detailPenumpang($nik_penumpang)) die ("Error: Id tidak ada");
        if($obj->updatePenumpang($nama_penumpang, $jenis_kelamin_penumpang, $no_hp_penumpang, $nik_penumpang)){
            echo '<div class="alert alert-success">Data Berhasil disimpan</div>';
            header("Location: sumberData.php");
        } else {
            echo '<div class="alert alert-success">Data gagal disimpan</div>';
            header("Location: sumberData.php");
        }
?>