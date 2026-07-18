<?php
require ('function.php');

if (isset($_COOKIE['cookie_email'])) {
  systemCookies();
}

$pageTitle = "Daftar - SI BOSS";
$authCardClass = "wide";

ob_start();
?>
            <div class="auth-card-head">
              <h4>Daftar akun baru</h4>
              <p>Lengkapi data di bawah untuk mulai mengelola pemesanan tiket bus.</p>
            </div>

            <form class="custom-validation" action="function.php" method="POST">
              <div class="col-lg-12 mb-3" hidden>
                <label for="InputId" class="form-label">Id</label>
                <input type="text" class="form-control" id="InputId" name="txt_id" placeholder="" />
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="InputNama" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" id="InputNama" name="txt_nama"
                    required data-parsley-required-message="Nama lengkap harus di isi !!!"
                    placeholder="Ex: Budi Santoso" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="InputEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="InputEmail" name="txt_email"
                    required data-parsley-required-message="Email harus di isi !!!"
                    placeholder="Ex: budiman@siboss.com" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="password-input" class="form-label">Kata Sandi</label>
                  <div class="wrapper position-relative">
                    <input type="password" class="form-control" id="password-input"
                      name="txt_password" required data-parsley-required-message="Kata sandi harus di isi !!!"
                      placeholder="********" data-parsley-length="[8,16]" maxlength="16" data-parsley-length-message="Harus disiisi 8 sampai 16 karakter !!!"
                      data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" />
                    <span class="eye hidden" id="spanEye">
                      <i class="bx bx-hide show-hide" toggle="#password-input" id="iconShowHide" style="color: #d8d8d8; cursor: pointer; font-size: 1.2rem;"></i>
                    </span>
                  </div>
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="Kpassword-input" class="form-label">Konfirmasi Kata sandi</label>
                  <div class="wrapper position-relative">
                    <input type="password" class="form-control" id="Kpassword-input"
                      name="txt_pass" required data-parsley-required-message="Masukan ulang kata sandi !!!"
                      data-parsley-equalto="#password-input" data-parsley-equalto-message="Kata sandi tidak cocok" placeholder="********" />
                    <span class="eye hidden" id="spanEye2">
                      <i class="bx bx-hide show-hide" toggle="#Kpassword-input" id="iconShowHide2" style="color: #d8d8d8; cursor: pointer; font-size: 1.2rem;"></i>
                    </span>
                  </div>
                </div>
              </div>

              <input type="hidden" name="id_level">

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="InputNoHp" class="form-label">No Handphone</label>
                  <input type="text" class="form-control" id="InputNoHp" name="txt_no_hp"
                    required data-parsley-required-message="No. HP harus di isi !!!"
                    placeholder="Ex: 085808241204" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                  <div class="row g-2 pt-1">
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1"
                        value="Laki-laki" checked />
                      <label class="gender-card-option" for="Radios1">
                        <div class="gender-card-content">
                          <i class="bx bx-male"></i>
                          <span>Laki-laki</span>
                        </div>
                      </label>
                    </div>
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2"
                        value="Perempuan" />
                      <label class="gender-card-option" for="Radios2">
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
                  <label for="InputAlamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="InputAlamat" name="txt_alamat"
                    required data-parsley-required-message="Alamat harus di isi !!!"
                    placeholder="Ex: JL. Dharmawangsa" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="InputIdTerminal" class="form-label">Terminal Tersedia</label>
                  <div class="d-flex align-items-center gap-2">
                    <select class="form-select flex-grow-1" aria-label=".form-select-sm example"
                      required data-parsley-required-message="Harap pilih data terminal !!!"
                      data-parsley-errors-container="#terminal-error-container" name="id_terminal">
                      <option disabled selected>Pilih Terminal</option>
                      <?php
                          $data = $obj->lihatTerminal();
                          $no = 1;
                          if($data->rowCount()>0){
                            if($sesLvl == 1){
                                $dis = "";
                            } else{
                                $dis = "disabled";
                            }
                            while($row=$data->fetch(PDO::FETCH_ASSOC)){
                              $id_terminal = $row['id_terminal'];
                              $nama_terminal = $row['nama_terminal'];
                              $provinsi = $row['provinsi_terminal'];
                              $kabupaten = $row['kabupaten_terminal'];
                              $kecamatan = $row['kecamatan_terminal'];
                          ?>
                      <option value="<?php echo $id_terminal;?>"><?php echo $nama_terminal, ', ', $kabupaten;?></option>
                      <?php
                        }}
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary btn-circle btn-user flex-shrink-0 align-self-start"
                      aria-label="Tambah terminal" data-bs-toggle="modal" data-bs-target="#TambahDataTerminal"
                      value="tambah"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah"></i></button>
                  </div>
                  <div id="terminal-error-container"></div>
                </div>
              </div>

              <div class="auth-actions">
                <a href="index.php" class="btn btn-secondary">
                  <span>Login</span>
                </a>
                <button type="submit" name="daftar" class="btn btn-primary btn-shadow">Daftar</button>
              </div>

              <div class="auth-foot-note">
                Sudah punya akun? Klik tombol <b>Login</b> untuk masuk ke akun Anda.
              </div>
            </form>
<?php
$authCardContent = ob_get_clean();

ob_start();
?>
  <!-- Modal -->
  <div id="TambahDataTerminal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content modal-edit">
        <form action="tambahTerminalRegister.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data Terminal</h4>
            <button type="button" class="btn btn-danger btn-circle btn-user" data-bs-dismiss="modal"
              aria-label="Close">
              <i class="bx bx-x"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-lg-12 mb-3" hidden>
              <label for="InputId" class="form-label">Id</label>
              <input type="text" class="form-control" id="InputId" name="txt_id_terminal"
                placeholder="" />
            </div>
            <div class="row">
              <div class="col-12 mb-3">
                <label for="InputNamaTerminal" class="form-label">Nama Terminal</label>
                <input type="text" class="form-control" id="InputNamaTerminal"
                  name="txt_nama_terminal" placeholder="Ex: Tawang Alun" />
              </div>
              <div class="col-12 mb-3">
                <label for="InputAlamatTerminal" class="form-label">Alamat Terminal</label>
                <textarea class="form-control" id="InputAlamatTerminal" name="txt_detail_alamat_terminal"
                  placeholder="Ex: Jl. Dharmawangsa"></textarea>
              </div>
              <div class="col-12 mb-3">
                <label for="InputProvTerminal" class="form-label">Provinsi</label>
                <input type="text" class="form-control" id="InputProvTerminal"
                  name="d_provinsi_terminal" placeholder="Ex: Jawa Timur" />
              </div>
              <div class="col-6 mb-3">
                <label for="InputKabupatenTerminal" class="form-label">Kabupaten</label>
                <input type="text" class="form-control" id="InputKabupatenTerminal"
                  name="d_kabupaten_terminal" placeholder="Ex: Jember" />
              </div>
              <div class="col-6 mb-3">
                <label for="InputKecamatanTerminal" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" id="InputKecamatanTerminal"
                  name="d_kecamatan_terminal" placeholder="Ex: Rambupuji" />
              </div>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Cancel" />
              <input type="submit" name="simpan" class="btn btn-primary" value="Simpan" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function showHide(inputId, spanId){
      var myclass = $(inputId).is('.parsley-error');
      var myclass2 = $(inputId).is('.parsley-success');
      if (myclass) {
        $(spanId).removeClass('eye');
        $(spanId).addClass('eye2');
      } else if (myclass2) {
        $(spanId).removeClass('eye2');
        $(spanId).addClass('eye');
      }
    }

    function setupPasswordToggle(inputId, spanId) {
      $(inputId).keyup(function() {
        var inputs = $(inputId).val();
        if(inputs == ""){
          $(spanId).fadeOut("fast");
          $(spanId).removeClass('show');
          $(spanId).addClass('hidden');
        } else {
          $(spanId).fadeIn("fast");
          $(spanId).removeClass('hidden');
          $(spanId).addClass('show');
        }
        setTimeout(function() {
          showHide(inputId, spanId);
        }, 1);
      });

      $(inputId).on('blur change', function() {
        setTimeout(function() {
          showHide(inputId, spanId);
        }, 1);
      });
    }

    $(document).ready(function() {
      setupPasswordToggle('#password-input', '#spanEye');
      setupPasswordToggle('#Kpassword-input', '#spanEye2');

      $(".show-hide").click(function () {
        $(this).toggleClass("bx-hide bx-show");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
          $(this).css("color","#5886ef");
        } else {
          input.attr("type", "password");
          $(this).css("color","#d8d8d8");
        }
      });
    });
  </script>
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
<?php
$extraJS = ob_get_clean();

require_once 'layouts/auth_layout.php';
?>
