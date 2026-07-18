<?php
require_once('layouts/auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama_bus = $_POST['txt_nama_bus'] ?? '';
  $harga = $_POST['txt_harga'] ?? '';
  $status_bus = $_POST['txt_status_bus'] ?? '';
  $jumlah_kursi = $_POST['txt_jumlah_kursi'] ?? '';
  $foto_bus = $_POST['txt_foto_bus'] ?? '';
  $tanggal_pemberangkatan = $_POST['txt_tanggal_pemberangkatan'] ?? '';
  $id_jenis = $_POST['txt_id_jenis'] ?? '';
  $id_rute = $_POST['txt_id_rute'] ?? '';

  if ($obj->insertBus($nama_bus, $harga, $status_bus, $jumlah_kursi, $foto_bus, $tanggal_pemberangkatan, $id_jenis, $id_rute)) {
    // echo '<div class="alert alert-success">Terminal Berhasil Ditambahkan</div>';
  } else {
    // echo '<div class="alert alert-danger">Terminal Gagal Ditambahkan</div>';
  }
}

$pageTitle = "Data Bus - SI BOSS";
$activeMenu = "dataBus";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

// Fetch and process bus data for statistics
$allBuses = [];
$busQuery = $obj->lihatBus();
if ($busQuery->rowCount() > 0) {
  while ($row = $busQuery->fetch(PDO::FETCH_ASSOC)) {
    $allBuses[] = $row;
  }
}

$totalBus = count($allBuses);
$busOperasional = 0;
$busPemeliharaan = 0;
$totalKursi = 0;
$prices = [];
$jenisCounts = [];
$today = date('Y-m-d');
$nextDeparture = null;

foreach ($allBuses as $bus) {
  $status = isset($bus['status_bus']) ? strtolower(trim($bus['status_bus'])) : '';
  if ($status === 'operasional') {
    $busOperasional++;
  } else {
    $busPemeliharaan++;
  }
  
  $kursi = isset($bus['jumlah_kursi']) ? intval($bus['jumlah_kursi']) : 0;
  $totalKursi += $kursi;
  
  $price = isset($bus['harga']) ? floatval($bus['harga']) : 0;
  if ($price > 0) {
    $prices[] = $price;
  }
  
  $jenis = isset($bus['jenis']) ? trim($bus['jenis']) : 'Lainnya';
  if (!isset($jenisCounts[$jenis])) {
    $jenisCounts[$jenis] = 0;
  }
  $jenisCounts[$jenis]++;
  
  $tgl = isset($bus['tanggal_pemberangkatan']) ? $bus['tanggal_pemberangkatan'] : '';
  if ($tgl >= $today) {
    if ($nextDeparture === null || $tgl < $nextDeparture) {
      $nextDeparture = $tgl;
    }
  }
}

$averagePrice = count($prices) > 0 ? array_sum($prices) / count($prices) : 0;

ob_start();
?>

    <!-- ============ STAT CARDS ============ -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card: Total Armada -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-blue shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-bus"></i></div>
            </div>
            <div class="stat-label">Total Armada</div>
            <div class="stat-value"><?= $totalBus; ?><span class="stat-unit">Bus</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Bus Operasional -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-green shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-check-circle"></i></div>
            </div>
            <div class="stat-label">Bus Operasional</div>
            <div class="stat-value"><?= $busOperasional; ?><span class="stat-unit">Bus</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Dalam Perbaikan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-pink shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-wrench"></i></div>
            </div>
            <div class="stat-label">Dalam Perbaikan</div>
            <div class="stat-value"><?= $busPemeliharaan; ?><span class="stat-unit">Bus</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Total Kapasitas -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-yellow shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-group"></i></div>
            </div>
            <div class="stat-label">Kapasitas Kursi</div>
            <div class="stat-value"><?= $totalKursi; ?><span class="stat-unit">Kursi</span></div>
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
              <i class="bx bxs-bus fs-5"></i>
              <span class="m-0"><b>Tabel Data Bus</b></span>
            </div>
            <div class="btnAction d-flex align-items-center gap-2">
              <button type="button" id="btnAddBus" class="btn btn-light text-dark btn-circle shadow" data-bs-toggle="modal"
                data-bs-target="#modalFormBus"><i class="bx bx-plus" data-bs-toggle="tooltip"
                  title="Tambah Data"></i></button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-hover dataTable nowrap align-middle w-100">
                <thead>
                  <tr>
                    <th class="cb">
                      <span class="form-check d-inline-block">
                        <input type="checkbox" class="form-check-input selectAll" aria-label="Pilih semua data" />
                      </span>
                    </th>
                    <th class="actions">Action</th>
                    <th class="no">ID</th>
                    <th class="foto">Foto</th>
                    <th class="nama">Nama Bus</th>
                    <th class="detailBus">Harga</th>
                    <th class="status">Status Bus</th>
                    <th class="kursi">Kursi</th>
                    <th class="jenis">Jenis</th>
                    <th class="fasilitas">Fasilitas</th>
                    <th class="tanggal">Tanggal Berangkat</th>
                    <th class="pemberangkatan">Pemberangkatan</th>
                    <th class="tujuan">Tujuan</th>
                    <th class="waktu">Waktu Berangkat</th>
                    <th class="waktuTiba">Waktu Tiba</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <!-- <th class="detailRute">Detail Rute</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (count($allBuses) > 0) {
                    foreach ($allBuses as $row) {
                      $id_bus = $row['id_bus'];
                      $nama_bus = $row['nama_bus'];
                      $harga = $row['harga'];
                      $status_bus = $row['status_bus'];
                      $jumlah_kursi = $row['jumlah_kursi'];
                      $foto_bus = $row['foto_bus'];
                      $jenis_bus = $row['jenis'];
                      $fasilitas = $row['fasilitas'];
                      $tanggal_pemberangkatan = $row['tanggal_pemberangkatan'];
                      $pemberangkatan = $row['pemberangkatan'];
                      $waktu_berangkat = $row['waktu_berangkat'];
                      $tujuan = $row['tujuan'];
                      $waktu_tiba = $row['waktu_tiba'];
                      $id_jenis = $row['id_jenis'] ?? '';
                      $id_rute = $row['id_rute'] ?? '';
                      $created_at = $row['created_at'] ?? null;
                      $updated_at = $row['updated_at'] ?? null;
                  ?>
                  <tr>
                    <td>
                      <span class="form-check d-inline-block">
                        <input type="checkbox" class="form-check-input" aria-label="Pilih data" name="option[]" value="<?php echo $no; ?>" />
                      </span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-user btn-circle btn-edit-bus" aria-label="EditModal"
                          data-bs-toggle="modal" data-bs-target="#modalFormBus" 
                          data-id="<?php echo $id_bus; ?>"
                          data-nama="<?php echo htmlspecialchars($nama_bus); ?>"
                          data-harga="<?php echo $harga; ?>"
                          data-status="<?php echo $status_bus; ?>"
                          data-kursi="<?php echo $jumlah_kursi; ?>"
                          data-foto="<?php echo htmlspecialchars($foto_bus); ?>"
                          data-idjenis="<?php echo $id_jenis; ?>"
                          data-idrute="<?php echo $id_rute; ?>"
                          data-tanggal="<?php echo $tanggal_pemberangkatan; ?>"
                          title="Edit">
                          &nbsp;<i class="bx bx-edit" data-bs-toggle="tooltip" title="Edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-bus" aria-label="DeleteModal"
                          data-id="<?php echo $id_bus; ?>"
                          data-nama="<?php echo htmlspecialchars($nama_bus); ?>"
                          value="hapus">
                          <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                        </button>
                    </td>
            <td><span class="fw-semibold">B000<?php echo $id_bus; ?></span></td>
            <td>
              <a href="fotoBus/<?php echo $foto_bus; ?>" class="glightbox">
                <img src="fotoBus/<?php echo $foto_bus; ?>" class='img-table-row' alt="Foto Bus">
              </a>
            </td>
            <td><span class="fw-semibold"><?php echo $nama_bus; ?></span></td>
            <td>Rp. <?php echo number_format($harga); ?></td>
            <td>
              <?php $sb = strtolower(trim($status_bus)); ?>
              <span class="status-pill <?php echo $sb === 'operasional' ? 'status-on' : 'status-process'; ?>">
                <?php echo $status_bus; ?>
              </span>
            </td>
            <td><?php echo $jumlah_kursi; ?> kursi</td>
            <td>
              <?php 
              $jClass = strtolower(trim($jenis_bus));
              $badgeClass = 'jenis-other';
              if (strpos($jClass, 'eksekutif') !== false) {
                $badgeClass = 'jenis-eksekutif';
              } elseif (strpos($jClass, 'bisnis') !== false) {
                $badgeClass = 'jenis-bisnis';
              } elseif (strpos($jClass, 'patas') !== false) {
                $badgeClass = 'jenis-patas';
              } elseif (strpos($jClass, 'ekonomi') !== false) {
                $badgeClass = 'jenis-ekonomi';
              }
              echo '<span class="badge-jenis ' . $badgeClass . '">' . htmlspecialchars($jenis_bus) . '</span>';
              ?>
            </td>
            <td>
              <div class="d-flex flex-wrap gap-1">
                <?php 
                if (!empty($fasilitas)) {
                  $arrFasilitas = explode(',', $fasilitas);
                  foreach ($arrFasilitas as $f) {
                    $fTrimmed = htmlspecialchars(trim($f));
                    if ($fTrimmed !== '') {
                      echo '<span class="badge-chip">' . $fTrimmed . '</span>';
                    }
                  }
                } else {
                  echo '<span class="text-muted">—</span>';
                }
                ?>
              </div>
            </td>
            <td><?php echo $tanggal_pemberangkatan; ?></td>
            <td><?php echo $pemberangkatan; ?></td>
            <td><?php echo $tujuan; ?></td>
            <td><?php echo $waktu_berangkat; ?> WIB</td>
            <td><?php echo $waktu_tiba; ?> WIB</td>
            <td><?php echo $created_at ? '<span class="badge-waktu"><i class="bx bx-calendar"></i> ' . date('d M Y, H:i', strtotime($created_at)) . '</span>' : '-'; ?></td>
            <td><?php echo $updated_at ? '<span class="badge-waktu"><i class="bx bx-calendar"></i> ' . date('d M Y, H:i', strtotime($updated_at)) . '</span>' : '-'; ?></td>
            </tr>
            <?php
                      $no++;
                    }
                  }
            ?>
            </tbody>
          </table>
        </div>

        <!-- Generic Form Modal -->
        <div id="modalFormBus" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form id="formBus" role="form" action="tambahBus.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="txt_id_bus" id="inputIdBus" value="" />
                <div class="modal-header">
                  <div class="d-flex align-items-center gap-2">
                    <i id="modalIconBus" class="bx bx-plus-circle fs-4"></i>
                    <h4 id="modalTitleBus" class="modal-title m-0">Tambah Data Bus</h4>
                  </div>
                  <button type="button" class="btn btn-danger btn-circle" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="bx bx-x"></i>
                  </button>
                </div>
                <div class="modal-body p-4">
                  <div class="row g-4">
                    <!-- Left Side (Visual & Status) -->
                    <div class="col-md-5 d-flex flex-column gap-3">
                      <div>
                        <label class="form-label mb-2">Foto Bus</label>
                        <div class="bus-image-upload-wrapper shadow-sm" onclick="document.getElementById('fileInputBus').click()">
                          <div class="upload-placeholder d-flex flex-column align-items-center justify-content-center gap-2">
                            <i class="bx bx-image-add fs-1 text-muted"></i>
                            <span class="text-muted" style="font-size: 13px; font-weight: 500;">Pilih Foto Bus</span>
                          </div>
                          <div class="upload-overlay">
                            <i class="bx bx-camera fs-3"></i>
                            <span id="modalFotoLabelBus" style="font-size: 13px; font-weight: 500;">Pilih Foto Bus</span>
                          </div>
                          <!-- Default placeholder if no image -->
                          <img src="" id="busPreview" alt="Foto Bus Preview" />
                        </div>
                        <input type="file" name="txt_foto_bus" id="fileInputBus" onchange="previewBusImage(this, 'busPreview')" class="form-control d-none" />
                      </div>

                      <div>
                        <label class="form-label mb-2">Status Armada</label>
                        <div class="d-flex gap-2">
                          <input type="radio" class="btn-check" name="txt_status_bus" id="statusActiveBus" value="Operasional" checked>
                          <label class="btn btn-outline-success w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="statusActiveBus">
                            <i class="bx bxs-check-circle fs-5"></i> Operasional
                          </label>
                          
                          <input type="radio" class="btn-check" name="txt_status_bus" id="statusMaintenanceBus" value="Pemeliharaan">
                          <label class="btn btn-outline-danger w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="statusMaintenanceBus">
                            <i class="bx bxs-wrench fs-5"></i> Pemeliharaan
                          </label>
                        </div>
                      </div>
                    </div>

                    <!-- Right Side (Specifications & Schedule) -->
                    <div class="col-md-7 d-flex flex-column gap-3">
                      <div>
                        <label for="inputNamaBus" class="form-label">Nama Bus</label>
                        <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-bus text-muted"></i></span>
                          <input type="text" class="form-control" id="inputNamaBus" name="txt_nama_bus"
                            required data-parsley-required-message="Data harus di isi !!!"
                            placeholder="Ex: Pahala Kencana" />
                        </div>
                      </div>

                      <div>
                        <label for="selectJenisBus" class="form-label">Jenis Bus</label>
                        <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-category text-muted"></i></span>
                          <select class="form-select" id="selectJenisBus" aria-label="Pilih jenis bus"
                            required data-parsley-required-message="Harap pilih data jenis !!!" name="txt_id_jenis">
                            <option disabled selected value="">Pilih Jenis Bus</option>
                            <?php
                            $datas = $obj->lihatJenisBus();
                            if ($datas->rowCount() > 0) {
                              while ($rowJenis = $datas->fetch(PDO::FETCH_ASSOC)) {
                                $id_jeniss = $rowJenis['id_jenis'];
                                $jeniss = $rowJenis['jenis'];
                            ?>
                            <option value="<?php echo $id_jeniss; ?>"><?php echo $jeniss; ?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div>
                        <label for="selectRuteBus" class="form-label">Rute Perjalanan</label>
                        <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-map-alt text-muted"></i></span>
                          <select class="form-select" id="selectRuteBus" aria-label="Pilih rute"
                            required data-parsley-required-message="Harap pilih data rute !!!" name="txt_id_rute">
                            <option disabled selected value="">Pilih Rute</option>
                            <?php
                            $datasd = $obj->lihatRute();
                            if ($datasd->rowCount() > 0) {
                              while ($rowRute = $datasd->fetch(PDO::FETCH_ASSOC)) {
                                $id_rutes = $rowRute['id_rute'];
                                $pemberangkatans = $rowRute['pemberangkatan'];
                                $tujuans = $rowRute['tujuan'];
                            ?>
                            <option value="<?php echo $id_rutes; ?>"><?php echo $pemberangkatans . ' - ' . $tujuans; ?>
                            </option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="row g-3">
                        <div class="col-6">
                          <label for="inputKursiBus" class="form-label">Jumlah Kursi</label>
                          <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-chair text-muted"></i></span>
                            <input type="number" class="form-control" id="inputKursiBus" name="txt_jumlah_kursi"
                              required data-parsley-required-message="Data harus di isi !!!"
                              placeholder="Ex: 50" />
                          </div>
                        </div>
                        <div class="col-6">
                          <label for="inputTarifBus" class="form-label">Tarif Tiket</label>
                          <div class="input-group">
                            <span class="input-group-text fw-semibold text-muted">Rp</span>
                            <input type="number" class="form-control" id="inputTarifBus" required
                              data-parsley-required-message="Data harus di isi !!!" name="txt_harga"
                              placeholder="Ex: 50000">
                          </div>
                        </div>
                      </div>

                      <div>
                        <label for="InputTglPemberangkatanBus" class="form-label">Tanggal Keberangkatan</label>
                        <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-calendar text-muted"></i></span>
                          <input type="date" class="form-control" id="InputTglPemberangkatanBus"
                            name="txt_tanggal_pemberangkatan" required
                            data-parsley-required-message="Data harus di isi !!!" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer p-3 border-top-0 d-flex justify-content-end gap-2">
                  <button class="btn btn-secondary px-4 py-2" style="border-radius: var(--radius-pill);" type="button" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" id="btnSubmitBus" class="btn btn-primary px-4 py-2" style="border-radius: var(--radius-pill);" name="simpan">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- New Section: Bus Fleet Insights & Charts -->
  <div class="row g-4 m-0 px-4 pb-5">
    <!-- Chart Card -->
    <div class="col-lg-7">
      <div class="card shadow h-100">
        <div class="card-header shadow rounded d-flex align-items-center justify-content-between">
          <div class="title d-flex align-items-center gap-2">
            <i class="bx bx-pie-chart-alt-2 fs-5"></i>
            <span class="m-0"><b>Distribusi Status & Jenis Bus</b></span>
          </div>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center" style="min-height: 320px;">
          <div class="row w-100 align-items-center">
            <div class="col-md-6 text-center">
              <h6 class="mb-3 fw-semibold" style="color: var(--color-text-secondary); font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">Status Armada</h6>
              <div id="chartBusStatus"></div>
            </div>
            <div class="col-md-6 text-center">
              <h6 class="mb-3 fw-semibold" style="color: var(--color-text-secondary); font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">Jenis Armada</h6>
              <div id="chartBusJenis"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Highlights Card -->
    <div class="col-lg-5">
      <div class="card shadow h-100">
        <div class="card-header shadow rounded d-flex align-items-center justify-content-between">
          <div class="title d-flex align-items-center gap-2">
            <i class="bx bx-list-check fs-5"></i>
            <span class="m-0"><b>Ringkasan Detail Armada</b></span>
          </div>
        </div>
        <div class="card-body">
          <div class="list-group list-group-flush">
            <!-- Rata-rata Tarif -->
            <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 py-3 px-0">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--color-primary-container); color: var(--color-on-primary-container); flex-shrink: 0;">
                  <i class="bx bxs-wallet fs-5"></i>
                </div>
                <div style="line-height: 1.2;">
                  <h6 class="m-0 fw-semibold" style="color: var(--color-text-primary); font-size: 14px; margin-bottom: 2px;">Rata-rata Tarif</h6>
                  <small style="color: var(--color-text-secondary); font-size: 11.5px;">Harga tiket rata-rata</small>
                </div>
              </div>
              <span class="badge rounded-pill" style="font-size: 12px; font-weight: 600; padding: 6px 12px; background: var(--color-primary-container); color: var(--color-on-primary-container); border: 1px solid color-mix(in srgb, var(--color-on-primary-container) 15%, transparent);">Rp <?= number_format($averagePrice, 0, ',', '.'); ?></span>
            </div>
            
            <!-- Kapasitas Total -->
            <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 py-3 px-0">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--color-success-container); color: var(--color-on-success-container); flex-shrink: 0;">
                  <i class="bx bxs-group fs-5"></i>
                </div>
                <div style="line-height: 1.2;">
                  <h6 class="m-0 fw-semibold" style="color: var(--color-text-primary); font-size: 14px; margin-bottom: 2px;">Kapasitas Total</h6>
                  <small style="color: var(--color-text-secondary); font-size: 11.5px;">Total kursi semua armada</small>
                </div>
              </div>
              <span class="badge rounded-pill" style="font-size: 12px; font-weight: 600; padding: 6px 12px; background: var(--color-success-container); color: var(--color-on-success-container); border: 1px solid color-mix(in srgb, var(--color-on-success-container) 15%, transparent);"><?= $totalKursi; ?> Kursi</span>
            </div>

            <!-- Keberangkatan Terdekat -->
            <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 py-3 px-0">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--color-warning-container); color: var(--color-on-warning-container); flex-shrink: 0;">
                  <i class="bx bxs-calendar fs-5"></i>
                </div>
                <div style="line-height: 1.2;">
                  <h6 class="m-0 fw-semibold" style="color: var(--color-text-primary); font-size: 14px; margin-bottom: 2px;">Keberangkatan Terdekat</h6>
                  <small style="color: var(--color-text-secondary); font-size: 11.5px;">Tanggal jalan berikutnya</small>
                </div>
              </div>
              <span class="badge rounded-pill" style="font-size: 12px; font-weight: 600; padding: 6px 12px; background: var(--color-warning-container); color: var(--color-on-warning-container); border: 1px solid color-mix(in srgb, var(--color-on-warning-container) 15%, transparent);"><?= $nextDeparture ? date('d M Y', strtotime($nextDeparture)) : 'Tidak Ada'; ?></span>
            </div>

            <!-- Rasio Kesiapan -->
            <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 py-3 px-0">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--color-info-container); color: var(--color-on-info-container); flex-shrink: 0;">
                  <i class="bx bxs-check-shield fs-5"></i>
                </div>
                <div style="line-height: 1.2;">
                  <h6 class="m-0 fw-semibold" style="color: var(--color-text-primary); font-size: 14px; margin-bottom: 2px;">Rasio Kesiapan</h6>
                  <small style="color: var(--color-text-secondary); font-size: 11.5px;">Persentase bus siap jalan</small>
                </div>
              </div>
              <span class="badge rounded-pill" style="font-size: 12px; font-weight: 600; padding: 6px 12px; background: var(--color-info-container); color: var(--color-on-info-container); border: 1px solid color-mix(in srgb, var(--color-on-info-container) 15%, transparent);"><?= $totalBus > 0 ? round(($busOperasional / $totalBus) * 100, 1) : 0; ?>% Siap</span>
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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="plugin/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="plugin/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="plugin/js/datatables-demo.js"></script>
  <script src="plugin/js/javascript.js"></script>
  <script src="plugin/js/parsley.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var rootStyles = getComputedStyle(document.documentElement);
      var primaryColor = rootStyles.getPropertyValue("--color-primary").trim() || "#527bdd";
      var successColor = rootStyles.getPropertyValue("--color-success").trim() || "#22c55e";
      var warningColor = rootStyles.getPropertyValue("--color-warning").trim() || "#facc15";
      var errorColor = rootStyles.getPropertyValue("--color-error").trim() || "#ef4444";
      var textColor = rootStyles.getPropertyValue("--color-text-primary").trim() || "#1f264c";
      var textSecondary = rootStyles.getPropertyValue("--color-text-tertiary").trim() || "#6b7280";
      
      // ---- Donut Chart: Status Bus ----
      var optionsStatus = {
        series: [<?= $busOperasional; ?>, <?= $busPemeliharaan; ?>],
        chart: {
          type: "donut",
          height: 240,
          background: "transparent"
        },
        labels: ["Operasional", "Pemeliharaan"],
        colors: [successColor, errorColor],
        plotOptions: {
          pie: {
            donut: {
              size: "68%",
              labels: {
                show: true,
                name: { show: true, fontSize: "12px", color: textSecondary },
                value: {
                  show: true,
                  fontSize: "18px",
                  fontWeight: 700,
                  color: textColor,
                  formatter: function(val) { return val + " Bus"; }
                },
                total: {
                  show: true,
                  label: "Total",
                  fontSize: "11px",
                  color: textSecondary,
                  formatter: function(w) {
                    return w.globals.seriesTotals.reduce(function(a, b) { return a + b; }, 0) + " Bus";
                  }
                }
              }
            }
          }
        },
        dataLabels: { enabled: false },
        legend: { position: "bottom", fontSize: "11px", labels: { colors: textSecondary } },
        stroke: { width: 0 }
      };
      var chartStatus = new ApexCharts(document.querySelector("#chartBusStatus"), optionsStatus);
      chartStatus.render();

      // ---- Donut Chart: Jenis Bus ----
      <?php
      $labels = [];
      $counts = [];
      foreach ($jenisCounts as $jenis => $count) {
          $labels[] = $jenis;
          $counts[] = $count;
      }
      ?>
      var optionsJenis = {
        series: <?= json_encode($counts); ?>,
        chart: {
          type: "donut",
          height: 240,
          background: "transparent"
        },
        labels: <?= json_encode($labels); ?>,
        colors: [primaryColor, "#f59e0b", "#6366f1", "#06b6d4", "#ec4899"],
        plotOptions: {
          pie: {
            donut: {
              size: "68%",
              labels: {
                show: true,
                name: { show: true, fontSize: "12px", color: textSecondary },
                value: {
                  show: true,
                  fontSize: "18px",
                  fontWeight: 700,
                  color: textColor,
                  formatter: function(val) { return val + " Bus"; }
                },
                total: {
                  show: true,
                  label: "Total",
                  fontSize: "11px",
                  color: textSecondary,
                  formatter: function(w) {
                    return w.globals.seriesTotals.reduce(function(a, b) { return a + b; }, 0) + " Bus";
                  }
                }
              }
            }
          }
        },
        dataLabels: { enabled: false },
        legend: { position: "bottom", fontSize: "11px", labels: { colors: textSecondary } },
        stroke: { width: 0 }
      };
      var chartJenis = new ApexCharts(document.querySelector("#chartBusJenis"), optionsJenis);
      chartJenis.render();
    });

    function previewBusImage(input, previewId) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          const previewEl = document.getElementById(previewId);
          previewEl.src = e.target.result;
          previewEl.closest('.bus-image-upload-wrapper').classList.add('has-image');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    document.addEventListener("DOMContentLoaded", function() {
      // Handle Add Bus button click
      const btnAddBus = document.getElementById('btnAddBus');
      if(btnAddBus) {
        btnAddBus.addEventListener('click', function() {
          document.getElementById('formBus').action = 'tambahBus.php';
          document.getElementById('modalTitleBus').innerText = 'Tambah Data Bus';
          document.getElementById('modalIconBus').className = 'bx bx-plus-circle fs-4';
          document.getElementById('btnSubmitBus').innerText = 'Simpan';
          document.getElementById('modalFotoLabelBus').innerText = 'Pilih Foto Bus';
          
          document.getElementById('inputIdBus').value = '';
          document.getElementById('inputNamaBus').value = '';
          document.getElementById('selectJenisBus').value = '';
          document.getElementById('selectRuteBus').value = '';
          document.getElementById('inputKursiBus').value = '';
          document.getElementById('inputTarifBus').value = '';
          document.getElementById('InputTglPemberangkatanBus').value = '';
          document.getElementById('statusActiveBus').checked = true;
          
          const preview = document.getElementById('busPreview');
          preview.src = '';
          preview.closest('.bus-image-upload-wrapper').classList.remove('has-image');
          document.getElementById('fileInputBus').required = true;
        });
      }

      // Handle Edit Bus button click
      const editButtons = document.querySelectorAll('.btn-edit-bus');
      editButtons.forEach(button => {
        button.addEventListener('click', function() {
          document.getElementById('formBus').action = 'editBus.php';
          document.getElementById('modalTitleBus').innerText = 'Edit Data Bus';
          document.getElementById('modalIconBus').className = 'bx bxs-edit fs-4';
          document.getElementById('btnSubmitBus').innerText = 'Update';
          document.getElementById('modalFotoLabelBus').innerText = 'Ganti Foto Bus';
          
          document.getElementById('inputIdBus').value = this.getAttribute('data-id');
          document.getElementById('inputNamaBus').value = this.getAttribute('data-nama');
          document.getElementById('selectJenisBus').value = this.getAttribute('data-idjenis');
          document.getElementById('selectRuteBus').value = this.getAttribute('data-idrute');
          document.getElementById('inputKursiBus').value = this.getAttribute('data-kursi');
          document.getElementById('inputTarifBus').value = this.getAttribute('data-harga');
          document.getElementById('InputTglPemberangkatanBus').value = this.getAttribute('data-tanggal');
          
          if(this.getAttribute('data-status') === 'Operasional') {
             document.getElementById('statusActiveBus').checked = true;
          } else {
             document.getElementById('statusMaintenanceBus').checked = true;
          }
          
          const preview = document.getElementById('busPreview');
          preview.src = 'fotoBus/' + this.getAttribute('data-foto');
          preview.closest('.bus-image-upload-wrapper').classList.add('has-image');
          document.getElementById('fileInputBus').required = false; // Foto tidak wajib saat edit
        });
      });

      // Handle Delete Bus button click
      const deleteButtons = document.querySelectorAll('.btn-delete-bus');
      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const idBus = this.getAttribute('data-id');
          const namaBus = this.getAttribute('data-nama');
          
          Swal.fire({
            title: 'Hapus Bus',
            html: `Apakah Anda yakin ingin menghapus data bus <b>${namaBus}</b>?<br>Perlu hati-hati karena data akan hilang selamanya!`,
            icon: 'warning',
            showCancelButton: true,
            customClass: { confirmButton: 'btn-danger' },
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `hapusBus.php?id_bus=${idBus}`;
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