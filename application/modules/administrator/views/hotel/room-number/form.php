<form id="form-hotel" enctype="multipart/form-data">

	<input type="hidden" name="page" value="<?= $page ?>" required readonly>

	<input type="hidden" name="code" value="<?= $code ?>" required readonly>

	<div class="mb-3">
		<label class="form-label" for="number">
			Nomor Kamar
			<i class="text-danger">*</i>
		</label>

		<input
			type="text"
			name="number" id="number" class="form-control"
			placeholder="Ketik Nomor Kamar ..."
			required
			minlength="1" maxlength="10"
			<?php if($type == "edit") : ?>
				value="<?= $roomNumber->number ?>"
			<?php endif ?>
		>
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
							if($statuss->code == $roomNumber->status_code) {
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