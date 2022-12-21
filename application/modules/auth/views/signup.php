<form id="form-auth">

	<div class="mb-3" id="error"></div>

	<div class="mb-3">
		<label for="name" class="form-label">
			Nama Lengkap <i class="text-danger">*</i>
		</label>
		<input
			type="text"
			name="name" id="name" class="form-control"
			minlength="5" maxlength="255"
			placeholder="Ketik Nama Lengkap ..."
			autofocus required
		>
	</div>
	
	<div class="mb-3">
		<label for="username" class="form-label">
			Username <i class="text-danger">*</i>
		</label>
		<input
			type="text"
			name="username" id="username" class="form-control"
			minlength="5" maxlength="255"
			placeholder="Ketik Username ..."
			required
		>
	</div>

	<div class="mb-3">
		<label for="password" class="form-label">
			Password <i class="text-danger">*</i>
		</label>
		<input
			type="password"
			name="password" id="password" class="form-control"
			minlength="5" maxlength="255"
			placeholder="Ketik Password ..."
			required
		>
	</div>

	<div class="mb-3">
		<label for="password_confirm" class="form-label">
			Konfirmasi Password <i class="text-danger">*</i>
		</label>
		<input
			type="password"
			name="password_confirm" id="password_confirm" class="form-control"
			minlength="5" maxlength="255"
			placeholder="Ketik Password Kembali..."
			required
		>
	</div>

</form>

<script type="text/javascript">
	$('#modal-auth-title').text(`<?= $title ?? 'Authentication' ?>`)
	$('#modal-auth-footer').html(`

		<div class="d-grid gap-2">
			<button type="submit" class="btn btn-sm btn-primary w-100" id="btn-signin" form="form-auth">
				<i class="fa-solid fa-user-plus me-2"></i>
				Daftar
			</button>
		</div>

		<hr>

		<div class="text-center">
			<span>
				Sudah memiliki akun? 
				<span>
					<a href="javascript:void(0)" onclick="authentication('signin')">Masuk sekarang!</a>
				</span>
			</span>
		</div>
	`)
</script>

<script type="text/javascript">
	$('#form-auth').on('submit', function(e) {
		e.preventDefault()

		let password = $('#password').val()
			password_confirm = $('#password_confirm').val()

		if(password != password_confirm) {
			return Swal.fire('Password Tidak Sama!', 'Harap Ketik Password Yang Benar Kembali.', 'warning')
		}

		$.ajax({
			url: "<?= site_url('auth/signup_process') ?>",
			method: "POST",
			data: new FormData(this),
			processData: false,
			contentType: false,

			beforeSend: ()=> {
				$('#btn-signin').html(`
					<i class="fa-solid fa-circle-notch fa-spin me-2"></i>
					Sedang Memproses, Harap Tunggu .....
				`).attr('disabled', true)
			},

			success: (data)=> {

				if(data.status) {
					Swal.fire(data.title, data.desc, 'success').then(()=> {
						location.reload()
					})
				} else {
					Swal.fire("Username Sudah Digunakan!", "Harap Gunakan Username Lain.", 'warning').then(() => {
						$('#btn-signin').html(`
							<i class="fa-solid fa-user-plus me-2"></i>
							Daftar Sekarang !
						`).attr('disabled', false)
					})
				}
			},

			error: ()=> {
				Swal.fire('Gagal', 'Mohon Maaf, ada kesalahan pada sistem. silahkan Hubungi Administrator', 'error')
				$('#btn-signin').html(`
					<i class="fa-solid fa-user-plus me-2"></i>
					Daftar Sekarang !
				`).attr('disabled', false)
			}
		})

	})
</script>