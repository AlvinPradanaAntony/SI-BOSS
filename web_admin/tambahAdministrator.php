<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(isset($_POST['simpan'])){
  $nama = $_POST['txt_nama'];
  $jenis_kelamin = $_POST['Rbtn_jenis_kelamin'];
  $alamat = $_POST['txt_alamat'];
  $no_hp = $_POST['txt_no_hp'];
  // $foto = $_POST['txt_foto'];
  $foto = time() . '-' . $_FILES["txt_fotot"]["name"];
  $id_level = $_POST['txt_id_level'];
  $id_terminal = $_POST['txt_id_terminal'];
  $email = $_POST['txt_email'];
  $password = $_POST['txt_password'];

  // For image upload
  $target_dir = "fotoAdmin/";
  $target_file = $target_dir . basename($fotos);
  // VALIDATION
  // validate image size. Size is calculated in Bytes
  if($_FILES['txt_fotot']['size'] > 200000) {
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
    if(move_uploaded_file($_FILES["txt_fotot"]["tmp_name"], $target_file)) {
      $sql = "INSERT INTO administrator SET foto='$fotos'";
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

  if($obj->insertAdministrator($nama, $jenis_kelamin, $alamat, $no_hp, $foto, $id_level, $id_terminal, $email, $password)){
    echo '<div class="alert alert-success">Data Berhasil Ditambahkan</div>';
    header("Location: dataAkun.php");
  } else{
    echo '<div class="alert alert-danger">Data Gagal Ditambahkan</div>';
    header("Location: dataAkun.php");
  }
}


