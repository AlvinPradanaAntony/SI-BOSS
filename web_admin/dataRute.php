<?php
require_once('layouts/auth.php');

$pageTitle = "Data Rute - SI BOSS";
$activeMenu = "dataRute";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

// Fetch data for statistics and table
$allRute = [];
$ruteQuery = $obj->lihatRute();
if ($ruteQuery->rowCount() > 0) {
  while ($row = $ruteQuery->fetch(PDO::FETCH_ASSOC)) {
    $allRute[] = $row;
  }
}
$totalRute = count($allRute);

$totalAsal = count(array_unique(array_filter(array_column($allRute, 'pemberangkatan'))));
$totalTujuan = count(array_unique(array_filter(array_column($allRute, 'tujuan'))));
$totalJadwal = count(array_unique(array_filter(array_column($allRute, 'waktu_berangkat'))));

ob_start();
?>

    <!-- ============ STAT CARDS ============ -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card: Total Rute -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-yellow shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-map-alt"></i></div>
            </div>
            <div class="stat-label">Total Rute Aktif</div>
            <div class="stat-value"><?= $totalRute; ?><span class="stat-unit">Rute</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Terminal Asal -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-blue shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-map"></i></div>
            </div>
            <div class="stat-label">Terminal Asal</div>
            <div class="stat-value"><?= $totalAsal; ?><span class="stat-unit">Terminal</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Terminal Tujuan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-pink shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-map-pin"></i></div>
            </div>
            <div class="stat-label">Terminal Tujuan</div>
            <div class="stat-value"><?= $totalTujuan; ?><span class="stat-unit">Terminal</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Jadwal Keberangkatan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-green shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-time"></i></div>
            </div>
            <div class="stat-label">Variasi Jadwal</div>
            <div class="stat-value"><?= $totalJadwal; ?><span class="stat-unit">Waktu</span></div>
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
              <i class="bx bx-map-alt fs-5"></i>
              <span class="m-0"><b>Tabel Data Rute</b></span>
            </div>
            <div class="btnAction d-flex align-items-center gap-2">
              <button type="button" class="btn btn-light text-dark btn-circle shadow" data-bs-toggle="modal" data-bs-target="#tambahDataRute"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
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
                    <th class="id">ID</th>
                    <th class="pemberangkatan">Pemberangkatan</th>
                    <th class="waktu_berangkat">Waktu Berangkat</th>
                    <th class="tujuan">Tujuan</th>
                    <th class="waktu_tiba">Waktu Tiba</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (count($allRute) > 0) {
                    if ($sesLvl == 1) {
                      $dis = "";
                    } else {
                      $dis = "disabled";
                    }
                    foreach ($allRute as $row) {
                      $id_rute = $row['id_rute'];
                      $pemberangkatan = $row['pemberangkatan'];
                      $waktu_berangkat = $row['waktu_berangkat'];
                      $tujuan = $row['tujuan'];
                      $waktu_tiba = $row['waktu_tiba'];
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
                        <button type="button" class="btn btn-success btn-user btn-circle" aria-label="EditModal"
                          data-bs-toggle="modal" data-bs-target="#editDataRute<?php echo $id_rute ?>"
                          value="edit">
                          &nbsp;<i class="bx bx-edit" data-bs-toggle="tooltip" title="Edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-rute" aria-label="DeleteModal"
                           data-id="<?php echo $id_rute; ?>"
                           data-nama="<?php echo htmlspecialchars($pemberangkatan . ' - ' . $tujuan); ?>"
                           value="hapus">
                           <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                         </button>

                      <!-- Edit Modal -->
                      <div id="editDataRute<?php echo $id_rute ?>" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content modal-edit">
                            <form role="form" action="editRute.php" method="POST">
                              <?php
                                    // Removed N+1 query: directly use variables from the outer loop
                                    $id_rute2 = $id_rute;
                                    $pemberangkatan2 = $pemberangkatan;
                                    $waktu_berangkat2 = $waktu_berangkat;
                                    $tujuan2 = $tujuan;
                                    $waktu_tiba2 = $waktu_tiba;
                                  ?>
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Rute</h4>
                                <button type="button" class="btn btn-danger btn-circle btn-user"
                                  data-bs-dismiss="modal" aria-label="Close">
                                  <i class="bx bx-x"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-lg-12 mb-3" hidden>
                                    <label for="inputId" class="form-label">Id</label>
                                    <input type="text" class="form-control" id="inputId"
                                      name="txt_id_rute" value="<?php echo $id_rute2 ?>" placeholder=""
                                      readonly />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="InputIdTerminal" class="form-label">Pemberangkatan</label>
                                    <select class="form-select"
                                      aria-label=".form-select-sm example" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      name="txt_pemberangkatan">
                                      <option disabled selected>Pilih Terminal</option>
                                      <?php
                                            $datas = $obj->lihatTerminal();
                                            if ($datas->rowCount() > 0) {
                                              while ($rowTerm = $datas->fetch(PDO::FETCH_ASSOC)) {
                                                $id_terminal = $rowTerm['id_terminal'];
                                                $nama_terminal = $rowTerm['nama_terminal'];
                                                $kabupaten = $rowTerm['kabupaten_terminal'];
                                            ?>
                                      <option value="<?php echo $id_terminal; ?>">
                                        <?php echo $nama_terminal, ', ', $kabupaten; ?></option>
                                      <?php
                                              }
                                            }
                                            ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputWaktuBerangkat" class="form-label">Waktu
                                      Berangkat</label>
                                    <input type="time" class="form-control"
                                      id="inputWaktuBerangkat" name="txt_waktu_berangkat" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      placeholder="Ex: 00.00" value="<?php echo $waktu_berangkat2 ?>"></input>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="InputIdTerminal" class="form-label">Tujuan</label>
                                    <select class="form-select"
                                      aria-label=".form-select-sm example" required
                                      data-parsley-required-message="Data harus di isi !!!" name="txt_tujuan">
                                      <option disabled selected>Pilih Terminal</option>
                                      <?php
                                            $datasd = $obj->lihatTerminal();
                                            if ($datasd->rowCount() > 0) {
                                              while ($rowTerm = $datasd->fetch(PDO::FETCH_ASSOC)) {
                                                $id_terminals = $rowTerm['id_terminal'];
                                                $nama_terminals = $rowTerm['nama_terminal'];
                                                $kabupatens = $rowTerm['kabupaten_terminal'];
                                            ?>
                                      <option value="<?php echo $id_terminals; ?>">
                                        <?php echo $nama_terminals, ', ', $kabupatens; ?></option>
                                      <?php
                                              }
                                            }
                                            ?>
                                    </select>
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputWaktuTiba" class="form-label">Waktu Tiba</label>
                                    <input type="time" class="form-control"
                                      id="inputWaktuTiba" name="txt_waktu_tiba" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      placeholder="Ex: 06.00" value="<?php echo $waktu_tiba2 ?>"></input>
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
                    </td>
                    <td><span class="fw-semibold">RT000<?php echo $id_rute; ?></span></td>
                    <td><?php echo $pemberangkatan; ?></td>
                    <td><span class="badge-waktu"><i class="bx bx-time"></i><?php echo $waktu_berangkat; ?> WIB</span></td>
                    <td><?php echo $tujuan; ?></td>
                    <td><span class="badge-waktu"><i class="bx bx-time"></i><?php echo $waktu_tiba; ?> WIB</span></td>
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
        </div>
      </div>
    </div>

    <!-- Tambah Modal -->
    <div id="tambahDataRute" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content modal-edit">
          <form role="form" action="tambahRute.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Rute</h4>
              <button type="button" class="btn btn-danger btn-circle btn-user"
                data-bs-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="InputIdTerminalAdd" class="form-label">Pemberangkatan</label>
                  <select class="form-select" id="InputIdTerminalAdd"
                    aria-label=".form-select-sm example" required
                    data-parsley-required-message="Data harus di isi !!!" name="txt_pemberangkatan">
                    <option disabled selected>Pilih Terminal</option>
                    <?php
                    $datas = $obj->lihatTerminal();
                    if ($datas->rowCount() > 0) {
                      while ($row = $datas->fetch(PDO::FETCH_ASSOC)) {
                        $id_terminalt = $row['id_terminal'];
                        $nama_terminalt = $row['nama_terminal'];
                        $kabupatent = $row['kabupaten_terminal'];
                    ?>
                    <option value="<?php echo $id_terminalt; ?>">
                      <?php echo $nama_terminalt, ', ', $kabupatent; ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputWaktuBerangkatAdd" class="form-label">Waktu Berangkat</label>
                  <input type="time" class="form-control" id="inputWaktuBerangkatAdd"
                    name="txt_waktu_berangkat" required
                    data-parsley-required-message="Data harus di isi !!!"
                    placeholder="Ex: 00.00"></input>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="InputIdTerminalTujuanAdd" class="form-label">Tujuan</label>
                  <select class="form-select" id="InputIdTerminalTujuanAdd"
                    aria-label=".form-select-sm example" required
                    data-parsley-required-message="Data harus di isi !!!" name="txt_tujuan">
                    <option disabled selected>Pilih Terminal</option>
                    <?php
                    $datasd = $obj->lihatTerminal();
                    if ($datasd->rowCount() > 0) {
                      while ($row = $datasd->fetch(PDO::FETCH_ASSOC)) {
                        $id_terminalst = $row['id_terminal'];
                        $nama_terminalst = $row['nama_terminal'];
                        $kabupatenst = $row['kabupaten_terminal'];
                    ?>
                    <option value="<?php echo $id_terminalst; ?>">
                      <?php echo $nama_terminalst, ', ', $kabupatenst; ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputWaktuTibaAdd" class="form-label">Waktu Tiba</label>
                  <input type="time" class="form-control" id="inputWaktuTibaAdd"
                    name="txt_waktu_tiba" required data-parsley-required-message="Data harus di isi !!!"
                    placeholder="Ex: 06.00"></input>
                </div>
              </div>

              <div class="modal-footer">
                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                  value="Cancel" />
                <input type="submit" name="simpan" class="btn btn-primary"
                  value="Simpan" />
              </div>
            </div>
          </form>
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
  <script src="plugin/js/parsley.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteRuteButtons = document.querySelectorAll(".btn-delete-rute");
    deleteRuteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const idRute = this.getAttribute("data-id");
            const namaRute = this.getAttribute("data-nama");
            Swal.fire({
                title: "Hapus Rute",
                html: `Apakah Anda yakin ingin menghapus data rute <b>${namaRute}</b> (ID: <b>RT000${idRute}</b>)?<br>Perlu hati-hati karena data akan hilang selamanya!`,
                icon: "warning",
                showCancelButton: true,
                customClass: { confirmButton: "btn-danger" },
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `hapusRute.php?id_rute=${idRute}`;
                }
            });
        });
    });
});
</script>
<?php
$extraJS = ob_get_clean();
require_once('layouts/main_layout.php');
?>
