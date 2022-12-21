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
						<button
							type="button"
							class="btn btn-primary"
							onclick="getAdd()"
						>
							<i class="fa-solid fa-plus"></i>
							Tambah Administrator
						</button>
					</div>
				</div>	
			</div>

			<div class="table-responsive">
				<table class="table table-bordered" id="table-user">
					<thead class="table-secondary">
						<tr>
							<th class="text-end">No</th>
							<th>Nama Lengkap</th>
							<th>Username</th>
							<th>Email</th>
							<th class="text-center">Role</th>
							<th class="text-center">Status</th>
							<th class="text-center">Menu</th>
						</tr>
					</thead>
				</table>
			</div>
				
		</div>
	</div>

</div>

<div class="modal fade" id="modal-user" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modal-user-title"></h5>
                <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">
                	<i class="fa-solid fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-user-body"></div>
            </div>
            <div class="modal-footer justify-content-end">
                <div id="modal-user-footer"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/administrator/bawah'); ?>

<script type="text/javascript">
	let tableUser = $('#table-user').DataTable({
        responsive: true,
        ordering: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "<?= site_url('administrator/user/table') ?>",
            method: "get",
        },
        language: {
            search: 'Cari:',
            searchPlaceholder: 'Cari Sesuatu...',
            lengthMenu: "Lihat _MENU_ data",
            info: "_START_ - _END_ dari _TOTAL_ data"
        },
        columnDefs: [
            {
                targets: [-1],
                orderable: false,
            },
        ],
        initComplete: (settings, json)=> {
            $('.dataTables_paginate .pagination').addClass('pagination-sm');
        },
        rowCallback: function(row, data, index) {
            let tableData = [['row', row], ['data', data], ['index', index]]

            $('td', row).eq(0).addClass('text-end')
            $('td', row).eq(4).addClass('text-center')
            $('td', row).eq(5).addClass('text-center')
            $('td', row).eq(6).addClass('text-center')

        },
	})
</script>

<script type="text/javascript">
	function getAdd() {
		$.ajax({
			url: "<?= site_url('administrator/user/page/add') ?>",
			method: "get",

			beforeSend: ()=> {
				$('#modal-user').modal('show')
			},

			success: (data)=> {
				$('#modal-user-body').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Kesalahan pada sistem', 'error').then(() => {
					$('#modal-user').modal('hide')
				})
			}
		})
	}

	function getEdit(code) {
		$.ajax({
			url: "<?= site_url('administrator/user/page/edit') ?>",
			method: "get",
			data: { code },

			beforeSend: ()=> {
				$('#modal-user').modal('show')
			},

			success: (data)=> {
				$('#modal-user-body').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Kesalahan pada sistem', 'error').then(() => {
					$('#modal-user').modal('hide')
				})
			}
		})
	}
</script>