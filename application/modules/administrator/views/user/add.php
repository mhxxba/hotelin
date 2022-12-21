<?php $this->load->view('administrator/user/form'); ?>

<script type="text/javascript">
	$('#modal-user-title').text(`<?= $title ?? 'Pengguna' ?>`)
	$('#modal-user-footer').html(`
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
			Tutup
		</button>

		<button
			type="submit"
			class="btn btn-primary"
			form="form-user"
		>
			<i class="fa-solid fa-circle-check"></i>
			Simpan
		</button>
	`)
</script>

<script type="text/javascript">
	$('#form-user').on('submit', function(e) {
		e.preventDefault()

		Swal.fire({
            title: `Konfirmasi`,
            text: `Simpan Data Pengguna?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan Sekarang',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            customClass: {
            	confirmButton: 'btn-primary',
            	cancelButton: 'btn-danger'
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('administrator/user/process/save') ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,

                    beforeSend: ()=> {
                        Swal.fire({
                            title: "Menyimpan",
                            text: "Silahkan Tunggu, Proses Memakan Waktu",
                            allowOutsideClick: false,
				            allowEscapeKey: false,
				            allowEnterKey: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },

                    success: (data)=> {

                    	Swal.fire({
                    		title: "Berhasil",
                    		text: "Data Pengguna telah disimpan!",
                    		icon: "success"
                    	}).then(() => {
                    		$('#modal-user').modal('hide')
                    		tableUser.ajax.reload(null, false)
                    	})
	                    	
                    },

                    error: (req, status, error)=> {
                        Swal.fire('Gagal', 'Ada Kesalahan pada sistem', 'error')
                    },

                });
            }
        })
	})
</script>