
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class Pembeli extends CI_Controller 
{


	public function __construct()
	{
		parent:: __construct();

		is_logged_in();

	}



public function index(){

	$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Pembeli';

		$this->load->model('Model_barang','barang');


		// logic ambil id terbesar dari id tabel pembeli

     	$query = "SELECT `id` FROM `pembeli` ORDER BY `id` DESC LIMIT 1";

     	$idterakhir = $this->db->query($query)->row_array();

     	$satu = 1;

     	$data['idnext'] = $idterakhir['id'] + $satu;


     	// akhir logic ambil id terbesar dari id tabel pembeli 



    
		// load pagination
	$this->load->library('pagination');


	// config
	$config['base_url'] = 'http://localhost/wpu-login/Pembeli/index';
	$config['total_rows'] = $this->barang->hitungPembeli();
	$data['total_rows'] = $config['total_rows'];
	$config['per_page'] = 3;
	$config['num_links'] = 5;


	// styling
	$config['full_tag_open'] = '<nav aria-label="pagination justify-content-center">
  								<ul class="pagination">';

  	$config['full_tag_close'] ='</ul></nav>';


  	$config['first_link'] = 'First ';
  	$config['first_tag_open '] = '<li class="page-item">';
  	$config['first_tag_close '] = '</li>';


	$config['last_link'] = 'Last ';
  	$config['last_tag_open '] = '<li class="page-item">';
  	$config['last_tag_close '] = '</li>';


	$config['prev_link'] = '&raquo ';
  	$config['next_tag_open '] = '<li class="page-item">';
  	$config['next_tag_close '] = '</li>';


  	$config['prev_link'] = '&laquo ';
  	$config['prev_tag_open '] = '<li class="page-item">';
  	$config['prev_tag_close '] = '</li>';


  	$config['cur_tag_open '] = '<li class="page-item active"><a class="page-link" href="#">';
  	$config['cur_tag_close '] = '</a></li>';

  	$config['num_tag_open '] = '<li class="page-item">';
  	$config['num_tag_close '] = '</li>';


  	$config['attributes'] = array('class' => 'page-link');


	// initialize
	$this->pagination->initialize($config);
	


	$data['start'] = $this->uri->segment(3,0);
	$data['pembeli'] = $this->barang->getPembeliDb($config['per_page'], $data['start']);



		$this->form_validation->set_rules('pembeli','Pembeli','required|trim');


		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pembeli/index', $data);
		$this->load->view('templates/footer');

	}else{

		$this->barang->save_data_pembeli();


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Pembeli Ditambahkan!
				</div>');
				redirect('Transaksi/tambahTransaksi/'. $data['idnext']);
}

}


public function search()
{

	$email = $this->session->userdata('email');
	$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
	$data['title'] = 'Data Pembeli';


	$this->load->model('Model_barang','barang');



	// logic ambil id terbesar dari id tabel pembeli

     	$query = "SELECT `id` FROM `pembeli` ORDER BY `id` DESC LIMIT 1";

     	$idterakhir = $this->db->query($query)->row_array();

     	$satu = 1;

     	$data['idnext'] = $idterakhir['id'] + $satu;


     	// akhir logic ambil id terbesar dari id tabel pembeli 

     	
	

	// ambil data keyword

	if($this->input->post('keyword')){
	 $data['keyword'] = $this->input->post('keyword');
	 $this->session->set_userdata('keyword', $data['keyword']);

	}else{

		$data['keyword'] = $this->session->unset_userdata('keyword');
	}



	// load pagination
	$this->load->library('pagination');

	// config
	$config['base_url'] = 'http://localhost/wpu-login/Pembeli/index';
	$config['total_rows'] = $this->barang->hitungPembeli();
	$data['total_rows'] = $config['total_rows'];
	$config['per_page'] = 3;
	$config['num_links'] = 5;


	// styling
	$config['full_tag_open'] = '<nav aria-label="pagination justify-content-center">
  								<ul class="pagination">';

  	$config['full_tag_close'] ='</ul></nav>';


  	$config['first_link'] = 'First ';
  	$config['first_tag_open '] = '<li class="page-item">';
  	$config['first_tag_close '] = '</li>';


	$config['last_link'] = 'Last ';
  	$config['last_tag_open '] = '<li class="page-item">';
  	$config['last_tag_close '] = '</li>';


	$config['prev_link'] = '&raquo ';
  	$config['next_tag_open '] = '<li class="page-item">';
  	$config['next_tag_close '] = '</li>';


  	$config['prev_link'] = '&laquo ';
  	$config['prev_tag_open '] = '<li class="page-item">';
  	$config['prev_tag_close '] = '</li>';


  	$config['cur_tag_open '] = '<li class="page-item active"><a class="page-link" href="#">';
  	$config['cur_tag_close '] = '</a></li>';

  	$config['num_tag_open '] = '<li class="page-item">';
  	$config['num_tag_close '] = '</li>';


  	$config['attributes'] = array('class' => 'page-link');


	// initialize
	$this->pagination->initialize($config);
	


	$data['start'] = $this->uri->segment(3,0);
	$data['pembeli'] = $this->barang->getPembeliDb($config['per_page'], $data['start'],$data['keyword']);

		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pembeli/index', $data);
		$this->load->view('templates/footer');


}


public function editPembeli($idPembeli)
{
		
		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Edit Data Pembeli';

		$data['pembeli'] = $this->db->get_where('pembeli',['id'=> $idPembeli])->row_array();

		$this->form_validation->set_rules('pembeli','Pembeli','required|trim');
		
		$this->load->model('Model_barang','barang');



		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pembeli/editPembeli', $data);
		$this->load->view('templates/footer');

	}else{

		
		$this->barang->editPembeli($idPembeli);

	
		
		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Pembeli Berhasil di Ubah!
				</div>');
				redirect('Pembeli/editPembeli/'. $idPembeli);

	}		
}


public function deletePembeli($idPembeli)
{

	$data['pembeli'] = $this->db->get_where('pembeli', ['id' => $idPembeli])->row_array();



	$this->db->delete('pembeli',['id' => $idPembeli]);
	$this->db->delete('transaksi',['pembeli_id' => $idPembeli]);
	

	// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Pembeli Berhasil Dihapus!
				</div>');
				redirect('Pembeli/index');




}





}

