<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $nik_penumpang = $_POST['txt_nik_penumpang'];
  $nama_penumpang = $_POST['txt_nama_penumpang'];
  $jenis_kelamin_penumpang = $_POST['txt_jenis_kelamin_penumpang'];
  $no_hp_penumpang = $_POST['txt_no_hp_penumpang'];
  if($obj->insertPenumpang($nik_penumpang, $nama_penumpang, $jenis_kelamin_penumpang, $no_hp_penumpang)){
    // echo '<div class="alert alert-success">Terminal Berhasil Ditambahkan</div>';
    header("Location: sumberData.php");
  } else{
    // echo '<div class="alert alert-danger">Terminal Gagal Ditambahkan</div>';
    header("Location: sumberData.php");
  }
}

