<?php if(!$this->auth->is_login()) : ?>
    <div class="modal fade" id="modal-auth" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modal-auth-title"></h5>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">
                    	<i class="fa-solid fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-auth-body"></div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div id="modal-auth-footer"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<!-- Bootstrap 5 + Popper + jQuery 3 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

<!-- FA 6 -->
<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/js/fontawesome.min.js" integrity="sha256-CmI2IEcfp/ocwrmWKlpyn/Ms5CuLnZ2WWGa1nmooYvE=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/js/all.min.js" integrity="sha256-PrAGWuLoTJghkCUeIWpjfhI03fBwYSoDqBtwshkNS44=" crossorigin="anonymous"></script>

<!-- Flatpickr -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/id.js" integrity="sha256-cvHCpHmt9EqKfsBeDHOujIlR5wZ8Wy3s90da1L3sGkc=" crossorigin="anonymous"></script>

<!-- DayJS -->
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/dayjs.min.js" integrity="sha256-EfJOqCcshFS/2TxhArURu3Wn8b/XDA4fbPWKSwZ+1B8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.7/locale/id.js" integrity="sha256-tMrPkKOjzDOeZRX/t/pbA9r1Y1Dh4j/gs11O4sQhCWk=" crossorigin="anonymous"></script>
<script type="text/javascript">
	dayjs().locale('id-ID')
</script>

<!-- Swal 2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>

<?php if(!$this->auth->is_login()) : ?>
	<script type="text/javascript">
		function authentication(type) {
			$.ajax({
				url: "<?= site_url('auth/checker') ?>",
				method: "get",
				data: { type },

				beforeSend: ()=> {
					$('#modal-auth').modal('show')
				},

				success: (data)=> {
					$('#modal-auth-body').html(data)
				},

				error: ()=> {
					Swal.fire('Gagal', 'Ada Kesalahan Pada Sistem. Harap hubungi Admin', 'error')
				}
			})
		}
	</script>

<?php else : ?>

	<script type="text/javascript">
		function changePassword() {
			Swal.fire({
                title: 'Ganti Password',
                input: 'text',
                inputAttributes: {
                    placeholder: 'Ketik Password Baru',
                    required: true,
                    minlength: 5
                },
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn-primary',
                    cancelButton: 'btn-secondary'
                },
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showLoaderOnConfirm: true,
                preConfirm: (password)=> {
                	$.ajax({
                        url: "<?= site_url('auth/change_password') ?>",
                        method: "POST",
                        data: { password },

                        error: (req, status, error)=> {
                            Swal.fire('Gagal', 'Kesalahan pada sistem', 'error')
                        },

                    })
                }
            }).then((result) => {
                if(result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: "Password telah diganti!",
                        icon: 'success'
                    })
                }
            })
		}
	</script>
<?php endif ?>

</body>
</html>