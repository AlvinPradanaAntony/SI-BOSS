<?php
    require ('koneksi.php');
    require ('query.php');
    $obj = new crud;

    $id_bus = $_POST['txt_id_bus'];
    $nama_bus = $_POST['txt_nama_bus'];
    $harga = $_POST['txt_harga'];
    $status_bus = $_POST['txt_status_bus'];
    $jumlah_kursi = $_POST['txt_jumlah_kursi'];
    $foto_bus = $_POST['txt_foto_bus'];
    $tanggal_pemberangkatan = $_POST['txt_tanggal_pemberangkatan'];
    $id_jenis = $_POST['txt_id_jenis'];
    $id_rute = $_POST['txt_id_rute'];
    if(!$obj->detailBus($id_bus)) die ("Error: Id tidak ada");
        if($obj->updateBus($nama_bus, $harga, $status_bus, $jumlah_kursi, $foto_bus, $tanggal_pemberangkatan, $id_jenis, $id_rute, $id_bus)){
            echo '<div class="alert alert-success">Data Berhasil disimpan</div>';
            header("Location: dataBus.php");
        } else {
            echo '<div class="alert alert-success">Data gagal disimpan</div>';
            header("Location: dataBus.php");
        }
?>