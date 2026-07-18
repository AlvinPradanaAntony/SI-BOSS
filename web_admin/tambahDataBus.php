<!-- <?php
require('koneksi.php');

session_start();

if(!isset($_SESSION['email'])){
    header('Location: index.php');
}

$sesName = $_SESSION['name'];
if(isset ($_POST['submit'])){
  $nama_bus = $_POST['txt_nama_bus'];
  $status = $_POST['txt_status'];
  $kursi = $_POST['txt_kursi'];
  $jenis_bus = $_POST['txt_jenis_bus'];
  $fasilitas = $_POST['txt_fasilitas'];
  // $foto = $_POST['txt_foto'];
  $id_jenis = $_POST['d_id_jenis'];
  $id_rute = $_POST['d_id_rute'];
  
  $pemberangkatan = $_POST['txt_pemberangkatan'];
  $waktu_berangkat = $_POST['txt_waktu_berangkat'];
  $tujuan = $_POST['txt_tujuan'];
  $waktu_tiba = $_POST['txt_waktu_tiba'];
  $harga = $_POST['txt_harga'];

  $query = "INSERT INTO bus VALUES ('', '$nama_bus', '', '$status', '$kursi', '$foto', '$id_jenis', '$id_rute')";
  $query2 = "INSERT INTO jenis_bus VALUES ('', '$jenis_bus', '$fasilitas')";
  $query3 = "INSERT INTO terminal VALUES ('', '$pemberangkatan', '$waktu_berangkat', '$tujuan', '$waktu_tiba','$harga')";
  $result = mysqli_query($koneksi, $query);
  $result = mysqli_query($koneksi, $query2);
  $result = mysqli_query($koneksi, $query3);
  header('Location: registrasi.php');
  echo mysqli_error($result);
}
?> -->
<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="js/theme-init.js"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - SI BOSS</title>
    <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="css/components.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="plugin/font/stylesheet.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />
  </head>

  <body>
    <div class="sidebar">
      <!-- Logo -->
      <div class="logo-details">
        <i class="bx bxs-bus"></i>
        <span class="logo_name">SI-BOSS<span class="logo_nameMin">Express</span></span>
      </div>

      <!-- List Menu -->
      <ul class="nav-links">
        <!-- Heading -->
        <li class="sidebar-heading mb-2 p-0">Menu :</li>
        <li class="nav-item mb-1">
          <a href="dashboard.php" class="focusMenu">
            <div class="frame-ico">
              <img class="ico" src="img/ico/icoDash_Fill.png" alt="logo1" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard" />
            </div>
            <span class="link_name">Dashboard</span>
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
        <li><hr /></li>
        <li class="sidebar-heading mt-2 p-0">List Data</li>
        <li class="nav-item">
          <a href="sumberData.php" class="focusMenu">
            <div class="frame-ico">
              <img class="ico2" src="img/ico/icoData_noFill.png" alt="logo2" data-bs-toggle="collapse" data-bs-target="#SumberData" aria-expanded="false" aria-controls="SumberData" />
            </div>
            <span class="link_name">Sumber Data</span>
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
        <li class="nav-item active">
          <a href="#" class="focusMenu">
            <div class="frame-ico">
              <img class="ico2" src="img/ico/icoBus_Fill.png" alt="logo1" />
            </div>
            <span class="link_name">Data Bus</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Data Bus</a></li>
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
        <li><hr class="seperator" /></li>

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
            <a class="logout-btn" href="logout.php" title="Keluar"><i class="bx bx-log-out"></i></a>
          </div>
        </li>
      </ul>
    </div>

    <!-- Content -->
    <div class="home-section">
      <div class="home-content d-flex justify-content-end align-items-center mb-4">
        <div class="menu">
          <i class="bx bx-menu sidebar-toggle"></i>
        </div>
        <nav class="custNav">
          <ul class="nav">
            <li class="nav-item d-flex align-items-center" style="margin-right: 15px;">
              <div class="theme-switcher" data-active="system">
                <div class="theme-pill"></div>
                <button type="button" class="theme-btn" data-theme-value="light" title="Light Mode"><i class="bx bx-sun"></i></button>
                <button type="button" class="theme-btn" data-theme-value="system" title="System Mode"><i class="bx bx-desktop"></i></button>
                <button type="button" class="theme-btn" data-theme-value="dark" title="Dark Mode"><i class="bx bx-moon"></i></button>
              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link transition">
                <i class="bx bx-bell"></i>
                <span class="badge alert-danger p-1">5</span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="dropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="me-3"><?php echo $sesName;?></span>
                <img class="img-profile rounded-circle" src="img/bis.png" alt="LogoBis" />
              </a>

              <ul class="dropdown-menu border-0 dropdown-menu-end shadow" aria-labelledby="dropdownProfile">
                <li>
                  <a class="dropdown-item" href="#"> <i class="las la-user me-2"></i> My Profile </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#"> <i class="las la-list-alt me-2"></i> Activity Log </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="logout.php"> <i class="las la-sign-out-alt me-2"></i> Sign Out </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Content Row -->
      <div class="row m-0 px-3 pt-navbar">
        <!-- Card Total Data Bus -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-0 bg-gradient-blue shadow h-100 py-2">
            <div class="card-body">
              <div class="row g-0 align-items-center">
                <div class="col me-2">
                  <div class="text-white-50 small mb-1">Data Bus</div>
                  <div class="fs-5 fw-bold text-white">5 <span>Bus</span></div>
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
          <div class="card border-0 bg-gradient-pink shadow h-100 py-2">
            <div class="card-body">
              <div class="row g-0 align-items-center">
                <div class="col me-2">
                  <div class="text-white-50 small mb-1">Data Driver</div>
                  <div class="fs-5 fw-bold text-white">(Belum Tersedia)</div>
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
          <div class="card border-0 bg-gradient-yellow shadow h-100 py-2">
            <div class="card-body">
              <div class="row g-0 align-items-center">
                <div class="col me-2">
                  <div class="text-white-50 small mb-1">Data Pemesanan</div>
                  <div class="fs-5 fw-bold text-white">20 Pesanan</div>
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
          <div class="card border-0 bg-gradient-green shadow h-100 py-2">
            <div class="card-body">
              <div class="row g-0 align-items-center">
                <div class="col me-2">
                  <div class="text-white-50 small mb-1">Total Penghasilan</div>
                  <div class="fs-5 fw-bold text-white"><span>Rp</span>4.125.000</div>
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
          <div class="card shadow mb-4 rounded">
            <div class="card-header d-flex align-items-center py-3">
              <a href="dataBus.php" class="btn text-white p-0 me-2" aria-label="Kembali">
                <i class="bx bx-arrow-back" data-bs-toggle="tooltip" title="Kembali"></i>
              </a>
              <h5 class="m-0 font-weight-bold text-white">Tambah Data Bus</h5>
            </div>
            <div class="card-body">
              <form action="login.php" method="POST">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3" hidden>
                      <label for="InputId" class="form-label">Id</label>
                      <input type="text" class="form-control" id="InputId" name="txt_id" placeholder="" />
                    </div>
                    <div class="mb-3">
                      <label for="InputFotoBus" class="form-label">Foto Bus</label>
                      <div class="img-div">
                        <div class="img-placeholder" onClick="triggerClick()">
                          <img src="img/ico/IcoeditBusW.png" alt="" />
                        </div>
                        <img src="img/ico/IcoeditBus.png" onClick="triggerClick()" id="profileDisplay" />
                      </div>
                      <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none" />
                      <a href="#" class="float-end view text-secondary"> Lihat Foto </a>
                    </div>
                    <div class="mb-3">
                      <label for="InputNamaBus" class="form-label">Nama Bus</label>
                      <input type="text" class="form-control" id="InputNamaBus" name="txt_NamaBus" placeholder="" />
                    </div>
                    <div class="mb-3">
                      <label for="InputJenisBus" class="form-label">Jenis Bus</label>
                      <select class="form-select" aria-label="Pilih Jenis Bus" name="InputJenisBus">
                        <option disabled selected>Pilih Jenis Bus</option>
                        <option value="Ekonomi">Ekonomi</option>
                        <option value="Eksekutif">Eksekutif</option>
                        <option value="Pariwisata">Pariwisata</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="InputFasilitasBus" class="form-label">Fasilitas Bus</label>
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="AC" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault"> AC </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TV" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault"> TV </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Wi-Fi" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault"> Wi-Fi </label>
                          </div>
                        </div>
                        <div class="col-sm-10">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Toilet" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault"> Toilet </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Kursi baring" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault"> Kursi baring </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="InputStatusBus" class="form-label d-block">Status</label>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Operasional" checked />
                        <label class="form-check-label" for="exampleRadios1"> Operasional </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Pemeliharaan" />
                        <label class="form-check-label" for="exampleRadios2"> Pemeliharaan/Maintenance </label>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="InputTarif" class="form-label">Tarif</label>
                      <div class="input-group mb-3">
                        <span class="input-group-text tarif">Rp</span>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="InputTglPemberangkatan" class="form-label">Tanggal Pemberangkatan</label>
                      <input type="date" class="form-control" id="InputTglPemberangkatan" name="txt_Tgl" >
                    </div>
                    <div class="mb-3">
                      <label for="InputWaktu" class="form-label">Waktu pemberangkatan</label>
                      <input type="time" class="form-control" id="InputWaktu" name="txt_waktu" >
                    </div>
                    <div class="mb-3">
                      <label for="InputPemberangkatan" class="form-label">Pemberangkatan</label>
                      <input type="text" class="form-control" id="InputPemberangkatan" name="txt_Pemberangkatan" placeholder="" />
                    </div>
                    <div class="mb-3">
                      <label for="InputTujuan" class="form-label">Tujuan</label>
                      <input type="text" class="form-control" id="InputTujuan" name="txt_Tujuan" placeholder="" />
                    </div>
                    <div class="mb-3">
                      <label for="InputWaktuKedatangan" class="form-label">Estimasi Waktu Kedatangan</label>
                      <input type="time" class="form-control" id="InputWaktuKedatangan" name="txt_waktuDatang" >
                    </div>
                    <div class="mb-3">
                      <label for="InputDetail" class="form-label">Detail Rute</label>
                      <input type="text" class="form-control" id="InputDetail" name="txt_Detail" placeholder="" />
                    </div>
                  </div>
                  <div class="mb-5"></div>
                  <div class="col-12 d-flex justify-content-center">
                    <button type="submit" name="register" class="btn btn-success px-5">Tambah</button>
                  </div>
                </div>
              </form>
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
    <script src="js/theme-switcher.js"></script>
</body>
</html>
