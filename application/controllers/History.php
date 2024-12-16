<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class History extends CI_Controller 
{

public function __construct()
	{
		parent:: __construct();

		is_logged_in();

	}



public function index()
{

	$email = $this->session->userdata('email');
	$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
	$data['title'] = 'Rekapitulasi Penjualan';


	$this->load->model('Model_barang','barang');
	

	// ambil data keyword

	if($this->input->post('keyword')){
	 $data['keyword'] = $this->input->post('keyword');
	 $this->session->set_userdata('keyword', $data['keyword']);

	}else{

		$data['keyword'] = $this->session->unset_userdata('keyword');
	}



	$data['transaksi'] = $this->barang->tableJoinHistory($data['keyword']);

		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('history/index', $data);
		$this->load->view('templates/footer');

}

		

}