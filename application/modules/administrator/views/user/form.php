<form id="form-user">

	<?php if($type == "edit") : ?>
		<input type="hidden" name="code" value="<?= $user->code ?>" required readonly>
	<?php endif ?>

	<div class="mb-3">
		<label class="form-label" for="name">
			Nama Lengkap
			<i class="text-danger">*</i>
		</label>

		<input
			type="text"
			name="name" id="name"
			class="form-control"
			placeholder="Ketik nama lengkap"
			minlength="5" maxlength="255"
			required
			<?php if($type == "edit") : ?>
				value="<?= $user->name ?>"
			<?php endif ?>
		>
	</div>

	<div class="mb-3">
		<label class="form-label" for="username">
			Username
			<i class="text-danger">*</i>
		</label>

		<input
			type="text"
			id="username"
			class="form-control"
			<?php if($type == "edit") : ?>
				value="<?= $user->username ?>"
				disabled

			<?php else : ?>
				name="username"
				required
				minglength="5" maxlength="255"
				placeholder="Ketik username unik"
			<?php endif ?>
		>
	</div>

	<div class="mb-3">
		<label class="form-label" for="email">
			Email
			<i class="text-danger">*</i>
		</label>

		<input
			type="email"
			name="email" id="email"
			class="form-control"
			placeholder="Ketik Email"
			minlength="5" maxlength="255"
			<?php if($type == "edit") : ?>
				value="<?= $user->email ?>"
			<?php endif ?>
		>
	</div>

	<?php if($type == "add") : ?>
		<div class="mb-3">
			<label class="form-label" for="password">
				Password
				<i class="text-danger">*</i>
			</label>

			<input
				type="text"
				name="password" id="password"
				class="form-control"
				placeholder="Ketik Password"
				minlength="5" maxlength="255"
			>
		</div>
	<?php endif ?>

	<div class="mb-3">
		<label class="form-label" for="status">
			Status Pengguna
			<i class="text-danger">*</i>
		</label>
		<select name="status" id="status" class="form-select" required>
			<option value="">Pilih Status Pengguna</option>
			<?php foreach($status as $statuss) : ?>
				<option
					value="<?= $statuss->code ?>"
					<?php
						if($type == "edit") {
							if($statuss->code == $user->status_code) {
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