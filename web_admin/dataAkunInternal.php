<?php
require_once('layouts/auth.php');

// Security check: Only level 1 (Admin) can access this page
if ($sesLvl != 1) {
  header("Location: dashboard.php");
  exit;
}

$pageTitle = "Data Akun Internal - SI BOSS";
$activeMenu = "dataAkunInternal";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

// Fetch and process data for statistics
$allAdmins = [];
$adminQuery = $obj->lihatAdministrator();
if ($adminQuery->rowCount() > 0) {
  while ($row = $adminQuery->fetch(PDO::FETCH_ASSOC)) {
    $allAdmins[] = $row;
  }
}

$totalInternal = count($allAdmins);
$totalAdmin = 0;
$totalStaff = 0;

foreach ($allAdmins as $admin) {
  if (isset($admin['id_level']) && $admin['id_level'] == 1) {
    $totalAdmin++;
  } else {
    $totalStaff++;
  }
}
$activeTerminals = count(array_unique(array_filter(array_column($allAdmins, 'id_terminal'))));

ob_start();
?>

    <!-- ============ STAT CARDS ============ -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card: Total Staf Internal -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-blue shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-group"></i></div>
            </div>
            <div class="stat-label">Total Staf Internal</div>
            <div class="stat-value"><?= $totalInternal; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Administrator -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-indigo shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-shield"></i></div>
            </div>
            <div class="stat-label">Administrator (Super)</div>
            <div class="stat-value"><?= $totalAdmin; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Staff Terminal -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-pink shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-user-badge"></i></div>
            </div>
            <div class="stat-label">Staff Terminal (Operator)</div>
            <div class="stat-value"><?= $totalStaff; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Terminal Terjaga -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-green shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-buildings"></i></div>
            </div>
            <div class="stat-label">Terminal Terjaga</div>
            <div class="stat-value"><?= $activeTerminals; ?><span class="stat-unit">Lokasi</span></div>
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
              <i class="bx bxs-shield-quarter fs-5"></i>
              <span class="m-0"><b>Tabel Data Akun Internal</b></span>
            </div>
            <div class="btnAction d-flex align-items-center gap-2">
              <button type="button" class="btn btn-light text-dark btn-circle shadow" data-bs-toggle="modal" data-bs-target="#tambahDataAdministrator"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
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
                    <th class="foto">Foto</th>
                    <th class="nama">Nama</th>
                    <th class="jk">Jenis Kelamin</th>
                    <th class="alamat">Alamat</th>
                    <th class="nohp">No Handphone</th>
                    <th class="level">Status</th>
                    <th class="terminal">Terminal</th>
                    <th class="email">Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (count($allAdmins) > 0) {
                    foreach ($allAdmins as $row) {
                      $id_user_admin = $row['id_user_admin'];
                      $nama = $row['nama'];
                      $jenis_kelamin = $row['jenis_kelamin'];
                      $alamat = $row['alamat'];
                      $no_hp = $row['no_hp'];
                      $foto = $row['foto'];
                      $id_level = $row['id_level'];
                      $level = $row['level'];
                      $id_terminal = $row['id_terminal'];
                      $nama_terminal = $row['nama_terminal'];
                      $email = $row['email'];
                      $password = $row['password'];
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
                          <button type="button" class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataAdministrator<?php echo $id_user_admin ?>" value="edit">
                            &nbsp;<i class="bx bx-edit" data-bs-toggle="tooltip" title="Edit"></i>
                          </button>
                           <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-admin" data-id="<?php echo $id_user_admin; ?>" data-nama="<?php echo htmlspecialchars($nama); ?>" aria-label="Delete">
                             <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                           </button>

                          <!-- Edit Modal -->
                          <div id="editDataAdministrator<?php echo $id_user_admin ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content modal-edit">
                                <form role="form" action="editAdministrator.php" method="POST" enctype="multipart/form-data">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Data Administrator</h4>
                                    <button type="button" class="btn btn-danger btn-circle btn-user" data-bs-dismiss="modal" aria-label="Close">
                                      <i class="bx bx-x"></i>
                                    </button>
                                  </div>
                                  <div class="modal-body text-start">
                                    <input type="hidden" name="txt_id_user_admin" value="<?php echo $id_user_admin ?>" />
                                    <div class="row">
                                      <div class="col-lg-6 mb-3">
                                        <div class="mb-3">
                                          <label for="InputFotoAdminEdit<?php echo $id_user_admin ?>" class="form-label">Foto Administrator</label>
                                          <div class="img-div">
                                            <div class="img-placeholder" onClick="triggerClick()">
                                              <img src="img/ico/icons8_driver_50px.png" alt="" />
                                            </div>
                                            <img src="fotoAdmin/<?php echo !empty($foto) ? $foto : 'default.png'; ?>" onClick="triggerClick()" id="profileDisplay" class="img-profile rounded-circle" />
                                          </div>
                                          <input type="file" name="txt_fotoEa" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" />
                                        </div>
                                      </div>

                                      <div class="col-lg-6 mb-3">
                                        <label for="inputNamaEdit<?php echo $id_user_admin ?>" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="inputNamaEdit<?php echo $id_user_admin ?>" name="txt_nama" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($nama) ?>" />
                                        
                                        <label class="form-label mt-2">Jenis Kelamin</label>
                                        <div class="row g-2 pt-1">
                                          <div class="col-6">
                                            <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1EditAdmin<?php echo $id_user_admin; ?>" value="Laki-laki" <?= ($jenis_kelamin == 'Laki-laki') ? 'checked' : ''; ?> />
                                            <label class="gender-card-option" for="Radios1EditAdmin<?php echo $id_user_admin; ?>">
                                              <div class="gender-card-content">
                                                <i class="bx bx-male"></i>
                                                <span>Laki-laki</span>
                                              </div>
                                            </label>
                                          </div>
                                          <div class="col-6">
                                            <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2EditAdmin<?php echo $id_user_admin; ?>" value="Perempuan" <?= ($jenis_kelamin == 'Perempuan') ? 'checked' : ''; ?> />
                                            <label class="gender-card-option" for="Radios2EditAdmin<?php echo $id_user_admin; ?>">
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
                                        <label for="inputAlamatEdit<?php echo $id_user_admin ?>" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="inputAlamatEdit<?php echo $id_user_admin ?>" name="txt_alamat" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($alamat) ?>" />
                                      </div>
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputNoHpEdit<?php echo $id_user_admin ?>" class="form-label">No Handphone</label>
                                        <input type="number" class="form-control" id="inputNoHpEdit<?php echo $id_user_admin ?>" name="txt_no_hp" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $no_hp ?>" />
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputEmailEdit<?php echo $id_user_admin ?>" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmailEdit<?php echo $id_user_admin ?>" name="txt_email" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($email) ?>" />
                                      </div>
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputPasswordEdit<?php echo $id_user_admin ?>" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPasswordEdit<?php echo $id_user_admin ?>" name="txt_password" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($password) ?>" />
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-6 mb-3">
                                        <label for="InputLevelEdit<?php echo $id_user_admin ?>" class="form-label">Status</label>
                                        <select class="form-select" id="InputLevelEdit<?php echo $id_user_admin ?>" required data-parsley-required-message="Harap pilih data status !!!" name="txt_id_level">
                                          <?php
                                          $datasd = $obj->lihatLevel();
                                          if ($datasd->rowCount() > 0) {
                                            while ($lvlRow = $datasd->fetch(PDO::FETCH_ASSOC)) {
                                              $lvlId = $lvlRow['id_level'];
                                              $lvlName = $lvlRow['level'];
                                              $selected = ($id_level == $lvlId) ? 'selected' : '';
                                              echo "<option value='$lvlId' $selected>$lvlName</option>";
                                            }
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="col-lg-6 mb-3">
                                        <label for="InputTerminalEdit<?php echo $id_user_admin ?>" class="form-label">Terminal</label>
                                        <select class="form-select" id="InputTerminalEdit<?php echo $id_user_admin ?>" required data-parsley-required-message="Harap pilih data terminal !!!" name="txt_id_terminal">
                                          <?php
                                          $datas = $obj->lihatTerminal();
                                          if ($datas->rowCount() > 0) {
                                            while ($trmRow = $datas->fetch(PDO::FETCH_ASSOC)) {
                                              $trmId = $trmRow['id_terminal'];
                                              $trmName = $trmRow['nama_terminal'];
                                              $selected = ($id_terminal == $trmId) ? 'selected' : '';
                                              echo "<option value='$trmId' $selected>$trmName</option>";
                                            }
                                          }
                                          ?>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="modal-footer px-0 pb-0">
                                      <button class="btn btn-secondary rounded-pill" type="button" data-bs-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn btn-primary rounded-pill" name="simpan">Update</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td><span class="fw-semibold">A000<?php echo $id_user_admin; ?></span></td>
                        <td>
                          <a href="fotoAdmin/<?php echo !empty($foto) ? $foto : 'default.png'; ?>" class="glightbox">
                            <img src="fotoAdmin/<?php echo !empty($foto) ? $foto : 'default.png'; ?>" class='img-profile-row' alt="Foto Admin">
                          </a>
                        </td>
                        <td><span class="fw-semibold"><?php echo htmlspecialchars($nama); ?></span></td>
                        <td><?php echo $jenis_kelamin; ?></td>
                        <td><?php echo htmlspecialchars($alamat); ?></td>
                        <td><?php echo $no_hp; ?></td>
                        <td>
                          <?php if ($id_level == 1): ?>
                            <span class="badge-status status-admin"><?php echo $level; ?></span>
                          <?php else: ?>
                            <span class="badge-status status-staff"><?php echo $level; ?></span>
                          <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($nama_terminal); ?></td>
                        <td><?php echo htmlspecialchars($email); ?></td>
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
    <div id="tambahDataAdministrator" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content modal-edit">
          <form role="form" action="tambahAdministrator.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Akun Internal</h4>
              <button type="button" class="btn btn-danger btn-circle" data-bs-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body text-start">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <div class="mb-3">
                    <label for="InputFotoBus" class="form-label">Foto Akun Internal</label>
                    <div class="img-div">
                      <div class="img-placeholder" onClick="triggerClick()">
                        <img src="img/ico/icons8_driver_50px.png" alt="" />
                      </div>
                      <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" class="img-profile rounded-circle" />
                    </div>
                    <input type="file" name="txt_fotot" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none" />
                  </div>
                </div>

                <div class="col-lg-6 mb-3">
                  <label for="inputNamaAdd" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="inputNamaAdd" name="txt_nama" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" />
                  
                  <label class="form-label mt-2">Jenis Kelamin</label>
                  <div class="row g-2 pt-1">
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1AddAdmin" value="Laki-laki" checked />
                      <label class="gender-card-option" for="Radios1AddAdmin">
                        <div class="gender-card-content">
                          <i class="bx bx-male"></i>
                          <span>Laki-laki</span>
                        </div>
                      </label>
                    </div>
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2AddAdmin" value="Perempuan" />
                      <label class="gender-card-option" for="Radios2AddAdmin">
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
                  <label for="inputAlamatAdd" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="inputAlamatAdd" name="txt_alamat" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputNoHpAdd" class="form-label">No Handphone</label>
                  <input type="number" class="form-control" id="inputNoHpAdd" name="txt_no_hp" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputEmailAdd" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmailAdd" name="txt_email" placeholder="Ex: admin@gmail.com" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputPasswordAdd" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPasswordAdd" name="txt_password" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="InputLevelAdd" class="form-label">Status</label>
                  <select class="form-select" id="InputLevelAdd" required data-parsley-required-message="Harap pilih data status !!!" name="txt_id_level">
                    <option disabled selected value="">Pilih Status</option>
                    <?php
                    $datasd = $obj->lihatLevel();
                    if ($datasd->rowCount() > 0) {
                      while ($lvlRow = $datasd->fetch(PDO::FETCH_ASSOC)) {
                        $lvlId = $lvlRow['id_level'];
                        $lvlName = $lvlRow['level'];
                        echo "<option value='$lvlId'>$lvlName</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="InputTerminalAdd" class="form-label">Terminal</label>
                  <select class="form-select" id="InputTerminalAdd" required data-parsley-required-message="Harap pilih data terminal !!!" name="txt_id_terminal">
                    <option disabled selected value="">Pilih Terminal</option>
                    <?php
                    $datas = $obj->lihatTerminal();
                    if ($datas->rowCount() > 0) {
                      while ($trmRow = $datas->fetch(PDO::FETCH_ASSOC)) {
                        $trmId = $trmRow['id_terminal'];
                        $trmName = $trmRow['nama_terminal'];
                        echo "<option value='$trmId'>$trmName</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="modal-footer px-0 pb-0">
                <button class="btn btn-secondary rounded-pill" type="button" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-pill" name="simpan">Simpan</button>
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
       const deleteButtons = document.querySelectorAll('.btn-delete-admin');
       deleteButtons.forEach(button => {
         button.addEventListener('click', function() {
           const idAdmin = this.getAttribute('data-id');
           const namaAdmin = this.getAttribute('data-nama');
           
           Swal.fire({
             title: 'Hapus Akun Internal',
             html: `Apakah Anda yakin ingin menghapus data administrator/staf <b>${namaAdmin}</b>?<br>Perlu hati-hati karena data akan hilang selamanya!`,
             icon: 'warning',
             showCancelButton: true,
             customClass: { confirmButton: 'btn-danger' },
             confirmButtonColor: '#ef4444',
             cancelButtonColor: '#6b7280',
             confirmButtonText: 'Hapus',
             cancelButtonText: 'Batal'
           }).then((result) => {
             if (result.isConfirmed) {
               window.location.href = `hapusAdministrator.php?id_user_admin=${idAdmin}`;
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
