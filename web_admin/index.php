<?php
require('function.php');

if (isset($_COOKIE['cookie_email'])) {
  systemCookies();
}

$pageTitle = "SI-BOSS Express";

ob_start();
?>
<div class="auth-card-head">
  <h4>Selamat datang kembali</h4>
  <p>Masuk ke akun Anda untuk mengelola pemesanan tiket bus.</p>
</div>

<form class="custom-validation" action="function.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail"
      name="txt_email" required data-parsley-required-message="Email tidak boleh kosong !!!"
      placeholder="Ex: budiman@siboss.com" />
  </div>

  <label for="passInput" class="form-label">Kata sandi</label>
  <div class="mb-2 wrapper">
    <input type="password" class="form-control" id="passInput"
      name="txt_password" required data-parsley-required-message="Kata sandi tidak boleh kosong !!!"
      placeholder="********" data-parsley-length="[8,16]" maxlength="16"
      data-parsley-length-message="Password harus terdiri dari 8 sampai 16 karakter !!!" value="" />
    <span class="eye hidden" id="spanEye">
      <i class="bx bx-hide show-hide" toggle="#passInput" id="iconShowHide"></i>
    </span>
  </div>

  <div class="auth-remember">
    <div class="form-check small">
      <input type="checkbox" class="form-check-input" id="customCheck" name="check_remember" value="1" />
      <label class="form-check-label" for="customCheck">Ingat saya</label>
    </div>
    <div class="auth-forgot">
      <a href="#">Lupa kata sandi?</a>
    </div>
  </div>

  <div class="auth-actions">
    <a href="registrasi.php" class="btn btn-secondary">
      <span>Daftar</span>
    </a>
    <button type="submit" name="login" class="btn btn-primary btn-shadow" id="login">Login</button>
  </div>

  <div class="auth-foot-note">
    Belum punya akun? Klik tombol <b>Daftar</b> untuk membuat akun baru.
  </div>
</form>
<?php
$authCardContent = ob_get_clean();

ob_start();
?>
<script>
  function showHide() {
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
    if (inputs == "") {
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
  $(".show-hide").click(function() {
    $(this).toggleClass("bx-hide bx-show");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
      $('#iconShowHide').css("color", "#5886ef");
    } else {
      input.attr("type", "password");
      $('#iconShowHide').css("color", "#d8d8d8");
    }
  });
</script>
<script>
  $(document).ready(function() {
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3500);
  });
</script>
<?php
$extraJS = ob_get_clean();

require_once 'layouts/auth_layout.php';
?>