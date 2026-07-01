const notifikasi = $('.info-data').data('infodata');

if(notifikasi == "berhasil"){
	Swal.fire({
	  icon: 'success',
	  title: 'Login Berhasil !',
	  text: 'Anda '+notifikasi+' Login !, Klik OK untuk melanjutkan ke halaman berikutnya.',
	})
}else if(notifikasi == "statusEdit"){
	Swal.fire({
	  icon: 'success',
	  title: 'Update berhasil !',
	  text: 'Anda telah berhasil melakukan pembaruan data !',
	})
}else if(notifikasi == "statusSignUp"){
	Swal.fire({
	  icon: 'success',
	  title: 'Pendaftaran Akun berhasil !',
	  text: 'Anda berhasil melakukan pendaftaran akun, dan sekarang Anda dapat login !',
	})
}else if(notifikasi == "Dihapus"){
	Swal.fire({
		icon: 'success',
		title: 'Sukses',
		text: 'Data Berhasil '+ notifikasi,
	})
}else if(notifikasi == "Gagal Dihapus"){
	Swal.fire({
		icon: 'error',
	  title: 'GAGAL',
	  text: 'Data '+ notifikasi,
	})
}else if(notifikasi == "statusErrorPass"){
	Swal.fire({
	  icon: 'error',
	  title: 'Kata sandi salah !',
	  text: 'Silakan coba kembali, masukan kata sandi yang benar !',
	})
}else if(notifikasi == "statusNotFound"){
	Swal.fire({
	  icon: 'error',
	  title: 'Email salah/tidak ditemukan',
	  text: 'Silakan masukan email yang sudah terdaftar !',
	})
}else if(notifikasi == "statusEmpty"){
	Swal.fire({
	  icon: 'error',
	  title: 'Email dan Password kosong !',
	  text: 'Harap email dan password di isi !',
	})
}else if(notifikasi == "error"){
	Swal.fire({
	  icon: 'error',
	  title: 'Ada kesalahan !',
	  text: 'Periksa kembali data yang dimasukkan, lalu coba lagi klik daftar untuk menyelesaikan pembuatan akun !',
	})
}else if(notifikasi == "EmailHasBeenTaken"){
	Swal.fire({
	  icon: 'error',
	  title: 'Email sudah tersedia !',
	  text: 'Email ini sudah didaftarkan atau sudah digunakan, Harap menggunakan email lain !',
	})
}

$('.delete-data').on('click', function(e){
	e.preventDefault();
	var getLink = $(this).attr('href');

	Swal.fire({
	  title: 'Hapus Data?',
	  text: "Data akan dihapus permanen",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Hapus'
	}).then((result) => {
	  if (result.value) {
	    window.location.href = getLink;
	  }
	})
});