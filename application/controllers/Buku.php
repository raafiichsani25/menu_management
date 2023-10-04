<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class Buku extends CI_Controller 
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

		$data['title'] = 'Data Buku';

		$this->load->model('Menu_model','menu');



	// load pagination
	$this->load->library('pagination');


	// config
	$config['base_url'] = 'http://localhost/wpu-login/buku/index';
	$config['total_rows'] = $this->menu->hitungBuku();
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
	$data['buku'] = $this->menu->getBukuDb($config['per_page'], $data['start']);
	
	


		$this->form_validation->set_rules('kode','Kode','required|trim|is_unique[buku.kode]',
				[
				 'is_unique' => 'Kode Buku Sudah Terdaftar'
				]
			);

		$this->form_validation->set_rules('judul','Judul','required|trim');
		$this->form_validation->set_rules('penulis','Penulis','required|trim');
		$this->form_validation->set_rules('penerbit','Penerbit','required|trim');
		$this->form_validation->set_rules('tahun','Tahun','required|trim');

		
		if($this->form_validation->run() == false){	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/buku', $data);
		$this->load->view('templates/footer');

	}else{

		
			$this->menu->save_data_buku();
		


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Buku Ditambahkan!
				</div>');
				redirect('Buku/index');

	}


}


public function search()
{

	$email = $this->session->userdata('email');
	$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
	$data['title'] = 'Data Buku';


	$this->load->model('Menu_model','menu');
	


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
	$config['base_url'] = 'http://localhost/wpu-login/buku/index';
	$config['total_rows'] = $this->menu->hitungBuku();
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
	$data['buku'] = $this->menu->getBukuDb($config['per_page'], $data['start'], $data['keyword']);
	
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/buku', $data);
		$this->load->view('templates/footer');

}


public function deleteBuku($idBuku)
{
	$data['buku']=$this->db->get_where('buku',['id' => $idBuku])->row_array();

	$old_image = $data['buku']['gambar'];
	if($old_image != 'default.jpg'){
	unlink(FCPATH . 'assets/img/buku/' . $old_image );
	}

	$old_image_qrcode = $data['buku']['qrcode_path'];
	unlink(FCPATH . 'assets/img/qrcodebuku/' . $old_image_qrcode );
	 $this->db->delete('buku',['id'=> $idBuku]);

	 $this->db->delete('peminjaman',['buku_id' => $data['buku']['id']]);
	 $this->db->delete('pengembalian',['buku_id' => $data['buku']['id']]);


// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Buku Dihapus!
				</div>');
				redirect('Buku/index');



}


public function editBuku($idBuku)
{
	$email = $this->session->userdata('email');
	$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
	$data['title'] = 'Edit Data Buku';


	$data['buku'] = $this->db->get_where('buku',['id' => $idBuku])->row_array();


		$this->form_validation->set_rules('judul','Judul','required|trim');

		$this->form_validation->set_rules('penulis','Penulis','required|trim');
		$this->form_validation->set_rules('penerbit','Penerbit','required|trim');
		$this->form_validation->set_rules('tahun','Tahun','required|trim');

		
		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/editbuku', $data);
		$this->load->view('templates/footer');

	}else{


		$id = $this->input->post('id', true);
		$kode = $this->input->post('kode', true);
		$judul = $this->input->post('judul', true);
		$penulis = $this->input->post('penulis', true);
		$penerbit = $this->input->post('penerbit', true);
		$tahun = $this->input->post('tahun', true);
		


		// cek jika ada gambar yang diupload
		$upload_image = $_FILES['gambar']['name'];
		

		if($upload_image){
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']		 = '2000';
			$config['upload_path'] 	 ='./assets/img/buku';

			$this->load->library('upload', $config);


			if($this->upload->do_upload('gambar')){

				$old_image = $data['buku']['gambar'];
				if($old_image != 'default.jpg'){
					unlink(FCPATH . 'assets/img/buku/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				
				$this->db->set('gambar',$new_image);

			}else{
				echo $this->upload->display_errors();

			}
		}

		$this->db->set('kode',$kode);
		$this->db->set('judul',$judul);
		$this->db->set('penulis',$penulis);
		$this->db->set('penerbit',$penerbit);
		$this->db->set('tahun',$tahun);
		$this->db->where('id', $idBuku);
		$this->db->update('buku');

	
		
		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Buku Berhasil di Update!
				</div>');
				redirect('Buku');


	}

}

public function printBuku($idBuku)
{
	$data['title'] = 'Print Data Buku';
	$data['buku'] = $this->db->get_where('buku',['id' => $idBuku])->row_array();
	$this->load->view('print/printBuku', $data);

}

public function pdfBuku()
{

	require 'dompdf/vendor/autoload.php';
 	
 	$this->load->model('Menu_model','menu');
	
	$data['title'] = "Reporting Buku";

	$data['total_rows'] = $this->menu->hitungBuku();

	$data['buku'] = $this->db->get('buku')->result_array();

	$this->load->view('pdf/pdfBuku', $data);

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
		$dompdf->stream('laporan_data_buku.pdf', array('Attachment' => 0));

}




}
