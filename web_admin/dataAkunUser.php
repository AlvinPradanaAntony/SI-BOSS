<?php
require_once('layouts/auth.php');

// Security check: Only level 1 (Admin) and level 2 (Staff) can access this page
if ($sesLvl != 1 && $sesLvl != 2) {
  header("Location: dashboard.php");
  exit;
}

$pageTitle = "Data Akun User - SI BOSS";
$activeMenu = "dataAkunUser";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

// Fetch and process user data for statistics
$allUsers = [];
$userQuery = $obj->lihatUser();
if ($userQuery->rowCount() > 0) {
  while ($row = $userQuery->fetch(PDO::FETCH_ASSOC)) {
    $allUsers[] = $row;
  }
}

$totalUser = count($allUsers);
$totalLaki = 0;
$totalPerempuan = 0;
$activeContacts = 0;

foreach ($allUsers as $user) {
  $jk = isset($user['jenis_kelamin_user']) ? strtolower(trim($user['jenis_kelamin_user'])) : '';
  if ($jk === 'laki-laki' || $jk === 'l' || strpos($jk, 'laki') !== false) {
    $totalLaki++;
  } elseif ($jk === 'perempuan' || $jk === 'p' || strpos($jk, 'perempuan') !== false || strpos($jk, 'wanita') !== false) {
    $totalPerempuan++;
  }
  if (!empty($user['no_hp_user'])) {
    $activeContacts++;
  }
}

ob_start();
?>

    <!-- ============ STAT CARDS ============ -->
    <div class="row m-0 px-3 pt-navbar">
      <!-- Card: Total Penumpang -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-blue shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-group"></i></div>
            </div>
            <div class="stat-label">Total User Terdaftar</div>
            <div class="stat-value"><?= $totalUser; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Penumpang Laki-laki -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-indigo shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-male-sign"></i></div>
            </div>
            <div class="stat-label">User Laki-laki</div>
            <div class="stat-value"><?= $totalLaki; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Penumpang Perempuan -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-pink shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bx-female-sign"></i></div>
            </div>
            <div class="stat-label">User Perempuan</div>
            <div class="stat-value"><?= $totalPerempuan; ?><span class="stat-unit">Orang</span></div>
          </div>
        </div>
      </div>

      <!-- Card: Kontak Terdaftar -->
      <div class="col-6 col-md-6 col-xl-3 mb-4">
        <div class="card stat-card bg-gradient-green shadow h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="stat-icon"><i class="bx bxs-phone"></i></div>
            </div>
            <div class="stat-label">Kontak Terdaftar</div>
            <div class="stat-value"><?= $activeContacts; ?><span class="stat-unit">Nomor</span></div>
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
              <i class="bx bxs-user fs-5"></i>
              <span class="m-0"><b>Tabel Data Akun User (Penumpang)</b></span>
            </div>
            <div class="btnAction d-flex align-items-center gap-2">
              <button type="button" class="btn btn-light text-dark btn-circle shadow" data-bs-toggle="modal" data-bs-target="#tambahDataUser"><i class="bx bx-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
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
                    <th class="foto">Foto</th>
                    <th class="id">NIK User</th>
                    <th class="nama">Nama User</th>
                    <th class="tempat">Tempat Lahir</th>
                    <th class="tanggal">Tanggal Lahir</th>
                    <th class="jk">Jenis Kelamin</th>
                    <th class="alamat">Alamat</th>
                    <th class="nohp">No Handphone</th>
                    <th class="email">Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (count($allUsers) > 0) {
                    foreach ($allUsers as $row) {
                      $nik_user = $row['nik_user'];
                      $nama_user = $row['nama_user'];
                      $tempat_lahir_user = $row['tempat_lahir_user'];
                      $tanggal_lahir_user = $row['tanggal_lahir_user'];
                      $jenis_kelamin_user = $row['jenis_kelamin_user'];
                      $alamat_user = $row['alamat_user'];
                      $no_hp_user = $row['no_hp_user'];
                      $foto_user = $row['foto_user'];
                      $email_user = $row['email_user'];
                      $password_user = $row['password_user'];
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
                          <button type="button" class="btn btn-success btn-user btn-circle" aria-label="EditModal" data-bs-toggle="modal" data-bs-target="#editDataUser<?php echo $nik_user ?>" value="edit">
                            &nbsp;<i class="bx bx-edit" data-bs-toggle="tooltip" title="Edit"></i>
                          </button>
                           <button type="button" class="btn btn-danger btn-user btn-circle btn-delete-user" data-nik="<?php echo $nik_user; ?>" data-nama="<?php echo htmlspecialchars($nama_user); ?>" aria-label="Delete">
                             <i class="bx bx-trash" data-bs-toggle="tooltip" title="Delete"></i>
                           </button>

                          <!-- Edit Modal -->
                          <div id="editDataUser<?php echo $nik_user ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content modal-edit">
                                <form role="form" action="editUser.php" method="POST" enctype="multipart/form-data">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Data User (Penumpang)</h4>
                                    <button type="button" class="btn btn-danger btn-circle btn-user" data-bs-dismiss="modal" aria-label="Close">
                                      <i class="bx bx-x"></i>
                                    </button>
                                  </div>
                                  <div class="modal-body text-start">
                                    <div class="row">
                                      <div class="col-lg-6 mb-3">
                                        <div class="mb-3">
                                          <label for="InputFotoUserEdit<?php echo $nik_user ?>" class="form-label">Foto User</label>
                                          <div class="img-div">
                                            <div class="img-placeholder" onClick="triggerClick()">
                                              <img src="img/ico/icons8_driver_50px.png" alt="" />
                                            </div>
                                            <img src="fotoUser/<?php echo !empty($foto_user) ? $foto_user : 'default.png'; ?>" onClick="triggerClick()" id="profileDisplay" class="img-profile rounded-circle" />
                                          </div>
                                          <input type="file" name="txt_foto_usere" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" />
                                        </div>
                                      </div>

                                      <div class="col-lg-6 mb-3">
                                        <label for="inputNikEdit<?php echo $nik_user ?>" class="form-label">NIK</label>
                                        <input type="number" class="form-control" id="inputNikEdit<?php echo $nik_user ?>" name="txt_nik_user" value="<?php echo $nik_user ?>" readonly />
                                        
                                        <label for="inputNamaEdit<?php echo $nik_user ?>" class="form-label mt-2">Nama</label>
                                        <input type="text" class="form-control" id="inputNamaEdit<?php echo $nik_user ?>" name="txt_nama_user" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($nama_user) ?>" />
                                        
                                        <label class="form-label mt-2">Jenis Kelamin</label>
                                        <div class="row g-2 pt-1">
                                          <div class="col-6">
                                            <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1EditUser<?php echo $nik_user; ?>" value="Laki-laki" <?= ($jenis_kelamin_user == 'Laki-laki') ? 'checked' : ''; ?> />
                                            <label class="gender-card-option" for="Radios1EditUser<?php echo $nik_user; ?>">
                                              <div class="gender-card-content">
                                                <i class="bx bx-male"></i>
                                                <span>Laki-laki</span>
                                              </div>
                                            </label>
                                          </div>
                                          <div class="col-6">
                                            <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2EditUser<?php echo $nik_user; ?>" value="Perempuan" <?= ($jenis_kelamin_user == 'Perempuan') ? 'checked' : ''; ?> />
                                            <label class="gender-card-option" for="Radios2EditUser<?php echo $nik_user; ?>">
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
                                        <label for="inputTempatEdit<?php echo $nik_user ?>" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="inputTempatEdit<?php echo $nik_user ?>" name="txt_tempat_lahir_user" placeholder="Ex: Jember" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($tempat_lahir_user) ?>" />
                                      </div>
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputTanggalEdit<?php echo $nik_user ?>" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="inputTanggalEdit<?php echo $nik_user ?>" name="txt_tanggal_lahir_user" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $tanggal_lahir_user ?>" />
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputAlamatEdit<?php echo $nik_user ?>" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="inputAlamatEdit<?php echo $nik_user ?>" name="txt_alamat_user" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($alamat_user) ?>" />
                                      </div>
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputNoHpEdit<?php echo $nik_user ?>" class="form-label">No Handphone</label>
                                        <input type="number" class="form-control" id="inputNoHpEdit<?php echo $nik_user ?>" name="txt_no_hp_user" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo $no_hp_user ?>" />
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputEmailEdit<?php echo $nik_user ?>" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmailEdit<?php echo $nik_user ?>" name="txt_email_user" placeholder="Ex: penumpang@gmail.com" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($email_user) ?>" />
                                      </div>
                                      <div class="col-lg-6 mb-3">
                                        <label for="inputPasswordEdit<?php echo $nik_user ?>" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPasswordEdit<?php echo $nik_user ?>" name="txt_password_user" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" value="<?php echo htmlspecialchars($password_user) ?>" />
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

                           <!-- Delete Modal removed for SweetAlert2 -->
                        </td>
                        <td>
                          <a href="fotoUser/<?php echo !empty($foto_user) ? $foto_user : 'default.png'; ?>" class="glightbox">
                            <img src="fotoUser/<?php echo !empty($foto_user) ? $foto_user : 'default.png'; ?>" class='img-profile-row' alt="Foto User">
                          </a>
                        </td>
                        <td><span class="fw-semibold"><?php echo $nik_user; ?></span></td>
                        <td><span class="fw-semibold"><?php echo htmlspecialchars($nama_user); ?></span></td>
                        <td><?php echo htmlspecialchars($tempat_lahir_user); ?></td>
                        <td><?php echo $tanggal_lahir_user; ?></td>
                        <td><?php echo $jenis_kelamin_user; ?></td>
                        <td><?php echo htmlspecialchars($alamat_user); ?></td>
                        <td><?php echo $no_hp_user; ?></td>
                        <td><?php echo htmlspecialchars($email_user); ?></td>
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
    <div id="tambahDataUser" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content modal-edit">
          <form role="form" action="tambahUser.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Akun User</h4>
              <button type="button" class="btn btn-danger btn-circle" data-bs-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body text-start">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <div class="mb-3">
                    <label for="InputFotoUserAdd" class="form-label">Foto User</label>
                    <div class="img-div">
                      <div class="img-placeholder" onClick="triggerClick()">
                        <img src="img/ico/icons8_driver_50px.png" alt="" />
                      </div>
                      <img src="img/ico/icons8_driver_50px.png" onClick="triggerClick()" id="profileDisplay" class="img-profile rounded-circle" />
                    </div>
                    <input type="file" name="txt_foto_usert" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none" />
                  </div>
                </div>

                <div class="col-lg-6 mb-3">
                  <label for="inputNikAdd" class="form-label">NIK</label>
                  <input type="number" class="form-control" id="inputNikAdd" name="txt_nik_user" placeholder="3509030907020004" required data-parsley-required-message="Data harus di isi !!!" />
                  
                  <label for="inputNamaAdd" class="form-label mt-2">Nama</label>
                  <input type="text" class="form-control" id="inputNamaAdd" name="txt_nama_user" placeholder="Ex: Budi Santoso" required data-parsley-required-message="Data harus di isi !!!" />
                  
                  <label class="form-label mt-2">Jenis Kelamin</label>
                  <div class="row g-2 pt-1">
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios1AddUser" value="Laki-laki" checked />
                      <label class="gender-card-option" for="Radios1AddUser">
                        <div class="gender-card-content">
                          <i class="bx bx-male"></i>
                          <span>Laki-laki</span>
                        </div>
                      </label>
                    </div>
                    <div class="col-6">
                      <input class="gender-radio-input" type="radio" name="Rbtn_jenis_kelamin" id="Radios2AddUser" value="Perempuan" />
                      <label class="gender-card-option" for="Radios2AddUser">
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
                  <label for="inputTempatAdd" class="form-label">Tempat Lahir</label>
                  <input type="text" class="form-control" id="inputTempatAdd" name="txt_tempat_lahir_user" placeholder="Ex: Jember" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputTanggalAdd" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="inputTanggalAdd" name="txt_tanggal_lahir_user" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputAlamatAdd" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="inputAlamatAdd" name="txt_alamat_user" placeholder="Ex: Jl. Dharmawangsa" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputNoHpAdd" class="form-label">No Handphone</label>
                  <input type="number" class="form-control" id="inputNoHpAdd" name="txt_no_hp_user" placeholder="Ex: 085808241205" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="inputEmailAdd" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmailAdd" name="txt_email_user" placeholder="Ex: penumpang@gmail.com" required data-parsley-required-message="Data harus di isi !!!" />
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="inputPasswordAdd" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPasswordAdd" name="txt_password_user" placeholder="Ex: ********" required data-parsley-required-message="Data harus di isi !!!" />
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
      const deleteButtons = document.querySelectorAll('.btn-delete-user');
      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const nikUser = this.getAttribute('data-nik');
          const namaUser = this.getAttribute('data-nama');
          
          Swal.fire({
            title: 'Hapus Akun User',
            html: `Apakah Anda yakin ingin menghapus akun penumpang <b>${namaUser}</b>?<br>Perlu hati-hati karena data akan hilang selamanya!`,
            icon: 'warning',
            showCancelButton: true,
            customClass: { confirmButton: 'btn-danger' },
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `hapusUser.php?nik_user=${nikUser}`;
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
