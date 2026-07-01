<!-- <?php
require('koneksi.php');
require('query.php');
$obj = new crud;

session_start();

if(!isset($_SESSION['email'])){
    header('Location: index.php');
}

$sesID = $_SESSION['id'];
$sesName = $_SESSION['name'];
$sesLvl = $_SESSION['level'];
$email = $_GET['nama'];

?> -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SI-BOSS Express</title>
    <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="plugin/font/stylesheet.css" />
    <link rel="stylesheet" href="plugin/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="plugin/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css" />
    
    <!-- ini -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>

  <body>
    

    

      <!-- Panel -->
      <div class="row g-2 m-0 px-4">
        <div class="col-lg-12">
          <div class="card shadow mb-4 rounded">
            <div class="card-header shadow rounded">
              <div class="title float-start">
                <span class="m-0"><b>Tabel Data Laporan</b></span>
              </div>
              <div class="btnAction float-end">
                <!-- <button class="btn btn-light text-dark btn-circle custShadow2 me-2" data-bs-toggle="modal" data-bs-target="#tambahDataPemesanan"><i class="fas fa-plus" data-bs-toggle="tooltip" title="Tambah Data"></i></button>
                <button class="btn btn-light text-danger btn-circle custShadow2" data-bs-toggle="modal" data-bs-target="#deleteDataPemesanan"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Hapus Data"></i></button> -->
              </div>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover dataTable" id="mauexport" width="100%">
                  <thead>
                    <tr>
                      <!-- <th class="idPemesanan">ID Pemesanan</th> -->
                      <th>ID Tiket</th>
                      <!-- <th>Status</th> -->
                      <th>Nama Pemesan</th>
                      <!-- <th>No Handphone</th> -->
                      <th>Nama Penumpang</th>
                      <!-- <th>Jenis Kelamin</th> -->
                      <th>Nama Bus</th>
                      <!-- <th>Harga</th> -->
                      <!-- <th>Tanggal Pemberangkatan</th> -->
                      <th>Waktu Pemesanan</th>
                      <th>Kursi</th>
                      <th>Total Bayar</th>
                    </tr>
                  </thead>
                  <tbody><?php
                              // header("Location: dataLaporan.php");
                              $tanggal_mulai = $_POST['txt_tanggal_mulai'];
                              $tanggal_selesai = $_POST['txt_tanggal_selesai'];
                                $data = $obj->lihatLaporan($tanggal_mulai, $tanggal_selesai);
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
                                
                                
                                <!-- <td><?php echo $id_pemesanan; ?></td> -->
                                <td>APBTRMLRT000<?php echo $id_tiket; ?></td>
                                <!-- <td><?php echo $status;?></td> -->
                                <td><?php echo $nama_user; ?></td>
                                <!-- <td><?php echo $no_hp_user; ?></td> -->
                                <td><?php echo $nama_penumpang; ?></td>
                                <!-- <td><?php echo $jenis_kelamin_penumpang; ?></td> -->
                                <td><?php echo $nama_bus;?></td>
                                <!-- <td>Rp. <?php echo $harga;?></td> -->
                                <!-- <td><?php echo $tanggal_pemberangkatan?></td> -->
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
                <div class="col-2 d-flex justify-content-start">
                            <a href="dataLaporan.php" class="btn btn-daftar btn-block py-2">
                              <span>Kembali</span>
                            </a>
                          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

    <script src="jquery/jquery-3.6.0.min.js"></script>
    <script src="plugin/js/bootstrap.bundle.min.js"></script>
    <script src="plugin/jquery-easing/jquery.easing.min.js"></script>
    <script src="plugin/js/script.js"></script>
    <script src="plugin/js/calender.js"></script>
    <script src="plugin/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="plugin/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="plugin/js/datatables-demo.js"></script>
    <script src="plugin/js/javascript.js"></script>
    <script src="plugin/js/UpImg.js"></script>

    <!-- sama ini -->
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  </body>
</html>

