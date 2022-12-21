<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hotel extends CI_Model {

	public function hotel($where = "")
	{
		// d_hotel
		$this->db->select('
			d_hotel.code, d_hotel.name, d_hotel.slug,
			d_hotel.description, d_hotel.address, d_hotel.img, d_hotel.star
		');

		// status
		$this->db->select('
			status.name as status_name, status.code as status_code
		');

		$this->db->from('d_hotel');

		$this->db->join(
			'm_status as status',
			'status.code = d_hotel.status',
			'left'
		);


		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('d_hotel.created_at', 'desc');

		return $this->db->get();
	}

	public function room($where = "")
	{
		// d_hotel
		$this->db->select('
			d_hotel.name as hotel_name, d_hotel.code as hotel_code
		');

		// d_hotel_room
		$this->db->select('
			d_hotel_room.code, d_hotel_room.name, d_hotel_room.description, d_hotel_room.img,
			d_hotel_room.price
		');

		// status
		$this->db->select('
			status.name as status_name, status.code as status_code
		');

		$this->db->from('d_hotel_room');

		$this->db->join(
			'd_hotel',
			'd_hotel.code = d_hotel_room.hotel',
			'left'
		);

		$this->db->join(
			'm_status as status',
			'status.code = d_hotel_room.status',
			'left'
		);


		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('d_hotel_room.created_at', 'desc');

		return $this->db->get();
	}

	public function room_number($where = "")
	{
		// d_hotel
		$this->db->select('
			d_hotel.name as hotel_name
		');

		// d_hotel_room
		$this->db->select('
			d_hotel_room.name as room_name
		');

		// d_hotel_room_number
		$this->db->select('
			d_hotel_room_number.code, d_hotel_room_number.number
		');

		// status
		$this->db->select('
			status.name as status_name, status.code as status_code
		');

		$this->db->from('d_hotel_room_number');

		$this->db->join(
			'd_hotel_room',
			'd_hotel_room.code = d_hotel_room_number.room',
			'left'
		);

		$this->db->join(
			'd_hotel',
			'd_hotel.code = d_hotel_room.hotel',
			'left'
		);

		$this->db->join(
			'm_status as status',
			'status.code = d_hotel_room_number.status',
			'left'
		);


		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('d_hotel_room_number.created_at', 'desc');

		return $this->db->get();
	}

}

/* End of file M_hotel.php */
/* Location: ./application/modules/administrator/models/M_hotel.php */ ?>