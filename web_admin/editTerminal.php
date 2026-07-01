<?php
    require ('koneksi.php');
    require ('query.php');
    $obj = new crud;

    $id_terminal = $_POST['txt_id_terminal'];
    $namaTerminal = $_POST['txt_nama_terminal'];
    $alamatTerminal = $_POST['txt_detail_alamat_terminal'];
    $provinsi = $_POST['d_provinsi_terminal'];
    $kabupaten = $_POST['d_kabupaten_terminal'];
    $kecamatan = $_POST['d_kecamatan_terminal'];
    if(!$obj->detailTerminal($id_terminal)) die ("Error: Id tidak ada");
        if($obj->updateTerminal($namaTerminal, $alamatTerminal, $provinsi, $kabupaten, $kecamatan, $id_terminal)){
            echo '<div class="alert alert-success">Data Berhasil disimpan</div>';
            header("Location: sumberData.php");
        } else {
            echo '<div class="alert alert-success">Data gagal disimpan</div>';
            header("Location: sumberData.php");
        }
?>


