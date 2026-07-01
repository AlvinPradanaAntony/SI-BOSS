<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $jenis = $_POST['txt_jenis'];
  $fasilitas = $_POST['txt_fasilitas'];
  if($obj->insertJenisBus($jenis, $fasilitas)){
    echo '<div class="alert alert-success">Jenis Bus Berhasil Ditambahkan</div>';
    header("Location: sumberData.php");
  } else{
    echo '<div class="alert alert-danger">Jenis Bus Gagal Ditambahkan</div>';
    header("Location: sumberData.php");
  }
}


