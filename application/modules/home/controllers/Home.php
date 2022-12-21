<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = "Booking Online Hotel Terbaik!";
		$this->load->view('index', $data, FALSE);
	}

}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */ ?>