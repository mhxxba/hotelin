<form id="form-hotel" enctype="multipart/form-data">

	<input type="hidden" name="page" value="<?= $page ?>" required readonly>

	<input type="hidden" name="code" value="<?= $code ?>" required readonly>

	<div class="mb-3">
		<label class="form-label" for="name">
			Tipe Kamar
			<i class="text-danger">*</i>
		</label>

		<input
			type="text"
			name="name" id="name" class="form-control"
			placeholder="Ketik Tipe Kamar ..."
			required
			minlength="5" maxlength="255"
			<?php if($type == "edit") : ?>
				value="<?= $room->name ?>"
			<?php endif ?>
		>
	</div>

	<div class="mb-3">
		<label class="form-label" for="price">
			Harga
			<i class="text-danger">*</i>
		</label>

		<input
			type="number"
			name="price" id="price" class="form-control"
			placeholder="Ketik harga kamar per malam..."
			required
			min="0"
			<?php if($type == "edit") : ?>
				value="<?= $room->price ?>"
			<?php endif ?>
		>
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
		><?= $room->description ?? '' ?></textarea>
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
				<a href="<?= base_url('assets/img/hotel/room/'.$room->img) ?>" target="_blank">
					Lihat Gambar
				</a>
			</small>
		<?php endif ?>
	</div>

	<div class="mb-3">
		<label class="form-label" for="status">
			Status Tipe Kamar
			<i class="text-danger">*</i>
		</label>
		<select name="status" id="status" class="form-select" required>
			<option value="">Pilih Status Tipe Kamar</option>
			<?php foreach($status as $statuss) : ?>
				<option
					value="<?= $statuss->code ?>"
					<?php
						if($type == "edit") {
							if($statuss->code == $room->status_code) {
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