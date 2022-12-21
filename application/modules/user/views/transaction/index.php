<?php $this->load->view('layouts/app/atas'); ?>

<div class="container py-5">
	<h1>
		<?= $title ?>
	</h1>

	<div class="row">
		<div class="col-12">
			<table class="table table-sm table-borderless" id="table-transaction">
				<thead>
					<tr>
						<th>Data Transaksi</th>
					</tr>
				</thead>

				<tbody>

					<?php foreach($list as $lists) : ?>
						<tr>
							<td>
								<div class="col-12 mb-3">
									<div class="card">
										<div class="card-header bg-white">
											<div class="d-flex justify-content-start">
												<div class="p-1">
													<span class="fw-bold me-2">
														<i class="fa-solid fa-bag-shopping text-primary me-1"></i>
														Booking
													</span>
												</div>

												<div class="p-1">
													<span>
														<?= date('d/m/Y H:i:s', strtotime($lists->created_at)) ?>
													</span>
												</div>

												<div class="p-1">
													<span class="badge bg-primary">
														<?= $lists->status_name ?>
													</span>
												</div>
											</div>
										</div>

										<div class="card-body">
											<div class="row">
												<div class="col-12 col-lg-10">

													<div class="row">
														<div class="col-2 col-lg-3">
															<img
																src="<?= base_url('assets/img/hotel/'.$lists->hotel_img) ?>"
																class="img-fluid"
																alt="<?= $lists->hotel_name ?>"
															>
														</div>

														<div class="col-10 col-lg-9">
															<p class="fw-bold">
																<?= $lists->hotel_name ?>
															</p>
															<p>
																<span>
																	Tipe: <?= $lists->room_name ?>
																</span>
																<br>
																<span>
																	Nomor: <?= $lists->room_number ?? '-' ?>
																</span>
															</p>
															<p>
																<i class="fa-solid fa-map-pin"></i>
																<?= $lists->hotel_address ?>
															</p>
														</div>
													</div>
												</div>

												<div class="col-12 col-lg-2 border-start align-self-center">
													<p class="fw-lighter">Total Transaksi</p>
													<p class="fs-4">
														<sup>Rp</sup>
														<?= number_format($lists->price, 0, ',', '.') ?>
													</p>
												</div>
											</div>
										</div>

										<div class="card-footer bg-white">

											<div class="d-flex justify-content-end">
												<div class="p-1">
													<a
														href="<?= site_url('user/transaction/'.$lists->code) ?>"
														class="btn btn-success"
													>
														Detail
													</a>
												</div>

												<?php if($lists->status_code == "bo_pending") : ?>
													<div class="p-1">
														<button
															type="button"
															class="btn btn-danger"
															onclick="cancelBooking('<?= $lists->code ?>')"
														>
															<i class="fa-solid fa-close"></i>
															Batal Booking
														</button>
													</div>
												<?php endif ?>

													
											</div>
											
										</div>
									</div>
								</div>
							</td>
						</tr>
					<?php endforeach ?>
						
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->load->view('layouts/app/bawah'); ?>

<script type="text/javascript">
	let tableTransaction = $('#table-transaction').DataTable({
		ordering: false
	})
</script>

<script type="text/javascript">
	function cancelBooking(code) {
		Swal.fire({
            title: `Konfirmasi`,
            text: `Cancel Booking?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Cancel Sekarang',
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
                    url: "<?= site_url('hotel/cancel') ?>",
                    method: "POST",
                    data: { code },

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
                    		title: data.title,
                    		text: data.text,
                    		icon: data.icon
                    	}).then(() => {

                    		if(data.status) {
                    			location.reload()
                    		}
                    	})
	                    	
                    },

                    error: (req, status, error)=> {
                        Swal.fire('Gagal', 'Ada Kesalahan pada sistem', 'error')
                    },

                });
            }
        })
	}
</script>