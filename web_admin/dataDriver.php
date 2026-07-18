<?php
require_once('layouts/auth.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $nama_bus = $_POST['txt_nama_bus'];
  $harga = $_POST['txt_harga'];
  $status_bus = $_POST['txt_status_bus'];
  $jumlah_kursi = $_POST['txt_jumlah_kursi'];
  $jenis_bus = $_POST['txt_jenis_bus'];
  $fasilitas = $_POST['txt_fasilitas'];
  $foto_bus = $_POST['txt_foto_bus'];
  $tanggal_pemberangkatan = $_POST['txt_tanggal_pemberangkatan'];
  $id_jenis = $_POST['txt_id_jenis'];
  $id_rute = $_POST['txt_id_rute'];
  
  if($obj->insertBus($nama_bus, $harga, $status_bus, $jumlah_kursi, $foto_bus, $tanggal_pemberangkatan, $id_jenis, $id_rute)){
    // echo '<div class="alert alert-success">Terminal Berhasil Ditambahkan</div>';
  } else{
    // echo '<div class="alert alert-danger">Terminal Gagal Ditambahkan</div>';
  }
}

$pageTitle = "Data Driver - SI BOSS";
$activeMenu = "dataDriver";
$extraCSS = '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />';

ob_start();
?>

      <!-- ============ STAT CARDS ============ -->
      <div class="row m-0 px-3 pt-navbar">
        <!-- Card: Total Data Driver -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-pink shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-user-pin"></i></div>
              </div>
              <div class="stat-label">Total Driver</div>
              <div class="stat-value">0<span class="stat-unit">Orang</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Driver On Duty -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-blue shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-directions"></i></div>
              </div>
              <div class="stat-label">Driver Bertugas</div>
              <div class="stat-value">0<span class="stat-unit">Orang</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Driver Standby -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-teal shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-user-check"></i></div>
              </div>
              <div class="stat-label">Driver Standby</div>
              <div class="stat-value">0<span class="stat-unit">Orang</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Sertifikasi Layanan -->
        <div class="col-6 col-md-6 col-xl-3 mb-4">
          <div class="card stat-card bg-gradient-green shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-badge-check"></i></div>
              </div>
              <div class="stat-label">Status Kelayakan</div>
              <div class="stat-value">100%<span class="stat-unit">Layak</span></div>
            </div>
          </div>
        </div>
      </div>

            <!-- Panel -->
            <div class="row g-2 m-0 px-4">
        <div class="col-lg-12">
          <div class="card shadow mb-4 rounded">
            <div class="card-header shadow rounded">
              <div class="title float-start">
                <span class="m-0"><b>Tabel Data Driver</b></span>
              </div>
            </div>
            <div class="card-body">
               <table class="table table-hover dataTable" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Driver</th>
                      <th>No. HP</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
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
  <script src="plugin/js/parsley.min.js"></script>
<?php
$extraJS = ob_get_clean();
$useUpImg = true;
require_once('layouts/main_layout.php');
?>
