<?php $this->load->view('layouts/administrator/atas'); ?>

<div class="container py-5">
	<h1>
		<?= $title ?>
	</h1>

	<div class="row">
		<div class="col-12">
			<table class="table table-bordered" id="table-transaction">
				<thead class="table-secondary">
					<tr>
						<th class="text-end">No</th>
						<th>Customer</th>
						<th class="text-center">Tgl Booking</th>
						<th>Hotel</th>
						<th>Kamar</th>
						<th class="text-end">Harga</th>
						<th>Pembayaran</th>
						<th class="text-center">Status</th>
						<th class="text-center">Menu</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>

</div>

<div class="modal fade" id="modal-transaction" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modal-transaction-title"></h5>
                <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">
                	<i class="fa-solid fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-transaction-body"></div>
            </div>
            <div class="modal-footer justify-content-end">
                <div id="modal-transaction-footer"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/administrator/bawah'); ?>

<script type="text/javascript">
	let tableTransaction = $('#table-transaction').DataTable({
        responsive: true,
        ordering: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "<?= site_url('administrator/dashboard/table_transaction') ?>",
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
            $('td', row).eq(2).addClass('text-center')
            $('td', row).eq(5).addClass('text-end')
            $('td', row).eq(8).addClass('text-center')

        },
	})
</script>

<script type="text/javascript">
	function getDetail(code) {
		$.ajax({
			url: "<?= site_url('administrator/dashboard/detail') ?>",
			method: "get",
			data: { code },

			beforeSend: ()=> {
				$('#modal-transaction').modal('show')
			},

			success: (data)=> {
				$('#modal-transaction-body').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Kesalahan pada sistem', 'error').then(() => {
					$('#modal-transaction').modal('hide')
				})
			}
		})
	}

	function getProcess(code) {
		$.ajax({
			url: "<?= site_url('administrator/dashboard/proses') ?>",
			method: "get",
			data: { code },

			beforeSend: ()=> {
				$('#modal-transaction').modal('show')
			},

			success: (data)=> {
				$('#modal-transaction-body').html(data)
			},

			error: ()=> {
				Swal.fire('Gagal', 'Kesalahan pada sistem', 'error').then(() => {
					$('#modal-transaction').modal('hide')
				})
			}
		})
	}
</script>