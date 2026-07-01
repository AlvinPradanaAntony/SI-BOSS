<?php
require ('function.php');

if (isset($_COOKIE['cookie_email'])) {
  systemCookies();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>SI-BOSS Express</title>
  <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="plugin/font/stylesheet.css" />
  <link rel="stylesheet" href="plugin/css/app.min.css" />
  <link rel="stylesheet" href="plugin/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.3/dist/sweetalert2.min.css" integrity="sha256-7FY/kD9x8sdXwruZy+8tjKt05pkuxyF52nbrSazsNg8=" crossorigin="anonymous">
</head>

<body class="bg-white">
  <div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card o-hidden border-0 shadow-lg">
          <div class="card-body p-0">
            <div class="row autoHeight">
              <div class="col-lg-4 d-none d-lg-flex justify-content-center colorPrimary">
                <div class="banner py-5 position-fixed">
                  <h3 style="font-family: Poppins-Bold" class="mb-5">
                    System Information Booking <br />
                    Online Bus <br /><span>Aman, Mudah, dan Cepat</span>
                  </h3>
                  <img src="img/bus1_B.png" alt="logo_bus" class="img-fluid" width="376px" />
                </div>
              </div>
              <div class="col-lg-8 p-4 py-3 colorSecondary bg-img">
                <div class="logo2">
                  <a href="#">
                    <img src="img/logo.png" alt="" />
                  </a>
                </div>
                <div class="panel o-hidden border-0 shadow">
                  <div class="p-5">
                    <div class="judul">
                      <h4 class="text-gray-900 mb-5">Login <br /><span>System Information Booking Online Bus</span></h4>
                    </div>
                    <form class="custom-validation" action="function.php" method="POST">
                      <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                          name="txt_email" required data-parsley-required-message="Email tidak boleh kosong !!!"
                          placeholder="Ex: budiman@siboss.com" />
                      </div>
                      <label for="passInput" class="form-label">Kata sandi</label>
                      <div class="mb-2 wrapper">
                        <input type="password" class="form-control form-control-user" id="passInput"
                          name="txt_password" required data-parsley-required-message="Kata sandi tidak boleh kosong !!!"
                          placeholder="********" data-parsley-length="[8,16]" maxlength="16"
                          data-parsley-length-message="Password harus terdiri dari 8 sampai 16 karakter !!!" value=""/>
                        <span class="eye hidden" id="spanEye">
                          <i class="fas fa-eye-slash show-hide" toggle="#passInput" id="iconShowHide"></i>
                        </span>  
                      </div>
                      <!-- <div class="mb-2 inputPass">
                        <label for="exampleInputPassword" class="form-label">Kata sandi</label>
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                          name="txt_password" required data-parsley-required-message="Kata sandi tidak boleh kosong !!!"
                          placeholder="********" data-parsley-length="[8,16]" maxlength="16"
                          data-parsley-length-message="Password harus terdiri dari 8 sampai 16 karakter !!!" />
                          <span class="eye">
                            <i class="fas fa-eye-slash"></i>
                          </span>
                      </div> -->
                      <div class="mb-3 float-start">
                        <div class="form-check small">
                          <input type="checkbox" class="form-check-input" id="customCheck" name="check_remember"
                            value="1" />
                          <label class="form-check-label" for="customCheck">Remember Me</label>
                        </div>
                      </div>
                      <div class="mb-3 float-end">
                        <!-- <div class="small">
                            <a class="small" href="#">Lupa kata sandi ?</a>
                          </div> -->
                      </div>
                      <div class="clearfix"></div>
                      <div class="row mb-5">
                        <div class="col-6 d-flex justify-content-end">
                          <button type="submit" name="login" class="btn colorPrimary btn-login text-white btn-block py-2" id="login">Login</button>
                        </div>
                        <div class="col-6 d-flex justify-content-start">
                          <a href="registrasi.php" class="btn btn-daftar btn-block py-2">
                            <span>Daftar</span>
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="d-block position-fixed markQuestion2">
                  <!-- <a href="#">
                      <button class="btn colorPrimary text-white custBtn rounded-circle">
                        <span class="txt_mark">?</span>
                      </button>
                    </a> -->
                </div>
                <footer class="d-flex justify-content-center text-center mb-1">
                  <p class="col-md-4 mb-0 text-muted">&copy; 2021 SI-BOSS, All Rights Reserved</p>
                </footer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="plugin/js/bootstrap.bundle.min.js"></script>
  <script src="jquery/jquery-3.6.0.min.js"></script>
  <script src="plugin/js/form-validation.init.js"></script>
  <script src="plugin/js/parsley.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.3/dist/sweetalert2.all.min.js"
    integrity="sha256-+InBGKGbhOQiyCbWrARmIEICqZ8UvYJr/qVhHmlmFpc=" crossorigin="anonymous"></script>
  <script src="plugin/js/custom_SweetAlert2.js"></script>
  <script>
    function showHide(){
      var myclass = $('#passInput').is('.parsley-error');
      var myclass2 = $('#passInput').is('.parsley-success');
      if (myclass) {
        $('#spanEye').removeClass('eye');
        $('#spanEye').addClass('eye2');
      } else if (myclass2) {
        $('#spanEye').removeClass('eye2');
        $('#spanEye').addClass('eye');

      }
    }

    $('#login').click(function() {
      setTimeout(showHide, 1);
    });

    $('#passInput').keyup(function() {
      var inputs = $('#passInput').val();
      var myclass = $('#passInput').is('.parsley-error');
      var myclass2 = $('#passInput').is('.parsley-success');
      $("#spanEye").fadeIn("slow");
      if(inputs == ""){
        $("#spanEye").fadeOut("slow");
        $('#spanEye').removeClass('show');
        $('#spanEye').addClass('hidden');
      } else {
        $("#spanEye").fadeIn("slow");
        $('#spanEye').removeClass('hidden');
        $('#spanEye').addClass('show');
      }
      setTimeout(showHide, 1);
    });
    $(".show-hide").click(function () {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
          $('#iconShowHide').css("color","#5886ef");
        } else {
          input.attr("type", "password");
          $('#iconShowHide').css("color","#d8d8d8");
        }
      });
  </script>
  <script>
    $(document).ready(function () {
      window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
          $(this).remove();
        });
      }, 3500);
    });
  </script>
</body>

</html>