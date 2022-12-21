<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function table($type)
	{
		if(($type == "table") || ($type == "filter")) {
			$awal 	= $this->input->get('length');
			$akhir 	= $this->input->get('start');
			$sv 	= strtolower($_GET['search']['value']);

			if($sv) {

				$search = $sv;
				$cari = 
				'
					d_user.name LIKE ' . "'%" . $search . "%'" . '
					OR
					d_user.username LIKE ' . "'%" . $search . "%'" . '
					OR
					d_user.email LIKE ' . "'%" . $search . "%'" . '
					OR
					role.name LIKE ' . "'%" . $search . "%'" . '
					OR
					role.code LIKE ' . "'%" . $search . "%'" . '
					OR
					status.name LIKE ' . "'%" . $search . "%'" . '
					OR
					status.code LIKE ' . "'%" . $search . "%'" . '
					
				';
				$k_search = $this->db->where("($cari)");

			} else {
				$k_search = "";
			}
		}
			
		// d_user
		$this->db->select('
			d_user.code, d_user.name, d_user.username, d_user.email
		');

		// role
		$this->db->select('
			role.name as role_name, role.code as role_code
		');

		// status
		$this->db->select('
			status.name as status_name, status.code as status_code
		');

		$this->db->from('d_user');

		$this->db->join(
			'm_status as status',
			'status.code = d_user.status',
			'left'
		);

		$this->db->join(
			'm_role as role',
			'role.code = d_user.role',
			'left'
		);

		if($type == "table") {

			if($awal == -1){
				$batas = "";
			}else{
				$batas = $this->db->limit($awal, $akhir);
			}

			$this->db->order_by('d_user.created_at', 'desc');

			return $this->db->get()->result();

		} elseif($type == "filter") {

			return $this->db->get()->num_rows();

		} else if($type == "total") {

			return $this->db->get()->num_rows();

		} else {
			return false;
		}
	}

	public function user($where)
	{
		// d_user
		$this->db->select('
			d_user.code, d_user.name, d_user.username, d_user.email
		');

		// role
		$this->db->select('
			role.name as role_name, role.code as role_code
		');

		// status
		$this->db->select('
			status.name as status_name, status.code as status_code
		');

		$this->db->from('d_user');

		$this->db->join(
			'm_status as status',
			'status.code = d_user.status',
			'left'
		);

		$this->db->join(
			'm_role as role',
			'role.code = d_user.role',
			'left'
		);

		$this->db->where($where);

		$this->db->order_by('d_user.created_at', 'desc');

		return $this->db->get();

	}

}

/* End of file M_user.php */
/* Location: ./application/modules/administrator/models/M_user.php */ ?>