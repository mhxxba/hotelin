<?php $this->load->view('layouts/app/atas'); ?>

<div class="container-fluid p-0">

	<div class="bg-light">
		
		<div class="container py-5">
			
			<div class="row">
				<div class="col-12 col-lg-6 align-self-center">
					<h1 class="text-primary fw-bold">Cari & booking hotel dengan harga termurah di sini!</h1>
					<p class="text-dark lead">
						Temukan harga terbaik untuk setiap hotel yang Anda butuhkan. 
					</p>
				</div>

				<div class="col-6 d-none d-lg-block">
					<img
						src="<?= base_url('assets/img/travel-booking.svg') ?>"
						class="img-fluid w-100"
						alt="Travel Booking"
					>
				</div>
			</div>

		</div>

	</div>
	
</div>

<div class="container mx-auto col-12 col-lg-8 py-5">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white">
					<span class="p text-primary">
						<i class="fa-solid fa-hotel"></i>
						Temukan hotel yang cocok untuk kamu!
					</span>
				</div>

				<div class="card-body">
					<form id="form-booking">
						<div class="row row-cols-1 row-cols-lg-3">
							<div class="col">
								<label class="fw-bold mb-1" for="booking-date">
									Check-in
								</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fa-solid fa-calendar"></i>
									</span>
									<input
										type="text"
										name="booking_date" id="booking-date"
										class="date form-control"
										placeholder="Pilih Tanggal Check-in"
										required
										oninput="checkOutDetector()"
									>
								</div>
							</div>

							<div class="col">
								<label class="fw-bold mb-1" for="duration">
									Durasi
								</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="fa-solid fa-clock"></i>
									</span>
									<input
										type="number"
										name="duration" id="duration"
										class="form-control text-center"
										placeholder="Ketik Durasi"
										min="1"
										value="1"
										required
										oninput="checkOutDetector()"
									>
									<span class="input-group-text bg-white">
										Malam
									</span>
								</div>
							</div>

							<div class="col">
								<label class="fw-bold mb-1">
									Check-out
								</label>
								<p class="py-1" id="check-out">-</p>
							</div>
						</div>
					</form>
				</div>

				<div class="card-footer bg-white">
					<button
						type="submit"
						form="form-booking"
						class="btn btn-primary"
					>
						<i class="fa-solid fa-magnifying-glass"></i>
						Cari Hotel
					</button>
				</div>
			</div>
		</div>

		<div class="col-12 my-3" id="list-hotel"></div>
	</div>
</div>

<?php $this->load->view('layouts/app/bawah'); ?>

<script type="text/javascript">
	$('.date').flatpickr({
		altInput: true,
		locale: 'id',
		altFormat: "j F Y",
		dateFormat: "Y-m-d",
		defaultDate: new Date(),
		minDate: new Date()
	})
</script>

<script type="text/javascript">
	function checkOutDetector() {
		let bookingDate = $('#booking-date').val()
			duration = $('#duration').val()
			checkOut = ""

		checkOut = dayjs(bookingDate).add(duration, 'day').format('ddd, D MMMM YYYY')
		return $('#check-out').text(checkOut)
	}checkOutDetector()

	$('#form-booking').on('submit', function(e) {
		e.preventDefault()

		$.ajax({
			url: "<?= site_url('hotel/list') ?>",
			method: "POST",
			data: new FormData(this),
			processData: false,
			contentType: false,

			success: (data)=> {
				$('#list-hotel').html(data)
			}
		})
	})
</script>