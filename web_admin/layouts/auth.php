<?php
require_once('koneksi.php');
require_once('query.php');
if (!isset($obj)) {
    $obj = new crud;
}

if (session_id() == '') {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

$sesID = $_SESSION['id'];
$sesName = $_SESSION['name'];
$sesJK = $_SESSION['jk'];
$sesAlamat = $_SESSION['alamat'];
$sesNoHP = $_SESSION['noHP'];
$sesTerminal = $_SESSION['terminal'];
$sesEmail = $_SESSION['email'];
$sesPass = $_SESSION['pass'];
$sesLvl = $_SESSION['level'];
$sesFoto = $_SESSION['foto'];
?>
