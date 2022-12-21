<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function is_login()
	{
		return $this->session->userdata('is_login');
	}

	public function user($id = "")
	{
		if(empty($id)) {
			$id = $this->session->userdata('id');
		}

		$user = $this->db->get_where('d_user', ['code' => $id])->row();
		if($user) {

			return $user;

		} else {
			redirect('/','refresh');
		}
	}

	public function login_checker($username)
	{
		$this->db->group_start();
			$this->db->where('username', $username);
			$this->db->or_where('email', $username);
		$this->db->group_end();

		return $this->db->get('d_user');
	}

	public function get_user($where)
	{
		return $this->db->get_where('d_user', $where);
	}


}

/* End of file M_auth.php */
/* Location: ./application/modules/auth/models/M_auth.php */ ?>