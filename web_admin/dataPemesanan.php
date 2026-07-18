<?php
require_once('layouts/auth.php');

$pageTitle = "Data Pemesanan - SI BOSS";
$activeMenu = "dataPemesanan";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';
// Fetch pemesanan data once for stats and table
$allPemesanan = [];
$pemesananQuery = $obj->lihatPemesanan();
if ($pemesananQuery->rowCount() > 0) {
  while ($row = $pemesananQuery->fetch(PDO::FETCH_ASSOC)) {
    $allPemesanan[] = $row;
  }
}
$totalPemesanan = count($allPemesanan);
$sudahBayar = 0;
$belumBayar = 0;
$totalPenghasilan = 0;

foreach ($allPemesanan as $p) {
  $statusTrimmed = trim($p['status']);
  if ($statusTrimmed === "Sudah Bayar") {
    $sudahBayar++;
  } elseif ($statusTrimmed === "Belum Bayar") {
    $belumBayar++;
  }
  $totalPenghasilan += intval($p['total_bayar']);
}

ob_start();
?>

      <!-- ============ STAT CARDS ============ -->
      <div class="row m-0 px-3 pt-navbar">
        <!-- Card: Total Pemesanan -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-blue shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-receipt"></i></div>
              </div>
              <div class="stat-label">Total Pemesanan</div>
              <div class="stat-value"><?= $totalPemesanan; ?><span class="stat-unit">Pesanan</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Sudah Bayar -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-green shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-check-circle"></i></div>
              </div>
              <div class="stat-label">Sudah Bayar</div>
              <div class="stat-value"><?= $sudahBayar; ?><span class="stat-unit">Tiket</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Belum Bayar -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-yellow shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-time-five"></i></div>
              </div>
              <div class="stat-label">Belum Bayar</div>
              <div class="stat-value"><?= $belumBayar; ?><span class="stat-unit">Tiket</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Total Pendapatan -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-teal shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-wallet"></i></div>
              </div>
              <div class="stat-label">Total Pendapatan</div>
              <div class="stat-value">Rp <?= number_format($totalPenghasilan, 0, ',', '.'); ?></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Panel -->
      <div class="row g-2 m-0 px-4">
        <div class="col-lg-12">
          <div class="card shadow mb-4 rounded">
            <div class="card-header shadow rounded d-flex align-items-center justify-content-between gap-2">
              <div class="title d-flex align-items-center gap-2">
                <i class="bx bxs-receipt fs-5"></i>
                <span class="m-0"><b>Tabel Data Pemesanan</b></span>
              </div>
              <div class="btnAction d-flex align-items-center gap-2">
                <button type="button" class="btn btn-light text-dark shadow-sm d-flex align-items-center gap-2 border" style="font-size: 13px; padding: 6px 12px; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modalCetakLaporan">
                  <i class="bx bx-printer"></i>
                  <span>Cetak Laporan</span>
                </button>
              </div>
            </div>
            <div class="card-body">
                <table class="table table-hover dataTable nowrap align-middle w-100 dataPemesanan">
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
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </thead>
                  <tbody><?php
                                 $no = 1;
                                 if(count($allPemesanan) > 0){
                                   if($sesLvl == 1){
                                       $dis = "";
                                   } else{
                                       $dis = "disabled";
                                   }
                                   foreach($allPemesanan as $row){
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
                                    $total_bayar = $row['total_bayar'];
                                    $status = $row['status'];
                                    $created_at = $row['created_at'] ?? null;
                                    $updated_at = $row['updated_at'] ?? null;
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
                                  <div class="d-flex align-items-center gap-1">
                                    <?php if ($status!=="Belum Bayar" AND $status!=="Pesanan Dibatalkan"): ?>
                                      <a href="lihatPembayaran.php?id=<?php echo $id_pemesanan; ?>" class="btn btn-info btn-user btn-circle" target="_blank"><i class="bx bx-receipt" data-bs-toggle="tooltip" title="Receipt"></i></a>
                                    <?php endif ?>
                                    <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-pemesanan" data-id="<?php echo $id_tiket; ?>" data-idtiket="APBTRMLRT000<?php echo $id_tiket; ?>" aria-label="Delete">
                                      <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                                    </button>
                                  </div>

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
                                          <button type="button" class="btn btn-danger btn-circle btn-user" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="bx bx-x"></i>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="mb-3" hidden>
                                                <label for="InputId" class="form-label">Id</label>
                                                <input type="text" class="form-control" id="inputId" name="txt_id_bus" value="<?php echo $id_tiket?>" placeholder="" readonly/>
                                              </div>
                                              </div>
                                              </div>
                                              <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label for="InputNamaBus" class="form-label">Nama Bus</label>
                                                  <input type="text" class="form-control" id="inputNama" name="txt_nama_bus" placeholder="Ex: Pahala Kencana" value="<?php echo $nama_bus?>"/>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="InputJenisBus" class="form-label">Jenis Bus</label>
                                                  <select class="form-select" aria-label=".form-select-sm example" required data-parsley-required-message="Harap pilih data jenis !!!" name="txt_id_jenis">
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
                                                  <select class="form-select" aria-label=".form-select-sm example" required data-parsley-required-message="Harap pilih data rute !!!" name="txt_id_rute">
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
                                                    <option value="<?php echo $id_rutes;?>"><?php echo $pemberangkatans, " - ", $tujuans;?></option>
                                                  <?php 
                                                  }}
                                                  ?>
                                                  </select>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="InputTglPemberangkatan" class="form-label">Tanggal Pemberangkatan</label>
                                                  <input type="date" class="form-control" id="InputTglPemberangkatan" name="txt_tanggal_pemberangkatan" value="<?php echo $tanggal_pemberangkatan?>">
                                                </div>
                                                
                                              </div>
                                              <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" name="simpan">Update</button>
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

                                   <!-- Delete Modal removed for SweetAlert2 -->
                                </td>
                                 <td><span class="fw-semibold">P000<?php echo $id_pemesanan; ?></span></td>
                                 <td><span class="fw-semibold">APBTRMLRT000<?php echo $id_tiket; ?></span></td>
                                 <td>
                                   <?php
                                   $statusTrimmed = trim($status);
                                   if ($statusTrimmed === "Sudah Bayar") {
                                     echo '<span class="badge-status status-success">Sudah Bayar</span>';
                                   } elseif ($statusTrimmed === "Belum Bayar") {
                                     echo '<span class="badge-status status-warning">Belum Bayar</span>';
                                   } elseif ($statusTrimmed === "Pesanan Dibatalkan") {
                                     echo '<span class="badge-status status-danger">Dibatalkan</span>';
                                   } else {
                                     echo '<span class="badge-status status-staff">' . htmlspecialchars($status) . '</span>';
                                   }
                                   ?>
                                 </td>
                                 <td><span class="fw-semibold"><?php echo htmlspecialchars($nama_user); ?></span></td>
                                 <td><?php echo htmlspecialchars($no_hp_user); ?></td>
                                 <td><span class="fw-semibold"><?php echo htmlspecialchars($nama_penumpang); ?></span></td>
                                 <td><?php echo htmlspecialchars($jenis_kelamin_penumpang); ?></td>
                                 <td><?php echo htmlspecialchars($nama_bus); ?></td>
                                 <td><span class="text-primary fw-semibold">Rp. <?php echo number_format($harga); ?></span></td>
                                 <td><?php echo $tanggal_pemberangkatan; ?></td>
                                 <td><?php echo $waktu_pemesanan; ?></td>
                                 <td><?php echo $jumlah_kursi_pesan; ?></td>
                                 <td><span class="text-primary fw-bold">Rp. <?php echo number_format($total_bayar); ?></span></td>
                                 <td><?php echo $created_at ? '<span class="badge-waktu"><i class="bx bx-calendar"></i> ' . date('d M Y, H:i', strtotime($created_at)) . '</span>' : '-'; ?></td>
                                 <td><?php echo $updated_at ? '<span class="badge-waktu"><i class="bx bx-calendar"></i> ' . date('d M Y, H:i', strtotime($updated_at)) . '</span>' : '-'; ?></td>
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
            </div>

            <!-- Modal Cetak Laporan -->
            <div class="modal fade" id="modalCetakLaporan" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-edit">
                  <div class="modal-header">
                    <h4 class="modal-title">Cetak Laporan Pemesanan</h4>
                    <button type="button" class="btn btn-danger btn-circle btn-user" data-bs-dismiss="modal" aria-label="Close">
                      <i class="bx bx-x"></i>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="d-grid gap-3">
                      <!-- Periode -->
                      <div class="p-3 rounded" style="background-color: var(--color-surface-container); border: 1px solid var(--color-outline-variant) !important;">
                        <h6 class="fw-bold mb-2" style="color: var(--color-on-surface);">Berdasarkan Periode</h6>
                        <form action="cetakLaporanPeriode.php" method="POST" target="_blank">
                          <div class="row g-2 mb-2">
                            <div class="col-6">
                              <label class="form-label small mb-1" style="color: var(--color-on-surface-variant);">Tanggal Mulai</label>
                              <input type="date" class="form-control form-control-sm" name="txt_tanggal_mulai" required style="background-color: var(--color-surface); border-color: var(--color-outline); color: var(--color-on-surface);" />
                            </div>
                            <div class="col-6">
                              <label class="form-label small mb-1" style="color: var(--color-on-surface-variant);">Tanggal Selesai</label>
                              <input type="date" class="form-control form-control-sm" name="txt_tanggal_selesai" required style="background-color: var(--color-surface); border-color: var(--color-outline); color: var(--color-on-surface);" />
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-sm w-100" name="simpan"><i class="bx bx-printer"></i> Cetak Periode</button>
                        </form>
                      </div>
                      
                      <!-- Quick Prints -->
                      <div class="p-3 rounded" style="background-color: var(--color-surface-container); border: 1px solid var(--color-outline-variant) !important;">
                        <h6 class="fw-bold mb-2" style="color: var(--color-on-surface);">Cetak Cepat</h6>
                        <div class="row g-2">
                          <div class="col-6">
                            <form action="cetakLaporanHarian.php" method="POST" target="_blank">
                              <input type="hidden" name="txt_tanggal_mulaih" value="<?php echo date('Y-m-d'); ?>" />
                              <input type="hidden" name="txt_tanggal_selesaih" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" />
                              <button type="submit" class="btn btn-outline-primary btn-sm w-100" name="simpan">Laporan Harian</button>
                            </form>
                          </div>
                          <div class="col-6">
                            <form action="cetakLaporanMingguan.php" method="POST" target="_blank">
                              <input type="hidden" name="txt_tanggal_mulaim" value="<?php echo date('Y-m-d', strtotime('monday this week')); ?>" />
                              <input type="hidden" name="txt_tanggal_selesaim" value="<?php echo date('Y-m-d', strtotime('sunday this week')); ?>" />
                              <button type="submit" class="btn btn-outline-primary btn-sm w-100" name="simpan">Laporan Mingguan</button>
                            </form>
                          </div>
                          <div class="col-6">
                            <form action="cetakLaporanBulanan.php" method="POST" target="_blank">
                              <input type="hidden" name="txt_tanggal_mulaib" value="<?php echo date('Y-m-01'); ?>" />
                              <input type="hidden" name="txt_tanggal_selesaib" value="<?php echo date('Y-m-t'); ?>" />
                              <button type="submit" class="btn btn-outline-primary btn-sm w-100" name="simpan">Laporan Bulanan</button>
                            </form>
                          </div>
                          <div class="col-6">
                            <form action="cetakLaporanTahunan.php" method="POST" target="_blank">
                              <input type="hidden" name="txt_tanggal_mulait" value="<?php echo date('Y-01-01'); ?>" />
                              <input type="hidden" name="txt_tanggal_selesait" value="<?php echo date('Y-12-31'); ?>" />
                              <button type="submit" class="btn btn-outline-primary btn-sm w-100" name="simpan">Laporan Tahunan</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deleteButtons = document.querySelectorAll('.btn-delete-pemesanan');
      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const idTiket = this.getAttribute('data-id');
          const idTiketFormatted = this.getAttribute('data-idtiket');
          
          Swal.fire({
            title: 'Hapus Tiket',
            html: `Apakah Anda yakin ingin menghapus data tiket <b>${idTiketFormatted}</b>?<br>Perlu hati-hati karena data akan hilang selamanya!`,
            icon: 'warning',
            showCancelButton: true,
            customClass: { confirmButton: 'btn-danger' },
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `hapusTiket.php?id_tiket=${idTiket}`;
            }
          });
        });
      });
    });
  </script>
<?php
$extraJS = ob_get_clean();
$useUpImg = true;
require_once('layouts/main_layout.php');
?>
