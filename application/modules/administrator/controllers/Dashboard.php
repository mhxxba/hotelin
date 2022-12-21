<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/m_transaction', 'transaction');
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$this->load->view('dashboard/index', $data, FALSE);
	}

	public function table_transaction()
	{
		$table 	= $this->transaction->table('table');
		$filter = $this->transaction->table('filter');
		$total 	= $this->transaction->table('total');

		$no = $this->input->get('start');
		$data = [];
		foreach($table as $tables) {
			$no++;
			$td = [];

			$td[] = $no;
			$td[] = $tables->customer == '' ? $tables->user_name : $tables->customer;

			$bookingDate = date('d/m/Y', strtotime($tables->booking_date))." - ".date('d/m/Y', strtotime("+{$tables->duration} day", strtotime($tables->booking_date)))."($tables->duration) Malam";
			$td[] = $bookingDate;

			$td[] = $tables->hotel_name;

			$room = "
				{$tables->room_name} {$tables->room_number}
			";
			$td[] = $room;


			$td[] = number_format($tables->price, 0, ',', '.');
			$td[] = $tables->payment_name;
			$td[] = $tables->status_name;

			$btnDetail = "
				<div class='p-1'>
					<button
						type='button'
						class='btn btn-sm btn-warning'
						onclick='getDetail(`{$tables->code}`)'
					>
						Detail
					</button>
				</div>
			";

			$btnProcess = "";
			if($tables->status_code != 'bo_pending') {
				$btnProcess = "
					<div class='p-1'>
						<button
							type='button'
							class='btn btn-sm btn-primary'
							onclick='getProcess(`{$tables->code}`)'
						>
							Proses
						</button>
					</div>
				";
			}
				

			$menu = "
				<div class='d-flex justify-content-center'>
					{$btnDetail}
					{$btnProcess}
				</div>
			";
			$td[] = $menu;

			$data[] = $td;
		}
		$output = [
			'draw' 				=> $this->input->get('draw'),
			'recordsFiltered' 	=> $filter,
			'recordsTotal' 		=> $total,
			'data' 				=> $data
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function detail()
	{
		$code = $this->input->get('code');
		$transaction = $this->transaction->detail(['d_order.code' => $code])->row();
		$data['transaction'] = $transaction;

		$data['title'] = "Detail Transaksi";
		$this->load->view('dashboard/detail', $data, FALSE);
	}

	public function proses()
	{
		$code 					= $this->input->get('code');
		$transaction 			= $this->transaction->detail(['d_order.code' => $code])->row();
		$data['transaction'] 	= $transaction;

		$roomNumber = $this->db->get_where('d_hotel_room_number', ['room' => $transaction->room_code])->result();
		$data['roomNumber'] = $roomNumber;

		$status 		= $this->db->get_where('m_status', ['for' => "booking"])->result();
		$data['status'] = $status;

		$data['title'] = "Proses Transaksi";
		$this->load->view('dashboard/proses', $data, FALSE);
	}

	public function update_transaction()
	{
		$code 			= $this->input->post('code');
		$status 		= $this->input->post('status');
		$roomNumber 	= $this->input->post('room_number');

		$data['status'] = $status;

		if(!empty($roomNumber)) {
			$data['room_number'] = $roomNumber;
		} else {
			$data['room_number'] = null;
		}
		$this->db->update('d_order', $data, ['code' => $code]);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/modules/administrator/controllers/Dashboard.php */ ?>