<!DOCTYPE html>
<html>
<head>
  <script src="js/theme-init.js"></script>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $pageTitle ?? 'SI-BOSS Express' ?></title>
  <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/theme.css" />
  <link rel="stylesheet" href="css/components.css" />
  <link rel="stylesheet" href="css/style.css?v=3" />
  <link rel="stylesheet" href="css/auth-abstract.css" />
  <link rel="stylesheet" href="plugin/font/stylesheet.css" />
  <link rel="stylesheet" href="plugin/css/app.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
</head>

<body class="bg-white">
  <div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>"></div>
  <div class="container-fluid p-0">
    <div class="row g-0 auth-wrapper">
      <!-- Panel Kiri -->
      <div class="col-lg-4 d-none d-lg-flex auth-left">
        <div class="auth-left-inner">
          <div class="auth-hero">
            <h3>
              System Information Booking <br />
              Online Bus
            </h3>
            <span class="tagline">Aman &middot; Mudah &middot; Cepat</span>
          </div>

          <div class="auth-illustration">
            <img src="img/bus1_B.png" alt="Ilustrasi Bus SI-BOSS" />
          </div>

          <div class="auth-bottom-group">
            <div class="auth-features">
              <div class="auth-feature">
                <div class="ico-wrap"><i class="bx bx-shield-quarter"></i></div>
                <div class="txt">
                  <strong>Transaksi Aman</strong>
                  <span>Terenkripsi &amp; terverifikasi setiap pemesanan.</span>
                </div>
              </div>
              <div class="auth-feature">
                <div class="ico-wrap"><i class="bx bx-time-five"></i></div>
                <div class="txt">
                  <strong>Real&#8209;time Booking</strong>
                  <span>Ketersediaan kursi diperbarui secara langsung.</span>
                </div>
              </div>
              <div class="auth-feature">
                <div class="ico-wrap"><i class="bx bx-map-alt"></i></div>
                <div class="txt">
                  <strong>Rute Nusantara</strong>
                  <span>Ratusan trayek &amp; terminal terhubung.</span>
                </div>
              </div>
            </div>

            <div class="auth-stats py-2 px-3">
              <div class="stat">
                <b>120+</b>
                <span class="d-block lh-1 mt-1">Trayek</span>
              </div>
              <div class="stat">
                <b>50K+</b>
                <span class="d-block lh-1 mt-1">Penumpang</span>
              </div>
              <div class="stat">
                <b>4.9<i class="bx bxs-star" style="font-size:12px; color:#fedd00; margin-left:2px;"></i></b>
                <span class="d-block lh-1 mt-1">Rating</span>
              </div>
            </div>

            <div class="auth-foot">
              &copy; 2021 SI-BOSS Express. All rights reserved.
            </div>
          </div>
        </div>
      </div>

      <!-- Panel Kanan (Form) -->
      <div class="col-lg-8 auth-right bg-img">
        <div class="auth-top-logo">
          <a href="#"><img src="img/logo2.svg" alt="SI-BOSS" /></a>
        </div>
        <div class="auth-top-switcher">
          <div class="theme-switcher" data-active="system">
            <div class="theme-pill"></div>
            <button type="button" class="theme-btn" data-theme-value="light" title="Light Mode">
              <i class="bx bx-sun"></i>
            </button>
            <button type="button" class="theme-btn" data-theme-value="system" title="System Mode">
              <i class="bx bx-desktop"></i>
            </button>
            <button type="button" class="theme-btn" data-theme-value="dark" title="Dark Mode">
              <i class="bx bx-moon"></i>
            </button>
          </div>
        </div>

        <div class="auth-right-inner">
          <div class="auth-card <?= $authCardClass ?? '' ?>">
            <?= $authCardContent ?? '' ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="jquery/jquery-3.6.0.min.js"></script>
  <script src="plugin/js/bootstrap.bundle.min.js"></script>
  <script src="plugin/jquery-easing/jquery.easing.min.js"></script>
  <script src="plugin/js/form-validation.init.js"></script>
  <script src="plugin/js/parsley.min.js"></script>
  <script src="plugin/js/javascript.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="plugin/js/custom_SweetAlert2.js"></script>
  <script src="js/theme-switcher.js"></script>

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
  
  <?= $extraJS ?? '' ?>
</body>
</html>
