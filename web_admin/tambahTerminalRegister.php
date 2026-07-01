<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama_terminal = $_POST['txt_nama_terminal'];
    $alamat_terminal = $_POST['txt_detail_alamat_terminal'];
    $provinsi = $_POST['d_provinsi_terminal'];
    $kabupaten = $_POST['d_kabupaten_terminal'];
    $kecamatan = $_POST['d_kecamatan_terminal'];
    if($obj->insertTerminal($nama_terminal, $alamat_terminal, $provinsi, $kabupaten, $kecamatan)){
      header("Location: registrasi.php");
      // echo '<div class="alert alert-success">Terminal Berhasil Ditambahkan</div>';
    } else{
      // echo '<div class="alert alert-danger">Terminal Gagal Ditambahkan</div>';
      header("Location: registrasi.php");
    }
}


