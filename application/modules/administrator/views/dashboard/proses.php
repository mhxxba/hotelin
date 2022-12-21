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
						<td><?= $transaction->customer == '' ? $transaction->user_name : $transaction->customer ?></td>
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

					<?php if($transaction->payment_code == "payment_transfer") : ?>
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

		</div>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-12">
		<form id="form-proses">

			<input type="hidden" name="code" value="<?= $transaction->code ?>" required readonly>

			<div class="mb-3">
				<label class="form-label" for="status">
					Status Transaksi
					<i class="text-danger">*</i>
				</label>
				<select name="status" id="status" class="form-select" required>
					<option value="">Pilih Status Transaksi</option>
					<?php foreach($status as $statuss) : ?>
						<option
							value="<?= $statuss->code ?>"
							<?php
								if($statuss->code == $transaction->status_code) {
									echo "selected";
								}
							?>
						>
							<?= $statuss->name ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="mb-3">
				<label class="form-label" for="room-number">
					Nomor Kamar
				</label>
				<select name="room_number" id="room-number" class="form-select">
					<option value="">Pilih Nomor Kamar</option>
					<?php foreach($roomNumber as $roomNumbers) : ?>
						<option
							value="<?= $roomNumbers->code ?>"
							<?php
								if($roomNumbers->code == $transaction->room_number_code) {
									echo "selected";
								}
							?>
						>
							<?= $roomNumbers->number ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$('#modal-transaction-title').text(`<?= $title ?? 'Proses Booking' ?>`)
	$('#modal-transaction-footer').html(`
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
			Tutup
		</button>

		<button
			type="submit"
			class="btn btn-primary"
			form="form-proses"
		>
			<i class="fa-solid fa-circle-check"></i>
			Proses!
		</button>
	`)
</script>

<script type="text/javascript">
	$('#form-proses').on('submit', function(e) {
		e.preventDefault()

		Swal.fire({
            title: `Konfirmasi`,
            text: `Proses Transaksi?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Proses Sekarang',
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
                    url: "<?= site_url('administrator/dashboard/update_transaction') ?>",
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
                    		text: "Transaksi Telah di proses!",
                    		icon: "success"
                    	}).then(() => {
                    		$('#modal-transaction').modal('hide')
                    		tableTransaction.ajax.reload(null, false)
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