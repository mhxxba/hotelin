<h5>Hotel yang tersedia untukmu ...</h5>

<?php if(!empty($list)) : ?>

	<div class="row row-cols-1 row-cols-lg-3 g-3">

		<?php foreach($list as $lists) : ?>

			<div class="col">
				
				<div class="card h-100">
					<img
						src="<?= base_url('assets/img/hotel/'.$lists->img) ?>"
						class="card-img-top h-100 w-100"
						alt="<?= $lists->name ?>"
					>

					<div class="card-body">
						<p class="text-warning mb-0">
							<?php for($i = 1; $i <= $lists->star; $i++) : ?>
								<i class="fa-solid fa-star"></i>
							<?php endfor ?>
						</p>

						<p class="card-title fw-bold"><?= $lists->name ?></p>
						<p class="card-text">
							<i class="fa-solid fa-map-pin"></i>
							<?= $lists->address ?>
						</p>
					</div>

					<div class="card-footer bg-white">
						<div class="mt-auto">
							<button
								type="button"
								class="btn btn-primary"
								onclick="booking('<?= $lists->code ?>')"
							>
								<i class="fa-solid fa-arrow-right"></i>
								Booking Sekarang
							</button>
						</div>
					</div>
				</div>

			</div>

		<?php endforeach ?>

	</div>

	<div class="modal fade" id="modal-order" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modal-order-title"></h5>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">
                    	<i class="fa-solid fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-order-body"></div>
                </div>
                <div class="modal-footer justify-content-end">
                    <div id="modal-order-footer"></div>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>

	<p>
		Maaf tidak ada hotel yang tersedia.
		Silahkan coba beberapa saat lagi
	</p>

<?php endif ?>

<script type="text/javascript">
	function booking(code) {

		<?php if(!$this->auth->is_login()) : ?>
			return authentication('signin')
		<?php endif ?>

		let object = {
			bookingDate: `<?= $object->bookingDate ?? '' ?>`,
			duration: `<?= $object->duration ?? '' ?>`
		}

		object = JSON.stringify(object)

		$.ajax({
			url: "<?= site_url('hotel/order') ?>",
			method: "get",
			data: { code, object },

			beforeSend: ()=> {
				$('#modal-order').modal('show')
			},

			success: (data)=> {
				$('#modal-order-body').html(data)
			},

			error: ()=> {
				$('#modal-order').modal('hide')
				Swal.fire('Gagal', 'Ada Kesalahan pada sistem', 'error')
			}
		})
	}
</script>