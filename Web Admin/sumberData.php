<!-- <?php
require('koneksi.php');
session_start();

if(!isset($_SESSION['email'])){
    header('Location: index.php');
}

$sesName = $_SESSION['name'];

?> -->
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" crossorigin="anonymous" />
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
        <li><hr></li>
        <li class="sidebar-heading mt-2 p-0">List Data</li>
        <li class="nav-item active">
          <a href="#" class="focusMenu">
            <div class="frame-ico">
              <img class="ico2" src="img/ico/icoData_Fill.png" alt="logo2" data-bs-toggle="collapse" data-bs-target="#SumberData" aria-expanded="false" aria-controls="SumberData" />
            </div>
            <span class="link_name">Sumber Data</span>
            <i class="bx bxs-chevron-right arrow" data-bs-toggle="collapse" data-bs-target="#SumberData" aria-expanded="false" aria-controls="SumberData"></i>
          </a>
          <div id="SumberData" class="collapse">
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Sumber Data</a></li>
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
          <a href="#" class="focusMenu">
            <div class="frame-ico">
              <img class="ico2" src="img/ico/icoDriver_noFill.png" alt="logo1" />
            </div>
            <span class="link_name">Data Driver</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Data Driver</a></li>
          </ul>
        </li>

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
        <li><hr class="seperator"></li>

        <li class="sidebar-heading mt-2 p-0">Layanan</li>
        <li class="nav-item">
          <a href="#" class="focusMenu">
            <div class="frame-ico">
              <img class="ico2" src="img/ico/icoBooking_no Fill.png" alt="logo1" />
            </div>
            <span class="link_name">Pemesanan</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Pemesanan</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="focusMenu">
            <div class="frame-ico">
              <img class="ico2" src="img/ico/icoReport_noFill.png" alt="logo1" />
            </div>
            <span class="link_name">Laporan</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Laporan</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <div class="profile-details">
            <div class="profile-content">
              <img src="img/bis.png" alt="profileImg" />
            </div>
            <div class="name-job">
              <div class="profile_name">
              <span><?= (str_word_count($sesName) > 2 ? substr($sesName,0,9)."..." : $sesName);?></span>
              </div>
              <div class="job">Staff</div>
            </div>
            <i class="bx bx-log-out"></i>
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
                <span class="badge alert-danger p-1">5</span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="dropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="RobotoReg14"><?php echo $sesName;?></span>
                <img class="img-profile rounded-circle" src="img/bis.png" alt="LogoBis" />
              </a>

              <ul class="dropdown-menu border-0 dropdown-menu-end shadow" aria-labelledby="dropdownProfile">
                <li>
                  <a class="dropdown-item" href="#"> <i class="las la-user mr-2"></i> My Profile </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#"> <i class="las la-list-alt mr-2"></i> Activity Log </a>
                </li>
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

      <!-- Content Row -->
      <div class="row m-0 px-3 rowCustom">
        <!-- Card Total Data Bus -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-0 gradientBlue shadow h-100 py-2 rounded">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="RobotoReg14 text-white">Data Bus</div>
                  <div class="RobotoBold18 text-white">5 <span>Bus</span></div>
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
                  <div class="RobotoBold18 text-white">20 Pesanan</div>
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
                  <div class="RobotoBold18 text-white"><span>Rp</span>4.125.000</div>
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
        <div class="col-lg-12">
          <div class="colorSecondary2 shadow roundedPanel">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs bg-white pt-2 px-4 roundedTab custShadow" id="ex1" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tabs-1" type="button" role="tab" aria-controls="tabs-1" aria-selected="true">Terminal</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tabs-2" type="button" role="tab" aria-controls="tabs-2" aria-selected="false">Jenis Bus</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tabs-3" type="button" role="tab" aria-controls="tabs-3" aria-selected="false">Rute User</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-4" data-bs-toggle="tab" data-bs-target="#tabs-4" type="button" role="tab" aria-controls="tabs-4" aria-selected="false">Penumpang</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-5" data-bs-toggle="tab" data-bs-target="#tabs-5" type="button" role="tab" aria-controls="tabs-5" aria-selected="false">Staff</button>
              </li>
            </ul>

            <div class="tab-content mb-5 " id="ex1-content">
              <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">

                <div class="row g-2 m-0 ">
                  <div class="col-lg-12">
                    <div class="card mb-4 rounded">
                      <div class="card-header shadow">
                        <div class="title float-start">
                          <span class="m-0"><b>Tabel Data Terminal</b></span>
                        </div>
                        <div class="btnAction float-end">
                          <a href="tambahAkun.php">
                            <button class="btn btn-light text-dark btn-circle custShadow2 me-2"><i class="fas fa-plus" data-bs-toggle="tooltip" title="Tambah"></i></button>
                          </a>
                          <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-tooltip="tooltip" data-bs-target="#deleteDataAkun" title="Hapus Yang dipilih"><i class="fas fa-trash"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover dataTable" width="100%">
                            <thead>
                              <tr>
                                <th class="cb">
                                  <span class="custom-checkbox">
                                    <input type="checkbox" class="selectAll" />
                                    <label for="selectAll"></label>
                                  </span>
                                </th>
                                <th class="actions">Action</th>
                                <th class="nama">Nama Lengkap</th>
                                <th class="email">Email</th>
                                <th class="pass">Kata Sandi</th>
                                <th class="alamat">Alamat</th>
                                <th class="jenisKelamin">Jenis Kelamin</th>
                                <th class="namaTerminal">Nama Terminal</th>
                                <th class="AlamatTerminal">Alamat Terminal</th>
                                <th class="provinsi">Provinsi</th>
                                <th class="kabupaten">Kabupaten</th>
                                <th class="kecamatan">Kecamatan</th>
                                <th class="status">Status Level</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Admin 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_on">Admin</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 2</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 3</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 4</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <!-- Edit Modal -->
                      <div id="editDataAkun" class="modal fade">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content modal-edit">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Akun</h4>
                                <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                  <i class="fa fa-times fa-sm"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="col-lg-12 mb-3" hidden>
                                  <label for="exampleInputEmail" class="form-label">Id</label>
                                  <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_id" placeholder="" />
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_nama" placeholder="Ex: Budi Santoso" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-user2" id="exampleInputPassword" name="txt_email" placeholder="Ex: budiman@siboss.com" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kata Sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputEmail" name="txt_pass" placeholder="********" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Konfirmasi Kata sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputPassword" name="txt_pass" placeholder="********" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Alamat</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_alamat" placeholder="Ex: JL. Sudirman" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios1" value="option1" checked />
                                      <label class="form-check-label2" for="exampleRadios1"> Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios2" value="option2" />
                                      <label class="form-check-label2" for="exampleRadios2"> Perempuan </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_terminal" placeholder="Ex: Terminal A" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Alamat Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputPassword" name="txt_alamatterm" placeholder="JL. KH." />
                                  </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                  <label for="exampleInputEmail" class="form-label">Provinsi</label>
                                  <select class="form-select" aria-label=".form-select-sm example">
                                    <option disabled selected>Pilih Provinsi</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kota</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih kota</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Kecamatan</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Kecamatan</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-12 mb-2">
                                    <label for="exampleInputEmail" class="form-label">Status Level</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Level Otoritas</option>
                                      <option value="1">Admin</option>
                                      <option value="2">staff</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal" value="Cancel" />
                                  <input type="submit" class="btn colorPrimary text-white roundedBtn" value="Simpan" />
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Modal -->
                      <div id="deleteDataAkun" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Akun</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus data akun ini ?</p>
                                <p class="text-warning"><small>Perlu hati-hati karena data akan hilang selamanya !</small></p>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Cancel" />
                                <input type="submit" class="btn btn-danger" value="Delete" />
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
              <div class="row g-2 m-0 ">
                  <div class="col-lg-12">
                    <div class="card mb-4 rounded">
                      <div class="card-header shadow">
                        <div class="title float-start">
                          <span class="m-0"><b>Tabel Jenis Bus</b></span>
                        </div>
                        <div class="btnAction float-end">
                          <a href="tambahAkun.php">
                            <button class="btn btn-light text-dark btn-circle custShadow2 me-2"><i class="fas fa-plus" data-bs-toggle="tooltip" title="Tambah"></i></button>
                          </a>
                          <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-tooltip="tooltip" data-bs-target="#deleteDataAkun" title="Hapus Yang dipilih"><i class="fas fa-trash"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover dataTable" width="100%">
                            <thead>
                              <tr>
                                <th class="cb">
                                  <span class="custom-checkbox">
                                    <input type="checkbox" class="selectAll" />
                                    <label for="selectAll"></label>
                                  </span>
                                </th>
                                <th class="actions">Action</th>
                                <th class="nama">Nama Lengkap</th>
                                <th class="email">Email</th>
                                <th class="pass">Kata Sandi</th>
                                <th class="alamat">Alamat</th>
                                <th class="jenisKelamin">Jenis Kelamin</th>
                                <th class="namaTerminal">Nama Terminal</th>
                                <th class="AlamatTerminal">Alamat Terminal</th>
                                <th class="provinsi">Provinsi</th>
                                <th class="kabupaten">Kabupaten</th>
                                <th class="kecamatan">Kecamatan</th>
                                <th class="status">Status Level</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Admin 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_on">Admin</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 2</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 3</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 4</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <!-- Edit Modal -->
                      <div id="editDataAkun" class="modal fade">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content modal-edit">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Akun</h4>
                                <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                  <i class="fa fa-times fa-sm"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="col-lg-12 mb-3" hidden>
                                  <label for="exampleInputEmail" class="form-label">Id</label>
                                  <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_id" placeholder="" />
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_nama" placeholder="Ex: Budi Santoso" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-user2" id="exampleInputPassword" name="txt_email" placeholder="Ex: budiman@siboss.com" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kata Sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputEmail" name="txt_pass" placeholder="********" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Konfirmasi Kata sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputPassword" name="txt_pass" placeholder="********" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Alamat</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_alamat" placeholder="Ex: JL. Sudirman" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios1" value="option1" checked />
                                      <label class="form-check-label2" for="exampleRadios1"> Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios2" value="option2" />
                                      <label class="form-check-label2" for="exampleRadios2"> Perempuan </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_terminal" placeholder="Ex: Terminal A" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Alamat Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputPassword" name="txt_alamatterm" placeholder="JL. KH." />
                                  </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                  <label for="exampleInputEmail" class="form-label">Provinsi</label>
                                  <select class="form-select" aria-label=".form-select-sm example">
                                    <option disabled selected>Pilih Provinsi</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kota</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih kota</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Kecamatan</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Kecamatan</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-12 mb-2">
                                    <label for="exampleInputEmail" class="form-label">Status Level</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Level Otoritas</option>
                                      <option value="1">Admin</option>
                                      <option value="2">staff</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal" value="Cancel" />
                                  <input type="submit" class="btn colorPrimary text-white roundedBtn" value="Simpan" />
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Modal -->
                      <div id="deleteDataAkun" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Akun</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus data akun ini ?</p>
                                <p class="text-warning"><small>Perlu hati-hati karena data akan hilang selamanya !</small></p>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Cancel" />
                                <input type="submit" class="btn btn-danger" value="Delete" />
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="tab-3">
              <div class="row g-2 m-0 ">
                  <div class="col-lg-12">
                    <div class="card mb-4 rounded">
                      <div class="card-header shadow">
                        <div class="title float-start">
                          <span class="m-0"><b>Tabel Rute User</b></span>
                        </div>
                        <div class="btnAction float-end">
                          <a href="tambahAkun.php">
                            <button class="btn btn-light text-dark btn-circle custShadow2 me-2"><i class="fas fa-plus" data-bs-toggle="tooltip" title="Tambah"></i></button>
                          </a>
                          <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-tooltip="tooltip" data-bs-target="#deleteDataAkun" title="Hapus Yang dipilih"><i class="fas fa-trash"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover dataTable" width="100%">
                            <thead>
                              <tr>
                                <th class="cb">
                                  <span class="custom-checkbox">
                                    <input type="checkbox" class="selectAll" />
                                    <label for="selectAll"></label>
                                  </span>
                                </th>
                                <th class="actions">Action</th>
                                <th class="nama">Nama Lengkap</th>
                                <th class="email">Email</th>
                                <th class="pass">Kata Sandi</th>
                                <th class="alamat">Alamat</th>
                                <th class="jenisKelamin">Jenis Kelamin</th>
                                <th class="namaTerminal">Nama Terminal</th>
                                <th class="AlamatTerminal">Alamat Terminal</th>
                                <th class="provinsi">Provinsi</th>
                                <th class="kabupaten">Kabupaten</th>
                                <th class="kecamatan">Kecamatan</th>
                                <th class="status">Status Level</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Admin 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_on">Admin</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 2</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 3</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 4</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <!-- Edit Modal -->
                      <div id="editDataAkun" class="modal fade">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content modal-edit">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Akun</h4>
                                <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                  <i class="fa fa-times fa-sm"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="col-lg-12 mb-3" hidden>
                                  <label for="exampleInputEmail" class="form-label">Id</label>
                                  <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_id" placeholder="" />
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_nama" placeholder="Ex: Budi Santoso" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-user2" id="exampleInputPassword" name="txt_email" placeholder="Ex: budiman@siboss.com" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kata Sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputEmail" name="txt_pass" placeholder="********" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Konfirmasi Kata sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputPassword" name="txt_pass" placeholder="********" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Alamat</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_alamat" placeholder="Ex: JL. Sudirman" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios1" value="option1" checked />
                                      <label class="form-check-label2" for="exampleRadios1"> Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios2" value="option2" />
                                      <label class="form-check-label2" for="exampleRadios2"> Perempuan </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_terminal" placeholder="Ex: Terminal A" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Alamat Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputPassword" name="txt_alamatterm" placeholder="JL. KH." />
                                  </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                  <label for="exampleInputEmail" class="form-label">Provinsi</label>
                                  <select class="form-select" aria-label=".form-select-sm example">
                                    <option disabled selected>Pilih Provinsi</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kota</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih kota</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Kecamatan</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Kecamatan</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-12 mb-2">
                                    <label for="exampleInputEmail" class="form-label">Status Level</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Level Otoritas</option>
                                      <option value="1">Admin</option>
                                      <option value="2">staff</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal" value="Cancel" />
                                  <input type="submit" class="btn colorPrimary text-white roundedBtn" value="Simpan" />
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Modal -->
                      <div id="deleteDataAkun" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Akun</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus data akun ini ?</p>
                                <p class="text-warning"><small>Perlu hati-hati karena data akan hilang selamanya !</small></p>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Cancel" />
                                <input type="submit" class="btn btn-danger" value="Delete" />
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tabs-4" role="tabpanel" aria-labelledby="tab-4">
              <div class="row g-2 m-0 ">
                  <div class="col-lg-12">
                    <div class="card mb-4 rounded">
                      <div class="card-header shadow">
                        <div class="title float-start">
                          <span class="m-0"><b>Tabel penumpang</b></span>
                        </div>
                        <div class="btnAction float-end">
                          <a href="tambahAkun.php">
                            <button class="btn btn-light text-dark btn-circle custShadow2 me-2"><i class="fas fa-plus" data-bs-toggle="tooltip" title="Tambah"></i></button>
                          </a>
                          <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-tooltip="tooltip" data-bs-target="#deleteDataAkun" title="Hapus Yang dipilih"><i class="fas fa-trash"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover dataTable" width="100%">
                            <thead>
                              <tr>
                                <th class="cb">
                                  <span class="custom-checkbox">
                                    <input type="checkbox" class="selectAll" />
                                    <label for="selectAll"></label>
                                  </span>
                                </th>
                                <th class="actions">Action</th>
                                <th class="nama">Nama Lengkap</th>
                                <th class="email">Email</th>
                                <th class="pass">Kata Sandi</th>
                                <th class="alamat">Alamat</th>
                                <th class="jenisKelamin">Jenis Kelamin</th>
                                <th class="namaTerminal">Nama Terminal</th>
                                <th class="AlamatTerminal">Alamat Terminal</th>
                                <th class="provinsi">Provinsi</th>
                                <th class="kabupaten">Kabupaten</th>
                                <th class="kecamatan">Kecamatan</th>
                                <th class="status">Status Level</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Admin 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_on">Admin</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 1</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 2</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 3</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1" />
                                    <label for="checkbox1"></label>
                                  </span>
                                </td>
                                <td>
                                  <a href="#" class="actionBtn" aria-label="Edit">
                                    <button class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAkun" value="edit">
                                      &nbsp;<i class="fa fa-edit fa-sm" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button>
                                  </a>
                                  <a href="#" class="actionBtn" aria-label="Delete">
                                    <button class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataAkun" value="hapus">
                                      <i class="fa fa-trash fa-sm" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </a>
                                </td>
                                <td>Staff 4</td>
                                <td>amdin@admin.com</td>
                                <td>*******</td>
                                <td>Jakarta</td>
                                <td>Laki-laki</td>
                                <td>Terminal A</td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><center>-</center></td>
                                <td><span class="mode mode_done">Staff</span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <!-- Edit Modal -->
                      <div id="editDataAkun" class="modal fade">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content modal-edit">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Akun</h4>
                                <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">
                                  <i class="fa fa-times fa-sm"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="col-lg-12 mb-3" hidden>
                                  <label for="exampleInputEmail" class="form-label">Id</label>
                                  <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_id" placeholder="" />
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_nama" placeholder="Ex: Budi Santoso" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-user2" id="exampleInputPassword" name="txt_email" placeholder="Ex: budiman@siboss.com" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kata Sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputEmail" name="txt_pass" placeholder="********" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Konfirmasi Kata sandi</label>
                                    <input type="password" class="form-control form-control-user2" id="exampleInputPassword" name="txt_pass" placeholder="********" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Alamat</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_alamat" placeholder="Ex: JL. Sudirman" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios1" value="option1" checked />
                                      <label class="form-check-label2" for="exampleRadios1"> Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="Rbtnjk" id="exampleRadios2" value="option2" />
                                      <label class="form-check-label2" for="exampleRadios2"> Perempuan </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Nama Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputEmail" name="txt_terminal" placeholder="Ex: Terminal A" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Alamat Terminal</label>
                                    <input type="text" class="form-control form-control-user2" id="exampleInputPassword" name="txt_alamatterm" placeholder="JL. KH." />
                                  </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                  <label for="exampleInputEmail" class="form-label">Provinsi</label>
                                  <select class="form-select" aria-label=".form-select-sm example">
                                    <option disabled selected>Pilih Provinsi</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputEmail" class="form-label">Kota</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih kota</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="exampleInputPassword" class="form-label">Kecamatan</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Kecamatan</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-12 mb-2">
                                    <label for="exampleInputEmail" class="form-label">Status Level</label>
                                    <select class="form-select" aria-label=".form-select-sm example">
                                      <option disabled selected>Pilih Level Otoritas</option>
                                      <option value="1">Admin</option>
                                      <option value="2">staff</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal" value="Cancel" />
                                  <input type="submit" class="btn colorPrimary text-white roundedBtn" value="Simpan" />
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Modal -->
                      <div id="deleteDataAkun" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form action="">
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Akun</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true"></button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus data akun ini ?</p>
                                <p class="text-warning"><small>Perlu hati-hati karena data akan hilang selamanya !</small></p>
                              </div>
                              <div class="modal-footer">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Cancel" />
                                <input type="submit" class="btn btn-danger" value="Delete" />
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tabs-5" role="tabpanel" aria-labelledby="tab-5">Tab 5 content</div>
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
  </body>
</html>