<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama_bus = $_POST['txt_nama_bus'];
    $harga = $_POST['txt_harga'];
    $status_bus = $_POST['txt_status_bus'];
    $jumlah_kursi = $_POST['txt_jumlah_kursi'];
    // $foto_bus = $_POST['txt_foto_bus'];
    $foto_bus = time() . '-' . $_FILES["txt_foto_bus"]["name"];
    $tanggal_pemberangkatan = $_POST['txt_tanggal_pemberangkatan'];
    $id_jenis = $_POST['txt_id_jenis'];
    $id_rute = $_POST['txt_id_rute'];

    // For image upload
    $target_dir = "../fotoBus/";
    $target_file = $target_dir . basename($fotos);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['txt_foto_bus']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["txt_foto_bus"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO bus SET foto_bus='$fotos'";
        if(mysqli_query($conn, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
        } else {
          $msg = "There was an error in the database";
          $msg_class = "alert-danger";
        }
      } else {
        $error = "There was an erro uploading the file";
        $msg = "alert-danger";
      }
    }

  if($obj->insertBus($nama_bus, $harga, $status_bus, $jumlah_kursi, $foto_bus, $tanggal_pemberangkatan, $id_jenis, $id_rute)){
    echo '<div class="alert alert-success">Data Berhasil Ditambahkan</div>';
    header("Location: dataBus.php");
  } else{
    echo '<div class="alert alert-danger">Data Gagal Ditambahkan</div>';
    header("Location: dataBus.php");
  }
}


