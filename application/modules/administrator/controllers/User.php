<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/m_user', 'user');
	}

	public function index()
	{
		$data['title'] = "Data Pengguna";
		$this->load->view('user/index', $data, FALSE);
	}

	public function table()
	{
		$table 	= $this->user->table('table');
		$filter = $this->user->table('filter');
		$total 	= $this->user->table('total');

		$no = $this->input->get('start');
		$data = [];
		foreach($table as $tables) {
			$no++;
			$td = [];

			$td[] = $no;
			$td[] = $tables->name;
			$td[] = $tables->username;
			$td[] = $tables->email;
			$td[] = $tables->role_name;
			$td[] = $tables->status_name;

			$btnEdit = "
				<div class='p-1'>
					<button
						type='button'
						class='btn btn-sm btn-warning'
						onclick='getEdit(`{$tables->code}`)'
					>
						Edit
					</button>
				</div>
			";

			$menu = "
				<div class='d-flex justify-content-center'>
					{$btnEdit}
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

	public function page($type)
	{
		$data['type'] = $type;
		
		if($type == "edit") {

			$code = $this->input->get('code');
			$user = $this->user->user(['d_user.code' => $code])->row();
			$data['user'] = $user;

			$status 		= $this->db->get_where('m_status', ['for' => "activation"])->result();
			$data['status'] = $status;

			$data['title'] = "Edit: {$user->name}";
			$this->load->view('user/edit', $data, FALSE);

		} else {

			$status 		= $this->db->get_where('m_status', ['for' => "activation"])->result();
			$data['status'] = $status;

			$data['title'] = "Tambah Administrator";
			$this->load->view('user/add', $data, FALSE);
		}
	}

	public function process($method)
	{
		$name = $this->input->post('name');
		$data['name'] = $name;

		$email = $this->input->post('email');
		if(empty($email)) {
			$email = null;
		}
		$data['email'] = $email;

		$status = $this->input->post('status');
		$data['status'] = $status;
		
		if($method == "save") {

			$username = $this->input->post('username');
			$data['username'] = $username;

			$role = "ADMIN";
			$data['role'] = $role;

			$password = $this->input->post('password');
			$data['password'] = password_hash($password, PASSWORD_DEFAULT);

			$this->db->insert('d_user', $data);

		} elseif($method == "update") {

			$code = $this->input->post('code');

			$data['updated_at'] = date('Y-m-d H:i:s');

			$this->db->update('d_user', $data, ['code' => $code]);
		}
	}

}

/* End of file User.php */
/* Location: ./application/modules/administrator/controllers/User.php */ ?>