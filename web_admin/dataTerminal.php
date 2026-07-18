<?php
require_once('layouts/auth.php');

$pageTitle = "Data Terminal - SI BOSS";
$activeMenu = "dataTerminal";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

// Fetch data for statistics and table
$allTerminals = [];
$terminalQuery = $obj->lihatTerminal();
if ($terminalQuery->rowCount() > 0) {
  while ($row = $terminalQuery->fetch(PDO::FETCH_ASSOC)) {
    $allTerminals[] = $row;
  }
}
$totalTerminal = count($allTerminals);

$totalProvinsi = count(array_unique(array_map('strtolower', array_filter(array_column($allTerminals, 'provinsi_terminal')))));
$totalKabupaten = count(array_unique(array_map('strtolower', array_filter(array_column($allTerminals, 'kabupaten_terminal')))));
$totalKecamatan = count(array_unique(array_map('strtolower', array_filter(array_column($allTerminals, 'kecamatan_terminal')))));

ob_start();
?>

    <!-- ============ STAT CARDS ============ -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card: Total Terminal -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-blue shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-buildings"></i></div>
            </div>
            <div class="stat-label">Total Terminal</div>
            <div class="stat-value"><?= $totalTerminal; ?><span class="stat-unit">Lokasi</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Total Provinsi -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-teal shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-map"></i></div>
            </div>
            <div class="stat-label">Provinsi Terjangkau</div>
            <div class="stat-value"><?= $totalProvinsi; ?><span class="stat-unit">Provinsi</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Total Kabupaten -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-pink shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-map-pin"></i></div>
            </div>
            <div class="stat-label">Kota / Kabupaten</div>
            <div class="stat-value"><?= $totalKabupaten; ?><span class="stat-unit">Wilayah</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Total Kecamatan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-yellow shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-map-pin"></i></div>
            </div>
            <div class="stat-label">Kecamatan Terdaftar</div>
            <div class="stat-value"><?= $totalKecamatan; ?><span class="stat-unit">Daerah</span></div>
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
              <i class="bx bxs-buildings fs-5"></i>
              <span class="m-0"><b>Tabel Data Terminal</b></span>
            </div>
            <div class="btnAction d-flex align-items-center gap-2">
              <button type="button" class="btn btn-light text-dark btn-circle shadow" data-bs-toggle="modal" data-bs-target="#tambahDataTerminal"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
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
                    <th class="terminal">Terminal</th>
                    <th class="alamat">Alamat</th>
                    <th class="provinsis">Provinsi</th>
                    <th class="kabupatens">Kabupaten/Kota</th>
                    <th class="kecamatans">Kecamatan</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (count($allTerminals) > 0) {
                    if ($sesLvl == 1) {
                      $dis = "";
                    } else {
                      $dis = "disabled";
                    }
                    foreach ($allTerminals as $row) {
                      $id_terminal = $row['id_terminal'];
                      $terminal = $row['nama_terminal'];
                      $alamat = $row['detail_alamat_terminal'];
                      $provinsi = $row['provinsi_terminal'];
                      $kabupaten = $row['kabupaten_terminal'];
                      $kecamatan = $row['kecamatan_terminal'];
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
                          data-bs-toggle="modal" data-bs-target="#editDataTerminal<?php echo $id_terminal ?>"
                          value="edit">
                          &nbsp;<i class="bx bx-edit" data-bs-toggle="tooltip" title="Edit"></i>
                        </button>
                         <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-terminal" aria-label="DeleteModal"
                           data-id="<?php echo $id_terminal; ?>"
                           data-nama="<?php echo htmlspecialchars($terminal); ?>"
                           value="hapus">
                           <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                         </button>

                      <!-- Edit Modal -->
                      <div id="editDataTerminal<?php echo $id_terminal ?>" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content modal-edit">
                            <form role="form" action="editTerminal.php" method="POST">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Terminal</h4>
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
                                      name="txt_id_terminal" value="<?php echo $id_terminal ?>" placeholder=""
                                      readonly />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputTerminal" class="form-label">Nama Terminal</label>
                                    <input type="text" class="form-control"
                                      id="inputTerminal" name="txt_nama_terminal" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      placeholder="Ex: Tawang Alun" value="<?php echo $terminal ?>" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputAlamat" class="form-label">Alamat Terminal</label>
                                    <input type="text" class="form-control"
                                      id="inputAlamat" name="txt_detail_alamat_terminal"
                                      placeholder="Ex: Jl. Dharmawangsa" value="<?php echo $alamat ?>"
                                      required data-parsley-required-message="Data harus di isi !!!" />
                                  </div>
                                  <div class="col-12 mb-3">
                                    <label for="InputProvTerminal" class="form-label">Provinsi</label>
                                    <input type="text" class="form-control"
                                      id="InputProvTerminal" name="d_provinsi_terminal"
                                      placeholder="Ex: Jawa Timur" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      value="<?php echo $provinsi ?>" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-6 mb-3">
                                    <label for="InputKabupatenTerminal" class="form-label">Kabupaten</label>
                                    <input type="text" class="form-control"
                                      id="InputKabupatenTerminal" name="d_kabupaten_terminal"
                                      placeholder="Ex: Jember" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      value="<?php echo $kabupaten ?>" />
                                  </div>
                                  <div class="col-6 mb-3">
                                    <label for="InputKecamatanTerminal" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control"
                                      id="InputKecamatanTerminal" name="d_kecamatan_terminal"
                                      placeholder="Ex: Rambupuji" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      value="<?php echo $kecamatan ?>" />
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
                          </div>
                        </div>
                      </div>
                    </td>
                    <td><span class="fw-semibold">TRML000<?php echo $id_terminal; ?></span></td>
                    <td><?php echo $terminal; ?></td>
                    <td><?php echo $alamat; ?></td>
                    <td><?php echo $provinsi; ?></td>
                    <td><?php echo $kabupaten; ?></td>
                    <td><?php echo $kecamatan; ?></td>
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
    <div id="tambahDataTerminal" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content modal-edit">
          <form role="form" action="tambahTerminal.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Terminal</h4>
              <button type="button" class="btn btn-danger btn-circle btn-user"
                data-bs-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputTerminalAdd" class="form-label">Nama Terminal</label>
                  <input type="text" class="form-control" id="inputTerminalAdd"
                    name="txt_nama_terminal" required
                    data-parsley-required-message="Data harus di isi !!!"
                    placeholder="Ex: Tawang Alun" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputAlamatAdd" class="form-label">Alamat Terminal</label>
                  <input type="text" class="form-control" id="inputAlamatAdd"
                    name="txt_detail_alamat_terminal" required
                    data-parsley-required-message="Data harus di isi !!!"
                    placeholder="Ex: Jl. Dharmawangsa" />
                </div>
                <div class="col-12 mb-3">
                  <label for="InputProvTerminalAdd" class="form-label">Provinsi</label>
                  <input type="text" class="form-control" id="InputProvTerminalAdd"
                    name="d_provinsi_terminal" required
                    data-parsley-required-message="Data harus di isi !!!"
                    placeholder="Ex: Jawa Timur" />
                </div>
              </div>

              <div class="row">
                <div class="col-6 mb-3">
                  <label for="InputKabupatenTerminalAdd" class="form-label">Kabupaten</label>
                  <input type="text" class="form-control" id="InputKabupatenTerminalAdd"
                    name="d_kabupaten_terminal" required
                    data-parsley-required-message="Data harus di isi !!!" placeholder="Ex: Jember" />
                </div>
                <div class="col-6 mb-3">
                  <label for="InputKecamatanTerminalAdd" class="form-label">Kecamatan</label>
                  <input type="text" class="form-control" id="InputKecamatanTerminalAdd"
                    name="d_kecamatan_terminal" required
                    data-parsley-required-message="Data harus di isi !!!" placeholder="Ex: Rambupuji" />
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
    const deleteTerminalButtons = document.querySelectorAll(".btn-delete-terminal");
    deleteTerminalButtons.forEach(button => {
        button.addEventListener("click", function() {
            const idTerminal = this.getAttribute("data-id");
            const namaTerminal = this.getAttribute("data-nama");
            Swal.fire({
                title: "Hapus Terminal",
                html: `Apakah Anda yakin ingin menghapus data terminal <b>${namaTerminal}</b> (ID: <b>TRML000${idTerminal}</b>)?<br>Perlu hati-hati karena data akan hilang selamanya!`,
                icon: "warning",
                showCancelButton: true,
                customClass: { confirmButton: "btn-danger" },
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `hapusTerminal.php?id_terminal=${idTerminal}`;
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
