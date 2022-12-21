<?php $this->load->view('administrator/hotel/room/form'); ?>

<script type="text/javascript">
	$('#modal-hotel-title').text(`<?= $title ?? 'Pengguna' ?>`)
	$('#modal-hotel-footer').html(`
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
			Tutup
		</button>

		<button
			type="submit"
			class="btn btn-primary"
			form="form-hotel"
		>
			<i class="fa-solid fa-circle-check"></i>
			Simpan
		</button>
	`)
</script>

<script type="text/javascript">
	$('#form-hotel').on('submit', function(e) {
		e.preventDefault()

		Swal.fire({
            title: `Konfirmasi`,
            text: `Simpan Data Kamar?`,
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
                    url: "<?= site_url('administrator/hotel/process/save') ?>",
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
                    		text: "Data Kamar telah disimpan!",
                    		icon: "success"
                    	}).then(() => {
                            location.reload()
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