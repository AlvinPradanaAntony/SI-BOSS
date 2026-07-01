<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $pemberangkatan = $_POST['txt_pemberangkatan'];
  $waktu_berangkat = $_POST['txt_waktu_berangkat'];
  $tujuan = $_POST['txt_tujuan'];
  $waktu_tiba = $_POST['txt_waktu_tiba'];
  if($obj->insertRute($pemberangkatan, $waktu_berangkat, $tujuan, $waktu_tiba)){
    // echo '<div class="alert alert-success">Terminal Berhasil Ditambahkan</div>';
    header("Location: sumberData.php");
  } else{
    // echo '<div class="alert alert-danger">Terminal Gagal Ditambahkan</div>';
    header("Location: sumberData.php");
  }
}


