<?php
require_once('layouts/auth.php');

// Mock data notifikasi
$notifications = [
  [
    'id' => 1,
    'title' => 'Pemesanan Tiket Baru',
    'message' => 'NIK 317409210080002 membeli tiket Jember - Surabaya.',
    'time' => '5 menit yang lalu',
    'type' => 'booking',
    'status' => 'unread',
    'icon' => 'bx-receipt',
    'color' => 'primary'
  ],
  [
    'id' => 2,
    'title' => 'Jadwal Bus Diperbarui',
    'message' => 'Bus PO-05 Rute Jember - Bali dijadwalkan ulang ke 19:30.',
    'time' => '1 jam yang lalu',
    'type' => 'system',
    'status' => 'unread',
    'icon' => 'bx-calendar-event',
    'color' => 'warning'
  ],
  [
    'id' => 3,
    'title' => 'Driver Baru Terdaftar',
    'message' => 'Driver Slamet Hariadi telah diverifikasi untuk bertugas.',
    'time' => '3 jam yang lalu',
    'type' => 'driver',
    'status' => 'read',
    'icon' => 'bx-user-check',
    'color' => 'success'
  ],
  [
    'id' => 4,
    'title' => 'Peringatan Kapasitas',
    'message' => 'Bus PO-02 (Eksekutif) terisi penuh untuk keberangkatan malam ini.',
    'time' => '5 jam yang lalu',
    'type' => 'alert',
    'status' => 'read',
    'icon' => 'bx-error',
    'color' => 'danger'
  ]
];

$unreadCount = 0;
foreach ($notifications as $notif) {
  if ($notif['status'] === 'unread') {
    $unreadCount++;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="js/theme-init.js"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($pageTitle) ? $pageTitle : 'SI BOSS'; ?></title>
    <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="css/components.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="plugin/font/stylesheet.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <?= isset($extraCSS) ? $extraCSS : ''; ?>
  </head>
  <body>
    <div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>"></div>

    <div class="sidebar">
      <!-- Logo -->
      <div class="logo-details">
        <i class="bx bxs-bus icon-bus-logo"></i>
        <img src="img/logo2.svg" alt="SI-BOSS Logo" class="sidebar-logo">
      </div>

      <!-- List Menu -->
      <ul class="nav-links">
        <!-- Heading -->
        <li class="sidebar-heading mt-3 mb-2 p-0">Menu Utama</li>
        <li class="nav-item <?= (isset($activeMenu) && $activeMenu == 'dashboard') ? 'active' : ''; ?> mb-1">
          <a href="dashboard.php" class="focusMenu" data-tooltip="Dashboard">
            <i class="bx <?= (isset($activeMenu) && $activeMenu == 'dashboard') ? 'bxs-grid-alt' : 'bx-grid-alt'; ?>"></i>
            <span class="link_name">Dashboard</span>
          </a>
        </li>

        <li><hr class="sidebar-divider"></li>
        
        <li class="sidebar-heading mt-4 mb-2 p-0">Master Data</li>
        <?php $isSumberDataActive = (isset($activeMenu) && in_array($activeMenu, ['dataTerminal', 'dataJenisBus', 'dataRute', 'dataPenumpang'])); ?>
        <li class="nav-item <?= $isSumberDataActive ? 'active' : ''; ?>">
          <a href="#" class="focusMenu" data-bs-toggle="collapse" data-bs-target="#SumberData" aria-expanded="<?= $isSumberDataActive ? 'true' : 'false'; ?>" aria-controls="SumberData" data-tooltip="Sumber Data">
            <i class="bx <?= $isSumberDataActive ? 'bxs-data' : 'bx-data'; ?>"></i>
            <span class="link_name">Sumber Data</span>
            <i class="bx bx-chevron-right arrow"></i>
          </a>
          <div id="SumberData" class="collapse <?= $isSumberDataActive ? 'show' : ''; ?>">
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Sumber Data</a></li>
              <li><a class="<?= (isset($activeMenu) && $activeMenu == 'dataTerminal') ? 'active' : ''; ?>" href="dataTerminal.php"><i class="bx bx-buildings me-2"></i>Terminal</a></li>
              <li><a class="<?= (isset($activeMenu) && $activeMenu == 'dataJenisBus') ? 'active' : ''; ?>" href="dataJenisBus.php"><i class="bx bx-list-ul me-2"></i>Jenis Bus</a></li>
              <li><a class="<?= (isset($activeMenu) && $activeMenu == 'dataRute') ? 'active' : ''; ?>" href="dataRute.php"><i class="bx bx-map-alt me-2"></i>Rute</a></li>
              <li><a class="<?= (isset($activeMenu) && $activeMenu == 'dataPenumpang') ? 'active' : ''; ?>" href="dataPenumpang.php"><i class="bx bx-group me-2"></i>Penumpang</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item <?= (isset($activeMenu) && $activeMenu == 'dataBus') ? 'active' : ''; ?>">
          <a href="dataBus.php" class="focusMenu" data-tooltip="Data Bus">
            <i class="bx <?= (isset($activeMenu) && $activeMenu == 'dataBus') ? 'bxs-bus' : 'bx-bus'; ?>"></i>
            <span class="link_name">Data Bus</span>
          </a>
        </li>

        <li class="nav-item <?= (isset($activeMenu) && $activeMenu == 'dataDriver') ? 'active' : ''; ?>">
          <a href="dataDriver.php" class="focusMenu" data-tooltip="Data Driver">
            <i class="bx <?= (isset($activeMenu) && $activeMenu == 'dataDriver') ? 'bxs-user-pin' : 'bx-user-pin'; ?>"></i>
            <span class="link_name">Data Driver</span>
          </a>
        </li>

        <li class="nav-item <?= (isset($activeMenu) && ($activeMenu == 'dataAkunInternal' || $activeMenu == 'dataAkunUser')) ? 'active' : ''; ?>">
          <a href="#" class="focusMenu" data-bs-toggle="collapse" data-bs-target="#DataAkun" aria-expanded="<?= (isset($activeMenu) && ($activeMenu == 'dataAkunInternal' || $activeMenu == 'dataAkunUser')) ? 'true' : 'false'; ?>" aria-controls="DataAkun" data-tooltip="Data Akun">
            <i class="bx <?= (isset($activeMenu) && ($activeMenu == 'dataAkunInternal' || $activeMenu == 'dataAkunUser')) ? 'bxs-user-circle' : 'bx-user-circle'; ?>"></i>
            <span class="link_name">Data Akun</span>
            <i class="bx bx-chevron-right arrow"></i>
          </a>
          <div id="DataAkun" class="collapse <?= (isset($activeMenu) && ($activeMenu == 'dataAkunInternal' || $activeMenu == 'dataAkunUser')) ? 'show' : ''; ?>">
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Data Akun</a></li>
              <?php if (isset($_SESSION['level']) && $_SESSION['level'] == "1"): ?>
              <li><a class="<?= (isset($activeMenu) && $activeMenu == 'dataAkunInternal') ? 'active' : ''; ?>" href="dataAkunInternal.php"><i class="bx bx-shield-quarter me-2"></i>Akun Internal</a></li>
              <?php endif; ?>
              <li><a class="<?= (isset($activeMenu) && $activeMenu == 'dataAkunUser') ? 'active' : ''; ?>" href="dataAkunUser.php"><i class="bx bx-user me-2"></i>Akun User</a></li>
            </ul>
          </div>
        </li>

        <li><hr class="sidebar-divider"></li>

        <li class="sidebar-heading mt-4 mb-2 p-0">Layanan</li>
        <li class="nav-item <?= (isset($activeMenu) && $activeMenu == 'dataPemesanan') ? 'active' : ''; ?>">
          <a href="dataPemesanan.php" class="focusMenu" data-tooltip="Pemesanan">
            <i class="bx <?= (isset($activeMenu) && $activeMenu == 'dataPemesanan') ? 'bxs-receipt' : 'bx-receipt'; ?>"></i>
            <span class="link_name">Pemesanan</span>
          </a>
        </li>


        
        <li class="nav-item">
          <div class="profile-details">
            <div class="profile-content">
              <img src="fotoAdmin/<?= isset($sesFoto) ? $sesFoto : ''; ?>" />
            </div>
            <div class="name-job">
              <div class="profile_name">
              <span><?= isset($sesName) ? (str_word_count($sesName) > 2 ? substr($sesName,0,9)."..." : $sesName) : ''; ?></span>
              </div>
              <div class="job">Staff</div>
            </div>
            <a class="logout-btn" href="logout.php" title="Keluar"> <i class="bx bx-log-out"></i></a>
          </div>
        </li>
      </ul>
    </div>

    <!-- Content -->
    <div class="home-section">
      <div class="menu">
        <i class="bx bx-menu sidebar-toggle"></i>
      </div>
      <div class="home-content d-flex justify-content-end align-items-center mb-4">
        <nav class="custNav">
          <ul class="nav">
            <li class="nav-item d-flex align-items-center">
              <div class="theme-switcher" data-active="system">
                <div class="theme-pill"></div>
                <button type="button" class="theme-btn" data-theme-value="light" title="Light Mode"><i class="bx bx-sun"></i></button>
                <button type="button" class="theme-btn" data-theme-value="system" title="System Mode"><i class="bx bx-desktop"></i></button>
                <button type="button" class="theme-btn" data-theme-value="dark" title="Dark Mode"><i class="bx bx-moon"></i></button>
              </div>
            </li>
            <li class="nav-item dropdown nav-notification d-flex align-items-center me-2">
              <a href="#" class="nav-link position-relative" id="dropdownNotification" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi">
                <div class="notification-icon-wrap">
                  <i class="bx bx-bell"></i>
                  <?php if($unreadCount > 0): ?>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                    <?= $unreadCount;?>
                    <span class="visually-hidden">unread messages</span>
                  </span>
                  <?php endif; ?>
                </div>
              </a>

              <div class="dropdown-menu dropdown-menu-end border-0 shadow-modal custom-dropdown-menu notification-dropdown-menu" aria-labelledby="dropdownNotification">
                <div class="notification-header">
                  <h5>Notifikasi</h5>
                  <a href="#" class="mark-read-btn">Tandai dibaca</a>
                </div>
                
                <div class="notification-list-scroll">
                  <?php if(!empty($notifications)): ?>
                    <?php foreach($notifications as $notif): ?>
                      <a href="#" class="notification-item <?= $notif['status']; ?>">
                        <div class="notification-icon-box <?= $notif['color']; ?>">
                          <i class="bx <?= $notif['icon']; ?>"></i>
                        </div>
                        <div class="notification-content">
                          <div class="notification-title"><?= htmlspecialchars($notif['title']); ?></div>
                          <div class="notification-msg"><?= htmlspecialchars($notif['message']); ?></div>
                          <div class="notification-time"><?= htmlspecialchars($notif['time']); ?></div>
                        </div>
                        <?php if($notif['status'] === 'unread'): ?>
                          <div class="notification-unread-dot"></div>
                        <?php endif; ?>
                      </a>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="p-4 text-center text-muted">
                      <i class="bx bx-bell-off d-block fs-3 mb-2"></i>
                      <span class="small">Tidak ada notifikasi</span>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="notification-footer">
                  <a href="#">Lihat Semua Notifikasi</a>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown nav-profile-dropdown">
              <a class="nav-link d-flex align-items-center" href="#" id="dropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="profile-text text-end me-3 d-none d-md-block">
                  <span class="d-block fw-bold profile-name"><?php echo isset($sesName) ? $sesName : 'User';?></span>
                  <span class="d-block text-muted profile-role" style="font-size: 11px;">Admin Staff</span>
                </div>
                <div class="profile-img-container shadow-sm">
                  <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo isset($sesFoto) ? $sesFoto : 'default.png'; ?>" alt="Profile" />
                </div>
              </a>

              <ul class="dropdown-menu border-0 dropdown-menu-end shadow-modal custom-dropdown-menu" aria-labelledby="dropdownProfile">
                <li class="dropdown-header-profile d-md-none">
                  <div class="d-flex align-items-center px-3 py-2">
                    <img class="rounded-circle profile-dropdown-avatar me-3" src="fotoAdmin/<?php echo isset($sesFoto) ? $sesFoto : 'default.png'; ?>" alt="Profile" />
                    <div class="profile-dropdown-info">
                      <h6 class="mb-0 fw-bold"><?php echo isset($sesName) ? $sesName : 'User';?></h6>
                      <span class="text-muted d-block" style="font-size: 11px;">Admin Staff</span>
                    </div>
                  </div>
                </li>
                <li class="d-md-none"><hr class="dropdown-divider my-2"></li>
                <li>
                  <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#editDataAdministrator<?php echo isset($sesID) ? $sesID : ''; ?>" href="#">
                    <div class="dropdown-icon-wrapper me-2"><i class="bx bx-user-circle"></i></div> 
                    <span>My Profile</span>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                  <a class="dropdown-item d-flex align-items-center text-danger" href="logout.php"> 
                    <div class="dropdown-icon-wrapper me-2 text-danger"><i class="bx bx-log-out-circle"></i></div>
                    <span>Sign Out</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Profile Modal -->
      <div id="editDataAdministrator<?php echo isset($sesID) ? $sesID : ''; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content modal-edit">
            <form role="form" action="editProfile.php" method="POST" enctype="multipart/form-data">
              <?php
                if(isset($sesID) && isset($obj)) {
                  $queryProfile = $obj->pilihAdministrator($sesID);
                  while ($rowProf = $queryProfile->fetch(PDO::FETCH_ASSOC)){
              ?>
              <div class="modal-header">
                <h4 class="modal-title">Edit Data Administrator</h4>
                <button type="button" class="btn btn-danger btn-circle btn-user" data-bs-dismiss="modal" aria-label="Close">
                  <i class="bx bx-x"></i>
                </button>
              </div>
              <div class="modal-body">
                
                <div class="row">
                  <div class="col-lg-12 mb-3" hidden>
                    <label for="inputId" class="form-label">Id</label>
                    <input type="text" class="form-control" id="inputId" name="txt_id_user_admin" value="<?php echo $sesID?>" placeholder="" readonly/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <div class="mb-3">
                      <label for="InputFotoBus" class="form-label">Foto Administrator</label>
                      <div class="img-div">
                        <div class="img-placeholder" onClick="triggerClick()">
                          <img src="img/ico/icons8_driver_50px.png" alt="" />
                        </div>
                        <img class="img-profile rounded-circle" src="fotoAdmin/<?php echo $sesFoto; ?>" onClick="triggerClick()" id="profileDisplay"/>
                      </div>
                      <input type="file" name="txt_fotoEa" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" />
                    </div>
                  </div>
                  
                  <div class="col-lg-6 mb-3">
                    <label for="inputNama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="inputNama" name="txt_nama" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesName?>"/>
                    <label for="InputJenisKelaminProfile" class="form-label">Jenis Kelamin</label>
                    <div class="row g-2 pt-1">
                      <div class="col-6">
                        <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1Profile" value="Laki-laki" <?= ($sesJK == 'Laki-laki' || !isset($sesJK)) ? 'checked' : ''; ?> />
                        <label class="gender-card-option" for="Radios1Profile">
                          <div class="gender-card-content">
                            <i class="bx bx-male"></i>
                            <span>Laki-laki</span>
                          </div>
                        </label>
                      </div>
                      <div class="col-6">
                        <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2Profile" value="Perempuan" <?= ($sesJK == 'Perempuan') ? 'checked' : ''; ?> />
                        <label class="gender-card-option" for="Radios2Profile">
                          <div class="gender-card-content">
                            <i class="bx bx-female"></i>
                            <span>Perempuan</span>
                          </div>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <label for="inputAlamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="inputAlamat" name="txt_alamat" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesAlamat?>"/>
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="inputNoHp" class="form-label">No Handphone</label>
                    <input type="number" class="form-control" id="inputNoHp" name="txt_no_hp" placeholder="Ex: 085808241205"  required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesNoHP?>"/>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="txt_email" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesEmail?>"/>
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="txt_password" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $sesPass?>"/>
                  </div>
                </div>

                <div class="row">
                <div class="col-lg-6 mb-3" hidden>
                    <label for="inputId" class="form-label">Status</label>
                    <input type="text" class="form-control" id="inputId" name="txt_id_level" value="<?php echo $sesLvl?>" placeholder="" readonly />
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="inputId" class="form-label">Status</label>
                    <input type="text" class="form-control" id="inputId" name="txt" value="Staff" placeholder="" readonly />
                  </div>
                  <div class="col-lg-6 mb-3" hidden>
                    <label for="inputId" class="form-label">Terminal</label>
                    <input type="text" class="form-control" id="inputId" name="txt_id_terminal" value="<?php echo $sesTerminal?>" placeholder="" readonly />
                  </div>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-secondary rounded-pill" type="button" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary rounded-pill" name="simpan">Update</button>
                </div>
              </div>
              <?php 
                  }
                }
              ?> 
            </form>
          </div>
        </div>
      </div>

      <?= $mainContent ?? '' ?>

    </div> <!-- Close home-section -->
    
    <script src="jquery/jquery-3.6.0.min.js"></script>
    <script src="plugin/js/bootstrap.bundle.min.js"></script>
    <script src="plugin/jquery-easing/jquery.easing.min.js"></script>
    <script src="plugin/js/script.js"></script>
    
    <!-- Optional plugins -->
    <?php if(isset($useCalendar) && $useCalendar): ?>
    <script src="plugin/js/calender.js"></script>
    <?php endif; ?>

    <?php if(isset($useUpImg) && $useUpImg): ?>
    <script src="plugin/js/UpImg.js"></script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="plugin/js/custom_SweetAlert2.js"></script>

    <!-- SweetAlert Alert injection -->
    <?php if(isset($_SESSION['alert'])) { ?>
      <script>
        Swal.fire({
          icon: "<?= $_SESSION['alert'][0] ?>",
          title: "<?= $_SESSION['alert'][1] ?>",
          text: "<?= $_SESSION['alert'][2] ?>",
          confirmButtonColor: '#527bdd'
        });
      </script>
    <?php unset($_SESSION['alert']); } ?>

    <!-- Extra JS specific to pages (Datatables, SweetAlert, Parsley, dll) -->
    <?= isset($extraJS) ? $extraJS : ''; ?>

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const lightbox = GLightbox({
          selector: '.glightbox'
        });
      });
    </script>

    <script src="js/theme-switcher.js"></script>
  </body>
</html>
