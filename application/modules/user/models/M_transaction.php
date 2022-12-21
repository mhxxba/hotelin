<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaction extends CI_Model {

	public function table($where)
	{
		// d_order
		$this->db->select('
			d_order.code, d_order.customer, d_order.booking_date, d_order.duration,
			d_order.price, d_order.note, d_order.attachment, d_order.created_at
		');

		// d_hotel_room
		$this->db->select('
			d_hotel_room.name as room_name
		');

		// d_hotel_room_number
		$this->db->select('
			d_hotel_room_number.number as room_number
		');

		// d_hotel
		$this->db->select('
			d_hotel.name as hotel_name, d_hotel.img as hotel_img,
			d_hotel.address as hotel_address
		');

		// d_user
		$this->db->select('
			d_user.name as user_name
		');

		// payment
		$this->db->select('
			payment.name as payment_name, payment.code as payment_code
		');

		// status
		$this->db->select('
			status.name as status_name, status.code as status_code
		');

		$this->db->from('d_order');

		$this->db->join(
			'd_hotel_room',
			'd_hotel_room.code = d_order.room',
			'left'
		);

		$this->db->join(
			'd_hotel_room_number',
			'd_hotel_room_number.code = d_order.room_number',
			'left'
		);

		$this->db->join(
			'd_hotel',
			'd_hotel.code = d_hotel_room.hotel',
			'left'
		);

		$this->db->join(
			'd_user',
			'd_user.code = d_order.user',
			'left'
		);

		$this->db->join(
			'm_data as payment',
			'payment.code = d_order.payment',
			'left'
		);

		$this->db->join(
			'm_status as status',
			'status.code = d_order.status',
			'left'
		);

		$this->db->where($where);

		$this->db->order_by('created_at', 'desc');

		return $this->db->get();
	}

}

/* End of file M_transaction.php */
/* Location: ./application/modules/user/models/M_transaction.php */ ?>