<form id="form-order">
	<input type="hidden" name="hotel" value="<?= $hotel->code ?>" required readonly>
	<div class="row row-cols-1 row-cols-lg-3">
		<div class="col">
			<label class="fw-bold mb-1" for="booking-date-order">
				Check-in
			</label>
			<div class="input-group">
				<span class="input-group-text">
					<i class="fa-solid fa-calendar"></i>
				</span>
				<input
					type="text"
					name="booking_date" id="booking-date-order"
					class="date-order form-control"
					placeholder="Pilih Tanggal Check-in"
					value="<?= $object->bookingDate == "" ? date('Y-m-d') : $object->bookingDate ?>"
					required
					oninput="checkOutDetectorOrder()"
				>
			</div>
		</div>

		<div class="col">
			<label class="fw-bold mb-1" for="duration-order">
				Durasi
			</label>
			<div class="input-group">
				<span class="input-group-text">
					<i class="fa-solid fa-clock"></i>
				</span>
				<input
					type="number"
					name="duration" id="duration-order"
					class="form-control text-center"
					placeholder="Ketik Durasi"
					min="1"
					required
					value="<?= $object->duration == '' ? '1' : $object->duration ?>"
					oninput="checkOutDetectorOrder();getPrice()"
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
			<p class="py-1" id="check-out-order">-</p>
		</div>
	</div>

	<div class="mb-3">
		<label class="form-label" for="hotel">
			Hotel
		</label>

		<input type="text" class="form-control" value="<?= $hotel->name ?>" disabled>
	</div>

	<div class="mb-3">
		<label class="form-label" for="room">
			Tipe Kamar
			<i class="text-danger">*</i>
		</label>

		<select
			class="form-select" name="room" id="room"
			required
			onchange="getPrice()"
		>
			<option value="" data-price="0">Pilih Tipe Kamar</option>
			<?php foreach($room as $rooms) : ?>
				<option
					value="<?= $rooms->code ?>"
					data-price="<?= $rooms->price ?>"
				>
					<?= $rooms->name ?>
				</option>
			<?php endforeach ?>
		</select>
	</div>

	<div class="mb-3">
		<label class="form-label" for="price">
			Harga
		</label>
		<p>
			<sup>Rp</sup>
			<span id="price">0</span>
		</p>
	</div>

	<div class="mb-3">
		<label class="form-label" for="payment">
			Metode pembayaran
			<i class="text-danger">*</i>
		</label>

		<select
			class="form-select" name="payment" id="payment"
			required
		>
			<option value="" data-price="0">Pilih Metode Pembayaran</option>
			<?php foreach($payment as $payments) : ?>
				<option
					value="<?= $payments->code ?>"
				>
					<?= $payments->name ?>
				</option>
			<?php endforeach ?>
		</select>
	</div>

	<div class="mb-3">
		<label class="form-label" for="customer">
			Pesan atas nama <i>(opsional)</i>
		</label>

		<input
			type="text"
			name="customer" id="customer"
			class="form-control"
			placeholder="Ketik bila kamu memesankan untuk orang lain"
		>
	</div>

	<div class="mb-3">
		<label class="form-label" for="note">
			Catatan Tambahan <i>(opsional)</i>
		</label>

		<input
			type="text"
			name="note" id="note"
			class="form-control"
			placeholder="Ketik apabila ada catatan tambahan untuk hotel"
		>
	</div>
</form>

<script type="text/javascript">
	$('#modal-order-title').text(`<?= $title ?? 'Order Hotel' ?>`)
	$('#modal-order-footer').html(`
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
			Batal
		</button>
        <button type="submit" class="btn btn-primary" form="form-order">Booking</button>
	`)
</script>

<script type="text/javascript">

	$('.date-order').flatpickr({
		altInput: true,
		locale: 'id',
		altFormat: "j F Y",
		dateFormat: "Y-m-d",
		minDate: new Date()
	})

	function checkOutDetectorOrder() {
		let bookingDate = $('#booking-date-order').val()
			durationOrder = $('#duration-order').val()
			checkOut = ""

		checkOut = dayjs(bookingDate).add(durationOrder, 'day').format('ddd, D MMMM YYYY')
		return $('#check-out-order').text(checkOut)
	}checkOutDetectorOrder()

	function getPrice() {
		let duration = $('#duration-order').val()
			price = $('#room :selected').data('price')

		totalPrice = price * duration

		price = new Intl.NumberFormat('id-ID').format(totalPrice)
		price = $('#price').text(price)
		return price
	}
</script>

<script type="text/javascript">
	$('#form-order').on('submit', function(e) {
		e.preventDefault()

		Swal.fire({
            title: `Konfirmasi`,
            text: `Proses Booking?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Proses Sekarang',
            cancelButtonText: 'Tidak, mau pilih kamar lain',
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
                    url: "<?= site_url('hotel/order_process') ?>",
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
                    		title: data.title,
                    		text: data.text,
                    		icon: data.icon
                    	}).then(() => {

                    		if(data.status) {
                    			window.location.href = data.url
                    		}
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