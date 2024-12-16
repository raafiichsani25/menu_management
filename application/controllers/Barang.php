<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class Barang extends CI_Controller 
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

		$data['title'] = 'Data Barang';

		$this->load->model('Model_barang','barang');


	// load pagination
	$this->load->library('pagination');


	// config
	$config['base_url'] = 'http://localhost/wpu-login/barang/index';
	$config['total_rows'] = $this->barang->hitungBarang();
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
	$data['barang'] = $this->barang->getBarangDb($config['per_page'], $data['start']);
	
	
		

		$this->form_validation->set_rules('nama_barang','Barang','required|trim');
		$this->form_validation->set_rules('modal','Modal','required|trim');
		$this->form_validation->set_rules('harga_jual','Harga Jual','required|trim');
		$this->form_validation->set_rules('stok','Stok','required|trim');
		
		// $this->form_validation->set_rules('nis','Nis','required|trim|is_unique[siswa.nis]',

		// 	[
		// 		'is_unique' => ' Nomer Induk Siswa Sudah Terdaftar!'
		// 	]
		// );

		
		if($this->form_validation->run() == false){	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('barang/index', $data);
		$this->load->view('templates/footer');

	}else{

		
			
			$this->barang->save_data_barang();


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Barang Ditambahkan!
				</div>');
				redirect('Barang/index');


	}
}




public function search()
{

	$email = $this->session->userdata('email');
	$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
	$data['title'] = 'Data Barang';


	$this->load->model('Model_barang','barang');
	

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
	$config['base_url'] = 'http://localhost/wpu-login/Barang/index';
	$config['total_rows'] = $this->barang->hitungBarang();
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
	$data['barang'] = $this->barang->getBarangDb($config['per_page'], $data['start'],$data['keyword']);

		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('barang/index', $data);
		$this->load->view('templates/footer');


}



public function editBarang($idBarang)
{
		
		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Edit Data Barang';

		$data['barang'] = $this->db->get_where('barang',['id'=> $idBarang])->row_array();

		$this->form_validation->set_rules('nama_barang','Barang','required|trim');
		
		$this->form_validation->set_rules('stok','Stok','required|trim');

		$this->load->model('Model_barang','barang');

		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('barang/editbarang', $data);
		$this->load->view('templates/footer');

	}else{

		$id = $this->input->post('id', true);
		


		// cek jika ada gambar yang diupload
		$upload_image = $_FILES['gambar']['name'];
		

		if($upload_image){
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']		 = '2000';
			$config['upload_path'] 	 ='./assets/img/barang';

			$this->load->library('upload', $config);


			if($this->upload->do_upload('gambar')){

				$old_image = $data['barang']['gambar'];
				if($old_image != 'default.jpg'){
					unlink(FCPATH . 'assets/img/barang/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->barang->getGambarBarang($idBarang, $new_image);

			}else{
				echo $this->upload->display_errors();

			}
		}

		$this->barang->getBarang($idBarang);

	
		
		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Barang Berhasil di Ubah!
				</div>');
				redirect('Barang/editBarang/'.$idBarang);

	}		
}




public function deleteBarang($idBarang)
{

	$data['barang'] = $this->db->get_where('barang', ['id' => $idBarang])->row_array();

	

	$old_image = $data['barang']['gambar'];
	if($old_image != 'default.jpg'){
		unlink(FCPATH . 'assets/img/barang/' . $old_image );
	}

	$old_image_qrcode = $data['barang']['qrcode_path'];
	unlink(FCPATH . 'assets/img/qrcode-barang/' . $old_image_qrcode);

	$this->db->delete('barang',['id' => $idBarang]);
	$this->db->delete('transaksi',['barang_id' => $idBarang]);
	

	// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Barang Berhasil Dihapus!
				</div>');
				redirect('Barang/index');





}


public function printBarang($idBarang)
{
	$data['title'] = 'Print Barcode Barang';
	$data['barang'] = $this->db->get_where('barang',['id' => $idBarang])->row_array();
	$this->load->view('print/printBarang', $data);

}


public function pdfBarang()
{

	require 'dompdf/vendor/autoload.php';
 	
 	$this->load->model('Model_barang','barang');
	
	$data['title'] = "Reporting Barang";

	$data['total_rows'] = $this->barang->hitungBarang();

	$data['barang'] = $this->db->get('barang')->result_array();

	$this->load->view('pdf/pdfBarang', $data);

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
		$dompdf->stream('laporan_data_barang.pdf', array('Attachment' => 0));

	

}




public function untuk_isinya(){
	
 		
    $query = "SELECT  `nama_barang`,`stok` AS `stok_akhir`
               FROM `barang` ";
               
                    
                    $periksa = $this->db->query($query)->result_array();

                    $no = 1;

                    foreach($periksa as $pr){
                      if($pr['stok_akhir'] == 1){
                        echo "<div style = 'padding:5px' style='width:50px'><span class='glyphicon glyphicon-info-sign'></span> Barang <a style='color:blue'>".$pr['nama_barang']."</a>, Stok Tinggal Satu </div>";
                      }elseif($pr['stok_akhir'] == 0){
                         echo "<div style = 'padding:5px' style='width:50px'><span class='glyphicon glyphicon-info-sign'></span> Barang  <a style='color:blue'>".$pr['nama_barang']."</a>, Stok Barang Habis </div>";
                      
                      }else{
                       
                      }
                      $no++;
                    }
                   
}







}

