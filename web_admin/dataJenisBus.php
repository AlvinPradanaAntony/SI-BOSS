<?php
require_once('layouts/auth.php');

$pageTitle = "Data Jenis Bus - SI BOSS";
$activeMenu = "dataJenisBus";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

// Fetch data for statistics and table
$allJenisBus = [];
$jenisBusQuery = $obj->lihatJenisBus();
if ($jenisBusQuery->rowCount() > 0) {
  while ($row = $jenisBusQuery->fetch(PDO::FETCH_ASSOC)) {
    $allJenisBus[] = $row;
  }
}
$totalJenisBus = count($allJenisBus);

$facilities = [];
foreach ($allJenisBus as $jb) {
  if (!empty($jb['fasilitas'])) {
    $facList = explode(',', $jb['fasilitas']);
    foreach ($facList as $f) {
      $trimmed = trim($f);
      if (!empty($trimmed)) {
        $facilities[] = strtolower($trimmed);
      }
    }
  }
}
$totalUniqueFacilities = count(array_unique($facilities));
$averageFacilities = count($allJenisBus) > 0 ? round(count($facilities) / count($allJenisBus), 1) : 0;

ob_start();
?>

    <!-- ============ STAT CARDS ============ -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card: Total Kategori Jenis Bus -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-pink shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-list-ul"></i></div>
            </div>
            <div class="stat-label">Kategori Jenis Bus</div>
            <div class="stat-value"><?= $totalJenisBus; ?><span class="stat-unit">Jenis</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Ragam Layanan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-teal shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-face"></i></div>
            </div>
            <div class="stat-label">Fasilitas Unik</div>
            <div class="stat-value"><?= $totalUniqueFacilities; ?><span class="stat-unit">Layanan</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Rerata Fasilitas -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-indigo shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-star"></i></div>
            </div>
            <div class="stat-label">Rata-rata Fasilitas</div>
            <div class="stat-value"><?= $averageFacilities; ?><span class="stat-unit">Item</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Standar Pelayanan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-green shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-award"></i></div>
            </div>
            <div class="stat-label">Standar Layanan</div>
            <div class="stat-value">100%<span class="stat-unit">Prima</span></div>
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
              <i class="bx bx-list-ul fs-5"></i>
              <span class="m-0"><b>Tabel Data Jenis Bus</b></span>
            </div>
            <div class="btnAction d-flex align-items-center gap-2">
              <button type="button" class="btn btn-light text-dark btn-circle shadow" data-bs-toggle="modal" data-bs-target="#tambahDataJenisBus"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
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
                    <th class="id">ID Jenis Bus</th>
                    <th class="jenis">Jenis Bus</th>
                    <th class="fasilitas">Fasilitas</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (count($allJenisBus) > 0) {
                    if ($sesLvl == 1) {
                      $dis = "";
                    } else {
                      $dis = "disabled";
                    }
                    foreach ($allJenisBus as $row) {
                      $id_jenis = $row['id_jenis'];
                      $jenis = $row['jenis'];
                      $fasilitas = $row['fasilitas'];
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
                          data-bs-toggle="modal" data-bs-target="#editDataJenisBus<?php echo $id_jenis ?>"
                          value="edit">
                          &nbsp;<i class="bx bx-edit" data-bs-toggle="tooltip" title="Edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-jenisbus" aria-label="DeleteModal"
                           data-id="<?php echo $id_jenis; ?>"
                           data-nama="<?php echo htmlspecialchars($jenis); ?>"
                           value="hapus">
                           <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                         </button>

                      <!-- Edit Modal -->
                      <div id="editDataJenisBus<?php echo $id_jenis ?>" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content modal-edit">
                            <form role="form" action="editJenisBus.php" method="POST">
                              <?php
                                    // Removed N+1 query: directly use variables from the outer loop
                                    $id_jenis2 = $id_jenis;
                                    $jenis2 = $jenis;
                                    $fasilitas2 = $fasilitas;
                                  ?>
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Jenis Bus</h4>
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
                                      name="txt_id_jenis" value="<?php echo $id_jenis2; ?>" placeholder=""
                                      readonly />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputJenis" class="form-label">Jenis</label>
                                    <input type="text" class="form-control" id="inputJenis"
                                      name="txt_jenis" placeholder="Ex: AKAS" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      value="<?php echo $jenis2; ?>" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputFasilitas" class="form-label">Fasilitas</label>
                                    <input type="text" class="form-control"
                                      id="inputFasilitas" name="txt_fasilitas"
                                      placeholder="Ex: TV, AC, Wifi, Toilet" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      value="<?php echo $fasilitas2; ?>" />
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
                    <td><span class="fw-semibold">JB000<?php echo $id_jenis; ?></span></td>
                    <td>
                      <?php 
                      $jClass = strtolower(trim($jenis));
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
                      echo '<span class="badge-jenis ' . $badgeClass . '">' . htmlspecialchars($jenis) . '</span>';
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
    <div id="tambahDataJenisBus" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content modal-edit">
          <form role="form" action="tambahJenisBus.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Jenis Bus</h4>
              <button type="button" class="btn btn-danger btn-circle btn-user"
                data-bs-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputJenisAdd" class="form-label">Jenis</label>
                  <input type="text" class="form-control" id="inputJenisAdd"
                    name="txt_jenis" placeholder="Ex: AKAS" required
                    data-parsley-required-message="Data harus di isi !!!" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputFasilitasAdd" class="form-label">Fasilitas</label>
                  <input type="text" class="form-control" id="inputFasilitasAdd"
                    name="txt_fasilitas" placeholder="Ex: TV, AC, Wifi, Toilet" required
                    data-parsley-required-message="Data harus di isi !!!" />
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
    const deleteJenisBusButtons = document.querySelectorAll(".btn-delete-jenisbus");
    deleteJenisBusButtons.forEach(button => {
        button.addEventListener("click", function() {
            const idJenis = this.getAttribute("data-id");
            const namaJenis = this.getAttribute("data-nama");
            Swal.fire({
                title: "Hapus Jenis Bus",
                html: `Apakah Anda yakin ingin menghapus data jenis bus <b>${namaJenis}</b> (ID: <b>JB000${idJenis}</b>)?<br>Perlu hati-hati karena data akan hilang selamanya!`,
                icon: "warning",
                showCancelButton: true,
                customClass: { confirmButton: "btn-danger" },
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `hapusJenisBus.php?id_jenis=${idJenis}`;
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
