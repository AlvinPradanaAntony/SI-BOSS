<?php
require ('koneksi.php');
require ('query.php');
$obj = new crud;

if(!isset($_GET['id'])) die ("Error: ID Pemesanan tidak ditemukan");

$id_pemesanan = $_GET['id'];
$query = $obj->detailPemesananLengkap($id_pemesanan);

if($query->rowCount() == 0) {
    die("Data pemesanan tidak ditemukan!");
}

// Fetch all tickets for this booking
$tickets = [];
while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $tickets[] = $row;
}
$booking = $tickets[0]; // the general info is the same for all tickets
$total_bayar = $booking['total_bayar'];

// Status styling mapping
$status = trim($booking['status']);
$statusClass = 'status-warning';
if ($status === 'Sudah Bayar') {
    $statusClass = 'status-success';
} elseif ($status === 'Pesanan Dibatalkan' || $status === 'Batal') {
    $statusClass = 'status-danger';
} else {
    $statusClass = 'status-staff';
}

// Premium badge mapping based on bus type (jenis)
$jenis_bus_raw = isset($booking['jenis']) ? strtolower(trim($booking['jenis'])) : '';
$badgeBg = 'rgba(255, 255, 255, 0.12)';
$badgeBorder = 'rgba(255, 255, 255, 0.2)';
$badgeTextColor = '#ffffff';
$badgeIcon = 'bx bx-bus';
$badgeLabel = isset($booking['jenis']) ? $booking['jenis'] : 'Umum';

if (strpos($jenis_bus_raw, 'eksekutif') !== false || strpos($jenis_bus_raw, 'executive') !== false || strpos($jenis_bus_raw, 'vip') !== false) {
    $badgeBg = 'linear-gradient(135deg, rgba(245, 158, 11, 0.25) 0%, rgba(217, 119, 6, 0.35) 100%)';
    $badgeBorder = 'rgba(253, 224, 71, 0.4)';
    $badgeTextColor = '#fef08a';
    $badgeIcon = 'bx bxs-crown';
} elseif (strpos($jenis_bus_raw, 'bisnis') !== false || strpos($jenis_bus_raw, 'business') !== false) {
    $badgeBg = 'linear-gradient(135deg, rgba(99, 102, 241, 0.25) 0%, rgba(67, 56, 202, 0.35) 100%)';
    $badgeBorder = 'rgba(199, 210, 254, 0.4)';
    $badgeTextColor = '#e0e7ff';
    $badgeIcon = 'bx bxs-award';
} elseif (strpos($jenis_bus_raw, 'patas') !== false) {
    $badgeBg = 'linear-gradient(135deg, rgba(249, 115, 22, 0.25) 0%, rgba(234, 88, 12, 0.35) 100%)';
    $badgeBorder = 'rgba(253, 186, 116, 0.4)';
    $badgeTextColor = '#ffedd5';
    $badgeIcon = 'bx bx-bolt-circle';
} elseif (strpos($jenis_bus_raw, 'ekonomi') !== false || strpos($jenis_bus_raw, 'economy') !== false) {
    $badgeBg = 'linear-gradient(135deg, rgba(16, 185, 129, 0.25) 0%, rgba(4, 120, 87, 0.35) 100%)';
    $badgeBorder = 'rgba(167, 243, 208, 0.4)';
    $badgeTextColor = '#d1fae5';
    $badgeIcon = 'bx bx-purchase-tag-alt';
}

function generateBarcodeSVG($text) {
    $code39 = [
        '0' => '000110100', '1' => '100100001', '2' => '001100001', '3' => '101100000',
        '4' => '000110001', '5' => '100110000', '6' => '001110000', '7' => '000100101',
        '8' => '100100100', '9' => '001100100', 'A' => '100001001', 'B' => '001001001',
        'C' => '101001000', 'D' => '000011001', 'E' => '100011000', 'F' => '001011000',
        'G' => '000001101', 'H' => '100001100', 'I' => '001001100', 'J' => '000011100',
        'K' => '100000011', 'L' => '001000011', 'M' => '101000010', 'N' => '000010011',
        'O' => '100010010', 'P' => '001010010', 'Q' => '000000111', 'R' => '100000110',
        'S' => '001000110', 'T' => '000010110', 'U' => '110000001', 'V' => '011000001',
        'W' => '111000000', 'X' => '010010001', 'Y' => '110010000', 'Z' => '011010000',
        '-' => '010000101', '.' => '110000100', ' ' => '011000100', '*' => '010010100',
        '$' => '010101000', '/' => '010100010', '+' => '010001010', '%' => '000101010'
    ];

    $text = '*' . strtoupper($text) . '*';
    $width = 1.8; 
    $wide_width = 4.2; 
    $gap = 1.8; 
    
    $totalWidth = 20; 
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (!isset($code39[$char])) continue;
        $pattern = $code39[$char];
        for ($j = 0; $j < 9; $j++) {
            $is_wide = ($pattern[$j] == '1');
            $totalWidth += $is_wide ? $wide_width : $width;
        }
        $totalWidth += $gap;
    }
    
    $svg = '<svg width="100%" height="55" viewBox="0 0 ' . $totalWidth . ' 55" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" class="barcode-svg">';
    $x = 10;
    
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (!isset($code39[$char])) continue;
        $pattern = $code39[$char];
        
        for ($j = 0; $j < 9; $j++) {
            $is_bar = ($j % 2 == 0);
            $is_wide = ($pattern[$j] == '1');
            $w = $is_wide ? $wide_width : $width;
            
            if ($is_bar) {
                $svg .= '<rect x="' . $x . '" y="0" width="' . $w . '" height="55" fill="currentColor" />';
            }
            $x += $w;
        }
        $x += $gap;
    }
    $svg .= '</svg>';
    return $svg;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="js/theme-init.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran - <?= htmlspecialchars($id_pemesanan) ?></title>
    
    <!-- Google Fonts & Font Stylesheet -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugin/font/stylesheet.css" />
    
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="plugin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" crossorigin="anonymous" />
    
    <!-- Design System Tokens & Components -->
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="css/components.css" />
    <link rel="stylesheet" href="css/style.css" />
    
    <style>
        /* Custom Invoice Styles - Bootstrap overrides and modifications */
        body {
            min-height: 100vh;
        }

        .container-invoice {
            max-width: 850px;
        }

        .card-invoice::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--color-primary), var(--indigo-500), var(--purple-500));
        }

        .card-invoice .border-bottom-dashed {
            border-bottom: 2px dashed var(--color-outline-variant) !important;
        }

        .card-info-detail {
            background-color: var(--color-surface-container-low) !important;
            border-color: var(--color-outline-variant) !important;
            box-shadow: none !important;
            min-height: 165px;
            max-height: 185px;
        }

        .card-info-detail .card-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--color-text-secondary);
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .card-travel {
            background: var(--gradient-teal) !important;
            border: none !important;
            box-shadow: none !important;
            min-height: 165px;
            max-height: 185px;
            color: #ffffff !important;
        }

         .card-invoice .card-travel,
         .card-invoice .card-travel *:not(.rounded-pill):not(.rounded-pill *):not(.badge-travel-bottom):not(.badge-travel-bottom *),
         .card-invoice .card-travel .fw-bold,
         .card-invoice .card-travel h6 {
             color: #ffffff !important;
         }

        .card-invoice .card-travel .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .card-invoice .card-travel .text-white-50 {
            color: rgba(255, 255, 255, 0.55) !important;
        }

        /* Animated Bus Icon Wrapper */
        @keyframes driveBus {
            0% {
                left: 0%;
                opacity: 0;
            }
            8% {
                opacity: 1;
            }
            92% {
                opacity: 1;
            }
            100% {
                left: 100%;
                opacity: 0;
            }
        }

        .bus-anim-wrapper {
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: driveBus 5s linear infinite;
        }

        .badge-travel-bottom {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 4px !important;
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            border-radius: 9999px !important;
            padding: 4px 10px !important;
            font-size: 0.72rem !important;
            line-height: 1 !important;
            height: 26px !important;
        }

        .badge-travel-bottom i {
            display: inline-flex !important;
            align-items: center !important;
            font-size: 0.85rem !important;
            color: rgba(255, 255, 255, 0.75) !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1 !important;
        }

        .badge-travel-bottom span {
            display: inline-flex !important;
            align-items: center !important;
            color: rgba(255, 255, 255, 0.75) !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1 !important;
            position: relative !important;
            top: 1px !important; /* Offset system font rendering bias */
        }

        .badge-route {
            background-color: #e0f2fe !important;
            color: #0369a1 !important;
            border-color: #bae6fd !important;
            font-size: 13.5px;
        }

        .table-responsive.border {
            border-color: var(--color-outline-variant) !important;
        }

        .table-invoice {
            --bs-table-border-color: var(--color-outline-variant) !important;
            border-color: var(--color-outline-variant) !important;
        }

        .table-invoice th,
        .table-invoice td {
            border-color: var(--color-outline-variant) !important;
        }

        .table-invoice th {
            color: var(--color-text-secondary) !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px !important;
        }

        .badge-code {
            font-family: monospace;
            font-weight: 700;
            color: var(--color-text-secondary) !important;
            background-color: var(--color-surface-variant) !important;
            padding: 4px 8px !important;
            font-size: 12px !important;
            border-radius: 6px !important;
        }

        .badge-seat {
            background-color: #e0f2fe !important;
            color: #0369a1 !important;
            font-weight: 700 !important;
            padding: 4px 10px !important;
            font-size: 12px !important;
            border-radius: 9999px !important;
        }

        .card-total {
            background-color: var(--color-success-container) !important;
            border-color: color-mix(in srgb, var(--color-success) 35%, var(--color-outline-variant)) !important;
            color: var(--color-on-success-container) !important;
        }

        .card-total .fw-bolder {
            font-size: 20px !important;
        }

        /* Ensure texts inside card-total remain success-colored */
        .card-invoice .card-total,
        .card-invoice .card-total *,
        .card-invoice .card-total .fw-bold,
        .card-invoice .card-total .fw-bolder {
            color: var(--color-on-success-container) !important;
        }

        .card-footnote {
            background-color: light-dark(var(--purple-50), color-mix(in srgb, var(--purple-700) 15%, var(--neutral-900))) !important;
            border-left: 4px solid light-dark(var(--purple-400), var(--purple-500)) !important;
            color: light-dark(var(--purple-700), var(--purple-200)) !important;
            font-size: 12.5px;
            line-height: 1.6;
        }

        .card-invoice .card-footnote strong {
            color: light-dark(var(--purple-700), var(--purple-300)) !important;
        }

        /* Ensure proper text colors in light/dark themes */
        .card-invoice {
            background-color: var(--color-surface) !important;
            color: var(--color-text-primary) !important;
        }
        .card-invoice h5, 
        .card-invoice h6, 
        .card-invoice th, 
        .card-invoice td,
        .card-invoice .fw-bold {
            color: var(--color-text-primary) !important;
        }
        .card-invoice .text-secondary {
            color: var(--color-text-secondary) !important;
        }
        .card-invoice .text-body {
            color: var(--color-text-primary) !important;
        }
        .logo-invoice {
            height: 42px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }
        @media (max-width: 576px) {
            .logo-invoice {
                height: 32px;
            }
        }

        /* Print Override */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                color: #000000 !important;
            }
            .container-invoice {
                max-width: 100% !important;
                padding: 0 !important;
            }
            .card-invoice {
                box-shadow: none !important;
                border: none !important;
            }
            .card-invoice::before, .no-print {
                display: none !important;
            }
            .card-info-detail,
            .card-travel {
                background: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
                max-height: none !important;
            }
            .card-travel *,
            .card-invoice .card-travel *,
            .card-invoice .card-travel .fw-bold,
            .card-invoice .card-travel .text-white,
            .card-invoice .card-travel .text-white-50,
            .card-invoice .card-travel .text-white-75,
            .card-invoice .card-travel span,
            .card-invoice .card-travel div {
                color: #000000 !important;
                opacity: 1 !important;
            }
            .card-invoice .card-travel .position-absolute.top-50 {
                border-top: 2px dashed #000000 !important;
            }
            .card-invoice .card-travel .badge-travel-bottom {
                background: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
            }
            .card-invoice .card-travel .badge-travel-bottom i,
            .card-invoice .card-travel .badge-travel-bottom span {
                color: #000000 !important;
            }
            .card-invoice .card-travel .rounded-circle.bg-white.bg-opacity-25 {
                background-color: #f1f5f9 !important;
                border: 1px solid #cbd5e1 !important;
            }
            .card-invoice .card-travel .rounded-circle.bg-white.bg-opacity-25 i {
                color: #000000 !important;
            }
            .bus-icon-middle {
                filter: none !important;
                opacity: 1 !important;
            }
            .bus-anim-wrapper {
                animation: none !important;
                left: 50% !important;
                position: relative !important;
                transform: none !important;
                top: auto !important;
                display: inline-flex !important;
            }
            .card-travel .rounded-pill {
                background: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
            }
            .card-travel .rounded-pill *,
            .card-travel .rounded-pill i,
            .card-travel .rounded-pill span {
                color: #000000 !important;
            }
            .badge-route {
                background: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
                color: #000000 !important;
            }
            .card-total {
                background: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
                color: #000000 !important;
            }
            .card-total * {
                color: #000000 !important;
            }
            .table th {
                background-color: #ffffff !important;
                border-bottom: 2px solid #000000 !important;
                color: #000000 !important;
            }
            .table td {
                border-bottom: 1px solid #cbd5e1 !important;
                color: #000000 !important;
            }
            .badge {
                border: 1px solid #000 !important;
                color: #000 !important;
                background: #fff !important;
            }
        }

        /* Table Action Button overrides for Primary Circle button */
        .table .btn-primary.btn-circle {
            background-color: color-mix(in srgb, var(--color-primary) 12%, var(--color-surface)) !important;
            color: var(--color-primary) !important;
        }
        .table .btn-primary.btn-circle:hover {
            background-color: var(--color-primary) !important;
            color: var(--color-on-primary) !important;
            box-shadow: 0 2px 8px rgba(82, 123, 221, 0.25) !important;
        }
        .table .btn-primary.btn-circle i {
            font-size: 1.15rem !important;
        }

        /* E-Ticket Card Styles */
        .ticket-modal-content {
            background-color: transparent !important;
            border: none !important;
        }
        .ticket-card {
            background-color: transparent !important;
            border: none !important;
            filter: drop-shadow(0 15px 35px rgba(0, 0, 0, 0.35));
            overflow: visible;
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
            position: relative;
            color: var(--color-text-primary) !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .ticket-section {
            padding: 24px 28px;
        }
        .ticket-top {
            border-top-left-radius: 24px;
            border-top-right-radius: 24px;
            background: 
                radial-gradient(circle at 0px 100%, transparent 12px, var(--color-surface) 13px) bottom left / 51% 100% no-repeat,
                radial-gradient(circle at 100% 100%, transparent 12px, var(--color-surface) 13px) bottom right / 51% 100% no-repeat;
        }
        .ticket-middle {
            background: 
                radial-gradient(circle at 0px 0px, transparent 12px, var(--color-surface) 13px) top left / 51% 50.5% no-repeat,
                radial-gradient(circle at 100% 0%, transparent 12px, var(--color-surface) 13px) top right / 51% 50.5% no-repeat,
                radial-gradient(circle at 0px 100%, transparent 12px, var(--color-surface) 13px) bottom left / 51% 50.5% no-repeat,
                radial-gradient(circle at 100% 100%, transparent 12px, var(--color-surface) 13px) bottom right / 51% 50.5% no-repeat;
        }
        .ticket-bottom {
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
            padding-bottom: 28px;
            background: 
                radial-gradient(circle at 0px 0px, transparent 12px, var(--color-surface) 13px) top left / 51% 100% no-repeat,
                radial-gradient(circle at 100% 0%, transparent 12px, var(--color-surface) 13px) top right / 51% 100% no-repeat;
        }
        .ticket-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--color-text-secondary) !important;
            margin-bottom: 4px;
            line-height: 1;
        }
        .ticket-top .ticket-label {
            margin-bottom: 0 !important;
        }
        .ticket-passenger-name {
            font-size: 20px;
            font-weight: 800;
            color: var(--color-text-primary) !important;
        }
        .ticket-route-badge {
            background: linear-gradient(135deg, rgba(52, 123, 221, 0.15) 0%, rgba(99, 102, 241, 0.15) 100%);
            border: 1px solid rgba(99, 102, 241, 0.25);
            color: var(--color-text-link) !important;
            border-radius: 9999px;
            padding: 3px 10px;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.5px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
        }
        .ticket-time {
            font-size: 18px;
            font-weight: 800;
            color: var(--color-text-primary) !important;
        }
        .ticket-time-zone {
            font-size: 10px;
            font-weight: 600;
            color: var(--color-text-secondary) !important;
        }
        .ticket-duration-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .ticket-duration-text {
            font-size: 11px;
            font-weight: 700;
            color: var(--color-text-secondary) !important;
            margin-bottom: 2px;
        }
        .ticket-route-line-container {
            display: flex;
            align-items: center;
            width: 100%;
            position: relative;
            height: 16px;
        }
        .ticket-dot-start {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--color-text-primary);
            flex-shrink: 0;
        }
        .ticket-dot-end {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            border: 2px solid var(--color-text-primary);
            background-color: var(--color-surface);
            flex-shrink: 0;
        }
        .ticket-line-solid {
            height: 2px;
            background-color: var(--color-text-primary);
            flex-grow: 1;
        }
        .ticket-line-dashed {
            height: 2px;
            border-top: 2px dashed var(--color-outline);
            flex-grow: 1;
        }
        .ticket-route-icon {
            padding: 0 6px;
            color: var(--color-text-primary) !important;
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ticket-city-code {
            font-size: 16px;
            font-weight: 800;
            color: var(--color-text-primary) !important;
            margin-top: 2px;
        }
        .ticket-city-name {
            font-size: 11px;
            font-weight: 500;
            color: var(--color-text-secondary) !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .ticket-ref-value {
            font-size: 15px;
            font-weight: 800;
            color: var(--color-text-primary) !important;
        }
        .ticket-detail-val {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--color-text-primary) !important;
        }
        
        /* Notch & Dash Divider styling */
        .ticket-divider-container {
            position: relative;
            height: 0;
            background-color: transparent !important;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        .ticket-dash {
            width: calc(100% - 24px);
            border-top: 2px dashed var(--color-outline) !important;
            height: 0;
            z-index: 4;
        }
        
        .barcode-wrapper {
            max-width: 250px;
            color: var(--color-text-primary) !important;
        }
        .barcode-svg {
            color: var(--color-text-primary) !important;
        }
        .ticket-id-val {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--color-text-secondary) !important;
            font-family: monospace;
            margin-top: 6px;
        }
    </style>
</head>
<body>
    <div class="container container-invoice py-4 py-md-5">
        <div class="card card-invoice shadow-lg border rounded-4 position-relative overflow-hidden">
            <div class="card-body p-3 p-sm-4 p-md-5">
                <!-- Header -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 pb-4 mb-4 border-bottom border-2 border-bottom-dashed">
                    <div>
                        <img src="img/logo2.svg" alt="SI-BOSS Logo" class="logo-invoice mb-2" />
                        <p class="text-secondary mb-0 fw-medium fs-sm">E Ticket & Tanda Terima Pembayaran Resmi</p>
                    </div>
                    <div class="text-start text-sm-end">
                        <div class="mb-2">
                            <span class="badge badge-status <?= $statusClass ?>"><?= $status ?></span>
                        </div>
                        <h5 class="fw-bold mb-1 fs-6">Invoice: #<?= htmlspecialchars($booking['id_pemesanan']) ?></h5>
                        <small class="text-secondary fw-semibold d-block">
                            Tanggal: <?= date('d M Y, H:i', strtotime($booking['waktu_pemesanan'])) ?>
                        </small>
                    </div>
                </div>

                <!-- Customer & Trip Info -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-md-6">
                        <div class="card card-info-detail h-100 border rounded-4 shadow-none">
                            <div class="card-body p-3 p-md-4 d-flex flex-column justify-content-center">
                                <h6 class="card-title text-secondary mb-2">INFORMASI PEMESAN</h6>
                                <div class="row g-0 mb-2 align-items-baseline" style="font-size: 0.86rem;">
                                    <div class="col-4 col-sm-3 text-secondary">Nama</div>
                                    <div class="col-8 col-sm-9 fw-bold text-break"><?= htmlspecialchars($booking['nama_user']) ?></div>
                                </div>
                                <div class="row g-0 align-items-baseline" style="font-size: 0.86rem;">
                                    <div class="col-4 col-sm-3 text-secondary">No. HP</div>
                                    <div class="col-8 col-sm-9 fw-bold text-break"><?= htmlspecialchars($booking['no_hp_user']) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="card card-travel h-100 border-0 rounded-4 shadow-none overflow-hidden">
                            <div class="card-body p-3 d-flex flex-column justify-content-between h-100">
                                <!-- Top Row: Bus Name & Type Badge -->
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px;">
                                            <i class="bx bx-bus text-white fs-6"></i>
                                        </div>
                                        <div class="d-flex flex-column lh-1">
                                            <span class="text-white-50 mb-1" style="font-size: 0.68rem;">Nama Bus</span>
                                            <span class="fw-bold text-white text-truncate" style="font-size: 0.85rem; max-width: 135px;" title="<?= htmlspecialchars($booking['nama_bus']) ?>"><?= htmlspecialchars($booking['nama_bus']) ?></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-1 rounded-pill px-2 py-1 flex-shrink-0" style="background: <?= $badgeBg ?>; border: 1px solid <?= $badgeBorder ?>;">
                                        <i class="<?= $badgeIcon ?> fs-6" style="color: <?= $badgeTextColor ?>;"></i>
                                        <span class="fw-semibold" style="font-size: 0.72rem; color: <?= $badgeTextColor ?>;"><?= htmlspecialchars($badgeLabel) ?></span>
                                    </div>
                                </div>
                                
                                <!-- Middle Row: Origin -> Route Line -> Destination -->
                                <div class="d-flex justify-content-between align-items-center my-auto py-1">
                                    <div class="text-start flex-shrink-1" style="max-width: 42%;">
                                        <div class="fw-bold text-white text-truncate" style="font-size: 0.94rem;" title="<?= htmlspecialchars($booking['terminal_asal']) ?>"><?= htmlspecialchars($booking['terminal_asal']) ?></div>
                                        <div class="text-white-50" style="font-size: 0.74rem;"><?= date('H:i', strtotime($booking['waktu_berangkat'])) ?> WIB</div>
                                    </div>
                                    
                                    <div class="flex-grow-1 px-3 d-flex flex-column align-items-center justify-content-center position-relative" style="min-width: 100px;">
                                        <div class="w-100 position-relative" style="height: 36px;">
                                            <!-- Dashed Line -->
                                            <div class="w-100 position-absolute top-50 start-0 translate-middle-y" style="border-top: 2px dashed rgba(255, 255, 255, 0.4); height: 0;"></div>
                                            <!-- Animated Wrapper containing the bus icon -->
                                            <div class="bus-anim-wrapper">
                                                <img src="img/bus.svg" class="bus-icon-middle" alt="Bus Icon" style="width: 30px; height: 30px; filter: brightness(0) invert(1); opacity: 0.85;" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end flex-shrink-1" style="max-width: 42%;">
                                        <div class="fw-bold text-white text-truncate" style="font-size: 0.94rem;" title="<?= htmlspecialchars($booking['terminal_tujuan']) ?>"><?= htmlspecialchars($booking['terminal_tujuan']) ?></div>
                                        <div class="text-white-50" style="font-size: 0.74rem;"><?= date('H:i', strtotime($booking['waktu_tiba'])) ?> WIB</div>
                                    </div>
                                </div>
                                
                                <!-- Bottom Row: Passengers & Date -->
                                <div>
                                    <hr class="my-1 border-white opacity-25">
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <div class="badge-travel-bottom flex-shrink-0">
                                            <i class="bx bx-user"></i>
                                            <span class="fw-medium"><?= count($tickets) ?> Penumpang</span>
                                        </div>
                                        <div class="badge-travel-bottom flex-shrink-0">
                                            <i class="bx bx-calendar"></i>
                                            <span class="fw-medium"><?= date('d M Y', strtotime($booking['tanggal_pemberangkatan'])) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passengers / Tickets -->
                <h6 class="fw-bold mb-3">Detail Tiket & Penumpang</h6>
                <div class="table-responsive border rounded-3 mb-4">
                    <table class="table table-invoice table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="py-3 px-3">NO. TIKET</th>
                                <th class="py-3 px-3">NAMA PENUMPANG</th>
                                <th class="py-3 px-3">JENIS KELAMIN</th>
                                <th class="py-3 px-3 text-center">KURSI</th>
                                <th class="py-3 px-3 text-end">HARGA / KURSI</th>
                                <th class="py-3 px-3 text-center no-print">E-TIKET</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tickets as $t): ?>
                            <tr>
                                <td class="px-3"><span class="badge badge-code">APBTRM000<?= htmlspecialchars($t['id_tiket']) ?></span></td>
                                <td class="px-3 fw-bold text-uppercase"><?= htmlspecialchars($t['nama_penumpang']) ?></td>
                                <td class="px-3 text-secondary"><?= htmlspecialchars($t['jenis_kelamin_penumpang']) ?></td>
                                <td class="px-3 text-center"><span class="badge badge-seat"><?= htmlspecialchars($t['jumlah_kursi_pesan']) ?></span></td>
                                <td class="px-3 text-end fw-bold">Rp <?= number_format($t['harga'], 0, ',', '.') ?></td>
                                <td class="px-3 text-center no-print">
                                    <button type="button" class="btn btn-primary btn-user btn-circle" data-bs-toggle="modal" data-bs-target="#ticketModal<?= $t['id_tiket'] ?>" data-bs-toggle="tooltip" title="Lihat E-Tiket">
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Summary -->
                <div class="row justify-content-end mb-4">
                    <div class="col-12 col-md-6 col-lg-5">
                        <div class="d-flex justify-content-between align-items-center py-2 px-1 text-secondary">
                            <span>Subtotal Pembayaran</span>
                            <span class="fw-bold text-body">Rp <?= number_format($total_bayar, 0, ',', '.') ?></span>
                        </div>
                        <div class="card card-total border rounded-3 p-3 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">TOTAL DIBAYAR</span>
                                <span class="fw-bolder">Rp <?= number_format($total_bayar, 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footnote / Policy -->
                <div class="card card-footnote border-0 border-start border-4 rounded-3 p-3 mb-4">
                    <div>
                        <strong>Informasi Penting:</strong> E-Ticket ini merupakan bukti transaksi yang sah dari <strong>SI-BOSS EXPRESS</strong>. Silakan tunjukkan struk ini pada petugas di gerbang boarding terminal minimal 30 menit sebelum keberangkatan untuk ditukarkan dengan boarding pass fisik.
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-3 pt-4 border-top no-print">
                    <a href="dataPemesanan.php" class="btn btn-secondary d-inline-flex align-items-center justify-content-center gap-2">
                        <i class="bx bx-arrow-back fs-5"></i>
                        Kembali Ke Pemesanan
                    </a>
                    <button onclick="window.print()" class="btn btn-primary btn-shadow d-inline-flex align-items-center justify-content-center gap-2">
                        <i class="bx bx-printer fs-5"></i>
                        Cetak Struk Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Container for E-Tickets -->
    <?php foreach($tickets as $t): 
        // Calculate travel duration
        $waktu_berangkat = date_create($t['waktu_berangkat']);
        $waktu_tiba = date_create($t['waktu_tiba']);
        $diff = date_diff($waktu_berangkat, $waktu_tiba);
        $durasi = $diff->format('%h j %i m');
        
        // Define route code (first 3 letters of city name)
        $asal_code = strtoupper(substr($t['terminal_asal'], 0, 3));
        $tujuan_code = strtoupper(substr($t['terminal_tujuan'], 0, 3));
    ?>
    <div class="modal fade" id="ticketModal<?= $t['id_tiket'] ?>" tabindex="-1" aria-labelledby="ticketModalLabel<?= $t['id_tiket'] ?>" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(15, 23, 42, 0.3);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ticket-modal-content">
                <div class="modal-body p-0">
                    <div class="ticket-card mx-auto">
                        <!-- Top Row: Passenger & Route -->
                        <div class="ticket-section ticket-top">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="ticket-label">Passenger</span>
                                <span class="ticket-route-badge text-uppercase"><?= htmlspecialchars($t['jenis']) ?> Class</span>
                            </div>
                            <h4 class="ticket-passenger-name text-uppercase mb-3"><?= htmlspecialchars($t['nama_penumpang']) ?></h4>
                            
                            <!-- Route Line & Times -->
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="ticket-time"><?= date('H:i', strtotime($t['waktu_berangkat'])) ?> <span class="ticket-time-zone">WIB</span></div>
                                <div class="ticket-duration-container flex-grow-1 px-3">
                                    <span class="ticket-duration-text"><?= $durasi ?></span>
                                    <div class="ticket-route-line-container">
                                        <div class="ticket-dot-start"></div>
                                        <div class="ticket-line-solid"></div>
                                        <div class="ticket-route-icon"><i class="bx bxs-bus"></i></div>
                                        <div class="ticket-line-dashed"></div>
                                        <div class="ticket-dot-end"></div>
                                    </div>
                                </div>
                                <div class="ticket-time"><?= date('H:i', strtotime($t['waktu_tiba'])) ?> <span class="ticket-time-zone">WIB</span></div>
                            </div>
                            
                            <!-- Cities -->
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="ticket-city-container text-start" style="width: 45%;">
                                    <div class="ticket-city-code"><?= $asal_code ?></div>
                                    <div class="ticket-city-name text-truncate" style="max-width: 100%;" title="<?= htmlspecialchars($t['terminal_asal']) ?>"><?= htmlspecialchars($t['terminal_asal']) ?></div>
                                </div>
                                <div class="ticket-city-container text-end" style="width: 45%;">
                                    <div class="ticket-city-code"><?= $tujuan_code ?></div>
                                    <div class="ticket-city-name text-truncate" style="max-width: 100%;" title="<?= htmlspecialchars($t['terminal_tujuan']) ?>"><?= htmlspecialchars($t['terminal_tujuan']) ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- Divider 1 -->
                        <div class="ticket-divider-container">
                            <div class="ticket-dash"></div>
                        </div>

                        <!-- Middle Row: Details -->
                        <div class="ticket-section ticket-middle">
                            <div class="mb-3">
                                <span class="ticket-label d-block">Booking Reference</span>
                                <span class="ticket-ref-value text-uppercase">#<?= htmlspecialchars($t['id_pemesanan']) ?></span>
                            </div>
                            
                            <div class="row g-2">
                                <div class="col-4">
                                    <span class="ticket-label d-block">Tanggal</span>
                                    <span class="ticket-detail-val"><?= date('d/m/Y', strtotime($t['tanggal_pemberangkatan'])) ?></span>
                                </div>
                                <div class="col-5">
                                    <span class="ticket-label d-block">Bus</span>
                                    <span class="ticket-detail-val text-truncate d-block" title="<?= htmlspecialchars($t['nama_bus']) ?>"><?= htmlspecialchars($t['nama_bus']) ?></span>
                                </div>
                                <div class="col-3 text-end">
                                    <span class="ticket-label d-block">Seat</span>
                                    <span class="ticket-detail-val font-monospace"><?= htmlspecialchars($t['jumlah_kursi_pesan']) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Divider 2 -->
                        <div class="ticket-divider-container">
                            <div class="ticket-dash"></div>
                        </div>

                        <!-- Bottom Row: Barcode -->
                        <div class="ticket-section ticket-bottom text-center">
                            <div class="barcode-wrapper mx-auto mb-2">
                                <?= generateBarcodeSVG('APBTRM000' . $t['id_tiket']) ?>
                            </div>
                            <div class="ticket-id-val">APBTRM000<?= htmlspecialchars($t['id_tiket']) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Load Bootstrap JS bundle -->
    <script src="plugin/js/bootstrap.bundle.min.js"></script>
</body>
</html>