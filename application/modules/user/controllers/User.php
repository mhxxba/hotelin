<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaction', 'transaction');
	}

	public function index()
	{
		
	}

	public function transaction($url = "")
	{
		if(!empty($url)) {
			return $this->detail($url);
		}

		$user = $this->auth->user();
		
		$transactionWhere = ['d_order.user' => $user->code];
		$transaction 	= $this->transaction->table($transactionWhere)->result();
		$data['list'] 	= $transaction;

		$data['title'] = "Riwayat Transaksi";

		$this->load->view('transaction/index', $data, FALSE);
	}

	public function detail($code)
	{
		$user = $this->auth->user();
		
		$transactionWhere 	= ['d_order.user' => $user->code, 'd_order.code' => $code];
		$transaction 		= $this->transaction->table($transactionWhere)->row();

		if($transaction) {

			$data['user'] = $user;
			$data['transaction'] = $transaction;
			$data['title'] = "Detail Order";
			$this->load->view('transaction/detail', $data, FALSE);

		} else {
			redirect('user/transaction','refresh');
		}

	}

}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */ ?>