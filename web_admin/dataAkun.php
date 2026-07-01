<?php
require('koneksi.php');
require('query.php');
$obj = new crud;

session_start();

if (!isset($_SESSION['email'])) {
  header('Location: index.php');
}

$sesID = $_SESSION['id'];
$sesName = $_SESSION['name'];
$sesJK = $_SESSION['jk'];
$sesAlamat = $_SESSION['alamat'];
$sesNoHP = $_SESSION['noHP'];
$sesTerminal = $_SESSION['terminal'];
$sesEmail = $_SESSION['email'];
$sesPass = $_SESSION['pass'];
$sesLvl = $_SESSION['level'];
$sesFoto = $_SESSION['foto'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['txt_nama'];
  $jenis_kelamin = $_POST['Rbtn_jenis_kelamin'];
  $alamat = $_POST['txt_alamat'];
  $no_hp = $_POST['txt_no_hp'];
  $foto = $_POST['txt_foto'];
  $id_level = $_POST['txt_id_level'];
  $id_terminal = $_POST['txt_id_terminal'];
  $email = $_POST['txt_email'];
  $password = $_POST['txt_password'];

  if ($obj->insertAdministrator($nama, $jenis_kelamin, $alamat, $no_hp, $foto, $id_level, $id_jenis, $email, $password)) {
    // echo '<div class="alert alert-success">Terminal Berhasil Ditambahkan</div>';
  } else {
    // echo '<div class="alert alert-danger">Terminal Gagal Ditambahkan</div>';
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nik_user = $_POST['txt_nik_user'];
  $nama_user = $_POST['txt_nama_user'];
  $tempat_lahir_user = $_POST['txt_tempat_lahir_user'];
  $tanggal_lahir_user = $_POST['txt_tanggal_lahir_user'];
  $jenis_kelamin_user = $_POST['Rbtn_jenis_kelamin_user'];
  $alamat_user = $_POST['txt_alamat_user'];
  $no_hp_user = $_POST['txt_no_hp_user'];
  $foto_user = $_POST['txt_foto_user'];
  $email_user = $_POST['txt_email_user'];
  $password_user = $_POST['txt_password_user'];

  if ($obj->insertUser($nik_user, $nama_user, $tempat_lahir_user, $tanggal_lahir_user, $jenis_kelamin_user, $alamat_user, $no_hp_user, $foto_user, $email_user, $password_user)) {
    // echo '<div class="alert alert-success">Terminal Berhasil Ditambahkan</div>';
  } else {
    // echo '<div class="alert alert-danger">Terminal Gagal Ditambahkan</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SI-BOSS Express</title>
  <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="plugin/font/stylesheet.css" />
  <link rel="stylesheet" href="plugin/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />
</head>

<body>
  <div class="sidebar">
    <!-- Logo -->
    <div class="logo-details">
      <i class="fas fa-bus"></i>
      <span class="logo_name">SI-BOSS<span class="logo_nameMin">Express</span></span>
    </div>

    <!-- List Menu -->
    <ul class="nav-links">
      <!-- Heading -->
      <li class="sidebar-heading mb-2 p-0">Menu :</li>
      <li class="nav-item">
        <a href="dashboard.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico" src="img/ico/icoDash_Fill.png" alt="logo1" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard" />
          </div>
          <span class="link_name">Dashboard</span>
          <i class="bx bxs-chevron-right arrow" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard"></i>
        </a>
        <div id="dashboard" class="collapse">
          <ul class="sub-menu">
            <li><a class="link_name" href="dashboard.php">Dashboard</a></li>
            <li><a href="#">Grafik</a></li>
            <li><a href="#">Log</a></li>
            <li><a href="#">Pengaturan</a></li>
          </ul>
        </div>
      </li>
      <li>
        <hr />
      </li>
      <li class="sidebar-heading mt-2 p-0">List Data</li>
      <li class="nav-item">
        <a href="sumberData.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico2" src="img/ico/icoData_noFill.png" alt="logo2" data-bs-toggle="collapse" data-bs-target="#SumberData" aria-expanded="false" aria-controls="SumberData" />
          </div>
          <span class="link_name">Sumber Data</span>
          <i class="bx bxs-chevron-right arrow" data-bs-toggle="collapse" data-bs-target="#SumberData" aria-expanded="false" aria-controls="SumberData"></i>
        </a>
        <div id="SumberData" class="collapse">
          <ul class="sub-menu">
            <li><a class="link_name" href="sumberData.php">Sumber Data</a></li>
            <li><a href="#">Terminal</a></li>
            <li><a href="#">Jenis Bus</a></li>
            <li><a href="#">Rute User</a></li>
            <li><a href="#">Penumpang</a></li>
            <li><a href="#">Staff</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="dataBus.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico2" src="img/ico/icoBus_noFill.png" alt="logo1" />
          </div>
          <span class="link_name">Data Bus</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="dataBus.php">Data Bus</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="dataDriver.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico2" src="img/ico/icoDriver_noFill.png" alt="logo1" />
          </div>
          <span class="link_name">Data Driver</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="dataDriver.php">Data Driver</a></li>
        </ul>
      </li>

      <?php if ($_SESSION['level'] == "1") : ?>
        <li class="nav-item active">
          <a href="#" class="focusMenu">
            <div class="frame-ico">
              <img class="ico2" src="img/ico/iconProfile_Fill.png" alt="logo1" />
            </div>
            <span class="link_name">Data Akun</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Data Akun</a></li>
          </ul>
        </li>
        <li>
          <hr class="seperator" />
        </li>
      <?php endif; ?>

      <li class="sidebar-heading mt-2 p-0">Layanan</li>
      <li class="nav-item">
        <a href="dataPemesanan.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico2" src="img/ico/icoBooking_no Fill.png" alt="logo1" />
          </div>
          <span class="link_name">Pemesanan</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="dataPemesanan.php">Pemesanan</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="dataLaporan.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico2" src="img/ico/icoReport_noFill.png" alt="logo1" />
          </div>
          <span class="link_name">Laporan</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="dataLaporan.php">Laporan</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <div class="profile-details">
          <div class="profile-content">
            <img src="fotoAdmin/<?php echo $sesFoto; ?>" />
          </div>
          <div class="name-job">
            <div class="profile_name">
              <span><?= (str_word_count($sesName) > 2 ? substr($sesName, 0, 9) . "..." : $sesName); ?></span>
            </div>
            <div class="job">Staff</div>
          </div>
          <a class="" href="logout.php"> <i class="bx bx-log-out"></i></a>
        </div>
      </li>
    </ul>
  </div>

  <!-- Content -->
  <div class="home-section">
    <div class="home-content d-flex justify-content-end align-items-center mb-4">
      <div class="menu">
        <i class="fas fa-bars"></i>
      </div>
      <nav class="custNav">
        <ul class="nav">
          <li class="nav-item">
            <a href="#" class="nav-link transition">
              <i class="far fa-bell"></i>
              <?php
              $data = $obj->lihatAdministrator();
              $num = $data->rowCount();
              ?>
              <span class="badge alert-danger p-1"> <?php echo $num - 1; ?> Staff</span>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="RobotoReg14"><?php echo $sesName; ?></span>
              <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo $sesFoto; ?>" />
            </a>

            <ul class="dropdown-menu border-0 dropdown-menu-end shadow" aria-labelledby="dropdownProfile">
              <li>
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editDataAdministrator<?php echo $sesID ?>"><i class="las la-user mr-2"></i>My Profile</a>
              </li>
              <!-- <li>
                  <a class="dropdown-item" href="#"> <i class="las la-list-alt mr-2"></i> Activity Log </a>
                </li> -->
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="logout.php"> <i class="las la-sign-out-alt mr-2"></i> Sign Out </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Profile Modal -->
    <div id="editDataAdministrator<?php echo $sesID ?>" class="modal fade">
      <div class="modal-dialog modal-lg">
        <div class="modal-content modal-edit">
          <form role="form" action="editProfile.php" method="POST" enctype="multipart/form-data">
            <?php
            $query = $obj->pilihAdministrator($sesID);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <div class="modal-header">
                <h4 class="modal-title">Edit Data Administrator</h4>
                <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                  <i class="fa fa-times fa-sm"></i>
                </button>
              </div>
              <div class="modal-body">

                <div class="row">
                  <div class="col-lg-12 mb-3" hidden>
                    <label for="inputId" class="form-label">Id</label>
                    <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_user_admin" value="<?php echo $sesID ?>" placeholder="" readonly />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <!-- <form action="editAdministrator.php" method="POST" enctype="multipart/form-data"> -->
                    <div class="form-group">
                      <label for="InputFotoBus" class="form-label">Foto Administrator</label>
                      <div class="img-div">
                        <div class="img-placeholder" onClick="triggerClick()">
                          <img src="img/ico/icons8_driver_50px.png" alt="" />
                        </div>
                        <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo $sesFoto; ?>" onClick="triggerClick()" id="profileDisplay" />
                        <!-- <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" /> -->
                      </div>
                      <input type="file" name="txt_fotoEa" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" />
                      <!-- <a href="#" class="float-end view text-secondary"> Lihat Foto </a> -->
                    </div>
                  </div>
                  <!-- </form> -->

                  <div class="col-lg-6 mb-3">
                    <label for="inputNama" class="form-label">Nama</label>
                    <input type="text" class="form-control form-control-user2" id="inputNama" name="txt_nama" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesName ?>" />
                    <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1" value="Laki-laki" checked />
                      <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2" value="Perempuan" />
                      <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <label for="inputAlamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control form-control-user2" id="inputAlamat" name="txt_alamat" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesAlamat ?>" />
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="inputNoHp" class="form-label">No Handphone</label>
                    <input type="number" class="form-control form-control-user2" id="inputNoHp" name="txt_no_hp" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesNoHP ?>" />
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-user2" id="inputEmail" name="txt_email" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesEmail ?>" />
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-user2" id="inputPassword" name="txt_password" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesPass ?>" />
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 mb-3" hidden>
                    <label for="inputId" class="form-label">Status</label>
                    <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_level" value="<?php echo $sesLvl ?>" placeholder="" readonly />
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="inputId" class="form-label">Status</label>
                    <input type="text" class="form-control form-control-user2" id="inputId" name="txt" value="Staff" placeholder="" readonly />
                  </div>
                  <div class="col-lg-6 mb-3" hidden>
                                                <label for="inputId" class="form-label">Terminal</label>
                                                <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_terminal" value="<?php echo $sesTerminal?>" placeholder="" readonly />
                                              </div>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-secondary roundedBtn" type="button" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn text-white colorPrimary roundedBtn" name="simpan">Update</button>
                </div>
              </div>
          </form>
        <?php
            }
        ?>
        </div>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row m-0 px-3 rowCustom">
      <!-- Card Total Data Bus -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 gradientBlue shadow h-100 py-2 rounded">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="RobotoReg14 text-white">Data Bus</div>
                <div class="RobotoBold18 text-white">
                  <?php
                  $data = $obj->lihatBus();
                  $num = $data->rowCount();
                  echo $num;
                  ?><span> Bus</span></div>
              </div>
              <div class="col-auto">
                <img src="img/ico/icons8_Shuttle_bus_50px.png" alt="logoBus" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Total Data Driver -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 gradientPink shadow h-100 py-2 rounded">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="RobotoReg14 text-white">Data Driver</div>
                <div class="RobotoBold18 text-white">(Belum Tersedia)</div>
              </div>
              <div class="col-auto">
                <img src="img/ico/icons8_driver_50px.png" alt="logoDriver" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Total Data Pemesanan -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 gradientYellow shadow h-100 py-2 rounded">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="RobotoReg14 text-white">Data Pemesanan</div>
                <div class="RobotoBold18 text-white">
                  <?php
                  $data = $obj->lihatPemesanan();
                  $num = $data->rowCount();
                  echo $num;
                  ?> Pesanan</div>
              </div>
              <div class="col-auto">
                <img src="img/ico/icons8_bus_tickets_50px.png" alt="logoTicket" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Total Data Penghasilan -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 gradientGreen shadow h-100 py-2 rounded">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="RobotoReg14 text-white">Total Penghasilan</div>
                <div class="RobotoBold18 text-white"><span>Rp.</span>
                  <?php
                  $data = $obj->lihatPemesanan();
                  $no = 1;
                  if ($data->rowCount() > 0) {
                    if ($sesLvl == 1) {
                      $dis = "";
                    } else {
                      $dis = "disabled";
                    }
                    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                      $no++;
                      $hargatotal[$no] = $row['total_bayar'];
                    }
                    echo "" . array_sum($hargatotal);
                  } ?></div>
              </div>
              <div class="col-auto">
                <img src="img/ico/icons8_add_dollar_45px.png" alt="logoPay" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Panel -->
    <div class="row g-2 m-0 px-4">
      <div class="col-12">
        <div class="colorSecondary2 shadow roundedPanel">
          <!-- Tabs navs -->
          <ul class="nav nav-tabs bg-white pt-2 px-4 roundedTab custShadow" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tabs-1" type="button" role="tab" aria-controls="tabs-1" aria-selected="true">Administrator</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tabs-2" type="button" role="tab" aria-controls="tabs-2" aria-selected="false">User</button>
            </li>
          </ul>
          <div class="tab-content mb-5" id="ex1-content">
            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
              <div class="row g-2 m-0">
                <div class="col-lg-12 p-0 m-0">
                  <div class="card mb-4 roundedTabContent">
                    <div class="card-header shadow roundedTabContent">
                      <div class="title float-start">
                        <span class="m-0"><b>Tabel Data Administrator</b></span>
                      </div>
                      <div class="btnAction float-end">
                        <button class="btn btn-light text-dark btn-circle custShadow2 me-2" data-bs-toggle="modal" data-bs-target="#tambahDataAdministrator"><i class="fas fa-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
                        <!-- <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-bs-target="#deleteDataAdministrator"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover dataTable nowrap" width="100%">
                          <thead>
                            <tr>
                              <th class="cb">
                                <span class="custom-checkbox">
                                  <input type="checkbox" class="selectAll" />
                                  <label for="selectAll"></label>
                                </span>
                              </th>
                              <th class="actions">Action</th>
                              <th class="id">ID </th>
                              <th class="foto">Foto</th>
                              <th class="nama">Nama</th>
                              <th class="jk">Jenis Kelamin</th>
                              <th class="alamat">Alamat</th>
                              <th class="nohp">No Handphone</th>
                              <th class="level">Status</th>
                              <th class="terminal">Terminal</th>
                              <th class="email">Email</th>
                              <th class="password">Password</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $data = $obj->lihatAdministrator();
                            $no = 1;
                            if ($data->rowCount() > 0) {
                              if ($sesLvl == 1) {
                                $dis = "";
                              } else {
                                $dis = "disabled";
                              }
                              while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                $id_user_admin = $row['id_user_admin'];
                                $nama = $row['nama'];
                                $jenis_kelamin = $row['jenis_kelamin'];
                                $alamat = $row['alamat'];
                                $no_hp = $row['no_hp'];
                                $foto = $row['foto'];
                                $id_level = $row['id_level'];
                                $id_terminal = $row['id_terminal'];
                                $email = $row['email'];
                                $password = $row['password'];
                                $id_level = $row['id_level'];
                                $level = $row['level'];
                                $id_terminal = $row['id_terminal'];
                                $nama_terminal = $row['nama_terminal'];
                            ?>
                                <tr>
                                  <td>
                                    <span class="custom-checkbox">
                                      <input type="checkbox" id="checkbox1" name="option[]" value="<?php echo $no; ?>" />
                                      <label for="checkbox1"></label>
                                    </span>
                                  </td>
                                  <td>
                                    <a href="#" class="actionBtn" aria-label="Edit">
                                      <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAdministrator<?php echo $id_user_admin ?>" value="edit">
                                        &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                      </button>
                                    </a>
                                    <a href="#" class="actionBtn" aria-label="Delete">
                                      <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAdministrator<?php echo $id_user_admin ?>" value="hapus">
                                        <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                      </button>
                                    </a>

                                    <!-- Edit Modal -->
                                    <div id="editDataAdministrator<?php echo $id_user_admin ?>" class="modal fade">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content modal-edit">
                                          <form role="form" action="editAdministrator.php" method="POST" enctype="multipart/form-data">
                                            <?php
                                            $query = $obj->pilihAdministrator($id_user_admin);
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                              <div class="modal-header">
                                                <h4 class="modal-title">Edit Data Administrator</h4>
                                                <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                                  <i class="fa fa-times fa-sm"></i>
                                                </button>
                                              </div>
                                              <div class="modal-body">

                                                <div class="row">
                                                  <div class="col-lg-12 mb-3" hidden>
                                                    <label for="inputId" class="form-label">Id</label>
                                                    <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_user_admin" value="<?php echo $id_user_admin ?>" placeholder="" readonly />
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <!-- <form action="editAdministrator.php" method="POST" enctype="multipart/form-data"> -->
                                                    <div class="form-group">
                                                      <label for="InputFotoBus" class="form-label">Foto Administrator</label>
                                                      <div class="img-div">
                                                        <div class="img-placeholder" onClick="triggerClick()">
                                                          <img src="img/ico/icons8_driver_50px.png" alt="" />
                                                        </div>
                                                        <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" />
                                                      </div>
                                                      <input type="file" name="txt_fotoEa" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" />
                                                      <!-- <a href="#" class="float-end view text-secondary"> Lihat Foto </a> -->
                                                    </div>
                                                  </div>
                                                  <!-- </form> -->

                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputNama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control form-control-user2" id="inputNama" name="txt_nama" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $nama ?>" />
                                                    <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1" value="Laki-laki" checked />
                                                      <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2" value="Perempuan" />
                                                      <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputAlamat" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control form-control-user2" id="inputAlamat" name="txt_alamat" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $alamat ?>" />
                                                  </div>
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputNoHp" class="form-label">No Handphone</label>
                                                    <input type="number" class="form-control form-control-user2" id="inputNoHp" name="txt_no_hp" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $no_hp ?>" />
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control form-control-user2" id="inputEmail" name="txt_email" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $email ?>" />
                                                  </div>
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputPassword" class="form-label">Password</label>
                                                    <input type="password" class="form-control form-control-user2" id="inputPassword" name="txt_password" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $password ?>" />
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="InputIdTerminal" class="form-label">Status</label>
                                                    <select class="form-select form-select-user select-md" aria-label=".form-select-sm example" required data-parsley-required-message="Harap pilih data status !!!" name="txt_id_level">
                                                      <option disabled selected>Pilih Status</option>
                                                      <?php
                                                      $datasd = $obj->lihatLevel();
                                                      $no = 1;
                                                      if ($datasd->rowCount() > 0) {
                                                        if ($sesLvl == 1) {
                                                          $dis = "";
                                                        } else {
                                                          $dis = "disabled";
                                                        }
                                                        while ($row = $datasd->fetch(PDO::FETCH_ASSOC)) {
                                                          $id_levels = $row['id_level'];
                                                          $levels = $row['level'];
                                                      ?>
                                                          <option value="<?php echo $id_levels; ?>"><?php echo $levels; ?></option>
                                                      <?php
                                                        }
                                                      }
                                                      ?>
                                                    </select>
                                                  </div>
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="InputIdTerminal" class="form-label">Terminal</label>
                                                    <select class="form-select form-select-user select-md" aria-label=".form-select-sm example" required data-parsley-required-message="Harap pilih data terminal !!!" name="txt_id_terminal">
                                                      <option disabled selected>Pilih Terminal</option>
                                                      <?php
                                                      $datas = $obj->lihatTerminal();
                                                      $no = 1;
                                                      if ($datas->rowCount() > 0) {
                                                        if ($sesLvl == 1) {
                                                          $dis = "";
                                                        } else {
                                                          $dis = "disabled";
                                                        }
                                                        while ($row = $datas->fetch(PDO::FETCH_ASSOC)) {
                                                          $id_terminals = $row['id_terminal'];
                                                          $nama_terminals = $row['nama_terminal'];
                                                          $provinsis = $row['provinsi_terminal'];
                                                          $kabupatens = $row['kabupaten_terminal'];
                                                          $kecamatans = $row['kecamatan_terminal'];
                                                      ?>
                                                          <option value="<?php echo $id_terminals; ?>"><?php echo $nama_terminals, ' ', $provinsis, ' ', $kabupatens, ' ', $kecamatans; ?></option>
                                                      <?php
                                                        }
                                                      }
                                                      ?>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="modal-footer">
                                                  <button class="btn btn-secondary roundedBtn" type="button" data-bs-dismiss="modal">Batal</button>
                                                  <button type="submit" class="btn text-white colorPrimary roundedBtn" name="simpan">Update</button>
                                                </div>
                                              </div>
                                          </form>
                                        <?php
                                            }
                                        ?>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div id="deleteDataAdministrator<?php echo $id_user_admin; ?>" class="modal fade">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <form action="">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Hapus Administrator</h4>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Apakah Anda yakin ingin menghapus data administrator ini ?</p>
                                              <p class="text-warning"><small>Perlu hati-hati karena data akan hilang selamanya !</small></p>
                                            </div>
                                            <div class="modal-footer">
                                              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                              <a class="btn btn-danger" href="hapusAdministrator.php?id_user_admin=<?php echo $id_user_admin; ?>">Hapus</a>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>A000<?php echo $id_user_admin; ?></td>
                                  <td><img src="fotoAdmin/<?php echo $foto; ?>" class='img-fluid'></td>
                                  <td><?php echo $nama; ?></td>
                                  <td><?php echo $jenis_kelamin; ?></td>
                                  <td><?php echo $alamat; ?></td>
                                  <td><?php echo $no_hp; ?></td>
                                  <td value="<?php echo $id_level ?>"><?php echo $level ?></td>
                                  <td value="<?php echo $id_terminal ?>"><?php echo $nama_terminal ?></td>
                                  <td><?php echo $email ?></td>
                                  <td><?php echo $password ?></td>
                                </tr>
                            <?php
                                $no++;
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- Tambah Modal -->
                    <div id="tambahDataAdministrator" class="modal fade">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content modal-edit">
                          <form role="form" action="tambahAdministrator.php" method="POST">
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Data Administrator</h4>
                              <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                <i class="fa fa-times fa-sm"></i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-12 mb-3" hidden>
                                  <label for="inputId" class="form-label">Id</label>
                                  <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_user_admin" value="<?php echo $id_user_admin ?>" placeholder="" readonly />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="InputFotoBus" class="form-label">Foto Administrator</label>
                                    <div class="img-div">
                                      <div class="img-placeholder" onClick="triggerClick()">
                                        <img src="img/ico/icons8_driver_50px.png" alt="" />
                                      </div>
                                      <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" />
                                    </div>
                                    <input type="file" name="txt_fotot" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none" />
                                    <!-- <a href="#" class="float-end view text-secondary"> Lihat Foto </a> -->
                                  </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                  <label for="inputNama" class="form-label">Nama</label>
                                  <input type="text" class="form-control form-control-user2" id="inputNama" name="txt_nama" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" />
                                  <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1" value="Laki-laki" checked />
                                    <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2" value="Perempuan" />
                                    <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputAlamat" class="form-label">Alamat</label>
                                  <input type="text" class="form-control form-control-user2" id="inputAlamat" name="txt_alamat" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputNoHp" class="form-label">No Handphone</label>
                                  <input type="number" class="form-control form-control-user2" id="inputNoHp" name="txt_no_hp" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputEmail" class="form-label">Email</label>
                                  <input type="email" class="form-control form-control-user2" id="inputEmail" name="txt_email" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputPassword" class="form-label">Password</label>
                                  <input type="password" class="form-control form-control-user2" id="inputPassword" name="txt_password" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="InputIdTerminal" class="form-label">Status</label>
                                  <select class="form-select form-select-user select-md" aria-label=".form-select-sm example" required data-parsley-required-message="Harap pilih data status !!!" name="txt_id_level">
                                    <option disabled selected>Pilih Status</option>
                                    <?php
                                    $datasd = $obj->lihatLevel();
                                    $no = 1;
                                    if ($datasd->rowCount() > 0) {
                                      if ($sesLvl == 1) {
                                        $dis = "";
                                      } else {
                                        $dis = "disabled";
                                      }
                                      while ($row = $datasd->fetch(PDO::FETCH_ASSOC)) {
                                        $id_level = $row['id_level'];
                                        $level = $row['level'];
                                    ?>
                                        <option value="<?php echo $id_level; ?>"><?php echo $level; ?></option>
                                    <?php
                                      }
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="InputIdTerminal" class="form-label">Terminal</label>
                                  <select class="form-select form-select-user select-md" aria-label=".form-select-sm example" required data-parsley-required-message="Harap pilih data terminal !!!" name="txt_id_terminal">
                                    <option disabled selected>Pilih Terminal</option>
                                    <?php
                                    $datas = $obj->lihatTerminal();
                                    $no = 1;
                                    if ($datas->rowCount() > 0) {
                                      if ($sesLvl == 1) {
                                        $dis = "";
                                      } else {
                                        $dis = "disabled";
                                      }
                                      while ($row = $datas->fetch(PDO::FETCH_ASSOC)) {
                                        $id_terminals = $row['id_terminal'];
                                        $nama_terminals = $row['nama_terminal'];
                                        $provinsis = $row['provinsi_terminal'];
                                        $kabupatens = $row['kabupaten_terminal'];
                                        $kecamatans = $row['kecamatan_terminal'];
                                    ?>
                                        <option value="<?php echo $id_terminals; ?>"><?php echo $nama_terminals, ' ', $provinsis, ' ', $kabupatens, ' ', $kecamatans; ?></option>
                                    <?php
                                      }
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>

                              <div class="modal-footer">
                                <button class="btn btn-secondary roundedBtn" type="button" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn text-white colorPrimary roundedBtn" name="simpan">Simpan</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabs User -->
            <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
              <div class="row g-2 m-0">
                <div class="col-lg-12 p-0 m-0">
                  <div class="card mb-4 roundedTabContent">
                    <div class="card-header shadow roundedTabContent">
                      <div class="title float-start">
                        <span class="m-0"><b>Tabel Data User</b></span>
                      </div>
                      <div class="btnAction float-end">
                        <button class="btn btn-light text-dark btn-circle custShadow2 me-2" data-bs-toggle="modal" data-bs-target="#tambahDataUser"><i class="fas fa-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
                        <!-- <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-bs-target="#deleteDataUser"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover dataTable nowrap" width="100%">
                          <thead>
                            <tr>
                              <th class="cb">
                                <span class="custom-checkbox">
                                  <input type="checkbox" class="selectAll" />
                                  <label for="selectAll"></label>
                                </span>
                              </th>
                              <th class="actions">Action</th>
                              <th class="foto">Foto</th>
                              <th class="id">NIK User</th>
                              <th class="nama">Nama User</th>
                              <th class="tempat">Tempat Lahir</th>
                              <th class="tanggal">Tanggal Lahir</th>
                              <th class="jk">Jenis Kelamin</th>
                              <th class="alamat">Alamat</th>
                              <th class="nohp">No Handphone</th>
                              <th class="email">Email</th>
                              <th class="password">Password</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $data = $obj->lihatUser();
                            $no = 1;
                            if ($data->rowCount() > 0) {
                              if ($sesLvl == 1) {
                                $dis = "";
                              } else {
                                $dis = "disabled";
                              }
                              while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                $nik_user = $row['nik_user'];
                                $nama_user = $row['nama_user'];
                                $tempat_lahir_user = $row['tempat_lahir_user'];
                                $tanggal_lahir_user = $row['tanggal_lahir_user'];
                                $jenis_kelamin_user = $row['jenis_kelamin_user'];
                                $alamat_user = $row['alamat_user'];
                                $no_hp_user = $row['no_hp_user'];
                                $foto_user = $row['foto_user'];
                                $email_user = $row['email_user'];
                                $password_user = $row['password_user'];
                            ?>
                                <tr>
                                  <td>
                                    <span class="custom-checkbox">
                                      <input type="checkbox" id="checkbox1" name="option[]" value="<?php echo $no; ?>" />
                                      <label for="checkbox1"></label>
                                    </span>
                                  </td>
                                  <td>
                                    <a href="#" class="actionBtn" aria-label="Edit">
                                      <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataUser<?php echo $nik_user ?>" value="edit">
                                        &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                      </button>
                                    </a>
                                    <a href="#" class="actionBtn" aria-label="Delete">
                                      <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataUser<?php echo $nik_user ?>" value="hapus">
                                        <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                      </button>
                                    </a>

                                    <!-- Edit Modal -->
                                    <div id="editDataUser<?php echo $nik_user ?>" class="modal fade">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content modal-edit">
                                          <form role="form" action="editUser.php" method="POST">
                                            <?php
                                            $query = $obj->pilihUser($nik_user);
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                              <div class="modal-header">
                                                <h4 class="modal-title">Edit Data User</h4>
                                                <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                                  <i class="fa fa-times fa-sm"></i>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <div class="form-group">
                                                      <label for="InputFotoUser" class="form-label">Foto User</label>
                                                      <div class="img-div">
                                                        <div class="img-placeholder" onClick="triggerClick()">
                                                          <img src="img/ico/icons8_driver_50px.png" alt="" />
                                                        </div>
                                                        <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" />
                                                      </div>
                                                      <input type="file" name="txt_foto_usere" onChange="displayImag(this)" id="profileImage" class="form-control" style="display: none" />
                                                      <!-- <a href="#" class="float-end view text-secondary"> Lihat Foto </a> -->
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputId" class="form-label">NIK</label>
                                                    <input type="number" class="form-control form-control-user2" id="inputId" name="txt_nik_user" value="<?php echo $nik_user ?>" placeholder="3509030907020004" readonly />
                                                    <label for="inputNama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control form-control-user2" id="inputNama" name="txt_nama_user" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $nama_user ?>" />
                                                    <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin_user" id="Radios1" value="Laki-laki" checked />
                                                      <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin_user" id="Radios2" value="Perempuan" />
                                                      <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputIdLevel" class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control form-control-user2" id="inputIdLevel" name="txt_tempat_lahir_user" placeholder="Ex: Jember" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $tempat_lahir_user ?>" />
                                                  </div>
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputIdTerminal" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control form-control-user2" id="inputIdTerminal" name="txt_tanggal_lahir_user" placeholder="Ex: 1" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $tanggal_lahir_user ?>" />
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputAlamat" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control form-control-user2" id="inputAlamat" name="txt_alamat_user" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $alamat_user ?>" />
                                                  </div>
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputNoHp" class="form-label">No Handphone</label>
                                                    <input type="number" class="form-control form-control-user2" id="inputNoHp" name="txt_no_hp_user" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $no_hp_user ?>" />
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control form-control-user2" id="inputEmail" name="txt_email_user" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $email_user ?>" />
                                                  </div>
                                                  <div class="col-lg-6 mb-3">
                                                    <label for="inputPassword" class="form-label">Password</label>
                                                    <input type="password" class="form-control form-control-user2" id="inputPassword" name="txt_password_user" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $password_user ?>" />
                                                  </div>
                                                </div>

                                                <div class="modal-footer">
                                                  <button class="btn btn-secondary roundedBtn" type="button" data-bs-dismiss="modal">Batal</button>
                                                  <button type="submit" class="btn text-white colorPrimary roundedBtn" name="simpan">Update</button>
                                                </div>
                                              </div>
                                          </form>
                                        <?php
                                            }
                                        ?>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div id="deleteDataUser<?php echo $nik_user; ?>" class="modal fade">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <form action="">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Hapus User</h4>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Apakah Anda yakin ingin menghapus data user ini ?</p>
                                              <p class="text-warning"><small>Perlu hati-hati karena data akan hilang selamanya !</small></p>
                                            </div>
                                            <div class="modal-footer">
                                              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                              <a class="btn btn-danger" href="hapusUser.php?nik_user=<?php echo $nik_user; ?>">Hapus</a>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td><img src="fotoUser/<?php echo $foto_user; ?>" class='img-fluid'></td>
                                  <td><?php echo $nik_user; ?></td>
                                  <td><?php echo $nama_user; ?></td>
                                  <td><?php echo $tempat_lahir_user; ?></td>
                                  <td><?php echo $tanggal_lahir_user; ?></td>
                                  <td><?php echo $jenis_kelamin_user; ?></td>
                                  <td><?php echo $alamat_user; ?></td>
                                  <td><?php echo $no_hp_user; ?></td>
                                  <td><?php echo $email_user ?></td>
                                  <td><?php echo $password_user ?></td>
                                </tr>
                            <?php
                                $no++;
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- Tambah Modal -->
                    <div id="tambahDataUser" class="modal fade">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content modal-edit">
                          <form role="form" action="tambahUser.php" method="POST">
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Data User</h4>
                              <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                <i class="fa fa-times fa-sm"></i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="InputFotoBus" class="form-label">Foto User</label>
                                    <div class="img-div">
                                      <div class="img-placeholder" onClick="triggerClick()">
                                        <img src="img/ico/IcoeditBusW.png" alt="" />
                                      </div>
                                      <img src="img/ico/IcoeditBus.png" onClick="triggerClick()" id="profileDisplay" />
                                    </div>
                                    <input type="file" name="txt_foto_usert" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none" />
                                    <!-- <a href="#" class="float-end view text-secondary"> Lihat Foto </a> -->
                                  </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputId" class="form-label">NIK</label>
                                  <input type="number" class="form-control form-control-user2" id="inputId" name="txt_nik_user" placeholder="3509030907020004" required data-parsley-required-message="Data harus di isi !!!" />
                                  <label for="inputNama" class="form-label">Nama</label>
                                  <input type="text" class="form-control form-control-user2" id="inputNama" name="txt_nama_user" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" />
                                  <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin_user" id="Radios1" value="Laki-laki" checked />
                                    <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin_user" id="Radios2" value="Perempuan" />
                                    <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputIdLevel" class="form-label">Tempat Lahir</label>
                                  <input type="text" class="form-control form-control-user2" id="inputIdLevel" name="txt_tempat_lahir_user" placeholder="Ex: Jember" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputIdTerminal" class="form-label">Tanggal Lahir</label>
                                  <input type="date" class="form-control form-control-user2" id="inputIdTerminal" name="txt_tanggal_lahir_user" placeholder="Ex: 1" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputAlamat" class="form-label">Alamat</label>
                                  <input type="text" class="form-control form-control-user2" id="inputAlamat" name="txt_alamat_user" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputNoHp" class="form-label">No Handphone</label>
                                  <input type="number" class="form-control form-control-user2" id="inputNoHp" name="txt_no_hp_user" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputEmail" class="form-label">Email</label>
                                  <input type="email" class="form-control form-control-user2" id="inputEmail" name="txt_email_user" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputPassword" class="form-label">Password</label>
                                  <input type="password" class="form-control form-control-user2" id="inputPassword" name="txt_password_user" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>

                              <div class="modal-footer">
                                <button class="btn btn-secondary roundedBtn" type="button" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn text-white colorPrimary roundedBtn" name="simpan">Simpan</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="jquery/jquery-3.6.0.min.js"></script>
  <script src="plugin/js/bootstrap.bundle.min.js"></script>
  <script src="plugin/jquery-easing/jquery.easing.min.js"></script>
  <script src="plugin/js/script.js"></script>
  <script src="plugin/js/calender.js"></script>
  <script src="plugin/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="plugin/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="plugin/js/datatables-demo.js"></script>
  <script src="plugin/js/javascript.js"></script>
  <script src="plugin/js/UpImg.js"></script>
  <script src="plugin/js/parsley.min.js"></script>
</body>

</html>