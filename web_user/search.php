<?php
require 'function.php';
$filter = mysqli_query($koneksi, "SELECT * FROM wberangkat");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-BOSS</title>
    <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

  <!-- Bootstrap core CSS -->

<link rel="stylesheet" type="text/css" href="css/custom.css">
<script src="js/bootstrap.min.js"> </script>
<script src="jquery/jquery-.3.6.js"> </script>
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>
</head>
<body class="bg-custom">
    <div class="b-example-divider"></div>

    <div class="container-fluid "> 
      <header class="d-flex flex-wrap fixed-top bg-light align-items-center justify-content-center justify-content-md-between py-3 border-bottom">

        <a href="/" class="d-flex align-items-center col-md-3 mb-2 me-3 mb-md-0 ms-5 text-dark text-decoration-none">
          <img src="assets/img/logo.png" class="img-fluid rounded-start " alt="...">
        </a>
  
        <ul class="nav col-12 col-md-auto mb-2 justify-content- mb-md-0">
          <li><a href="#" class="nav-link px-2 link-dark">Home</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Booking</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Help</a></li>
        </ul>
  
        <div class="col-md-3 text-end me-5">
          <button type="button" class="custBtn btn btn-outline-primary me-2">Login</button>
          <button type="button" class="custBtn btn btn-primary">Sign-up</button>
        </div>

      </header>
    </div>

    <div class="cari">
        <span class= "spancari" > Asal: </span>
        <span class= "spancari1" > Tujuan: </span>
        <span class= "spancari2" > Tanggal: </span>
      <div class="location">
        <img src="assets/img/loc.png" class="img-fluid rounded-start " alt="...">
 </div>
    <select class="form-select select1" aria-label="Default select example">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>

    <div class="location1">
      <img src="assets/img/loc.png" class="img-fluid rounded-start " alt="...">
</div>
  <select class="form-select select2" aria-label="Default select example">
    <option selected>Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>

  <div class="location2">
    <img src="assets/img/shuffle.png" class="img-fluid rounded-start " alt="...">
</div>

    <div class= "mb-2">
      <input class="form-control form-control-userp1" type="date" placeholder="yy-mm-dddd">

      <div class="d-flex justify-content-center mt-3 search">
        <button type="button" name="button" class="btn akun_btn4">Cari</button>

    </div>

    </div>
     
    <div class = "filter">
      <div class= "row">

      </div>
    </div>

    <div class = "filter1">   
      <div class= "row">
        
      </div>
    </div>

    <div class = "filter2">
      <div class= "row">
        
      </div>
    </div>

    <div class = "filter3">
      <div class= "row">
        
      </div>
    </div>

    <div class = "filter4">
      <div class= "row">
        
      </div>
    </div>

    <div class = "filter5">
      <div class= "row">
        
      </div>
    </div>

    <div class = "filter6">
      <div class= "row">
        
      </div>
    </div>