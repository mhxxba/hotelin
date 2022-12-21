<?php $this->load->view('layouts/app/atas'); ?>

<div class="container py-5">
	<h1>
		<?= $title ?>
	</h1>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-sm table-borderless">
						<tr>
							<th>Hotel</th>
							<td>:</td>
							<td><?= $transaction->hotel_name ?></td>
						</tr>
						<tr>
							<th>Tipe Kamar</th>
							<td>:</td>
							<td><?= $transaction->room_name ?></td>
						</tr>
						<tr>
							<th>Status Booking</th>
							<td>:</td>
							<td><?= $transaction->status_name ?></td>
						</tr>
						<tr>
							<th>Nomor Kamar</th>
							<td>:</td>
							<td><?= $transaction->room_number ?? '<i>Belum diproses admin</i>' ?></td>
						</tr>
						<tr>
							<th>Customer</th>
							<td>:</td>
							<td><?= $transaction->customer == '' ? $user->name : $transaction->customer ?></td>
						</tr>
						<tr>
							<th>Tanggal Pemesanan</th>
							<td>:</td>
							<td>
								<?= date('d/m/Y H:i:s', strtotime($transaction->created_at)) ?>
							</td>
						</tr>
						<tr>
							<th>Tanggal Booking</th>
							<td>:</td>
							<td>
								<?= date('d/m/Y', strtotime($transaction->booking_date)) ?>
								-
								<?= date('d/m/Y', strtotime("+{$transaction->duration} day", strtotime($transaction->booking_date))) ?>
								(<?= $transaction->duration ?> Malam)
							</td>
						</tr>
						<tr>
							<th>Total Harga</th>
							<td>:</td>
							<td>
								<sup>Rp</sup>
								<?= number_format($transaction->price, 0, ',', '.') ?>
							</td>
						</tr>
						<tr>
							<th>Catatan</th>
							<td>:</td>
							<td><?= $transaction->note == "" ? '-' : $transaction->note ?></td>
						</tr>
						<tr>
							<th>Metode Pembayaran</th>
							<td>:</td>
							<td><?= $transaction->payment_name ?></td>
						</tr>

						<?php if(($transaction->payment_code == "payment_transfer") && ($transaction->status_code == "bo_pending")) : ?>
							<tr>
								<th>Bukti Pembayaran</th>
								<td>:</td>
								<td>
									<?php if(!empty($transaction->attachment)) : ?>
										<a href="<?= base_url('assets/attachment/'.$transaction->attachment) ?>" target="_blank">
											Lihat File
										</a>

									<?php else : ?>
										<form id="form-upload" enctype="multipart/form-data">
											<input type="hidden" name="code" value="<?= $transaction->code ?>" required readonly>
											<div class="input-group">
												<input accept=".pdf, image/*" type="file" name="attachment" required class="form-control form-control-sm">
												<button type="submit" class="btn btn-sm btn-primary">
													Upload Bukti Pembayaran
												</button>
											</div>
										</form>
										<small class="text-danger">
											Max 3MB .pdf, .png, .jpg, .jpeg
										</small>
										<p>
											Harap upload bukti pembayaran agar booking segera diproses oleh admin
										</p>
									<?php endif ?>
								</td>
							</tr>
						<?php endif ?>
					</table>
				</div>

				<div class="card-footer">
					<a class="btn btn-warning" href="<?= site_url('user/transaction') ?>">
						Kembali
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('layouts/app/bawah'); ?>

<?php if(empty($transaction->attachment)) : ?>
	<script type="text/javascript">
		$('#form-upload').on('submit', function(e) {
			e.preventDefault()

			Swal.fire({
	            title: `Konfirmasi`,
	            text: `Upload bukti pembayaran?`,
	            icon: 'question',
	            showCancelButton: true,
	            confirmButtonText: 'Ya, Upload Sekarang',
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
	                    url: "<?= site_url('hotel/attachment_process') ?>",
	                    method: "POST",
	                    data: new FormData(this),
	                    processData: false,
	                    contentType: false,

	                    beforeSend: function(){
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

	                    success: function(data){

	                    	Swal.fire({
	                    		title: data.title,
	                    		text: data.text,
	                    		icon: data.icon,
	                    	}).then(() => {

	                    		if(data.status) {
	                    			location.reload()
	                    		}
	                    			
	                    	})
	                    },

	                    error: (req, status, error)=> {
	                        Swal.fire('Gagal', 'Kesalahan pada sistem', 'error')
	                    },

	                });
	            }
	        })
		})
	</script>
<?php endif ?>
