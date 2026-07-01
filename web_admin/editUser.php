<?php
    require ('koneksi.php');
    require ('query.php');
    $obj = new crud;

    $nik_user = $_POST['txt_nik_user'];
    $nama_user = $_POST['txt_nama_user'];
    $tempat_lahir_user = $_POST['txt_tempat_lahir_user'];
    $tanggal_lahir_user = $_POST['txt_tanggal_lahir_user'];
    $jenis_kelamin_user = $_POST['Rbtn_jenis_kelamin_user'];
    $alamat_user = $_POST['txt_alamat_user'];
    $no_hp_user = $_POST['txt_no_hp_user'];
    // $foto_user = $_POST['txt_foto_user'];
    $foto_user = time() . '-' . $_FILES["txt_foto_usere"]["name"];
    $email_user = $_POST['txt_email_user'];
    $password_user = $_POST['txt_password_user'];

    // For image upload
    $target_dir = "../fotoUser/";
    $target_file = $target_dir . basename($fotos);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['txt_foto_usere']['size'] > 200000) {
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
      if(move_uploaded_file($_FILES["txt_foto_usere"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO user SET foto_user='$fotos'";
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

    if(!$obj->detailUser($nik_user)) die ("Error: Id tidak ada"); 
        if($obj->updateUser($nama_user, $tempat_lahir_user, $tanggal_lahir_user, $jenis_kelamin_user, $alamat_user, $no_hp_user, $foto_user, $email_user, $password_user, $nik_user)){
            echo '<div class="alert alert-success">Data Berhasil disimpan</div>';
            header("Location: dataAkun.php");
        } else {
            echo '<div class="alert alert-success">Data gagal disimpan</div>';
            header("Location: dataAkun.php");
        }
?>