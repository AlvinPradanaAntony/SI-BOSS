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

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - SI BOSS</title>
  <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="plugin/font/stylesheet.css" />
  <link rel="stylesheet" href="plugin/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" crossorigin="anonymous" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
    crossorigin="anonymous" />
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
            <img class="ico" src="img/ico/icoDash_Fill.png" alt="logo1" data-bs-toggle="collapse"
              data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard" />
          </div>
          <span class="link_name">Dashboard</span>
          <i class="bx bxs-chevron-right arrow" data-bs-toggle="collapse" data-bs-target="#dashboard"
            aria-expanded="false" aria-controls="dashboard"></i>
        </a>
        <div id="dashboard" class="collapse">
          <ul class="sub-menu">
            <li><a class="link_name" href="#">Dashboard</a></li>
            <li><a href="#">Grafik</a></li>
            <li><a href="#">Log</a></li>
            <li><a href="#">Pengaturan</a></li>
          </ul>
        </div>
      </li>
      <li>
        <hr>
      </li>
      <li class="sidebar-heading mt-2 p-0">List Data</li>
      <li class="nav-item active">
        <a href="sumberData.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico2" src="img/ico/icoData_Fill.png" alt="logo2" data-bs-toggle="collapse"
              data-bs-target="#SumberData" aria-expanded="false" aria-controls="SumberData" />
          </div>
          <span class="link_name">Sumber Data</span>
          <i class="bx bxs-chevron-right arrow" data-bs-toggle="collapse" data-bs-target="#SumberData"
            aria-expanded="false" aria-controls="SumberData"></i>
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
      <li class="nav-item">
        <a href="dataAkun.php" class="focusMenu">
          <div class="frame-ico">
            <img class="ico2" src="img/ico/iconProfile_noFill.png" alt="logo1" />
          </div>
          <span class="link_name">Data Akun</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="dataAkun.php">Data Akun</a></li>
        </ul>
      </li>
      <li>
        <hr class="seperator">
      </li>
      <?php endif ?>

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
            <a class="nav-link dropdown-toggle" id="dropdownProfile" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <span class="RobotoReg14"><?php echo $sesName; ?></span>
              <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo $sesFoto; ?>" />
            </a>

            <ul class="dropdown-menu border-0 dropdown-menu-end shadow" aria-labelledby="dropdownProfile">
              <li>
                <a class="dropdown-item" data-bs-toggle="modal"
                  data-bs-target="#editDataAdministrator<?php echo $sesID ?>"><i class="las la-user mr-2"></i>My
                  Profile</a>
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

    <div id="editDataAdministrator<?php echo $sesID ?>" class="modal fade">
      <div class="modal-dialog modal-lg">
        <div class="modal-content modal-edit">
          <form role="form" action="editAdministrator.php" method="POST" enctype="multipart/form-data">
            <?php
            $query = $obj->pilihAdministrator($sesID);
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Administrator</h4>
              <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal"
                aria-label="Close" aria-hidden="true">
                <i class="fa fa-times fa-sm"></i>
              </button>
            </div>
            <div class="modal-body">

              <div class="row">
                <div class="col-lg-12 mb-3" hidden>
                  <label for="inputId" class="form-label">Id</label>
                  <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_user_admin"
                    value="<?php echo $sesID ?>" placeholder="" readonly />
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
                      <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo $sesFoto; ?>"
                        onClick="triggerClick()" id="profileDisplay" />
                      <!-- <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" /> -->
                    </div>
                    <input type="file" name="txt_fotoEa" onChange="displayImage(this)" id="profileImage"
                      class="form-control" style="display: none;" />
                    <!-- <a href="#" class="float-end view text-secondary"> Lihat Foto </a> -->
                  </div>
                </div>
                <!-- </form> -->

                <div class="col-lg-6 mb-3">
                  <label for="inputNama" class="form-label">Nama</label>
                  <input type="text" class="form-control form-control-user2" id="inputNama" name="txt_nama"
                    placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!"
                    value="<?php echo $sesName ?>" />
                  <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1"
                      value="Laki-laki" checked />
                    <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2"
                      value="Perempuan" />
                    <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputAlamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control form-control-user2" id="inputAlamat" name="txt_alamat"
                    placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!"
                    value="<?php echo $sesAlamat ?>" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputNoHp" class="form-label">No Handphone</label>
                  <input type="number" class="form-control form-control-user2" id="inputNoHp" name="txt_no_hp"
                    placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!"
                    value="<?php echo $sesNoHP ?>" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputEmail" class="form-label">Email</label>
                  <input type="email" class="form-control form-control-user2" id="inputEmail" name="txt_email"
                    placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!"
                    value="<?php echo $sesEmail ?>" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputPassword" class="form-label">Password</label>
                  <input type="password" class="form-control form-control-user2" id="inputPassword" name="txt_password"
                    placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!"
                    value="<?php echo $sesPass ?>" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3" hidden>
                  <label for="inputId" class="form-label">Status</label>
                  <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_level"
                    value="<?php echo $sesLvl ?>" placeholder="" readonly />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputId" class="form-label">Status</label>
                  <input type="text" class="form-control form-control-user2" id="inputId" name="txt" value="Staff"
                    placeholder="" readonly />
                </div>
                <div class="col-lg-6 mb-3" hidden>
                  <label for="inputId" class="form-label">Terminal</label>
                  <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_terminal"
                    value="<?php echo $sesTerminal?>" placeholder="" readonly />
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
              <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tabs-1" type="button"
                role="tab" aria-controls="tabs-1" aria-selected="true">Terminal</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tabs-2" type="button" role="tab"
                aria-controls="tabs-2" aria-selected="false">Jenis Bus</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tabs-3" type="button" role="tab"
                aria-controls="tabs-3" aria-selected="false">Rute</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-4" data-bs-toggle="tab" data-bs-target="#tabs-4" type="button" role="tab"
                aria-controls="tabs-4" aria-selected="false">Penumpang</button>
            </li>
          </ul>
          <!-- Tab terminal -->
          <div class="tab-content mb-5" id="ex1-content">
            <div class="tab-pane show active" id="tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
              <div class="row g-2 m-0">
                <div class="col-lg-12 p-0 m-0">
                  <div class="card mb-4 roundedTabContent">
                    <div class="card-header shadow roundedTabContent">
                      <div class="title float-start">
                        <span class="m-0"><b>Tabel Data Terminal</b></span>
                      </div>
                      <div class="btnAction float-end">
                        <button class="btn btn-light text-dark btn-circle custShadow2 me-2" data-bs-toggle="modal"
                          data-bs-target="#tambahDataTerminal"><i class="fas fa-plus" data-bs-toggle="tooltip"
                            title="Tambah Data"></i></button>
                        <!-- <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-bs-target="#deleteDataTerminal"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
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
                              <th class="id">ID</th>
                              <th class="terminal">Terminal</th>
                              <th class="alamat">Alamat</th>
                              <th class="provinsis">Provinsi</th>
                              <th class="kabupatens">Kabupaten/Kota</th>
                              <th class="kecamatans">Kecamatan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $data = $obj->lihatTerminal();
                            $no = 1;
                            if ($data->rowCount() > 0) {
                              if ($sesLvl == 1) {
                                $dis = "";
                              } else {
                                $dis = "disabled";
                              }
                              while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                $id_terminal = $row['id_terminal'];
                                $terminal = $row['nama_terminal'];
                                $alamat = $row['detail_alamat_terminal'];
                                $provinsi = $row['provinsi_terminal'];
                                $kabupaten = $row['kabupaten_terminal'];
                                $kecamatan = $row['kecamatan_terminal'];
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
                                  <button class="btn btn-success btn-user btn-circle" aria-label="EditModal"
                                    data-bs-toggle="modal" data-bs-target="#editDataTerminal<?php echo $id_terminal ?>"
                                    value="edit">
                                    &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                  </button>
                                </a>
                                <a href="#" class="actionBtn" aria-label="Delete">
                                  <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteDataTerminal<?php echo $id_terminal ?>" value="hapus">
                                    <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                  </button>
                                </a>

                                <!-- Edit Modal -->
                                <div id="editDataTerminal<?php echo $id_terminal ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content modal-edit">
                                      <form role="form" action="editTerminal.php" method="POST">
                                        <?php
                                            $query = $obj->pilihTerminal($id_terminal);
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                        <div class="modal-header">
                                          <h4 class="modal-title">Edit Data Terminal</h4>
                                          <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                            data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                            <i class="fa fa-times fa-sm"></i>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                            <div class="col-lg-12 mb-3" hidden>
                                              <label for="inputId" class="form-label">Id</label>
                                              <input type="text" class="form-control form-control-user2" id="inputId"
                                                name="txt_id_terminal" value="<?php echo $id_terminal ?>" placeholder=""
                                                readonly />
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputTerminal" class="form-label">Nama Terminal</label>
                                              <input type="text" class="form-control form-control-user2"
                                                id="inputTerminal" name="txt_nama_terminal" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                placeholder="Ex: Tawang Alun" value="<?php echo $terminal ?>" />
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputAlamat" class="form-label">Alamat Terminal</label>
                                              <input type="text" class="form-control form-control-user2"
                                                id="inputAlamat" name="txt_detail_alamat_terminal"
                                                placeholder="Ex: Jl. Dharmawangsa" value="<?php echo $alamat ?>"
                                                required data-parsley-required-message="Data harus di isi !!!" />
                                            </div>
                                            <div class="col-12 mb-3">
                                              <label for="InputProvTerminal" class="form-label">Provinsi</label>
                                              <input type="text" class="form-control form-control-user2"
                                                id="InputProvTerminal" name="d_provinsi_terminal"
                                                placeholder="Ex: Jawa Timur" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                value="<?php echo $provinsi ?>" />
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-6 mb-3">
                                              <label for="InputKabupatenTerminal" class="form-label">Kabupaten</label>
                                              <input type="text" class="form-control form-control-user2"
                                                id="InputKabupatenTerminal" name="d_kabupaten_terminal"
                                                placeholder="Ex: Jember" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                value="<?php echo $kabupaten ?>" />
                                            </div>
                                            <div class="col-6 mb-3">
                                              <label for="InputKecamatanTerminal" class="form-label">Kecamatan</label>
                                              <input type="text" class="form-control form-control-user2"
                                                id="InputKecamatanTerminal" name="d_kecamatan_terminal"
                                                placeholder="Ex: Rambupuji" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                value="<?php echo $kecamatan ?>" />
                                            </div>
                                          </div>

                                          <div class="modal-footer">
                                            <button class="btn btn-secondary roundedBtn" type="button"
                                              data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn text-white colorPrimary roundedBtn"
                                              name="simpan">Update</button>
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
                                <div id="deleteDataTerminal<?php echo $id_terminal; ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form action="">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Hapus Terminal</h4>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Apakah Anda yakin ingin menghapus data terminal ini ?</p>
                                          <p class="text-warning"><small>Perlu hati-hati karena data akan hilang
                                              selamanya !</small></p>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-secondary" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                          <a class="btn btn-danger"
                                            href="hapusTerminal.php?id_terminal=<?php echo $id_terminal; ?>">Hapus</a>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>TRML000<?php echo $id_terminal; ?></td>
                              <td><?php echo $terminal; ?></td>
                              <td><?php echo $alamat; ?></td>
                              <td><?php echo $provinsi; ?></td>
                              <td><?php echo $kabupaten; ?></td>
                              <td><?php echo $kecamatan; ?></td>
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
                    <div id="tambahDataTerminal" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content modal-edit">
                          <form role="form" action="tambahTerminal.php" method="POST">
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Data Terminal</h4>
                              <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                <i class="fa fa-times fa-sm"></i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputTerminal" class="form-label">Nama Terminal</label>
                                  <input type="text" class="form-control form-control-user2" id="inputTerminal"
                                    name="txt_nama_terminal" required
                                    data-parsley-required-message="Data harus di isi !!!"
                                    placeholder="Ex: Tawang Alun" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputAlamat" class="form-label">Alamat Terminal</label>
                                  <input type="text" class="form-control form-control-user2" id="inputAlamat"
                                    name="txt_detail_alamat_terminal" required
                                    data-parsley-required-message="Data harus di isi !!!"
                                    placeholder="Ex: Jl. Dharmawangsa" />
                                </div>
                                <div class="col-12 mb-3">
                                  <label for="InputProvTerminal" class="form-label">Provinsi</label>
                                  <input type="text" class="form-control form-control-user2" id="InputProvTerminal"
                                    name="d_provinsi_terminal" required
                                    data-parsley-required-message="Data harus di isi !!!"
                                    placeholder="Ex: Jawa Timur" />
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-6 mb-3">
                                  <label for="InputKabupatenTerminal" class="form-label">Kabupaten</label>
                                  <input type="text" class="form-control form-control-user2" id="InputKabupatenTerminal"
                                    name="d_kabupaten_terminal" required
                                    data-parsley-required-message="Data harus di isi !!!" placeholder="Ex: Jember" />
                                </div>
                                <div class="col-6 mb-3">
                                  <label for="InputKecamatanTerminal" class="form-label">Kecamatan</label>
                                  <input type="text" class="form-control form-control-user2" id="InputKecamatanTerminal"
                                    name="d_kecamatan_terminal" required
                                    data-parsley-required-message="Data harus di isi !!!" placeholder="Ex: Rambupuji" />
                                </div>
                              </div>

                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal"
                                  value="Cancel" />
                                <input type="submit" name="simpan" class="btn colorPrimary text-white roundedBtn"
                                  value="Simpan" />
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

            <!-- Tab Jenis Bus -->
            <div class="tab-pane" id="tabs-2" role="tabpanel" aria-labelledby="tab-2">
              <div class="row g-2 m-0">
                <div class="col-lg-12 p-0 m-0">
                  <div class="card mb-4 roundedTabContent">
                    <div class="card-header shadow roundedTabContent">
                      <div class="title float-start">
                        <span class="m-0"><b>Tabel Data Jenis Bus</b></span>
                      </div>
                      <div class="btnAction float-end">
                        <button class="btn btn-light text-dark btn-circle custShadow2 me-2" data-bs-toggle="modal"
                          data-bs-target="#tambahDataJenisBus"><i class="fas fa-plus" data-bs-toggle="tooltip"
                            title="Tambah Data"></i></button>
                        <!-- <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-bs-target="#deleteDataJenisBus"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover dataTable nowrap" width="100%" id="tabelJenisBus">
                          <thead>
                            <tr>
                              <th class="cb">
                                <span class="custom-checkbox">
                                  <input type="checkbox" class="selectAll" />
                                  <label for="selectAll"></label>
                                </span>
                              </th>
                              <th class="actions">Action</th>
                              <th class="id">ID Jenis Bus</th>
                              <th class="jenis">Jenis Bus</th>
                              <th class="fasilitas">Fasilitas</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $data = $obj->lihatJenisBus();
                            $no = 1;
                            if ($data->rowCount() > 0) {
                              if ($sesLvl == 1) {
                                $dis = "";
                              } else {
                                $dis = "disabled";
                              }
                              while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                $id_jenis = $row['id_jenis'];
                                $jenis = $row['jenis'];
                                $fasilitas = $row['fasilitas'];
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
                                  <button class="btn btn-success btn-user btn-circle" aria-label="EditModal"
                                    data-bs-toggle="modal" data-bs-target="#editDataJenisBus<?php echo $id_jenis ?>"
                                    value="edit">
                                    &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                  </button>
                                </a>
                                <a href="#" class="actionBtn" aria-label="Delete">
                                  <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal"
                                    data-bs-toggle="modal" data-bs-target="#deleteDataJenisBus<?php echo $id_jenis ?>"
                                    value="hapus">
                                    <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                  </button>
                                </a>

                                <!-- Edit Modal -->
                                <div id="editDataJenisBus<?php echo $id_jenis ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content modal-edit">
                                      <form role="form" action="editJenisBus.php" method="POST">
                                        <?php
                                            $query = $obj->pilihJenisBus($id_jenis);
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                              $id_jenis2 = $row['id_jenis'];
                                              $jenis2 = $row['jenis'];
                                              $fasilitas2 = $row['fasilitas'];
                                            ?>
                                        <div class="modal-header">
                                          <h4 class="modal-title">Edit Data Jenis Bus</h4>
                                          <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                            data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                            <i class="fa fa-times fa-sm"></i>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                            <div class="col-lg-12 mb-3" hidden>
                                              <label for="inputId" class="form-label">Id</label>
                                              <input type="text" class="form-control form-control-user2" id="inputId"
                                                name="txt_id_jenis" value="<?php echo $id_jenis2; ?>" placeholder=""
                                                readonly />
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputJenis" class="form-label">Jenis</label>
                                              <input type="text" class="form-control form-control-user2" id="inputJenis"
                                                name="txt_jenis" placeholder="Ex: AKAS" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                value="<?php echo $jenis2; ?>" />
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputFasilitas" class="form-label">Fasilitas</label>
                                              <input type="text" class="form-control form-control-user2"
                                                id="inputFasilitas" name="txt_fasilitas"
                                                placeholder="Ex: TV, AC, Wifi, Toilet" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                value="<?php echo $fasilitas2; ?>" />
                                            </div>
                                          </div>

                                          <div class="modal-footer">
                                            <button class="btn btn-secondary roundedBtn" type="button"
                                              data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn text-white colorPrimary roundedBtn"
                                              name="simpan">Update</button>
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
                                <div id="deleteDataJenisBus<?php echo $id_jenis; ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form action="">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Hapus Jenis Bus</h4>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Apakah Anda yakin ingin menghapus data jenis bus ini ?</p>
                                          <p class="text-warning"><small>Perlu hati-hati karena data akan hilang
                                              selamanya !</small></p>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-secondary" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                          <a class="btn btn-danger"
                                            href="hapusJenisBus.php?id_jenis=<?php echo $id_jenis; ?>">Hapus</a>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>JB000<?php echo $id_jenis; ?></td>
                              <td><?php echo $jenis; ?></td>
                              <td><?php echo $fasilitas; ?></td>
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
                    <div id="tambahDataJenisBus" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content modal-edit">
                          <form role="form" action="tambahJenisBus.php" method="POST">
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Data Jenis Bus</h4>
                              <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                <i class="fa fa-times fa-sm"></i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputJenis" class="form-label">Jenis</label>
                                  <input type="text" class="form-control form-control-user2" id="inputJenis"
                                    name="txt_jenis" placeholder="Ex: AKAS" required
                                    data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputFasilitas" class="form-label">Fasilitas</label>
                                  <input type="text" class="form-control form-control-user2" id="inputFasilitas"
                                    name="txt_fasilitas" placeholder="Ex: TV, AC, Wifi, Toilet" required
                                    data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal"
                                  value="Cancel" />
                                <input type="submit" name="simpan" class="btn colorPrimary text-white roundedBtn"
                                  value="Simpan" />
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

            <!-- Tabs Rute -->
            <div class="tab-pane" id="tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
              <div class="row g-2 m-0">
                <div class="col-lg-12 p-0 m-0">
                  <div class="card mb-4 roundedTabContent">
                    <div class="card-header shadow roundedTabContent">
                      <div class="title float-start">
                        <span class="m-0"><b>Tabel Data Rute</b></span>
                      </div>
                      <div class="btnAction float-end">
                        <button class="btn btn-light text-dark btn-circle custShadow2 me-2" data-bs-toggle="modal"
                          data-bs-target="#tambahDataRute"><i class="fas fa-plus" data-bs-toggle="tooltip"
                            title="Tambah Data"></i></button>
                        <!-- <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-bs-target="#deleteDataRute"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
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
                              <th class="id">ID</th>
                              <th class="pemberangkatan">Pemberangkatan</th>
                              <th class="waktu_berangkat">Waktu Berangkat</th>
                              <th class="tujuan">Tujuan</th>
                              <th class="waktu_tiba">Waktu Tiba</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $data = $obj->lihatRute();
                            $no = 1;
                            if ($data->rowCount() > 0) {
                              if ($sesLvl == 1) {
                                $dis = "";
                              } else {
                                $dis = "disabled";
                              }
                              while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                $id_rute = $row['id_rute'];
                                $pemberangkatan = $row['pemberangkatan'];
                                $waktu_berangkat = $row['waktu_berangkat'];
                                $tujuan = $row['tujuan'];
                                $waktu_tiba = $row['waktu_tiba'];
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
                                  <button class="btn btn-success btn-user btn-circle" aria-label="EditModal"
                                    data-bs-toggle="modal" data-bs-target="#editDataRute<?php echo $id_rute ?>"
                                    value="edit">
                                    &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                  </button>
                                </a>
                                <a href="#" class="actionBtn" aria-label="Delete">
                                  <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal"
                                    data-bs-toggle="modal" data-bs-target="#deleteDataRute<?php echo $id_rute ?>"
                                    value="hapus">
                                    <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                  </button>
                                </a>

                                <!-- Edit Modal -->
                                <div id="editDataRute<?php echo $id_rute ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content modal-edit">
                                      <form role="form" action="editRute.php" method="POST">
                                        <?php
                                            $query = $obj->pilihRute($id_rute);
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                              $id_rute2 = $row['id_rute'];
                                              $pemberangkatan2 = $row['pemberangkatan'];
                                              $waktu_berangkat2 = $row['waktu_berangkat'];
                                              $tujuan2 = $row['tujuan'];
                                              $waktu_tiba2 = $row['waktu_tiba'];
                                            ?>
                                        <div class="modal-header">
                                          <h4 class="modal-title">Edit Data Rute</h4>
                                          <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                            data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                            <i class="fa fa-times fa-sm"></i>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                            <div class="col-lg-12 mb-3" hidden>
                                              <label for="inputId" class="form-label">Id</label>
                                              <input type="text" class="form-control form-control-user2" id="inputId"
                                                name="txt_id_rute" value="<?php echo $id_rute2 ?>" placeholder=""
                                                readonly />
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-lg-6 mb-3">
                                              <label for="InputIdTerminal" class="form-label">Pemberangkatan</label>
                                              <select class="form-select form-select-user select-md"
                                                aria-label=".form-select-sm example" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                name="txt_pemberangkatan">
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
                                                          $id_terminal = $row['id_terminal'];
                                                          $nama_terminal = $row['nama_terminal'];
                                                          $kabupaten = $row['kabupaten_terminal'];
                                                      ?>
                                                <option value="<?php echo $id_terminal; ?>">
                                                  <?php echo $nama_terminal, ', ', $kabupaten; ?></option>
                                                <?php
                                                        }
                                                      }
                                                      ?>
                                              </select>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputWaktuBerangkat" class="form-label">Waktu
                                                Berangkat</label>
                                              <input type="time" class="form-control form-control-user2"
                                                id="inputWaktuBerangkat" name="txt_waktu_berangkat" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                placeholder="Ex: 00.00" value="<?php echo $waktu_berangkat2 ?>"></input>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-lg-6 mb-3">
                                              <label for="InputIdTerminal" class="form-label">Tujuan</label>
                                              <select class="form-select form-select-user select-md"
                                                aria-label=".form-select-sm example" required
                                                data-parsley-required-message="Data harus di isi !!!" name="txt_tujuan">
                                                <option disabled selected>Pilih Terminal</option>
                                                <?php
                                                      $datasd = $obj->lihatTerminal();
                                                      $no = 1;
                                                      if ($datasd->rowCount() > 0) {
                                                        if ($sesLvl == 1) {
                                                          $dis = "";
                                                        } else {
                                                          $dis = "disabled";
                                                        }
                                                        while ($row = $datasd->fetch(PDO::FETCH_ASSOC)) {
                                                          $id_terminals = $row['id_terminal'];
                                                          $nama_terminals = $row['nama_terminal'];
                                                          $kabupatens = $row['kabupaten_terminal'];
                                                      ?>
                                                <option value="<?php echo $id_terminals; ?>">
                                                  <?php echo $nama_terminals, ', ', $kabupatens; ?></option>
                                                <?php
                                                        }
                                                      }
                                                      ?>
                                              </select>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputWaktuTiba" class="form-label">Waktu Tiba</label>
                                              <input type="time" class="form-control form-control-user2"
                                                id="inputWaktuTiba" name="txt_waktu_tiba" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                placeholder="Ex: 06.00" value="<?php echo $waktu_tiba2 ?>"></input>
                                            </div>
                                          </div>

                                          <div class="modal-footer">
                                            <button class="btn btn-secondary roundedBtn" type="button"
                                              data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn text-white colorPrimary roundedBtn"
                                              name="simpan">Update</button>
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
                                <div id="deleteDataRute<?php echo $id_rute; ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form action="">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Hapus Rute</h4>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Apakah Anda yakin ingin menghapus data rute ini ?</p>
                                          <p class="text-warning"><small>Perlu hati-hati karena data akan hilang
                                              selamanya !</small></p>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-secondary" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                          <a class="btn btn-danger"
                                            href="hapusRute.php?id_rute=<?php echo $id_rute; ?>">Hapus</a>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>RT000<?php echo $id_rute; ?></td>
                              <td><?php echo $pemberangkatan; ?></td>
                              <td><?php echo $waktu_berangkat; ?> WIB</td>
                              <td><?php echo $tujuan; ?></td>
                              <td><?php echo $waktu_tiba; ?> WIB</td>
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
                    <div id="tambahDataRute" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content modal-edit">
                          <form role="form" action="tambahRute.php" method="POST">
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Data Rute</h4>
                              <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                <i class="fa fa-times fa-sm"></i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="InputIdTerminal" class="form-label">Pemberangkatan</label>
                                  <select class="form-select form-select-user select-md"
                                    aria-label=".form-select-sm example" required
                                    data-parsley-required-message="Data harus di isi !!!" name="txt_pemberangkatan">
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
                                        $id_terminalt = $row['id_terminal'];
                                        $nama_terminalt = $row['nama_terminal'];
                                        $kabupatent = $row['kabupaten_terminal'];
                                    ?>
                                    <option value="<?php echo $id_terminalt; ?>">
                                      <?php echo $nama_terminalt, ', ', $kabupatent; ?></option>
                                    <?php
                                      }
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputWaktuBerangkat" class="form-label">Waktu Berangkat</label>
                                  <input type="time" class="form-control form-control-user2" id="inputWaktuBerangkat"
                                    name="txt_waktu_berangkat" required
                                    data-parsley-required-message="Data harus di isi !!!"
                                    placeholder="Ex: 00.00"></input>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="InputIdTerminal" class="form-label">Tujuan</label>
                                  <select class="form-select form-select-user select-md"
                                    aria-label=".form-select-sm example" required
                                    data-parsley-required-message="Data harus di isi !!!" name="txt_tujuan">
                                    <option disabled selected>Pilih Terminal</option>
                                    <?php
                                    $datasd = $obj->lihatTerminal();
                                    $no = 1;
                                    if ($datasd->rowCount() > 0) {
                                      if ($sesLvl == 1) {
                                        $dis = "";
                                      } else {
                                        $dis = "disabled";
                                      }
                                      while ($row = $datasd->fetch(PDO::FETCH_ASSOC)) {
                                        $id_terminalst = $row['id_terminal'];
                                        $nama_terminalst = $row['nama_terminal'];
                                        $kabupatenst = $row['kabupaten_terminal'];
                                    ?>
                                    <option value="<?php echo $id_terminalst; ?>">
                                      <?php echo $nama_terminalst, ', ', $kabupatenst; ?></option>
                                    <?php
                                      }
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputWaktuTiba" class="form-label">Waktu Tiba</label>
                                  <input type="time" class="form-control form-control-user2" id="inputWaktuTiba"
                                    name="txt_waktu_tiba" required data-parsley-required-message="Data harus di isi !!!"
                                    placeholder="Ex: 06.00"></input>
                                </div>
                              </div>

                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal"
                                  value="Cancel" />
                                <input type="submit" name="simpan" class="btn colorPrimary text-white roundedBtn"
                                  value="Simpan" />
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

            <!-- Tabs Penumpang   -->
            <div class="tab-pane" id="tabs-4" role="tabpanel" aria-labelledby="ex1-tab-4">
              <div class="row g-2 m-0">
                <div class="col-lg-12 p-0 m-0">
                  <div class="card mb-4 roundedTabContent">
                    <div class="card-header shadow roundedTabContent">
                      <div class="title float-start">
                        <span class="m-0"><b>Tabel Data Penumpang</b></span>
                      </div>
                      <div class="btnAction float-end">
                        <button class="btn btn-light text-dark btn-circle custShadow2 me-2" data-bs-toggle="modal"
                          data-bs-target="#tambahDataPenumpang"><i class="fas fa-plus" data-bs-toggle="tooltip"
                            title="Tambah Data"></i></button>
                        <!-- <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-bs-target="#deleteDataPenumpang"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
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
                              <th class="nik">NIK Penumpang </th>
                              <th class="nama">Nama Penumpang</th>
                              <th class="jk">Jenis Kelamin</th>
                              <th class="no_hp">No Handphone</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $data = $obj->lihatPenumpang();
                            $no = 1;
                            if ($data->rowCount() > 0) {
                              if ($sesLvl == 1) {
                                $dis = "";
                              } else {
                                $dis = "disabled";
                              }
                              while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                $nik_penumpang = $row['nik_penumpang'];
                                $nama_penumpang = $row['nama_penumpang'];
                                $jenis_kelamin_penumpang = $row['jenis_kelamin_penumpang'];
                                $no_hp_penumpang = $row['no_hp_penumpang'];
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
                                  <button class="btn btn-success btn-user btn-circle" aria-label="EditModal"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDataPenumpang<?php echo $nik_penumpang ?>" value="edit">
                                    &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                  </button>
                                </a>
                                <a href="#" class="actionBtn" aria-label="Delete">
                                  <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteDataPenumpang<?php echo $nik_penumpang; ?>" value="hapus">
                                    <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                  </button>
                                </a>

                                <!-- Edit Modal -->
                                <div id="editDataPenumpang<?php echo $nik_penumpang ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content modal-edit">
                                      <form role="form" action="editPenumpang.php" method="POST">
                                        <?php
                                            $query = $obj->pilihPenumpang($nik_penumpang);
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                              $nik_penumpang2 = $row['nik_penumpang'];
                                              $nama_penumpang2 = $row['nama_penumpang'];
                                              $jenis_kelamin_penumpang2 = $row['jenis_kelamin_penumpang'];
                                              $no_hp_penumpang2 = $row['no_hp_penumpang'];
                                            ?>
                                        <div class="modal-header">
                                          <h4 class="modal-title">Edit Data Penumpang</h4>
                                          <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                            data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                            <i class="fa fa-times fa-sm"></i>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputNik" class="form-label">NIK Penumpang</label>
                                              <input type="number" class="form-control form-control-user2" id="inputNik"
                                                name="txt_nik_penumpang" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                data-parsley-length="[15,16]" maxlength="16" data-parsley-number="1"
                                                placeholder="Ex: 3509030907020006" value="<?php echo $nik_penumpang2 ?>"
                                                placeholder="" readonly />
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputNamaPenumpang" class="form-label">Nama Penumpang</label>
                                              <input type="text" class="form-control form-control-user2"
                                                id="inputNamaPenumpang" name="txt_nama_penumpang" required
                                                data-parsley-required-message="Data harus di isi !!!"
                                                placeholder="Ex: Budi Santoso" value="<?php echo $nama_penumpang2 ?>" />
                                            </div>

                                          </div>

                                          <div class="row">
                                            <div class="col-lg-6 mb-3">
                                              <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                  name="txt_jenis_kelamin_penumpang" id="Radios1" value="Laki-laki"
                                                  checked />
                                                <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                  name="txt_jenis_kelamin_penumpang" id="Radios2" value="Perempuan" />
                                                <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                                              </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                              <label for="inputNoHp" class="form-label">No Handphone</label>
                                              <input type="number" class="form-control form-control-user2"
                                                id="inputNoHp" name="txt_no_hp_penumpang" placeholder="Ex: 085808241204"
                                                required data-parsley-required-message="Data harus di isi !!!"
                                                value="<?php echo $no_hp_penumpang2 ?>" />
                                            </div>
                                          </div>

                                          <div class="modal-footer">
                                            <button class="btn btn-secondary roundedBtn" type="button"
                                              data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn text-white colorPrimary roundedBtn"
                                              name="simpan">Update</button>
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
                                <div id="deleteDataPenumpang<?php echo $nik_penumpang; ?>" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form action="">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Hapus Penumpang</h4>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Apakah Anda yakin ingin menghapus data <?php echo $nik_penumpang; ?> ini ?</p>
                                          <p class="text-warning"><small>Perlu hati-hati karena data akan hilang
                                              selamanya !</small></p>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-secondary" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                          <a class="btn btn-danger"
                                            href="hapusPenumpang.php?nik_penumpang=<?php echo $nik_penumpang; ?>">Hapus</a>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td><?php echo $nik_penumpang; ?></td>
                              <td><?php echo $nama_penumpang; ?></td>
                              <td><?php echo $jenis_kelamin_penumpang; ?></td>
                              <td><?php echo $no_hp_penumpang; ?></td>
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
                    <div id="tambahDataPenumpang" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content modal-edit">
                          <form role="form" action="tambahPenumpang.php" method="POST">
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Data Penumpang</h4>
                              <button type="button" class="btn btn-danger btn-circle btn-user2 shadow"
                                data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                <i class="fa fa-times fa-sm"></i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="inputNikPenumpang" class="form-label">NIK Penumpang</label>
                                  <input type="number" class="form-control form-control-user2" id="inputNikPenumpang"
                                    name="txt_nik_penumpang" placeholder="Ex: 3509030907020006" required
                                    data-parsley-required-message="Data harus di isi !!!" data-parsley-length="[15,16]"
                                    maxlength="16" data-parsley-number="1" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputNamaPenumpang" class="form-label">Nama Penumpang</label>
                                  <input type="text" class="form-control form-control-user2" id="inputNamaPenumpang"
                                    name="txt_nama_penumpang" placeholder="Ex: Budi Santoso" required
                                    data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-6 mb-3">
                                  <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="txt_jenis_kelamin_penumpang"
                                      id="Radios1" value="Laki-laki" checked />
                                    <label class="form-label2" for="Radios1"><span>Laki-laki</span></label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="txt_jenis_kelamin_penumpang"
                                      id="Radios2" value="Perempuan" />
                                    <label class="form-label2" for="Radios2"><span>Perempuan</span></label>
                                  </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                  <label for="inputNoHp" class="form-label">No Handphone</label>
                                  <input type="number" class="form-control form-control-user2" id="inputNoHp"
                                    name="txt_no_hp_penumpang" placeholder="Ex: 085808241204" required
                                    data-parsley-required-message="Data harus di isi !!!" />
                                </div>
                              </div>

                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal"
                                  value="Cancel" />
                                <input type="submit" name="simpan" class="btn colorPrimary text-white roundedBtn"
                                  value="Simpan" />
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
  <script src="plugin/js/dataWilayah.js"></script>
  <script src="plugin/js/dataWilayahT.js"></script>
  <script src="plugin/js/parsley.min.js"></script>
  <script>
    window.Parsley.addValidator("uppercase", {
      requirementType: "number",
      validateString: function (value, requirement) {
        var uppercases = value.match(/[A-Z]/g) || [];
        return uppercases.length >= requirement;
      },
      messages: {
        en: "Password harus terdiri dari minimal (%s) huruf kapital !!!",
      },
    });

    //has lowercase
    window.Parsley.addValidator("lowercase", {
      requirementType: "number",
      validateString: function (value, requirement) {
        var lowecases = value.match(/[a-z]/g) || [];
        return lowecases.length >= requirement;
      },
      messages: {
        en: "Password harus terdiri dari huruf abjad !!!",
      },
    });

    //has number
    window.Parsley.addValidator("number", {
      requirementType: "number",
      validateString: function (value, requirement) {
        var numbers = value.match(/[0-9]/g) || [];
        return numbers.length >= requirement;
      },
      messages: {
        en: "Password harus terdiri dari minimal (%s) angka !!!",
      },
    });

    //has special char
    window.Parsley.addValidator("special", {
      requirementType: "number",
      validateString: function (value, requirement) {
        var specials = value.match(/[^a-zA-Z0-9]/g) || [];
        return specials.length >= requirement;
      },
      messages: {
        en: "Your password must contain at least (%s) special characters.",
      },
    });
  </script>
</body>

</html>