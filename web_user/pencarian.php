<?php
  require('koneksi.php');
  require('query.php');
  $obj = new crud;

  // session_start();

  // if(!isset($_SESSION['email'])){
  //     header('Location: index.php');
  // }

  // $sesID = $_SESSION['id'];
  // $sesName = $_SESSION['name'];
  // $sesLvl = $_SESSION['level'];

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Landing Page-SI-BOSS</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/custom2.css" />
    <link rel="stylesheet" href="font/stylesheet.css" />
    <link rel="stylesheet" href="plugin/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="plugin/animation/animate.min.css" />
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow mod fixed-top">
        <div class="container">
          <a class="navbar-brand m-0 d-flex align-self-stretch align-items-center" href="#">
            <img src="assets/img/logo.png" alt="Logo" />
          </a>
          <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="icon fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item ms-3 me-2">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item ms-3 me-2">
                <a class="nav-link" href="#">Booking</a>
              </li>
              <li class="nav-item ms-3 me-2">
                <a class="nav-link" href="#">Help</a>
              </li>
              <li class="nav-item ms-3 me-2">
                <a class="nav-link" href="#">About</a>
              </li>
            </ul>
            <div class="ms-auto myClass">
              <button class="btn colorPrimary me-2 roundedBtn text-white" type="submit">Masuk</button>
              <button class="btn btn-outlineCust roundedBtn" type="submit">Daftar</button>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <main>
      <section class="py-5 pb-2 bg-light">
        <div class="mx-5">
          <div class="search-bar bg-white py-2 myRounded shadow mod d-flex align-content-center">
            <div class="container">
              <div class="row">
                <div class="col-lg-6 myCol border border-start-0 border-bottom-0 border-top-0">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                      <p class="ps-3 mb-2"><b>Asal</b></p>
                      <p class="ps-3 mb-2"><b>Ke</b></p>
                      <p class="pe-3 mb-2"><b>Tujuan</b></p>
                    </div>
                    <div class="col-12 mb-4 mb-lg-0">
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-location-arrow text-white"></i></span>
                        <input type="text" class="form-control" placeholder="Pemberangkatan" aria-label="Username" />
                        <span class="input-group-text"><i class="fas fa-exchange-alt text-white"></i></span>
                        <input type="text" class="form-control" placeholder="Tujuan" aria-label="Server" />
                        <span class="input-group-text"><i class="fas fa-map-marker-alt text-white"></i> </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                      <div class="form-group">
                        <label for="datepicker" class="ps-3 form-label"><b>Tanggal Pemberangkatan</b></label>
                        <input type="date" class="form-control" id="datepicker" name="txt_Tgl" />
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="InputJenisBus" class="ps-3 form-label"><b>Jenis Bus</b></label>
                        <select class="form-select form-select-user" aria-label=".form-select-sm example" name="InputJenisBus">
                          <option disabled selected>Pilih Jenis Bus</option>
                          <option value="Ekonomi">Ekonomi</option>
                          <option value="Eksekutif">Eksekutif</option>
                          <option value="Pariwisata">Pariwisata</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-12 text-center">
                  <button class="btn colorPrimary text-white roundedBtn">Cari</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5 pt-0 bg-light">
        <div class="row">
          <div class="col-lg-3">
            <div class="ms-5 sticky">
              <div class="panel-filter bg-white py-2 myRounded shadow mod d-flex align-content-center sticky-top">
                <div class="container">
                  <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                      <span><b>Filter</b></span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                      <button class="btn colorPrimary text-white roundedBtn">Terapkan</button>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                      <p><b>Waktu Pemberangkatan</b></p>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="AC" id="check1" />
                        <label class="form-check-label" for="check1"> 00:00 - 06:00 </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="TV" id="check2" />
                        <label class="form-check-label" for="check2"> 06:00 - 12:00 </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Wi-Fi" id="check3" />
                        <label class="form-check-label" for="check3"> 12:00 - 18:00 </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Wi-Fi" id="check4" />
                        <label class="form-check-label" for="check4"> 18:00 - 24:00 </label>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                      <p><b>Waktu Tiba</b></p>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="AC" id="checkT1" />
                        <label class="form-check-label" for="checkT1"> 00:00 - 06:00 </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="TV" id="checkT2" />
                        <label class="form-check-label" for="checkT2"> 06:00 - 12:00 </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Wi-Fi" id="checkT3" />
                        <label class="form-check-label" for="checkT3"> 12:00 - 18:00 </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Wi-Fi" id="checkT4" />
                        <label class="form-check-label" for="checkT4"> 18:00 - 24:00 </label>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                      <p><b>Jenis</b></p>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Ekonomi" id="jenis1" />
                        <label class="form-check-label" for="jenis1"> Ekonomi </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Patas" id="jenis2" />
                        <label class="form-check-label" for="jenis2"> Patas </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-9">
            <div class="me-5">
              <!-- Content Data -->
              <?php
                $data = $obj->lihatBus();
                while($row=$data->fetch(PDO::FETCH_ASSOC)){
                  $idBus = $row['id_bus'];
                  $namaBus = $row['nama_bus'];
                  $harga = $row['harga'];
                  $status = $row['status_bus'];
                  $JKursi = $row['jumlah_kursi'];
                  $fotoBus = $row['foto_bus'];
                  $jenis_bus = $row['jenis'];
                  $fasilitas = $row['fasilitas'];
                  $tgl_brngkt = $row['tanggal_pemberangkatan'];
                  $pemberangkatan = $row['pemberangkatan'];
                  $waktu_berangkat = $row['waktu_berangkat'];
                  $tujuan = $row['tujuan'];
                  $waktu_tiba = $row['waktu_tiba'];
                  ?>
              <div class="panel-data bg-white py-2 myRounded shadow mod mb-2 d-flex">
                <div class="container">
                  <div class="row myrowData h-100">
                    <div class="col-6 pt-2">
                      <h3 class="m-0"><b><?php echo ucwords($namaBus) ?></b></h3>
                      <p class="m-0"><?php echo ucwords($jenis_bus) ?></p>
                    </div>
                    <div class="col-6 pt-2">
                      <h3 class="m-0 d-flex justify-content-end font-RobotoBold s22 colorPrimaryText">
                        <?php echo rupiah($harga) ?>
                        <span class="font-Roboto s14 align-self-center colorBlueDarkText">/Kursi</span>
                      </h3>
                      <p class="m-0 d-flex justify-content-end font-RobotoBold s14">0/<?php echo $JKursi ?></p>
                    </div>
                    <div class="col-2 py-2">
                      <img class="img-fluid img-bus rounded" src="assets/img/image 3.jpg" alt="icoBus" />
                    </div>
                    <div class="col-10 py-2">
                      <div class="row">
                        <div class="col-3">
                          <p class="m-0"><span class="Waktu"><?php echo date("H:i",strtotime($waktu_berangkat)) ?></span></p>
                          <p class="m-0"><?php echo ucwords($pemberangkatan) ?></p>
                          <span class="badge bg-warning text-dark"><?php echo date("d-m-Y",strtotime($tgl_brngkt)) ?></span>
                        </div>
                        <div class="col-1 d-flex justify-content-center align-items-center">
                          <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="col-3">
                          <p class="m-0"><span class="Waktu"><?php echo date("H:i",strtotime($waktu_tiba)) ?></span></p>
                          <p class="m-0"><?php echo ucwords($tujuan) ?></p>
                        </div>
                        <div class="col-2 border border-start border-bottom-0 border-top-0 border-end-0">
                          <p class="font-Roboto s12 m-0">Estimasi</p>
                          <p class="font-RobotoBold s18">7 jam</p>
                        </div>
                        <div class="col-3 border border-start border-bottom-0 border-top-0 border-end-0 d-flex justify-content-start align-items-center">
                          <a href="">
                            <button class="btn colorYellow roundedBtn text-white font-RobotoBold btnPesan">Pesan</button>
                          </a>
                        </div>
                      </div>
                      <div class="row mt-2 info">
                        <div class="col-4 text-end">
                          <button class="colorPrimaryText btn s14" id="shadow1" data-bs-toggle="collapse" data-bs-target="#detailBus" aria-expanded="false" aria-controls="detailBus">Detail Bus</button>
                        </div>
                        <div class="col-4 text-center">
                          <button class="colorPrimaryText btn s14" id="shadow2" data-bs-toggle="collapse" data-bs-target="#detailRute" aria-expanded="false" aria-controls="detailRute">Detail Rute</button>
                        </div>
                        <div class="col-4 text-start">
                          <button class="colorPrimaryText btn s14" id="shadow3" data-bs-toggle="collapse" data-bs-target="#ulasan" aria-expanded="false" aria-controls="ulasan">Ulasan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="detailBus" class="collapse">
                <div class="panel-data2 bg-white py-2 myRounded transitionShadow mb-1">
                  <div class="container">
                    <p class="pt-3 font-RobotoBold mb-2">Jenis Bus : <span class="font-Roboto">Eknonomi</span></p>
                    <p class="font-RobotoBold mb-2">Kapasitas Kursi : <span class="font-Roboto">60 Kursi</span></p>
                    <p class="font-RobotoBold mb-2">
                      Fasilitas bus :
                      <span class="font-Roboto"> - </span>
                    </p>
                  </div>
                </div>
              </div>

              <div id="detailRute" class="collapse">
                <div class="panel-data2 bg-white py-2 myRounded transitionShadow mb-1 shadow-none">
                  <div class="container">
                    <p class="alert alert-danger m-0">Detail Rute Belum Tersedia !</p>
                  </div>
                </div>
              </div>

              <div id="ulasan" class="collapse">
                <div class="panel-data2 bg-white py-2 myRounded transitionShadow mb-1 shadow-none">
                  <div class="container">
                    <p class="alert alert-danger m-0">Ulasan Belum Tersedia !</p>
                  </div>
                </div>
              </div>
            <?php
              }
            ?>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- JavaScript & JQuery -->
    <script src="plugin/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
      // $("#shadow1, #shadow2, #shadow3").click(function () {
      //   $(".transitionShadow").toggleClass("shadow mod");
      // });
      $(".btn").click(function () {
          $(".collapse.show").collapse("hide");
        });
    </script>
  </body>
</html>