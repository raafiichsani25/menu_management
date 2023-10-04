<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class Perpustakaan extends CI_Controller 
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

		$data['title'] = 'Data Siswa';

		$this->load->model('Menu_model','menu');


	// load pagination
	$this->load->library('pagination');


	// config
	$config['base_url'] = 'http://localhost/wpu-login/perpustakaan/index';
	$config['total_rows'] = $this->menu->hitungSiswa();
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
	$data['siswa'] = $this->menu->getSiswaDb($config['per_page'], $data['start']);
	
	
		

		$this->form_validation->set_rules('nama','Nama','required|trim');
		$this->form_validation->set_rules('nis','Nis','required|trim|is_unique[siswa.nis]',

			[
				'is_unique' => ' Nomer Induk Siswa Sudah Terdaftar!'
			]
		);

		
		if($this->form_validation->run() == false){	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/index', $data);
		$this->load->view('templates/footer');

	}else{

		
			
			$this->menu->save_data();


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Siswa Ditambahkan!
				</div>');
				redirect('Perpustakaan/index');


	}
}


public function search()
{

	$email = $this->session->userdata('email');
	$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
	$data['title'] = 'Data Siswa';


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
	$config['base_url'] = 'http://localhost/wpu-login/perpustakaan/index';
	$config['total_rows'] = $this->menu->hitungSiswa();
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
	$data['siswa'] = $this->menu->getSiswaDb($config['per_page'], $data['start'],$data['keyword']);

		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/index', $data);
		$this->load->view('templates/footer');



}




public function deleteSiswa($idSiswa)
{

	$data['siswa'] = $this->db->get_where('siswa', ['id' => $idSiswa])->row_array();

	

	$old_image = $data['siswa']['foto'];
	if($old_image != 'default.jpg'){
		unlink(FCPATH . 'assets/img/siswa/' . $old_image );
	}

	$old_image_qrcode = $data['siswa']['qrcode_path'];
	unlink(FCPATH . 'assets/img/qrcode/' . $old_image_qrcode);

	$this->db->delete('siswa',['id' => $idSiswa]);

	$this->db->delete('peminjaman',['siswa_id' => $data['siswa']['id']]);
	$this->db->delete('pengembalian',['siswa_id' => $data['siswa']['id']]);
	

	// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Siswa Dihapus!
				</div>');
				redirect('Perpustakaan');





}


public function editSiswa($idSiswa)
{
		
		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Edit Data Siswa';

		$data['siswa'] = $this->db->get_where('siswa',['id'=> $idSiswa])->row_array();

		$this->form_validation->set_rules('nama','Nama','required|trim');
		
		$this->form_validation->set_rules('nis','Nis','required|trim');

		$this->load->model('Menu_model','menu');

		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/editsiswa', $data);
		$this->load->view('templates/footer');

	}else{

		$id = $this->input->post('id', true);
		


		// cek jika ada gambar yang diupload
		$upload_image = $_FILES['foto']['name'];
		

		if($upload_image){
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']		 = '2000';
			$config['upload_path'] 	 ='./assets/img/siswa';

			$this->load->library('upload', $config);


			if($this->upload->do_upload('foto')){

				$old_image = $data['siswa']['foto'];
				if($old_image != 'default.jpg'){
					unlink(FCPATH . 'assets/img/siswa/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->menu->getFotoSiswa($idSiswa, $new_image);

			}else{
				echo $this->upload->display_errors();

			}
		}

		$this->menu->getSiswa($idSiswa);

	
		
		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Siswa Berhasil di Update!
				</div>');
				redirect('Perpustakaan/index');

	}		
}


public function printSiswa($idSiswa)
{
	$data['title'] = 'Print Data Siswa';
	$data['siswa'] = $this->db->get_where('siswa',['id' => $idSiswa])->row_array();
	$this->load->view('print/printSiswa', $data);

}

public function pdfSiswa()
{

	require 'dompdf/vendor/autoload.php';
 	
 	$this->load->model('Menu_model','menu');
	
	$data['title'] = "Reporting Siswa";

	$data['total_rows'] = $this->menu->hitungSiswa();

	$data['siswa'] = $this->db->get('siswa')->result_array();

	$this->load->view('pdf/pdfSiswa', $data);

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
		$dompdf->stream('laporan_data_siswa.pdf', array('Attachment' => 0));

	

}


}
