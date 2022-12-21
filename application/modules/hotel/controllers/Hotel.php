<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_hotel', 'model');
	}

	public function index()
	{
		$data['title'] = "Pilihan Hotel Terbaik Untuk Kamu!";

		$list 			= $this->model->list()->result();
		$data['list'] 	= $list;

		$this->load->view('index', $data, FALSE);
	}

	public function list()
	{
		$object = new stdClass();
		
		$object->bookingDate 	= $this->input->post('booking_date');
		$data['bookingDate'] 	= $object->bookingDate;

		$object->duration 		= $this->input->post('duration');
		$data['duration'] 		= $object->duration;

		$data['object'] = $object;

		$list 			= $this->model->list()->result();
		$data['list'] 	= $list;

		$this->load->view('components/hotel/list', $data, FALSE);
	}

	public function order()
	{
		$code 	= $this->input->get('code');

		$object 		= json_decode($this->input->get('object'));
		$data['object'] = $object;

		$hotel 			= $this->model->list(['code' => $code])->row();
		if(!$hotel) {
			throw new Exception("Hotel tidak ditemukan, coba cari lagi", 404);
		}
		$data['hotel'] 	= $hotel;

		$room 			= $this->model->room(['hotel' => $code])->result();
		$data['room'] 	= $room;

		$payment 		= $this->db->get_where('m_data', ['for' => 'payment_method'])->result();
		$data['payment'] = $payment;

		$data['title'] = "Booking Hotel";
		$this->load->view('order', $data, FALSE);

	}

	public function order_process()
	{
		$user = $this->auth->user();

		$hotel = $this->input->post('hotel');
		$hotel = $this->model->list(['code' => $hotel])->row();

		$room = $this->input->post('room');
		$room = $this->model->room(['code' => $room])->row();

		$payment 		= $this->input->post('payment');
		$bookingDate 	= $this->input->post('booking_date');
		$duration 		= $this->input->post('duration');
		$customer 		= $this->input->post('customer');
		$note 			= $this->input->post('note');
		$price 			= $room->price * $duration;

		$data['room'] 		= $room->code;
		$data['user'] 		= $user->code;
		$data['payment'] 	= $payment;

		$data['customer'] 		= $customer;
		$data['booking_date'] 	= $bookingDate;
		$data['duration'] 		= $duration;
		$data['price'] 			= $price;
		$data['note'] 			= $note;

		if($payment == "payment_cash") {
			$data['status'] = "bo_success";
		}

		try {

			if(!$user) {
				throw new Exception("Anda belum melakukan autentikasi", 500);
			}
			
			if(!$hotel) {
				throw new Exception("Hotel tidak ditemukan", 404);
			}
			
			if(!$room) {
				throw new Exception("Tipe kamar tidak ditemukan", 404);
			}
			
			$order = $this->db->insert('d_order', $data);

			$order = $this->db->insert_id();
			$order = $this->db->get_where('d_order', ['id' => $order])->row();
			if(!$order) {
				throw new Exception("Ada kesalahan saat proses data", 500);
			}

			$output['status'] = TRUE;
			$output['title'] = "Berhasil!";
			$output['text'] = "Booking berhasil diproses! Harap bayar pesananmu segera";
			$output['icon'] = "success";
			$output['url'] = site_url('user/transaction/'.$order->code);

			$this->output->set_content_type('application/json')->set_output(json_encode($output));

		} catch (Exception $e) {
			
			$output['status'] = FALSE;
			$output['title'] = "Gagal!";
			$output['text'] = $e;
			$output['icon'] = "warning";

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
	}

	public function attachment_process()
	{
		try {

			if(!is_dir(FCPATH.'/assets/attachment/')) {
				mkdir(FCPATH.'/assets/attachment/', 0777);
			}
			$config['upload_path'] 		= FCPATH.'/assets/attachment/';
			$config['allowed_types'] 	= 'pdf|jpg|png|jpeg';
			$config['max_size']  		= '3000';
	        $config['encrypt_name']     = TRUE;
	    	$this->upload->initialize($config);

	    	$code = $this->input->post('code');
	    	if($this->upload->do_upload('attachment')) {
	    		$data['attachment'] = $this->upload->data('file_name');
	    		$data['status'] 	= "bo_success";

	    		$this->db->update('d_order', $data, ['code' => $code]);

	    		$output['status'] = TRUE;
				$output['title'] = "Berhasil!";
				$output['text'] = "Admin akan segera memproses booking anda";
				$output['icon'] = "success";

				$this->output->set_content_type('application/json')->set_output(json_encode($output));

	    	} else {
	    		throw new Exception("Ada kesalahan saat proses data", 500);
	    	}
			
		} catch (Exception $e) {

			$output['status'] = FALSE;
			$output['title'] = "Gagal!";
			$output['text'] = $e->getMessage();
			$output['icon'] = "warning";

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
	}

	public function cancel()
	{
		try {

	    	$code = $this->input->post('code');
    		$data['status'] 	= "bo_cancel";

    		$this->db->update('d_order', $data, ['code' => $code]);

    		$output['status'] = TRUE;
			$output['title'] = "Berhasil!";
			$output['text'] = "Transaksi anda berhasil dibatalkan";
			$output['icon'] = "success";

			$this->output->set_content_type('application/json')->set_output(json_encode($output));

		} catch (Exception $e) {

			$output['status'] = FALSE;
			$output['title'] = "Gagal!";
			$output['text'] = $e->getMessage();
			$output['icon'] = "warning";

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
	}

	public function test()
	{
		$output['status'] = true;
		$output['title'] = "Berhasil!";
		$output['text'] = "Admin akan segera memproses booking anda";
		$output['icon'] = "success";

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}

/* End of file Hotel.php */
/* Location: ./application/modules/hotel/controllers/Hotel.php */ ?>