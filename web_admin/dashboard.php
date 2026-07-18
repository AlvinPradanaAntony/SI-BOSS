<?php
$pageTitle = "Dashboard - SI BOSS";
$activeMenu = "dashboard";
require_once('layouts/auth.php');
$useCalendar = true;
$useUpImg = true;

// Fetch data
$dataBus = $obj->lihatBus();
$numBus = $dataBus->rowCount();

$dataRute = $obj->lihatRute();
$numRute = $dataRute->rowCount();

$dataPenumpang = $obj->lihatPenumpang();
$numPenumpang = $dataPenumpang->rowCount();

$dataPemesanan = $obj->lihatPemesanan();
$numPemesanan = $dataPemesanan->rowCount();

// Calculate total revenue & count active/inactive
$totalRevenue = 0;
$busAktif = 0;
$busNonaktif = 0;
$recentOrders = [];
$orderIdx = 0;

// Re-fetch bus for active/inactive count
$dataBus2 = $obj->lihatBus();
while($rowBus = $dataBus2->fetch(PDO::FETCH_ASSOC)){
  if(isset($rowBus['status_bus']) && strtolower($rowBus['status_bus']) == 'aktif'){
    $busAktif++;
  } else {
    $busNonaktif++;
  }
}

// Re-fetch pemesanan for revenue + recent
$dataPemesanan2 = $obj->lihatPemesanan();
while($rowP = $dataPemesanan2->fetch(PDO::FETCH_ASSOC)){
  $totalRevenue += isset($rowP['total_bayar']) ? $rowP['total_bayar'] : 0;
  if($orderIdx < 5){
    $recentOrders[] = $rowP;
    $orderIdx++;
  }
}

$extraJS = '
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get CSS custom property values for chart styling
    var rootStyles = getComputedStyle(document.documentElement);
    var primaryColor = rootStyles.getPropertyValue("--color-primary").trim() || "#527bdd";
    var successColor = rootStyles.getPropertyValue("--color-success").trim() || "#22c55e";
    var warningColor = rootStyles.getPropertyValue("--color-warning").trim() || "#facc15";
    var errorColor = rootStyles.getPropertyValue("--color-error").trim() || "#ef4444";
    var infoColor = rootStyles.getPropertyValue("--color-info").trim() || "#527bdd";
    var textColor = rootStyles.getPropertyValue("--color-text-primary").trim() || "#1f264c";
    var textSecondary = rootStyles.getPropertyValue("--color-text-tertiary").trim() || "#6b7280";
    var surfaceColor = rootStyles.getPropertyValue("--color-surface").trim() || "#ffffff";
    var borderColor = rootStyles.getPropertyValue("--color-outline-variant").trim() || "#f3f4f6";

    // ---- Area Chart: Tren Pemesanan Bulanan ----
    var optionsPemesanan = {
      series: [{
        name: "Pemesanan",
        data: [12, 19, 14, 25, 22, 30, 28, 35, 32, 40, 38, 45]
      }, {
        name: "Pendapatan (juta)",
        data: [3, 5, 4, 7, 6, 9, 8, 10, 9, 12, 11, 14]
      }],
      chart: {
        type: "area",
        height: 300,
        fontFamily: "Roboto-Regular, sans-serif",
        toolbar: { show: false },
        zoom: { enabled: false },
        background: "transparent"
      },
      colors: [primaryColor, successColor],
      dataLabels: { enabled: false },
      stroke: {
        curve: "smooth",
        width: 2.5
      },
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.4,
          opacityTo: 0.05,
          stops: [0, 95, 100]
        }
      },
      xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        labels: {
          style: {
            colors: textSecondary,
            fontSize: "11px"
          }
        },
        axisBorder: { show: false },
        axisTicks: { show: false }
      },
      yaxis: {
        labels: {
          style: {
            colors: textSecondary,
            fontSize: "11px"
          }
        }
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 4,
        xaxis: { lines: { show: false } }
      },
      legend: {
        position: "top",
        horizontalAlign: "right",
        fontSize: "12px",
        labels: { colors: textSecondary },
        markers: { radius: 12 }
      },
      tooltip: {
        theme: document.documentElement.getAttribute("data-theme") === "dark" ? "dark" : "light",
        y: {
          formatter: function(val, opts) {
            if(opts.seriesIndex === 1) return "Rp " + val + " jt";
            return val + " pesanan";
          }
        }
      },
      responsive: [{
        breakpoint: 768,
        options: {
          chart: { height: 220 },
          legend: { fontSize: "10px" }
        }
      }]
    };
    var chartPemesanan = new ApexCharts(document.querySelector("#chartPemesanan"), optionsPemesanan);
    chartPemesanan.render();

    // ---- Donut Chart: Distribusi Jenis Bus ----
    var optionsJenisBus = {
      series: [45, 30, 25],
      chart: {
        type: "donut",
        height: 260,
        fontFamily: "Roboto-Regular, sans-serif",
        background: "transparent"
      },
      labels: ["Ekonomi", "Bisnis", "Eksekutif"],
      colors: [primaryColor, "#f59e0b", "#6366f1"],
      plotOptions: {
        pie: {
          donut: {
            size: "68%",
            labels: {
              show: true,
              name: {
                show: true,
                fontSize: "13px",
                color: textSecondary
              },
              value: {
                show: true,
                fontSize: "20px",
                fontWeight: 700,
                color: textColor,
                formatter: function(val) { return val + "%"; }
              },
              total: {
                show: true,
                label: "Total",
                fontSize: "12px",
                color: textSecondary,
                formatter: function(w) {
                  return w.globals.seriesTotals.reduce(function(a, b) { return a + b; }, 0) + "%";
                }
              }
            }
          }
        }
      },
      dataLabels: { enabled: false },
      legend: {
        position: "bottom",
        fontSize: "12px",
        labels: { colors: textSecondary },
        markers: { radius: 12 }
      },
      stroke: {
        width: 0
      },
      tooltip: {
        theme: document.documentElement.getAttribute("data-theme") === "dark" ? "dark" : "light"
      },
      responsive: [{
        breakpoint: 768,
        options: {
          chart: { height: 220 }
        }
      }]
    };
    var chartJenisBus = new ApexCharts(document.querySelector("#chartJenisBus"), optionsJenisBus);
    chartJenisBus.render();
  });
</script>
';

ob_start();
?>
      <!-- Dashboard Content -->
      <div class="row m-0 px-3 px-lg-4 pt-navbar">

        <!-- Greeting -->
        <div class="col-12 dashboard-greeting">
          <h4>Selamat Datang, <?= isset($sesName) ? htmlspecialchars($sesName) : 'Admin'; ?> 👋</h4>
          <p>Berikut ringkasan data sistem pemesanan tiket bus online hari ini</p>
        </div>

        <!-- ============ STAT CARDS ============ -->
        <!-- Card: Data Bus -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
          <div class="card stat-card bg-gradient-blue shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-bus"></i></div>
              </div>
              <div class="stat-label">Data Bus</div>
              <div class="stat-value"><?= $numBus; ?><span class="stat-unit">Bus</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Data Driver -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
          <div class="card stat-card bg-gradient-pink shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-user-pin"></i></div>
              </div>
              <div class="stat-label">Driver</div>
              <div class="stat-value">0<span class="stat-unit">Orang</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Pemesanan -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
          <div class="card stat-card bg-gradient-yellow shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-receipt"></i></div>
              </div>
              <div class="stat-label">Pemesanan</div>
              <div class="stat-value"><?= $numPemesanan; ?><span class="stat-unit">Pesanan</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Total Penghasilan -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
          <div class="card stat-card bg-gradient-green shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-wallet"></i></div>
              </div>
              <div class="stat-label">Penghasilan</div>
              <div class="stat-value">Rp <?= number_format($totalRevenue, 0, ',', '.'); ?></div>
            </div>
          </div>
        </div>

        <!-- Card: Total Rute -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
          <div class="card stat-card bg-gradient-indigo shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bx-map-alt"></i></div>
              </div>
              <div class="stat-label">Total Rute</div>
              <div class="stat-value"><?= $numRute; ?><span class="stat-unit">Rute</span></div>
            </div>
          </div>
        </div>

        <!-- Card: Penumpang Terdaftar -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
          <div class="card stat-card bg-gradient-teal shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon"><i class="bx bxs-group"></i></div>
              </div>
              <div class="stat-label">Penumpang</div>
              <div class="stat-value"><?= $numPenumpang; ?><span class="stat-unit">Orang</span></div>
            </div>
          </div>
        </div>
      </div>

      <!-- ============ MAIN CONTENT 2 COLUMNS ============ -->
      <div class="row g-4 m-0 px-3 px-lg-4 pb-5">
        
        <!-- ===== LEFT COLUMN (9) ===== -->
        <div class="col-lg-9">

          <!-- MAP Widget -->
          <div class="dashboard-card mb-4">
            <div class="dashboard-card-header">
              <h6><i class="bx bx-map"></i> Lokasi Terminal</h6>
              <span class="badge-coming">GIS Coming Soon</span>
            </div>
            <div class="dashboard-card-body p-3">
              <div class="dashboard-map">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.0431495410394!2d113.62862401436116!3d-8.198407984497482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69176d9e76d41%3A0x4e4c6e9a855a4fdf!2sTerminal%20Tawang%20Alun%20Jember!5e0!3m2!1sid!2sid!4v1637845956332!5m2!1sid!2sid"
                  allowfullscreen=""
                  loading="lazy"
                ></iframe>
              </div>
            </div>
          </div>

          <!-- CHARTS ROW: Tren Pemesanan & Distribusi Jenis Bus -->
          <div class="row g-4 mb-4">
            <div class="col-md-7 col-xl-8">
              <!-- CHART: Tren Pemesanan Bulanan -->
              <div class="dashboard-card h-100 mb-0">
                <div class="dashboard-card-header">
                  <h6><i class="bx bx-line-chart"></i> Tren Pemesanan Bulanan</h6>
                </div>
                <div class="chart-container">
                  <div id="chartPemesanan"></div>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-xl-4">
              <!-- CHART: Distribusi Jenis Bus -->
              <div class="dashboard-card h-100 mb-0">
                <div class="dashboard-card-header">
                  <h6><i class="bx bx-pie-chart-alt-2"></i> Distribusi Jenis Bus</h6>
                </div>
                <div class="chart-container" style="min-height: 260px;">
                  <div id="chartJenisBus"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- ACTIVITY: Pemesanan Terbaru -->
          <div class="dashboard-card">
            <div class="dashboard-card-header">
              <h6><i class="bx bx-history"></i> Aktivitas Pemesanan Terbaru</h6>
              <a href="dataPemesanan.php" class="text-decoration-none" style="font-size: var(--font-size-xs); color: var(--color-primary);">Lihat Semua →</a>
            </div>
            <div class="dashboard-card-body">
              <ul class="activity-list">
                <?php if(!empty($recentOrders)): ?>
                  <?php foreach($recentOrders as $order): ?>
                  <li class="activity-item">
                    <div class="activity-icon booking"><i class="bx bx-receipt"></i></div>
                    <div class="activity-body">
                      <div class="activity-title">Pemesanan #<?= isset($order['id_pemesanan']) ? $order['id_pemesanan'] : '-'; ?></div>
                      <p class="activity-desc">
                        NIK: <?= isset($order['nik_user']) ? $order['nik_user'] : '-'; ?>
                        — Total: Rp <?= isset($order['total_bayar']) ? number_format($order['total_bayar'], 0, ',', '.') : '0'; ?>
                      </p>
                    </div>
                    <span class="activity-time"><?= isset($order['waktu_pemesanan']) ? date('d M Y', strtotime($order['waktu_pemesanan'])) : '-'; ?></span>
                  </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li class="activity-item">
                    <div class="activity-icon info"><i class="bx bx-info-circle"></i></div>
                    <div class="activity-body">
                      <div class="activity-title">Belum ada data pemesanan</div>
                      <p class="activity-desc">Data pemesanan akan muncul di sini</p>
                    </div>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </div>

        </div>

        <!-- ===== RIGHT COLUMN (3) ===== -->
        <div class="col-lg-3">
          
          <!-- CALENDAR Widget -->
          <div class="dashboard-card calendar-card mb-4">
            <div class="dashboard-card-header">
              <h6><i class="bx bx-calendar"></i> Kalender</h6>
            </div>
            <div class="dashboard-card-body pt-2">
              <div class="content w-100">
                <div class="calendar-container">
                  <div class="calendar">
                    <div class="year-header">
                      <span class="left-button bx bx-chevron-left" id="prev"> </span>
                      <span class="year" id="label"></span>
                      <span class="right-button bx bx-chevron-right" id="next"> </span>
                    </div>
                    <table class="months-table w-100">
                      <tbody>
                        <tr class="months-row">
                          <td class="month">Jan</td>
                          <td class="month">Feb</td>
                          <td class="month">Mar</td>
                          <td class="month">Apr</td>
                          <td class="month">May</td>
                          <td class="month">Jun</td>
                          <td class="month">Jul</td>
                          <td class="month">Aug</td>
                          <td class="month">Sep</td>
                          <td class="month">Oct</td>
                          <td class="month">Nov</td>
                          <td class="month">Dec</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="days-table w-100">
                      <td class="day">Sun</td>
                      <td class="day">Mon</td>
                      <td class="day">Tue</td>
                      <td class="day">Wed</td>
                      <td class="day">Thu</td>
                      <td class="day">Fri</td>
                      <td class="day">Sat</td>
                    </table>
                    <div class="frame">
                      <table class="dates-table w-100">
                        <tbody class="tbody"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- QUICK STATS -->
          <div class="dashboard-card mb-4">
            <div class="dashboard-card-header">
              <h6><i class="bx bx-bar-chart-square"></i> Ringkasan Cepat</h6>
            </div>
            <div class="dashboard-card-body">
              <div class="row g-3">
                <div class="col-6">
                  <div class="quick-stat">
                    <div class="qs-icon success"><i class="bx bxs-check-circle"></i></div>
                    <div>
                      <div class="qs-label">Bus Aktif</div>
                      <div class="qs-value"><?= $busAktif; ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="quick-stat">
                    <div class="qs-icon danger"><i class="bx bxs-x-circle"></i></div>
                    <div>
                      <div class="qs-label">Bus Nonaktif</div>
                      <div class="qs-value"><?= $busNonaktif; ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="quick-stat">
                    <div class="qs-icon primary"><i class="bx bxs-cart-alt"></i></div>
                    <div>
                      <div class="qs-label">Total Pesanan</div>
                      <div class="qs-value"><?= $numPemesanan; ?> Pesanan</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- RUTE POPULER -->
          <div class="dashboard-card">
            <div class="dashboard-card-header">
              <h6><i class="bx bx-trending-up"></i> Rute Populer</h6>
            </div>
            <div class="dashboard-card-body">
              <?php
                // Fetch rute data for display
                $dataRute2 = $obj->lihatRute();
                $ruteList = [];
                while($rowR = $dataRute2->fetch(PDO::FETCH_ASSOC)){
                  $ruteList[] = $rowR;
                }
                $maxRute = count($ruteList);
                if($maxRute > 5) $maxRute = 5;
              ?>
              <?php if(!empty($ruteList)): ?>
                <?php for($ri = 0; $ri < $maxRute; $ri++): ?>
                  <?php $percentage = 100 - ($ri * 18); if($percentage < 15) $percentage = 15; ?>
                  <div class="route-item">
                    <div class="route-info">
                      <span class="route-name">
                        <i class="bx bx-map-pin"></i>
                        <?= isset($ruteList[$ri]['pemberangkatan']) ? 'Rute #'.$ruteList[$ri]['id_rute'] : 'Rute '.($ri+1); ?>
                      </span>
                      <span class="route-count"><?= rand(12, 85); ?> trip</span>
                    </div>
                    <div class="route-bar">
                      <div class="route-bar-fill" style="width: <?= $percentage; ?>%;"></div>
                    </div>
                  </div>
                <?php endfor; ?>
              <?php else: ?>
                <p class="text-center text-muted" style="font-size: var(--font-size-sm);">Belum ada data rute</p>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>


<?php
$mainContent = ob_get_clean();
require_once('layouts/main_layout.php');
?>
