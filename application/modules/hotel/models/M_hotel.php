<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hotel extends CI_Model {

	public function list($where = "")
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('name', 'RANDOM');
		return $this->db->get('d_hotel');
	}

	public function room($where = "")
	{
		if(!empty($where)) {
			$this->db->where($where);
		}

		$this->db->order_by('price', 'ASC');
		return $this->db->get('d_hotel_room');
	}

}

/* End of file M_hotel.php */
/* Location: ./application/modules/hotel/models/M_hotel.php */ ?>