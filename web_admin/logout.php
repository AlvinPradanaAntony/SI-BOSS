<?php
session_start();
session_destroy();

$cookie_name = "cookie_id";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_name";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_jk";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_alamat";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_noHP";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_terminal";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_email";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_password";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_level";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");

$cookie_name = "cookie_foto";
$cookie_value = "";
$cookie_time = time() - (60 * 60 * 24); //1 hari
setcookie($cookie_name, $cookie_value, $cookie_time, "/");
header("Location: index.php");
