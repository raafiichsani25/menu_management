<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class Transaksi extends CI_Controller 
{

public function __construct()
	{
		parent:: __construct();

		is_logged_in();

	}

	

public function tambahTransaksi($idPembeli)
{
		
		

		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Data Transaksi';


		$this->load->model('Model_barang','barang');

		$data['total_rows'] = $this->barang->hitungTransaksi($idPembeli);


		$data['pembeli'] = $this->db->get_where('pembeli',['id' => $idPembeli])->row_array();
		$data['transaksi'] = $this->barang->tableJoinTransaksi($idPembeli);


		$this->form_validation->set_rules('barang_id','Barang','required|trim');
		$this->form_validation->set_rules('qty','Qty','required|trim');


		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/index', $data);
		$this->load->view('templates/footer');

	}else{

		$this->barang->save_data_transaksi($idPembeli);

		
		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Transaksi Ditambahkan!
				</div>');

				redirect('Transaksi/tambahTransaksi/'.$idPembeli);
				
			
	}

}


public function namaBarang(){

	  $barang_id = $this->input->post('barang_id', true);
	 
	 	$barang = $this->db->get_where('barang',['qrcode_data' => $barang_id])->row_array();
		
		    $data['barang'] = $barang["nama_barang"];
		    $data['gambar'] = $barang["gambar"];
		    $data['modal'] = $barang['modal'];
		    $data['harga_jual'] = $barang['harga_jual'];
		    $data['stok'] = $barang["stok"];

			echo json_encode($data);


}






public function editTransaksi($idTransaksi)
{
		
		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Edit Data Transaksi';

		
		$this->form_validation->set_rules('barang_id','Barang','required|trim');
		$this->form_validation->set_rules('qty','Qty','required|trim');

		
		$this->load->model('Model_barang','barang');
	

		$data['transaksi'] = $this->barang->tableJoinEditTransaksi($idTransaksi);



		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_radika', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/edittransaksi', $data);
		$this->load->view('templates/footer');

	}else{

		
		$this->barang->editTransaksi($idTransaksi);

	
	
		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Transaksi Berhasil di Ubah!
				</div>');
				redirect('Transaksi/editTransaksi/'. $idTransaksi);

	}		
}


public function deleteTransaksi($idTransaksi)
{


	$transaksi = $this->db->get_where('transaksi',['id' => $idTransaksi ])->row_array();

	$idPembeli = $transaksi['pembeli_id'];


	$stokAwal = $this->db->get_where('barang',['id' => $transaksi['barang_id']])->row_array();

	$stokNew = 0;
	$stokNew = $stokAwal['stok'] + $transaksi['qty'];

	$this->db->set('stok', $stokNew );
	$this->db->where('id',$stokAwal['id']);
	$this->db->update('barang');

	$this->db->delete('transaksi',['id' => $idTransaksi]);


	
	

	// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Sukses Data Transaksi Berhasil Dihapus!
				</div>');
				redirect('Transaksi/tambahTransaksi/'.$idPembeli);





}



public function pdfTransaksi($idPembeli)
{

	require 'dompdf/vendor/autoload.php';
	
	$data['title'] = "Reporting Transaksi";

	$this->load->model('Model_barang','barang');

	$data['total_rows'] = $this->barang->hitungTransaksi($idPembeli);


	$data['pembeli'] = $this->db->get_where('pembeli',['id' => $idPembeli])->row_array();

	$data['transaksi'] = $this->barang->tableJoinTransaksi($idPembeli);

	$this->load->view('pdf/pdfTransaksi', $data);

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
		$dompdf->stream('laporan_data_transaksi.pdf', array('Attachment' => 0));

}




}