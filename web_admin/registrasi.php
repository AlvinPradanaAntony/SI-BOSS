<?php
require ('function.php');

if (isset($_COOKIE['cookie_email'])) {
  systemCookies();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Daftar - SI BOSS</title>
  <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="plugin/font/stylesheet.css" />
  <link rel="stylesheet" href="plugin/css/app.min.css" />
  <link rel="stylesheet" href="plugin/fontawesome-free/css/all.min.css" />
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
                <div class="logoT">
                  <a href="#">
                    <img src="img/logo.png" alt="LogoSiboss" />
                  </a>
                </div>
                <div class="panelFormDaftar o-hidden border-0 shadow">
                  <div class="p-5">
                    <div class="judul">
                      <h4 class="text-gray-900 mb-5">Daftar <br /><span>System Information Booking Online Bus</span>
                      </h4>
                    </div>
                    <form class="custom-validation" action="function.php" method="POST">
                      <div class="col-lg-12 mb-3" hidden>
                        <label for="InputId" class="form-label">Id</label>
                        <input type="text" class="form-control form-control-user2" id="InputId" name="txt_id"
                          placeholder="" />
                      </div>
                      <div class="row">
                        <div class="col-lg-6 mb-3">
                          <label for="InputNama" class="form-label">Nama Lengkap</label>
                          <input type="text" class="form-control form-control-user2" id="InputNama" name="txt_nama"
                            required data-parsley-required-message="Nama lengkap harus di isi !!!"
                            placeholder="Ex: Budi Santoso" />
                        </div>
                        <div class="col-lg-6 mb-3">
                          <label for="InputEmail" class="form-label">Email</label>
                          <input type="email" class="form-control form-control-user2" id="InputEmail" name="txt_email"
                            required data-parsley-required-message="Email harus di isi !!!"
                            placeholder="Ex: budiman@siboss.com" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-6 mb-3">
                          <label for="password-input" class="form-label">Kata Sandi</label>
                          <input type="password" class="form-control form-control-user2" id="password-input"
                            name="txt_password" required data-parsley-required-message="Kata sandi harus di isi !!!"
                            placeholder="********" data-parsley-length="[8,16]" maxlength="16" data-parsley-length-message="Harus disiisi 8 sampai 16 karakter !!!"
                            data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" />
                        </div>
                        <div class="col-lg-6 mb-3">
                          <label for="Kpassword-input" class="form-label">Konfirmasi Kata sandi</label>
                          <input type="password" class="form-control form-control-user2" id="Kpassword-input"
                            name="txt_pass" required data-parsley-required-message="Masukan ulang kata sandi !!!"
                            data-parsley-equalto="#password-input" data-parsley-equalto-message="Kata sandi tidak cocok" placeholder="********" />
                            <span class="s10 p-0 mb-2 d-flex justify-content-end show-hideWithText mt-1" toggle="#password-input" toggle2="#Kpassword-input" id="spanShow">
                              Tampilkan Kata Sandi
                            </span>
                          </div>

                      </div>
                      <input type="hidden" name="id_level">
                      <div class="row">
                        <div class="col-lg-6 mb-3">
                          <label for="InputNoHp" class="form-label">No Handphone</label>
                          <input type="text" class="form-control form-control-user2" id="InputNoHp" name="txt_no_hp"
                            required data-parsley-required-message="No. HP harus di isi !!!"
                            placeholder="Ex: 085808241204" />
                        </div>
                        <div class="col-lg-6 mb-3">
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
                          <label for="InputAlamat" class="form-label">Alamat</label>
                          <input type="text" class="form-control form-control-user2" id="InputAlamat" name="txt_alamat"
                            required data-parsley-required-message="Alamat harus di isi !!!"
                            placeholder="Ex: JL. Dharmawangsa" />
                        </div>
                        <div class="col-lg-6 mb-3">
                          <label for="InputIdTerminal" class="form-label">Terminal Tersedia</label>
                          <select class="form-select form-select-user select-md" aria-label=".form-select-sm example"
                            required data-parsley-required-message="Harap pilih data terminal !!!" name="id_terminal">
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
                            <option value="<?php echo $id_terminal;?>"><?php echo $nama_terminal, ', ', $kabupaten;?>
                            </option>
                            <?php 
                              }}
                              ?>
                          </select>
                          <a href="#" class="actionBtn" aria-label="Tambah">
                            <button class="btn colorPrimary text-white btn-user btn-circle btn-xs"
                              aria-label="TambahModal" data-bs-toggle="modal" data-bs-target="#TambahDataTerminal"
                              value="tambah"><i class="fa fa-plus" data-bs-toggle="tooltip" title="Tambah"></i></button>
                          </a>
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="mb-5"></div>
                      <div class="col-12 d-flex justify-content-center mb-3">
                        <button type="submit" name="daftar"
                          class="btn colorPrimary btn-login text-white btn-block2">Daftar</button>
                      </div>
                      <div class="col-12 d-flex justify-content-center">
                        <a href="index.php" class="btn btn-daftar btn-block2 py-2">
                          <span>Login</span>
                        </a>
                      </div>
                      <div class="mb-3"></div>
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
                <footer class="d-flex justify-content-center text-center">
                  <p class="col-md-4 mb-0 text-muted">&copy; 2021 SI-BOSS, All Rights Reserved</p>
                </footer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="TambahDataTerminal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content modal-edit">
        <form action="tambahTerminalRegister.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data Terminal</h4>
            <button type="button" class="btn btn-danger btn-circle btn-user2 shadow" data-bs-dismiss="modal"
              aria-label="Close" aria-hidden="true">
              <i class="fa fa-times fa-sm"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-lg-12 mb-3" hidden>
              <label for="InputId" class="form-label">Id</label>
              <input type="text" class="form-control form-control-user2" id="InputId" name="txt_id_terminal"
                placeholder="" />
            </div>
            <div class="row">
              <div class="col-12 mb-3">
                <label for="InputNamaTerminal" class="form-label">Nama Terminal</label>
                <input type="text" class="form-control form-control-user2" id="InputNamaTerminal"
                  name="txt_nama_terminal" placeholder="Ex: Tawang Alun" />
              </div>
              <div class="col-12 mb-3">
                <label for="InputAlamat" class="form-label">Alamat Terminal</label>
                <textarea class="form-control form-control-user2" id="InputAlamat" name="txt_detail_alamat_terminal"
                  placeholder="Ex: Jl. Dharmawangsa"></textarea>
              </div>
              <div class="col-12 mb-3">
                <label for="InputProvTerminal" class="form-label">Provinsi</label>
                <input type="text" class="form-control form-control-user2" id="InputProvTerminal"
                  name="d_provinsi_terminal" placeholder="Ex: Jawa Timur" />
              </div>
              <div class="col-6 mb-3">
                <label for="InputKabupatenTerminal" class="form-label">Kabupaten</label>
                <input type="text" class="form-control form-control-user2" id="InputKabupatenTerminal"
                  name="d_kabupaten_terminal" placeholder="Ex: Jember" />
              </div>
              <div class="col-6 mb-3">
                <label for="InputKecamatanTerminal" class="form-label">Kecamatan</label>
                <input type="text" class="form-control form-control-user2" id="InputKecamatanTerminal"
                  name="d_kecamatan_terminal" placeholder="Ex: Rambupuji" />
              </div>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-secondary roundedBtn" data-bs-dismiss="modal" value="Cancel" />
              <input type="submit" name="simpan" class="btn colorPrimary text-white roundedBtn" value="Simpan" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="plugin/js/bootstrap.bundle.min.js"></script>
  <script src="jquery/jquery-3.6.0.min.js"></script>
  <script src="plugin/js/form-validation.init.js"></script>
  <script src="plugin/js/parsley.min.js"></script>
  <script src="plugin/js/javascript.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.3/dist/sweetalert2.all.min.js" integrity="sha256-+InBGKGbhOQiyCbWrARmIEICqZ8UvYJr/qVhHmlmFpc=" crossorigin="anonymous"></script>
  <script src="plugin/js/custom_SweetAlert2.js"></script>
  <script>
    $(document).ready(function(){
      $(".show-hideWithText").click(function() {
        $(this).text(($("#spanShow").text() == 'Sembunyikan Kata Sandi') ? 'Tampilkan Kata Sandi' : 'Sembunyikan Kata Sandi');
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          $('.show-hideWithText').css('color','#527bdd');
          input.attr("type", "text");
        } else {
          $('.show-hideWithText').css('color','#6c757D');
          input.attr("type", "password");
        }
        var input = $($(this).attr("toggle2"));
        if (input.attr("type") == "password") {
          $('.show-hideWithText').css('color','#527bdd');
          input.attr("type", "text");
        } else {
          $('.show-hideWithText').css('color','#6c757D');
          input.attr("type", "password");
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
</body>

</html>