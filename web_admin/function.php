<?php
require('koneksi.php');
require('query.php');
$obj = new crud;

session_start();

// Aksi tombol login
if (isset($_POST['login'])) {
	$email = $_POST['txt_email'];
	$password = $_POST['txt_password'];
	$rememberMe = !empty($_POST['check_remember']) ? $_POST['check_remember'] : '';

	if (!empty(trim($email)) && !empty(trim($password))) {
		$query = $obj->login($email);
		$num = $query->rowCount();

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$id_user_admin = $row['id_user_admin'];
			$nama = $row['nama'];
			$jk = $row['jenis_kelamin'];
			$alamat = $row['alamat'];
			$noHP = $row['no_hp'];
			$terminal = $row['id_terminal'];
			$emailVal = $row['email'];
			$passwordVal = $row['password'];
			$level = $row['id_level'];
			$foto = $row['foto'];
		}

		if ($num != 0) {
			if ($emailVal == $email && $passwordVal == $password) {
				$_SESSION['id'] = $id_user_admin;
				$_SESSION['name'] = $nama;
				$_SESSION['jk'] = $jk;
				$_SESSION['alamat'] = $alamat;
				$_SESSION['noHP'] = $noHP;
				$_SESSION['terminal'] = $terminal;
				$_SESSION['email'] = $emailVal;
				$_SESSION['pass'] = $passwordVal;
				$_SESSION['level'] = $level;
				$_SESSION['foto'] = $foto;


				if ($rememberMe == 1) {
					$cookie_name = "cookie_id";
					$cookie_value = $id_user_admin;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_name";
					$cookie_value = $nama;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_jk";
					$cookie_value = $jk;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_alamat";
					$cookie_value = $alamat;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_noHP";
					$cookie_value = $noHP;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_terminal";
					$cookie_value = $terminal;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_email";
					$cookie_value = $emailVal;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_password";
					$cookie_value = $passwordVal;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_level";
					$cookie_value = $level;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");

					$cookie_name = "cookie_foto";
					$cookie_value = $foto;
					$cookie_time = time() + 1800; //30 menit
					setcookie($cookie_name, $cookie_value, $cookie_time, "/");
				}
				header('Location: dashboard.php');
			} else {
				$_SESSION['info'] = 'statusErrorPass';
				header('Location: index.php');
			}
		} else {
			$_SESSION['info'] = 'statusNotFound';
			header('Location: index.php');
		}
	} else {
		$_SESSION['info'] = 'statusEmpty';
		header('Location: index.php');
	}
}

// Aksi tombol daftar
if (isset($_POST['daftar'])) {
	$_POST['id_level'] = 2;
	$nama = $_POST['txt_nama'];
	$jenis_kelamin = $_POST['Rbtn_jenis_kelamin'];
	$alamat = $_POST['txt_alamat'];
	$no_hp = $_POST['txt_no_hp'];
	$level = $_POST['id_level'];
	$id_terminal = $_POST['id_terminal'];
	$email = $_POST['txt_email'];
	$password = $_POST['txt_password'];
	$data = $obj->ValidasiEmail($email);
  if ($data->rowCount() > 0) {
    $_SESSION['info'] = 'EmailHasBeenTaken';
    header('Location: registrasi.php');
  }else if ($obj->insertAdministrato($nama, $jenis_kelamin, $alamat, $no_hp, $level, $id_terminal, $email, $password)) {
			$_SESSION['info'] = 'statusSignUp';
			header('Location: index.php');
		} else {
			$_SESSION['info'] = 'error';
			header('Location: registrasi.php');
		}

}

// Fungsi
function systemCookies()
{
	$obj = new crud;
	$cookieEmail = $_COOKIE['cookie_email'];
	$cookiePass = $_COOKIE['cookie_password'];
	$cookieName = $_COOKIE['cookie_name'];
	$cookieId = $_COOKIE['cookie_id'];
	$cookieJK = $_COOKIE['cookie_jk'];
	$cookieAlamat = $_COOKIE['cookie_alamat'];
	$cookieNoHP = $_COOKIE['cookie_noHP'];
	$cookieTerminal = $_COOKIE['cookie_terminal'];
	$cookieLevel = $_COOKIE['cookie_level'];
	$cookieFoto = $_COOKIE['cookie_foto'];
	$queryCookie = $obj->login($cookieEmail);
	while ($row = $queryCookie->fetch(PDO::FETCH_ASSOC)) {
		$id_user_admin = $row['id_user_admin'];
		$nama = $row['nama'];
		$jk = $row['jenis_kelamin'];
		$alamat = $row['alamat'];
		$noHP = $row['no_hp'];
		$terminal = $row['id_terminal'];
		$emailVal = $row['email'];
		$passwordVal = $row['password'];
		$level = $row['id_level'];
		$foto = $row['foto'];
	}

	if ($emailVal == $cookieEmail && $passwordVal == $cookiePass) {
		$_SESSION['id'] = $cookieId;
		$_SESSION['name'] = $cookieName;
		$_SESSION['email'] = $cookieEmail;
		$_SESSION['pass'] = $cookiePass;
		$_SESSION['jk'] = $cookieJK;
		$_SESSION['alamat'] = $cookieAlamat;
		$_SESSION['noHP'] = $cookieNoHP;
		$_SESSION['terminal'] = $cookieTerminal;
		$_SESSION['level'] = $cookieLevel;
		$_SESSION['foto'] = $cookieFoto;
	}

	if (isset($_SESSION['email'])) {
		header('Location: dashboard.php');
	}
}
