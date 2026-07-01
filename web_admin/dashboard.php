<!-- <?php
require('koneksi.php');
require('query.php');
$obj = new crud;

session_start();

if(!isset($_SESSION['email'])){
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
        <li class="nav-item active mb-1">
          <a href="#" class="focusMenu">
            <div class="frame-ico">
              <img class="ico" src="img/ico/icoDash_noFill.png" alt="logo1" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard" />
            </div>
            <span class="link_name">Dashboard</span>
            <i class="bx bxs-chevron-right arrow" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard"></i>
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
        <li><hr></li>
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

        <?php if ($_SESSION['level']=="1"): ?>
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
              <span><?= (str_word_count($sesName) > 2 ? substr($sesName,0,9)."..." : $sesName);?></span>
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
                <span class="badge alert-danger p-1"> <?php echo $num - 1;?> Staff</span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="dropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="RobotoReg14"><?php echo $sesName;?></span>
                <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo $sesFoto; ?>" />
              </a>

              <ul class="dropdown-menu border-0 dropdown-menu-end shadow" aria-labelledby="dropdownProfile">
                <li>
                  <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editDataAdministrator<?php echo $sesID ?>" ><i class="las la-user mr-2" ></i>My Profile</a>
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
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
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
                                                <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_user_admin" value="<?php echo $sesID?>" placeholder="" readonly/>
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
                                                    <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo $sesFoto; ?>" onClick="triggerClick()" id="profileDisplay"/>
                                                    <!-- <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" /> -->
                                                  </div>
                                                  <input type="file" name="txt_fotoEa" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" />
                                                  <!-- <a href="#" class="float-end view text-secondary"> Lihat Foto </a> -->
                                                </div>
                                              </div>
                                              <!-- </form> -->
                                              
                                              <div class="col-lg-6 mb-3">
                                                <label for="inputNama" class="form-label">Nama</label>
                                                <input type="text" class="form-control form-control-user2" id="inputNama" name="txt_nama" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesName?>"/>
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
                                                <input type="text" class="form-control form-control-user2" id="inputAlamat" name="txt_alamat" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesAlamat?>"/>
                                              </div>
                                              <div class="col-lg-6 mb-3">
                                                <label for="inputNoHp" class="form-label">No Handphone</label>
                                                <input type="number" class="form-control form-control-user2" id="inputNoHp" name="txt_no_hp" placeholder="Ex: 085808241205"  required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesNoHP?>"/>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-lg-6 mb-3">
                                                <label for="inputEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control form-control-user2" id="inputEmail" name="txt_email" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesEmail?>"/>
                                              </div>
                                              <div class="col-lg-6 mb-3">
                                                <label for="inputPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control form-control-user2" id="inputPassword" name="txt_password" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesPass?>"/>
                                              </div>
                                            </div>

                                            <div class="row">
                                            <div class="col-lg-6 mb-3" hidden>
                                                <label for="inputId" class="form-label">Status</label>
                                                <input type="text" class="form-control form-control-user2" id="inputId" name="txt_id_level" value="<?php echo $sesLvl?>" placeholder="" readonly />
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
                                if($data->rowCount()>0){
                                  if($sesLvl == 1){
                                      $dis = "";
                                  } else{
                                      $dis = "disabled";
                                  }
                                  while($row=$data->fetch(PDO::FETCH_ASSOC)){
                                    $no++;
                                    $hargatotal[$no] = $row['total_bayar'];
                                  }
                                  echo "".array_sum($hargatotal);
                                  }?></div>
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
        <div class="col-lg-8">
          <div class="colorSecondary2 shadow roundedPanel" style="height: 500px">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3 bg-white pt-2 px-4 roundedTab custShadow" id="ex1" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#tabs-1" type="button" role="tab" aria-controls="tabs-1" aria-selected="true">Dashboard</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#tabs-2" type="button" role="tab" aria-controls="tabs-2" aria-selected="false">Grafik</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tabs-3" type="button" role="tab" aria-controls="tabs-3" aria-selected="false">Log</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-4" data-bs-toggle="tab" data-bs-target="#tabs-4" type="button" role="tab" aria-controls="tabs-4" aria-selected="false">Pengaturan</button>
              </li>
            </ul>
            <div class="tab-content mb-5 px-4" id="ex1-content">
              <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                <div class="responsive-map shadow">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.0431495410394!2d113.62862401436116!3d-8.198407984497482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69176d9e76d41%3A0x4e4c6e9a855a4fdf!2sTerminal%20Tawang%20Alun%20Jember!5e0!3m2!1sid!2sid!4v1637845956332!5m2!1sid!2sid"
                    width="600"
                    height="450"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                  ></iframe>
                </div>
              </div>
              <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">sfda</div>
              <div class="tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">Tab 3 content</div>
              <div class="tab-pane fade" id="tabs-4" role="tabpanel" aria-labelledby="ex1-tab-4">Tab 4 content</div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-none d-lg-block">
          <div class="bg-white shadow text-center roundedPanel pt-3 px-4" style="height: 500px">
            <span class="kalenderHead">Kalender</span>
            <div class="row">
              <div class="col-md-12">
                <div class="content w-100">
                  <div class="calendar-container">
                    <div class="calendar">
                      <div class="year-header">
                        <span class="left-button fa fa-chevron-left" id="prev"> </span>
                        <span class="year" id="label"></span>
                        <span class="right-button fa fa-chevron-right" id="next"> </span>
                      </div>
                      <table class="months-table w-100">
                        <tbody>
                          <tr class="months-row">
                            <td class="month">Jan</td>
                            <td class="month">Feb</td>
                            <td class="month">Mar</td>
                            <td class="month">Apr</td>
                            <td class="month">May</td>
                            <td class="month">Jun</td>
                            <td class="month">Jul</td>
                            <td class="month">Aug</td>
                            <td class="month">Sep</td>
                            <td class="month">Oct</td>
                            <td class="month">Nov</td>
                            <td class="month">Dec</td>
                          </tr>
                        </tbody>
                      </table>

                      <table class="days-table w-100">
                        <td class="day">Sun</td>
                        <td class="day">Mon</td>
                        <td class="day">Tue</td>
                        <td class="day">Wed</td>
                        <td class="day">Thu</td>
                        <td class="day">Fri</td>
                        <td class="day">Sat</td>
                      </table>
                      <div class="frame">
                        <table class="dates-table w-100">
                          <tbody class="tbody"></tbody>
                        </table>
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
    <script src="plugin/js/UpImg.js"></script>
  </body>
</html>
