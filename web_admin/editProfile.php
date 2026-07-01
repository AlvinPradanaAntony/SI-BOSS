<?php
    require ('koneksi.php');
    require ('query.php');
    $obj = new crud;
    
    if (isset($_POST['simpan'])) {
      $id_user_admin = $_POST['txt_id_user_admin'];
      $nama = $_POST['txt_nama'];
      $jenis_kelamin = $_POST['Rbtn_jenis_kelamin'];
      $alamat = $_POST['txt_alamat'];
      $no_hp = $_POST['txt_no_hp'];
      $foto = time() . '-' . $_FILES["txt_fotoEa"]["name"];
      $id_level = $_POST['txt_id_level'];
      $id_terminal = $_POST['txt_id_terminal'];
      $email = $_POST['txt_email'];
      $password = $_POST['txt_password'];

      // For image upload
      $sumber = $_FILES['txt_fotoEa']['tmp_name'];
      $target_dir = "fotoAdmin/";
      move_uploaded_file($sumber, $target_dir.$foto);

    if(!$obj->detailAdministrator($id_user_admin)) die ("Error: Id tidak ada");
        if($obj->updateAdministrator($nama, $jenis_kelamin, $alamat, $no_hp, $foto, $id_level, $id_terminal, $email, $password, $id_user_admin)){
            echo '<div class="alert alert-success">Data Berhasil disimpan</div>';
            header("Location: dashboard.php");
        } else {
            echo '<div class="alert alert-success">Data gagal disimpan</div>';
            header("Location: dashboard.php");
        }
      }
    ?>