<?php $this->load->view('layouts/administrator/atas'); ?>

<div class="container py-5">
	<h1>
		<?= $title ?>
	</h1>

	<div class="row">
		<div class="col-12">

			<div class="mb-3">
				<div class="d-flex justify-content-start">
					<div class="p-1">
						<a
							href="<?= site_url('administrator/hotel') ?>"
							class="btn btn-warning"
						>
							Kembali
						</a>
					</div>

					<div class="p-1">
						<button
							type="button"
							class="btn btn-primary"
							onclick="getAdd('room', `<?= $code ?>`)"
						>
							<i class="fa-solid fa-plus"></i>
							Tambah Tipe Kamar
						</button>
					</div>
				</div>	
			</div>

			<div class="table-responsive">
				<table class="table table-bordered" id="table-hotel">
					<thead class="table-secondary">
						<tr>
							<th class="text-end">No</th>
							<th class="text-center">Img</th>
							<th>Hotel</th>
							<th class="text-end">Harga</th>
							<th>Deskripsi</th>
							<th class="text-center">Status</th>
							<th class="text-center">Menu</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 0; foreach($room as $rooms) : $no++ ?>

							<tr>
								<td class="text-end"><?= $no ?></td>
								<td class="">
									<img
										src="<?= base_url('assets/img/hotel/room/'.$rooms->img) ?>"
										class="img-fluid rounded-3"
										alt="<?= $rooms->name ?>"
										width="150"
									>
								</td>
								<td>
									<a
										href="<?= site_url('administrator/hotel/detail?type=room&code='.$rooms->code) ?>"
										class="text-decoration-none"
									>
										<?= $rooms->name ?>
									</a>
								</td>
								<td class="text-end"><?= number_format($rooms->price, 0, ',', '.') ?></td>
								<td><?= $rooms->description ?></td>
								<td class="text-center"><?= $rooms->status_name ?></td>
								<td class="text-center">
									<div class="d-flex justify-content-center">
										<button
											type="button"
											class="btn btn-warning"
											onclick="getEdit('room', '<?= $rooms->code ?>')"
										>
											Edit
										</button>
									</div>
								</td>
							</tr>

						<?php endforeach ?>
					</tbody>
				</table>
			</div>
				
		</div>
	</div>

</div>

<div class="modal fade" id="modal-hotel" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modal-hotel-title"></h5>
                <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">
                	<i class="fa-solid fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-hotel-body"></div>
            </div>
            <div class="modal-footer justify-content-end">
                <div id="modal-hotel-footer"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/administrator/bawah'); ?>

<script type="text/javascript">
	let tableHotel = $('#table-hotel').DataTable()
</script>

<script type="text/javascript">
	function getAdd(type, code) {
		$.ajax({
			url: "<?= site_url('administrator/hotel/page/add') ?>",
			method: "get",
			data: { type, code },

			beforeSend: ()=> {
				$('#modal-hotel').modal('show')
			},

			success: (data)=> {
				$('#modal-hotel-body').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Kesalahan pada sistem', 'error').then(() => {
					$('#modal-hotel').modal('hide')
				})
			}
		})
	}

	function getEdit(type, code) {
		$.ajax({
			url: "<?= site_url('administrator/hotel/page/edit') ?>",
			method: "get",
			data: { type, code },

			beforeSend: ()=> {
				$('#modal-hotel').modal('show')
			},

			success: (data)=> {
				$('#modal-hotel-body').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Kesalahan pada sistem', 'error').then(() => {
					$('#modal-hotel').modal('hide')
				})
			}
		})
	}
</script>