<form id="form-auth">

	<div class="mb-3" id="error"></div>
	
	<div class="mb-3">
		<label for="username" class="form-label">
			Username / Email <i class="text-danger">*</i>
		</label>
		<input
			type="text"
			name="username" id="username" class="form-control"
			minlength="5" maxlength="255"
			placeholder="Ketik Username / Email ..."
			autofocus required
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

</form>

<script type="text/javascript">
	$('#modal-auth-title').text(`<?= $title ?? 'Authentication' ?>`)
	$('#modal-auth-footer').html(`

		<div class="d-grid gap-2">
			<button type="submit" class="btn btn-sm btn-primary w-100" id="btn-signin" form="form-auth">
	            <i class="bi bi-box-arrow-in-right me-2"></i>
				Masuk
			</button>
		</div>

		<hr>

		<div class="text-center">
			<span>
				Belum memiliki akun? 
				<span>
					<a href="javascript:void(0)" onclick="authentication('signup')">Daftar sekarang!</a>
				</span>
			</span>
		</div>
	`)
</script>

<script type="text/javascript">
	$('#form-auth').on('submit', function(e) {
		e.preventDefault()

		$.ajax({
			url: "<?= site_url('auth') ?>",
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

					location.reload()

				} else {
					$('#btn-signin').html(`
						<i class="bi bi-box-arrow-in-right me-2"></i>
						Masuk Sekarang !
					`).attr('disabled', false)

					$('#error').html(data.error)
				}
			},

			error: ()=> {
				Swal.fire('Gagal', 'Mohon Maaf, ada kesalahan pada sistem. silahkan Hubungi Administrator', 'error')
				$('#btn-signin').html(`
					<i class="bi bi-box-arrow-in-right me-2"></i>
					Masuk Sekarang !
				`).attr('disabled', false)
			}
		})

	})
</script>