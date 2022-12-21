<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('administrator/dashboard','refresh');
	}

}

/* End of file Administrator.php */
/* Location: ./application/modules/administrator/controllers/Administrator.php */ ?>