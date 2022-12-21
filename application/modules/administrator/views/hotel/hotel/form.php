<form id="form-hotel" enctype="multipart/form-data">

	<input type="hidden" name="page" value="<?= $page ?>" required readonly>

	<?php if($type == "edit") : ?>
		<input type="hidden" name="code" value="<?= $hotel->code ?>" required readonly>
	<?php endif ?>

	<div class="mb-3">
		<label class="form-label" for="name">
			Hotel
			<i class="text-danger">*</i>
		</label>

		<input
			type="text"
			name="name" id="name" class="form-control"
			placeholder="Ketik nama hotel ..."
			required
			minlength="5" maxlength="255"
			<?php if($type == "edit") : ?>
				value="<?= $hotel->name ?>"
			<?php endif ?>
		>
	</div>

	<div class="mb-3">
		<label class="form-label" for="star">
			Star
			<i class="text-danger">*</i>
		</label>

		<input
			type="number"
			name="star" id="star" class="form-control"
			placeholder="Ketik tingkatan bintang hotel ..."
			required
			min="1" max="5"
			<?php if($type == "edit") : ?>
				value="<?= $hotel->star ?>"
			<?php endif ?>
		>
	</div>

	<div class="mb-3">
		<label class="form-label" for="address">
			Alamat
			<i class="text-danger">*</i>
		</label>

		<textarea
			name="address" id="address" class="form-control"
			required
			placeholder="Ketik alamat lengkap hotel"
		><?= $hotel->address ?? '' ?></textarea>
	</div>

	<div class="mb-3">
		<label class="form-label" for="description">
			Deskripsi
			<i class="text-danger">*</i>
		</label>

		<textarea
			name="description" id="description" class="form-control"
			required
			placeholder="Ketik deskripsi hotel"
		><?= $hotel->description ?? '' ?></textarea>
	</div>

	<div class="mb-3">
		<label class="form-label" for="img">
			Gambar

			<?php if($type == "add") : ?>
				<i class="text-danger">*</i>
			<?php endif ?>
		</label>

		<p class="my-0 small text-danger">
			Max 3MB .png .jpg .jpeg
		</p>
		<input
			type="file" accept="image/*"
			name="img" id="img" class="form-control"
			<?php if($type == "add") : ?>
				required
			<?php endif ?>
		>
		<?php if($type == "edit") : ?>
			<small>
				<a href="<?= base_url('assets/img/hotel/'.$hotel->img) ?>" target="_blank">
					Lihat Gambar
				</a>
			</small>
		<?php endif ?>
	</div>

	<div class="mb-3">
		<label class="form-label" for="status">
			Status Hotel
			<i class="text-danger">*</i>
		</label>
		<select name="status" id="status" class="form-select" required>
			<option value="">Pilih Status Hotel</option>
			<?php foreach($status as $statuss) : ?>
				<option
					value="<?= $statuss->code ?>"
					<?php
						if($type == "edit") {
							if($statuss->code == $hotel->status_code) {
								echo "selected";
							}
						}
					?>
				>
					<?= $statuss->name ?>
				</option>
			<?php endforeach ?>
		</select>
	</div>

</form>