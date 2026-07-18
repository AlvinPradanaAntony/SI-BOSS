function tampilkanAlert(key) {
	if(key == "statusEdit"){
		Swal.fire({
		  icon: 'success',
		  title: 'Update berhasil !',
		  text: 'Anda telah berhasil melakukan pembaruan data !',
		})
	}else if(key == "statusSignUp"){
		Swal.fire({
		  icon: 'success',
		  title: 'Pendaftaran Akun berhasil !',
		  text: 'Anda berhasil melakukan pendaftaran akun, dan sekarang Anda dapat login !',
		})
	}else if(key == "Dihapus"){
		Swal.fire({
			icon: 'success',
			title: 'Sukses',
			text: 'Data Berhasil Dihapus',
		})
	}else if(key == "Gagal Dihapus"){
		Swal.fire({
			icon: 'error',
		  title: 'GAGAL',
		  text: 'Data Gagal Dihapus',
		})
	}else if(key == "statusErrorPass"){
		Swal.fire({
		  icon: 'error',
		  title: 'Kata sandi salah !',
		  text: 'Silakan coba kembali, masukan kata sandi yang benar !',
		})
	}else if(key == "statusNotFound"){
		Swal.fire({
		  icon: 'error',
		  title: 'Email salah/tidak ditemukan',
		  text: 'Silakan masukan email yang sudah terdaftar !',
		})
	}else if(key == "statusEmpty"){
		Swal.fire({
		  icon: 'error',
		  title: 'Email dan Password kosong !',
		  text: 'Harap email dan password di isi !',
		})
	}else if(key == "error"){
		Swal.fire({
		  icon: 'error',
		  title: 'Ada kesalahan !',
		  text: 'Periksa kembali data yang dimasukkan, lalu coba lagi klik daftar untuk menyelesaikan pembuatan akun !',
		})
	}else if(key == "EmailHasBeenTaken"){
		Swal.fire({
		  icon: 'error',
		  title: 'Email sudah tersedia !',
		  text: 'Email ini sudah didaftarkan atau sudah digunakan, Harap menggunakan email lain !',
		})
	}
}

const notifikasi = $('.info-data').data('infodata');
if (notifikasi) {
	tampilkanAlert(notifikasi);
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

$(document).ready(function() {
  if ($('.auth-card form.custom-validation').length) {
    $('.auth-card form.custom-validation').parsley().on('form:submit', function() {
      var form = this.$element;
      var formData = form.serialize();
      
      if (form.find('button[name="login"]').length) {
        formData += '&login=1';
      } else if (form.find('button[name="daftar"]').length) {
        formData += '&daftar=1';
      }

      $.ajax({
        type: 'POST',
        url: form.attr('action'),
        data: formData,
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            if (response.redirect) {
              window.location.href = response.redirect;
            }
          } else if (response.status === 'error') {
            tampilkanAlert(response.info);
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Koneksi Gagal',
            text: 'Terjadi kesalahan sistem, silakan coba lagi nanti.'
          });
        }
      });
      return false; // Don't submit form normally
    });
  }
});