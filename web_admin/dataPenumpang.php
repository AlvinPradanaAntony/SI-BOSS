<?php
require_once('layouts/auth.php');

$pageTitle = "Data Penumpang - SI BOSS";
$activeMenu = "dataPenumpang";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

// Fetch data for statistics and table
$allPenumpang = [];
$penumpangQuery = $obj->lihatPenumpang();
if ($penumpangQuery->rowCount() > 0) {
  while ($row = $penumpangQuery->fetch(PDO::FETCH_ASSOC)) {
    $allPenumpang[] = $row;
  }
}
$totalPenumpang = count($allPenumpang);

$pria = 0;
$wanita = 0;
$kontak = 0;
foreach ($allPenumpang as $p) {
  $jk = isset($p['jenis_kelamin_penumpang']) ? strtolower(trim($p['jenis_kelamin_penumpang'])) : '';
  if ($jk === 'laki-laki' || $jk === 'l' || strpos($jk, 'laki') !== false) {
    $pria++;
  } else if ($jk === 'perempuan' || $jk === 'p' || strpos($jk, 'perempuan') !== false || strpos($jk, 'wanita') !== false) {
    $wanita++;
  }
  if (!empty($p['no_hp_penumpang'])) {
    $kontak++;
  }
}

ob_start();
?>

    <!-- ============ STAT CARDS ============ -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card: Total Penumpang -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-teal shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-group"></i></div>
            </div>
            <div class="stat-label">Total Penumpang</div>
            <div class="stat-value"><?= $totalPenumpang; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Laki-laki -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-blue shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-male-sign"></i></div>
            </div>
            <div class="stat-label">Laki-laki</div>
            <div class="stat-value"><?= $pria; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Perempuan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-pink shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-female-sign"></i></div>
            </div>
            <div class="stat-label">Perempuan</div>
            <div class="stat-value"><?= $wanita; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Kontak HP -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-green shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-phone"></i></div>
            </div>
            <div class="stat-label">Kontak Terdaftar</div>
            <div class="stat-value"><?= $kontak; ?><span class="stat-unit">Nomor</span></div>
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
              <i class="bx bxs-group fs-5"></i>
              <span class="m-0"><b>Tabel Data Penumpang</b></span>
            </div>
            <div class="btnAction d-flex align-items-center gap-2">
              <button type="button" class="btn btn-light text-dark btn-circle shadow" data-bs-toggle="modal" data-bs-target="#tambahDataPenumpang"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
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
                    <th class="nik">NIK Penumpang </th>
                    <th class="nama">Nama Penumpang</th>
                    <th class="jk">Jenis Kelamin</th>
                    <th class="no_hp">No Handphone</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (count($allPenumpang) > 0) {
                    if ($sesLvl == 1) {
                      $dis = "";
                    } else {
                      $dis = "disabled";
                    }
                    foreach ($allPenumpang as $row) {
                      $nik_penumpang = $row['nik_penumpang'];
                      $nama_penumpang = $row['nama_penumpang'];
                      $jenis_kelamin_penumpang = $row['jenis_kelamin_penumpang'];
                      $no_hp_penumpang = $row['no_hp_penumpang'];
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
                          data-bs-toggle="modal"
                          data-bs-target="#editDataPenumpang<?php echo $nik_penumpang ?>" value="edit">
                          &nbsp;<i class="bx bx-edit" data-bs-toggle="tooltip" title="Edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-penumpang" aria-label="DeleteModal"
                           data-nik="<?php echo $nik_penumpang; ?>"
                           data-nama="<?php echo htmlspecialchars($nama_penumpang); ?>"
                           value="hapus">
                           <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                         </button>

                      <!-- Edit Modal -->
                      <div id="editDataPenumpang<?php echo $nik_penumpang ?>" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content modal-edit">
                            <form role="form" action="editPenumpang.php" method="POST">
                              <?php
                                    // Removed N+1 query: directly use variables from the outer loop
                                    $nik_penumpang2 = $nik_penumpang;
                                    $nama_penumpang2 = $nama_penumpang;
                                    $jenis_kelamin_penumpang2 = $jenis_kelamin_penumpang;
                                    $no_hp_penumpang2 = $no_hp_penumpang;
                              ?>
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Data Penumpang</h4>
                                <button type="button" class="btn btn-danger btn-circle btn-user"
                                  data-bs-dismiss="modal" aria-label="Close">
                                  <i class="bx bx-x"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputNik" class="form-label">NIK Penumpang</label>
                                    <input type="number" class="form-control" id="inputNik"
                                      name="txt_nik_penumpang" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      data-parsley-length="[15,16]" maxlength="16" data-parsley-number="1"
                                      placeholder="Ex: 3509030907020006" value="<?php echo $nik_penumpang2 ?>"
                                      placeholder="" readonly />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputNamaPenumpang" class="form-label">Nama Penumpang</label>
                                    <input type="text" class="form-control"
                                      id="inputNamaPenumpang" name="txt_nama_penumpang" required
                                      data-parsley-required-message="Data harus di isi !!!"
                                      placeholder="Ex: Budi Santoso" value="<?php echo $nama_penumpang2 ?>" />
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="InputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                    <div class="row g-2 pt-1">
                                      <div class="col-6">
                                        <input class="gender-radio-input" type="radio"
                                          name="txt_jenis_kelamin_penumpang" id="Radios1Edit<?php echo $nik_penumpang2; ?>" value="Laki-laki"
                                          <?php echo ($jenis_kelamin_penumpang2 == 'Laki-laki' || empty($jenis_kelamin_penumpang2)) ? 'checked' : ''; ?> />
                                        <label class="gender-card-option" for="Radios1Edit<?php echo $nik_penumpang2; ?>">
                                          <div class="gender-card-content">
                                            <i class="bx bx-male"></i>
                                            <span>Laki-laki</span>
                                          </div>
                                        </label>
                                      </div>
                                      <div class="col-6">
                                        <input class="gender-radio-input" type="radio"
                                          name="txt_jenis_kelamin_penumpang" id="Radios2Edit<?php echo $nik_penumpang2; ?>" value="Perempuan"
                                          <?php echo ($jenis_kelamin_penumpang2 == 'Perempuan') ? 'checked' : ''; ?> />
                                        <label class="gender-card-option" for="Radios2Edit<?php echo $nik_penumpang2; ?>">
                                          <div class="gender-card-content">
                                            <i class="bx bx-female"></i>
                                            <span>Perempuan</span>
                                          </div>
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="inputNoHp" class="form-label">No Handphone</label>
                                    <input type="number" class="form-control"
                                      id="inputNoHp" name="txt_no_hp_penumpang" placeholder="Ex: 085808241204"
                                      required data-parsley-required-message="Data harus di isi !!!"
                                      value="<?php echo $no_hp_penumpang2 ?>" />
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
                    <td><span class="fw-semibold"><?php echo $nik_penumpang; ?></span></td>
                    <td><?php echo $nama_penumpang; ?></td>
                    <td><?php echo htmlspecialchars($jenis_kelamin_penumpang); ?></td>
                    <td><?php echo $no_hp_penumpang; ?></td>
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
    <div id="tambahDataPenumpang" class="modal fade" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content modal-edit">
          <form role="form" action="tambahPenumpang.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Penumpang</h4>
              <button type="button" class="btn btn-danger btn-circle btn-user"
                data-bs-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputNikPenumpang" class="form-label">NIK Penumpang</label>
                  <input type="number" class="form-control" id="inputNikPenumpang"
                    name="txt_nik_penumpang" placeholder="Ex: 3509030907020006" required
                    data-parsley-required-message="Data harus di isi !!!" data-parsley-length="[15,16]"
                    maxlength="16" data-parsley-number="1" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputNamaPenumpangAdd" class="form-label">Nama Penumpang</label>
                  <input type="text" class="form-control" id="inputNamaPenumpangAdd"
                    name="txt_nama_penumpang" placeholder="Ex: Budi Santoso" required
                    data-parsley-required-message="Data harus di isi !!!" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="InputJenisKelaminAdd" class="form-label">Jenis Kelamin</label>
                  <div class="row g-2 pt-1">
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="txt_jenis_kelamin_penumpang"
                        id="Radios1Add" value="Laki-laki" checked />
                      <label class="gender-card-option" for="Radios1Add">
                        <div class="gender-card-content">
                          <i class="bx bx-male"></i>
                          <span>Laki-laki</span>
                        </div>
                      </label>
                    </div>
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="txt_jenis_kelamin_penumpang"
                        id="Radios2Add" value="Perempuan" />
                      <label class="gender-card-option" for="Radios2Add">
                        <div class="gender-card-content">
                          <i class="bx bx-female"></i>
                          <span>Perempuan</span>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputNoHpAdd" class="form-label">No Handphone</label>
                  <input type="number" class="form-control" id="inputNoHpAdd"
                    name="txt_no_hp_penumpang" placeholder="Ex: 085808241204" required
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
    const deletePenumpangButtons = document.querySelectorAll(".btn-delete-penumpang");
    deletePenumpangButtons.forEach(button => {
        button.addEventListener("click", function() {
            const nikPenumpang = this.getAttribute("data-nik");
            const namaPenumpang = this.getAttribute("data-nama");
            Swal.fire({
                title: "Hapus Penumpang",
                html: `Apakah Anda yakin ingin menghapus data penumpang <b>${namaPenumpang}</b> (NIK: <b>${nikPenumpang}</b>)?<br>Perlu hati-hati karena data akan hilang selamanya!`,
                icon: "warning",
                showCancelButton: true,
                customClass: { confirmButton: "btn-danger" },
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `hapusPenumpang.php?nik_penumpang=${nikPenumpang}`;
                }
            });
        });
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
require_once('layouts/main_layout.php');
?>
