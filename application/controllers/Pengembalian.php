<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class Pengembalian extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();

		is_logged_in();

	}



public function index()
{

	    $email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Pengembalian Buku';

		$data['siswa'] = $this->db->get('siswa')->result_array();
		$data['buku'] = $this->db->get('buku')->result_array();


		$this->load->model('Menu_model','menu');
		

	// load pagination
	$this->load->library('pagination');


	// ambil data keyword

	if($this->input->post('keyword')){
	 $data['keyword'] = $this->input->post('keyword');
	 $this->session->set_userdata('keyword', $data['keyword']);

	

	}else{

		$data['keyword'] = $this->session->unset_userdata('keyword');
	
	}


	// config
	$config['base_url'] = 'http://localhost/wpu-login/Pengembalian/index';
	$config['total_rows'] = $this->menu->hitungKembali();
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
	$data['pengembalian'] = $this->menu->getPengembalian($config['per_page'],$data['start'],$data['keyword']);


		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/pengembalian', $data);
		$this->load->view('templates/footer');


}



public function editPengembalian($id)
{

		$email = $this->session->userdata('email');
		$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
		$data['title'] = 'Edit Data Pengembalian Buku';

		$data['siswa'] = $this->db->get('siswa')->result_array();
		$data['buku'] = $this->db->get('buku')->result_array();


		
		$data['pengembalian'] = $this->db->get_where('pengembalian',['id'=> $id])->row_array();

		$this->form_validation->set_rules('siswa_id','Siswa','required|trim');
		$this->form_validation->set_rules('buku_id','Buku','required|trim');
		
		$this->form_validation->set_rules('tanggal_pengembalian','Pengembalian','required|trim');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');


		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/editpengembalian', $data);
		$this->load->view('templates/footer');

	}else{

			$siswa_id = $this->input->post('siswa_id', true);
			$buku_id = $this->input->post('buku_id', true);
			$tanggal_pinjam = $this->input->post('tanggal_pinjam', true);
			$tanggal_pengembalian = $this->input->post('tanggal_pengembalian', true);
			$keterangan = $this->input->post('keterangan', true);


			$data = [

						'siswa_id' => htmlspecialchars($siswa_id),
						'buku_id' => htmlspecialchars($buku_id),
						'tanggal_pinjam' => strtotime($tanggal_pinjam),
						'tanggal_pengembalian' =>  strtotime($tanggal_pengembalian),
						'keterangan' => htmlspecialchars($keterangan)


					];


					$this->db->set($data);
					$this->db->where('id', $id);
					$this->db->update('pengembalian');



			// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Pengembalian Buku Berhasil di Ubah!
				</div>');
				redirect('Pengembalian/index');


	}


}


public function deletePengembalian($idPinjam)
{

	$this->db->delete('pengembalian',['id' => $idPinjam]);

	// flashdata message
	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 	Data Berhasil Dihapus!
	</div>');
	redirect('Pengembalian/index');

}



public function pdfPengembalian()
{

	require 'dompdf/vendor/autoload.php';
	
	$data['title'] = "Reporting Pengembalian Buku";

	$this->load->model('Menu_model','menu');

	$data['total_rows'] = $this->menu->hitungKembali();

	  $query = "SELECT `pengembalian`.*,`siswa`.`nama`,`buku`.`judul` 

				 		   FROM `pengembalian`

							 INNER JOIN `siswa` ON `pengembalian`.`siswa_id` = `siswa`.`id`

						   INNER JOIN `buku` ON `pengembalian`.`buku_id` = `buku`.`id`
				 		 	 ORDER BY `pengembalian`.`id` ASC

					 	";

		$data['pengembalian'] =	$this->db->query($query)->result_array();

	$this->load->view('pdf/pdfPengembalian', $data);

	    // instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$options = $dompdf->getOptions();
			$options->setDefaultFont('Courier');
			$dompdf->setOptions($options);
			
			$html = $this->output->get_output();
			$dompdf->loadHtml($html);
			

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'potrait');

		$dompdf->load_html($html);

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream('laporan_data_kembali_buku.pdf', array('Attachment' => 0));

}


}