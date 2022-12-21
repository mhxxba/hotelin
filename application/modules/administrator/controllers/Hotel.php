<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/m_hotel', 'hotel');
	}

	public function index()
	{
		$hotel = $this->hotel->hotel()->result();
		$data['hotel'] = $hotel;

		$data['title'] = "Data Hotel";
		$this->load->view('hotel/index', $data, FALSE);
	}

	public function detail()
	{
		$type = $this->input->get('type');
		$data['type'] = $type;

		$code = $this->input->get('code');
		$data['code'] = $code;

		if($type == "hotel") {

			$hotel = $this->hotel->hotel(['d_hotel.code' => $code])->row();
			$data['hotel'] = $hotel;

			$room = $this->hotel->room(['d_hotel.code' => $code])->result();
			$data['room'] = $room;

			$data['title'] = "Data Tipe Kamar: {$hotel->name}";
			$this->load->view('hotel/room/index', $data, FALSE);

		} elseif($type == "room") {

			$room = $this->hotel->room(['d_hotel_room.code' => $code])->row();
			$data['room'] = $room;

			$hotel = $this->hotel->hotel(['d_hotel.code' => $room->hotel_code])->row();
			$data['hotel'] = $hotel;

			$roomNumber = $this->hotel->room_number(['d_hotel_room.code' => $code])->result();
			$data['roomNumber'] = $roomNumber;

			$data['title'] = "Data Nomor Kamar: {$hotel->name} - {$room->name}";
			$this->load->view('hotel/room-number/index', $data, FALSE);
		}
	}

	public function page($page)
	{
		$type = $this->input->get('type');
		$code = $this->input->get('code');

		$status 		= $this->db->get_where('m_status', ['for' => "activation"])->result();
		$data['status'] = $status;

		if($type == "hotel") {

			$data['page'] 	= $type;
			$data['type'] 	= $page;

			if($page == "add") {

				$data['title'] 	= "Tambah Hotel";
				$this->load->view('hotel/hotel/add', $data, FALSE);
			} elseif($page == "edit") {

				$hotel = $this->hotel->hotel(['d_hotel.code' => $code])->row();
				$data['hotel'] = $hotel;

				$data['title'] = "Edit Hotel: {$hotel->name}";
				$this->load->view('hotel/hotel/edit', $data, FALSE);
			}

		} elseif($type == "room") {

			$data['page'] 	= $type;
			$data['type'] 	= $page;

			if($page == "add") {

				$data['code'] = $code;

				$data['title'] 	= "Tambah Tipe Kamar Hotel";
				$this->load->view('hotel/room/add', $data, FALSE);

			} elseif($page == "edit") {

				$room = $this->hotel->room(['d_hotel_room.code' => $code])->row();
				$data['room'] = $room;

				$data['code'] = $room->code;

				$data['title'] = "Edit Tipe Kamar Hotel: {$room->name}";
				$this->load->view('hotel/room/edit', $data, FALSE);
			}

		} elseif($type == "roomNumber") {

			$data['page'] 	= $type;
			$data['type'] 	= $page;

			if($page == "add") {

				$data['code'] = $code;

				$data['title'] 	= "Tambah Nomor Kamar";
				$this->load->view('hotel/room-number/add', $data, FALSE);

			} elseif($page == "edit") {

				$roomNumber = $this->hotel->room_number(['d_hotel_room_number.code' => $code])->row();
				$data['roomNumber'] = $roomNumber;

				$data['code'] = $roomNumber->code;

				$data['title'] = "Edit Nomor Kamar: {$roomNumber->number}";
				$this->load->view('hotel/room-number/edit', $data, FALSE);
			}
		}

	}

	public function process($method)
	{
		$page = $this->input->post('page');

		if($page == "hotel") {

			$name = $this->input->post('name');
			$data['name'] = $name;

			$description = $this->input->post('description');
			$data['description'] = $description;

			$address = $this->input->post('address');
			$data['address'] = $address;

			$star = $this->input->post('star');
			$data['star'] = $star;

			$status = $this->input->post('status');
			$data['status'] = $status;

			if(!is_dir(FCPATH.'/assets/img/hotel/')) {
				mkdir(FCPATH.'/assets/img/hotel/', 0777);
			}
			$config['upload_path'] 		= FCPATH.'/assets/img/hotel/';
			$config['allowed_types'] 	= 'jpg|png|jpeg';
			$config['max_size']  		= '3000';
	        $config['encrypt_name']     = TRUE;
	    	$this->upload->initialize($config);

	    	if($this->upload->do_upload('img')) {
				$data['img'] = $this->upload->data('file_name');
			}

			if($method == "save") {

				$this->db->insert('d_hotel', $data);

			} elseif($method == "update") {

				$code = $this->input->post('code');
				$this->db->update('d_hotel', $data, ['code' => $code]);
			}

		} elseif($page == "room") {

			$code = $this->input->post('code');

			$name = $this->input->post('name');
			$data['name'] = $name;

			$description = $this->input->post('description');
			$data['description'] = $description;

			$price = $this->input->post('price');
			$data['price'] = $price;

			$status = $this->input->post('status');
			$data['status'] = $status;

			if(!is_dir(FCPATH.'/assets/img/hotel/room/')) {
				mkdir(FCPATH.'/assets/img/hotel/room/', 0777);
			}
			$config['upload_path'] 		= FCPATH.'/assets/img/hotel/room/';
			$config['allowed_types'] 	= 'jpg|png|jpeg';
			$config['max_size']  		= '3000';
	        $config['encrypt_name']     = TRUE;
	    	$this->upload->initialize($config);

	    	if($this->upload->do_upload('img')) {
				$data['img'] = $this->upload->data('file_name');
			}

			if($method == "save") {
				$data['hotel'] = $code;

				$this->db->insert('d_hotel_room', $data);

			} elseif($method == "update") {
				
				$this->db->update('d_hotel_room', $data, ['code' => $code]);
			}

		} elseif($page == "roomNumber") {

			$code = $this->input->post('code');

			$number = $this->input->post('number');
			$data['number'] = $number;

			$status = $this->input->post('status');
			$data['status'] = $status;

			if($method == "save") {
				$data['room'] = $code;

				$this->db->insert('d_hotel_room_number', $data);

			} elseif($method == "update") {
				
				$this->db->update('d_hotel_room_number', $data, ['code' => $code]);
			}
		}

	}



}

/* End of file Hotel.php */
/* Location: ./application/modules/administrator/controllers/Hotel.php */ ?>