<?php
require_once('layouts/auth.php');

$pageTitle = "Data Laporan - SI BOSS";
$activeMenu = "dataLaporan";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

ob_start();
?>
    <!-- Content Row -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card Total Data Bus -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 bg-gradient-blue shadow h-100 py-2">
          <div class="card-body">
            <div class="row g-0 align-items-center">
              <div class="col me-2">
                <div class="small text-white">Data Bus</div>
                <div class="fs-5 fw-bold text-white">
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
        <div class="card border-0 bg-gradient-pink shadow h-100 py-2">
          <div class="card-body">
            <div class="row g-0 align-items-center">
              <div class="col me-2">
                <div class="small text-white">Data Driver</div>
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
                <div class="small text-white">Data Pemesanan</div>
                <div class="fs-5 fw-bold text-white">
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
        <div class="card border-0 bg-gradient-green shadow h-100 py-2">
          <div class="card-body">
            <div class="row g-0 align-items-center">
              <div class="col me-2">
                <div class="small text-white">Total Penghasilan</div>
                <div class="fs-5 fw-bold text-white"><span>Rp.</span>
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

    <!-- Content Row -->
    <div class="row m-0 px-4">
      <div class="row">
        <div class="col-12">
          <form action="cetakLaporanPeriode.php" method="POST">
            <table>
              <div class="row">
                <div class="col-lg-2 mb-3">
                  <label for="inputJenis" class="form-label">Tanggal Mulai</label>
                  <input type="date" class="form-control" id="inputJenis" name="txt_tanggal_mulai" />
                </div>
                <div class="col-lg-2 mb-3">
                  <label for="inputFasilitas" class="form-label">Tanggal Selesai</label>
                  <input type="date" class="form-control" id="inputFasilitas"
                    name="txt_tanggal_selesai" />
                </div>
                <div class="col-lg-3 mb-3 d-flex align-items-end pb-2">
                  <button type="submit" class="btn btn-primary" name="simpan"
                    style="width: 80px;">Lihat</button>
                </div>
              </div>
            </table>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-1">
          <form action="cetakLaporanHarian.php" method="POST">
            <table>
              <div class="row">
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputJenis" class="form-label">Tanggal Mulai</label>
                  <input type="date" class="form-control" id="inputJenis" name="txt_tanggal_mulaih"
                    value="<?php echo date('Y-m-d'); ?>" />
                </div>
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputFasilitas" class="form-label">Tanggal Selesai</label>
                  <input type="date" class="form-control" id="inputFasilitas"
                    name="txt_tanggal_selesaih"
                    value="<?php echo date('Y-m-d', strtotime("+1 day", strtotime(date("Y-m-d")))); ?>" />
                </div>
                <div class="col-lg-3 mb-3">
                  <button type="submit" class="btn btn-primary" name="simpan" style="width: 80px;">Harian</button>
                </div>
              </div>
              <td>
              </td>
            </table>
          </form>
        </div>

        <div class="col-1">
          <form action="cetakLaporanMingguan.php" method="POST">
            <table>
              <div class="row">
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputJenis" class="form-label">Tanggal Mulai</label>
                  <input type="date" class="form-control" id="inputJenis" name="txt_tanggal_mulaim"
                    value="<?php $tgl1 = date('Y-m-d'); $tgl2 = date("Y-m-d", strtotime('monday this week')); echo $tgl2;?>" />
                </div>
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputFasilitas" class="form-label">Tanggal Selesai</label>
                  <input type="date" class="form-control" id="inputFasilitas"
                    name="txt_tanggal_selesaim"
                    value="<?php $tgl1 = date('Y-m-d'); $tgl2 = date("Y-m-d", strtotime('sunday this week')); echo $tgl2;?>" />
                </div>
                <div class="col-lg-3 mb-3">
                  <button type="submit" class="btn btn-primary" name="simpan">Mingguan</button>
                </div>
              </div>
              <td>
              </td>
            </table>
          </form>
        </div>

        <div class="col-1">
          <form action="cetakLaporanBulanan.php" method="POST">
            <table>
              <div class="row">
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputJenis" class="form-label">Tanggal Mulai</label>
                  <input type="date" class="form-control" id="inputJenis" name="txt_tanggal_mulaib"
                    value="<?php $tgl1 = date('Y-m-d'); $tgl2 = date('Y-m-01', strtotime($tgl1)); echo $tgl2;?>" />
                </div>
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputFasilitas" class="form-label">Tanggal Selesai</label>
                  <input type="date" class="form-control" id="inputFasilitas"
                    name="txt_tanggal_selesaib"
                    value="<?php $tgl1 = date('Y-m-d'); $tgl2 = date('Y-m-t', strtotime($tgl1)); echo $tgl2;?>" />
                </div>
                <div class="col-lg-3 mb-3">
                  <button type="submit" class="btn btn-primary" name="simpan">Bulanan</button>
                </div>
              </div>
              <td>
              </td>
            </table>
          </form>
        </div>

        <div class="col-1">
          <form action="cetakLaporanTahunan.php" method="POST">
            <table>
              <div class="row">
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputJenis" class="form-label">Tanggal Mulai</label>
                  <input type="date" class="form-control" id="inputJenis" name="txt_tanggal_mulait"
                    value="<?php $tgl1 = date('Y-m-d'); $tgl2 = date('Y-01-01', strtotime($tgl1)); echo $tgl2;?>" />
                </div>
                <div class="col-lg-2 mb-3" hidden>
                  <label for="inputFasilitas" class="form-label">Tanggal Selesai</label>
                  <input type="date" class="form-control" id="inputFasilitas"
                    name="txt_tanggal_selesait"
                    value="<?php $tgl1 = date('Y-m-d'); $tgl2 = date('Y-m-t', strtotime($tgl1)); echo $tgl2;?>" />
                </div>
                <div class="col-lg-3 mb-3">
                  <button type="submit" class="btn btn-primary" name="simpan">Tahunan</button>
                </div>
              </div>
              <td>
              </td>
            </table>
          </form>
        </div>
      </div>
    </div>


    <!-- Panel -->
    <div class="row g-2 m-0 px-4">
      <div class="col-lg-12">
        <div class="card shadow mb-4 rounded">
          <div class="card-header shadow rounded">
            <div class="title float-start">
              <span class="m-0"><b>Tabel Data Laporan</b></span>
            </div>
            <div class="btnAction float-end">
              <!-- <button type="button" class="btn btn-light text-dark btn-circle shadow me-2" data-bs-toggle="modal" data-bs-target="#tambahDataPemesanan"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
                <button type="button" class="btn btn-light text-danger btn-circle shadow" data-bs-toggle="modal" data-bs-target="#deleteDataPemesanan"><i class="bx bx-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
            </div>
          </div>

          <div class="card-body">
              <table class="table table-hover dataTable nowrap" width="100%">
                <thead>
                  <tr>
                    <th class="cb">
                      <span class="form-check d-inline-block">
                        <input type="checkbox" class="form-check-input selectAll" aria-label="Pilih semua data" />
                      </span>
                    </th>
                    <th class="actions">Action</th>
                    <th class="idPemesanan">ID Pemesanan</th>
                    <th>ID Tiket</th>
                    <th>Status</th>
                    <th>Nama Pemesan</th>
                    <th>No Handphone</th>
                    <th>Nama Penumpang</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama Bus</th>
                    <th>Harga</th>
                    <th>Tanggal Pemberangkatan</th>
                    <th>Waktu Pemesanan</th>
                    <th>Kursi</th>
                    <th>Total Bayar</th>
                  </tr>
                </thead>
                <tbody><?php
                                $data = $obj->lihatPemesanan();
                                $no = 1;
                                if($data->rowCount()>0){
                                  if($sesLvl == 1){
                                      $dis = "";
                                  } else{
                                      $dis = "disabled";
                                  }
                                  while($row=$data->fetch(PDO::FETCH_ASSOC)){
                                    // $id_pembayaran = $row['id_pembayaran'];
                                    $id_tiket = $row['id_tiket'];
                                    $id_pemesanan = $row['id_pemesanan'];
                                    $nama_user = $row['nama_user'];
                                    $no_hp_user = $row['no_hp_user'];
                                    $nama_penumpang = $row['nama_penumpang'];
                                    $jenis_kelamin_penumpang = $row['jenis_kelamin_penumpang'];
                                    // $id_bus = $row['id_bus'];
                                    $nama_bus = $row['nama_bus'];
                                    $harga = $row['harga'];
                                    // $status_bus = $row['status_bus'];
                                    // $jumlah_kursi = $row['jumlah_kursi'];
                                    // $foto_bus = $row['foto_bus'];
                                    // $id_jenis = $row['id_jenis'];
                                    // $jenis_bus = $row['jenis'];
                                    // $fasilitas = $row['fasilitas'];
                                    $tanggal_pemberangkatan = $row['tanggal_pemberangkatan'];
                                    // $pemberangkatan = $row['pemberangkatan'];
                                    // $waktu_berangkat = $row['waktu_berangkat'];
                                    // $tujuan = $row['tujuan'];
                                    $waktu_pemesanan = $row['waktu_pemesanan'];
                                    $jumlah_kursi_pesan = $row['jumlah_kursi_pesan'];                                    
                                    // $waktu_tiba = $row['waktu_tiba'];
                                    $total_bayar = $row['total_bayar'];
                                    $status = $row['status'];
                                    // $id_terminal = $row['id_terminal'];
                                    // $nama_terminal = $row['nama_terminal'];
                                ?>
                  <tr>
                    <td>
                      <span class="form-check d-inline-block">
                        <input type="checkbox" class="form-check-input" aria-label="Pilih data" name="option[]" value="<?php echo $no; ?>" />
                      </span>
                    </td>
                    <td>
                      <?php if ($status!=="Belum Bayar" AND $status!=="Pesanan Dibatalkan"): ?>
                      <a href="lihatPembayaran.php?id_pembayaran=<?php echo $id_pemesanan ?>" class="btn btn-info"><i
                          class="bx bx-receipt"></i></a><br>

                      <?php endif ?>
                      <!-- <a href="#" class="actionBtn" aria-label="Edit">
                                    <button type="button" class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataPemesanan<?php echo $id_tiket ?>" value="edit">
                                      &nbsp;<i class="bx bx-receipt" data-bs-toggle="tooltip" title="Edit"></i>
                                    </button> -->
                      <!-- <a href="#" class="actionBtn" aria-label="Delete">
                                    <button type="button" class="btn btn-danger btn-user btn-circle" aria-label="DeleteModal" data-bs-toggle="modal" data-bs-target="#deleteDataPemesanan<?php echo $id_tiket ?>" value="hapus">
                                      <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button> -->

                      <!-- Edit Modal -->
                      <div id="editDataPemesanan<?php echo $id_tiket ?>" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content modal-edit">
                            <form role="form" action="editPemesanan.php" method="POST">
                              <?php
                                            // Removed N+1 query: directly use variables from the outer loop
                                          ?>
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Tiket</h4>
                                <button type="button" class="btn btn-danger btn-circle btn-user"
                                  data-bs-dismiss="modal" aria-label="Close">
                                  <i class="bx bx-x"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3" hidden>
                                      <label for="InputId" class="form-label">Id</label>
                                      <input type="text" class="form-control" id="inputId"
                                        name="txt_id_bus" value="<?php echo $id_tiket?>" placeholder="" readonly />
                                    </div>


                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="mb-3">
                                    <label for="InputNamaBus" class="form-label">Nama Bus</label>
                                    <input type="text" class="form-control" id="inputNama"
                                      name="txt_nama_bus" placeholder="Ex: Pahala Kencana"
                                      value="<?php echo $nama_bus?>" />
                                  </div>
                                  <div class="mb-3">
                                    <label for="InputJenisBus" class="form-label">Jenis Bus</label>
                                    <select class="form-select"
                                      aria-label=".form-select-sm example" required
                                      data-parsley-required-message="Harap pilih data jenis !!!" name="txt_id_jenis">
                                      <option disabled selected>Pilih Jenis Bus</option>
                                      <?php
                                                    $datas = $obj->lihatJenisBus();
                                                    $no = 1;
                                                    if($datas->rowCount()>0){
                                                      if($sesLvl == 1){
                                                          $dis = "";
                                                      } else{
                                                          $dis = "disabled";
                                                      }
                                                      while($row=$datas->fetch(PDO::FETCH_ASSOC)){
                                                        $id_jeniss = $row['id_jenis'];
                                                        $jeniss = $row['jenis'];
                                                        $fasilitass = $row['fasilitas'];
                                                    ?>
                                      <option value="<?php echo $id_jeniss;?>"><?php echo $jeniss;?></option>
                                      <?php 
                                                  }}
                                                  ?>
                                    </select>
                                  </div>
                                  <div class="mb-3">
                                    <label for="InputJenisBus" class="form-label">Rute</label>
                                    <select class="form-select"
                                      aria-label=".form-select-sm example" required
                                      data-parsley-required-message="Harap pilih data rute !!!" name="txt_id_rute">
                                      <option disabled selected>Pilih Rute</option>
                                      <?php
                                                    $datasd = $obj->lihatRute();
                                                    $no = 1;
                                                    if($datasd->rowCount()>0){
                                                      if($sesLvl == 1){
                                                          $dis = "";
                                                      } else{
                                                          $dis = "disabled";
                                                      }
                                                      while($row=$datasd->fetch(PDO::FETCH_ASSOC)){
                                                        $id_rutes = $row['id_rute'];
                                                        $pemberangkatans = $row['pemberangkatan'];
                                                        $tujuans = $row['tujuan'];
                                                    ?>
                                      <option value="<?php echo $id_rutes;?>">
                                        <?php echo $pemberangkatans, " - ", $tujuans;?></option>
                                      <?php 
                                                  }}
                                                  ?>
                                    </select>
                                  </div>
                                  <div class="mb-3">
                                    <label for="InputTglPemberangkatan" class="form-label">Tanggal
                                      Pemberangkatan</label>
                                    <input type="date" class="form-control"
                                      id="InputTglPemberangkatan" name="txt_tanggal_pemberangkatan"
                                      value="<?php echo $tanggal_pemberangkatan?>">
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button"
                                    data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary"
                                    name="simpan">Update</button>
                                </div>
                              </div>
                            </form>
                            <?php 
                                            // Removed closing bracket for N+1 query loop
                                          ?>
                          </div>
                        </div>
                      </div>
            </div>

            <!-- Delete Modal -->
            <div id="deleteDataPemesanan<?php echo $id_tiket; ?>" class="modal fade" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Tiket</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                      <p>Apakah Anda yakin ingin menghapus data tiket ini ?</p>
                      <p class="text-warning"><small>Perlu hati-hati karena data akan hilang selamanya !</small></p>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                      <a class="btn btn-danger" href="hapusTiket.php?id_bus=<?php echo $id_tiket; ?>">Hapus</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </td>
            <td>P000<?php echo $id_pemesanan; ?></td>
            <td>APBTRMLRT000<?php echo $id_tiket; ?></td>
            <td><?php echo $status;?></td>
            <td><?php echo $nama_user; ?></td>
            <td><?php echo $no_hp_user; ?></td>
            <td><?php echo $nama_penumpang; ?></td>
            <td><?php echo $jenis_kelamin_penumpang; ?></td>
            <td><?php echo $nama_bus;?></td>
            <td>Rp. <?php echo $harga;?></td>
            <td><?php echo $tanggal_pemberangkatan?></td>
            <td><?php echo $waktu_pemesanan;?></td>
            <td><?php echo $jumlah_kursi_pesan;?> kursi</td>
            <td>Rp. <?php echo $total_bayar;?></td>
            </tr>
            <?php
                                $no++;
                                }}
                              ?>
            </tbody>
            </table>
        </div>
      </div>
    </div>
<?php
$mainContent = ob_get_clean();

ob_start();
?>
  <script src="plugin/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="plugin/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="plugin/js/datatables-demo.js"></script>
  <script src="plugin/js/javascript.js"></script>
<?php
$extraJS = ob_get_clean();
$useUpImg = true;
require_once('layouts/main_layout.php');
?>