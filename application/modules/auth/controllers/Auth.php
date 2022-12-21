<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if($this->auth->is_login()) {

			redirect('/','refresh');

		} else {

			// Start Form Validation
				$validation_config = [
					[
						'field' => "username",
						'label' => "Username",
						'rules' => "trim|required|min_length[5]|max_length[50]",
					],

					[
						'field' => "password",
						'label' => "Password",
						'rules' => "trim|required|min_length[5]|max_length[255]",
					],
				];
				$this->form_validation->set_rules($validation_config);
				$this->form_validation->set_message(
					'required',
					'<div class="alert alert-danger alert-dismissible">
						<b>{field}</b> HARUS DIISI!
						<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
			// End Form Validation

			// Start Validation Checking

				if($this->form_validation->run() == TRUE) {

					$username 	= $this->input->post('username');
					$password 	= $this->input->post('password');

					$user = $this->auth->login_checker($username)->row();
					if($user) {

						$password_checker = password_verify($password, $user->password);
						if($password_checker) {

							if($user->status == "act_active") {

								$session['id'] 			= $user->code;
								$session['is_login'] 	= true;

								$this->session->set_userdata($session);
								
								$data['status'] = true;

							} else {
								$data['status'] = false;
								$data['error'] = '
									<div class="alert alert-danger alert-dismissible">
										<span class="font-weight-bold">
											Akun Anda Sudah Tidak Aktif!
											Harap Hubungi Admin
										</span>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
										</button>
									</div>';
								$data['title'] = "Masuk";
							}

						} else {
							$data['status'] = false;
							$data['error'] = '
								<div class="alert alert-danger alert-dismissible">
									<span class="font-weight-bold">
										Password Salah!
									</span>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
									</button>
								</div>';
							$data['title'] = "Masuk";
						}

					} else {
						$data['status'] = false;
						$data['error'] = '
							<div class="alert alert-danger alert-dismissible">
								<span class="font-weight-bold">
									Akun Tidak Ditemukan
								</span>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								</button>
							</div>';
						$data['title'] = "Masuk";
					}

					$this->output->set_content_type('application/json')->set_output(json_encode($data));

				}

			// End Validation Checking

		}
	}

	public function checker()
	{
		$type = $this->input->get('type');
		switch ($type) {
			case 'signin':

				$data['title'] = "Masuk";
				$this->load->view('signin', $data, FALSE);
				break;

			case 'signup':

				$data['title'] = "Daftar";
				$this->load->view('signup', $data, FALSE);
				break;

			case 'forgot':

				$data['title'] 		= "Lupa Password";
				$this->load->view('forgot', $data, FALSE);
				break;
			
			default:
				$data['title'] = "Masuk";
				$this->load->view('signin', $data, FALSE);
				break;
		}
	}

	public function signup_process()
	{
		// Start Form Validation
			$validation_config = [
				[
					'field' => "name",
					'label' => "Name",
					'rules' => "trim|required|min_length[5]|max_length[255]",
				],
				[
					'field' => "username",
					'label' => "Username",
					'rules' => "trim|required|min_length[5]|max_length[255]|is_unique[d_user.username]",
					[
						'is_unique' => "Username Sudah Digunakan! Harap Gunakan Username Lain."
					]
				],

				[
					'field' => "password",
					'label' => "Password",
					'rules' => "trim|required|min_length[5]|max_length[255]",
				]
			];
			$this->form_validation->set_rules($validation_config);
			$this->form_validation->set_message(
				'required',
				'<div class="alert alert-danger alert-dismissible">
					<b>{field}</b> HARUS DIISI!
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				</div>'
			);
		// End Form Validation

		// Start Validation Checking
			if($this->form_validation->run() == TRUE) {

				$name 		= $this->input->post('name');
				$username 	= $this->input->post('username');
				$password 	= password_hash($this->input->post('password'), PASSWORD_DEFAULT);

				$user_checker = $this->db->get_where('d_user', ['username' => $username])->row();

				if(!$user_checker) {

					$data['name'] 		= $name;
					$data['username'] 	= $username;
					$data['password'] 	= $password;
					$data['role'] 		= "USER";

					$this->db->insert('d_user', $data);
					$user = $this->db->insert_id();
					$user = $this->db->get_where('d_user', ['id' => $user])->row();

					$session['id'] 			= $user->code;
					$session['is_login'] 	= true;

					$this->session->set_userdata($session);

					$output['status'] = true;
					$output['title'] = "Pendaftaran Berhasil!";
					$output['desc'] = "Anda mulai bisa melakukan Booking Online!";

				} else {
					$output['status'] = false;
					$output['title'] = "Username Sudah Digunakan!";
					$output['desc'] = "Harap Gunakan Username Lain.";
				}

				$this->output->set_content_type('application/json')->set_output(json_encode($output));

			}
		// End Validation Checking
	}

	public function change_password()
	{
		$id 		= $this->session->userdata('id');
		$password 	= $this->input->post('password');
		$password 	= password_hash($password, PASSWORD_DEFAULT);

		$data['password'] 	= $password;
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->update('d_user', $data, ['code' => $id]);
	}

	public function update()
	{
		$user = $this->auth->user();

		$name = $this->input->post('name');
		
		$email = $this->input->post('email');
		$user = $this->auth->get_user(['email' => $email])->row();
		
		try {

			if($user) {
				throw new Exception("Email sudah digunakan", 500);
			}

			$data['name'] 	= $name;
			$data['email'] 	= $email;
			$this->db->update('d_user', $data, ['code' => $user->code]);
			
			$output['status'] = true;
			$output['title'] = "Berhasil!";
			$output['desc'] = "Profil anda berhasil diperbarui";

			$this->output->set_content_type('application/json')->set_output(json_encode($output));

		} catch (Exception $e) {
			$output['status'] = false;
			$output['title'] = "Gagal!";
			$output['desc'] = $e->getMessage();
		}

	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect('/','refresh');
	}

}

/* End of file Auth.php */
/* Location: ./application/modules/auth/controllers/Auth.php */ ?>