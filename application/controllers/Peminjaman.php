<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// reference the Dompdf namespace
	    use Dompdf\Dompdf;

class Peminjaman extends CI_Controller 
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
	$data['title'] = 'Peminjaman Buku';

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
	
	$config['total_rows'] = $this->menu->hitungPinjam();
	$data['total_rows'] = $config['total_rows'];
	$config['per_page'] = 3;


  	$config['attributes'] = array('class' => 'page-link');


	// initialize
	$this->pagination->initialize($config);


	$data['start'] = $this->uri->segment(3,0);
	$data['peminjaman'] = $this->menu->getPeminjaman($config['per_page'],$data['start'],$data['keyword']);


		
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/peminjaman', $data);
		$this->load->view('templates/footer');

	

}

public function tambah(){

	$email = $this->session->userdata('email');
	$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
	$data['title'] = 'Tambah Peminjaman Buku';



		// $this->form_validation->set_rules('siswa_id','Siswa','required|trim');
		// $this->form_validation->set_rules('buku_id','Buku','required|trim');

		if($this->input->post('siswa_id') == null){

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/tambahpinjam', $data);
		$this->load->view('templates/footer');

		}else{

  	$siswa_id = $this->input->post('siswa_id', true);
		$buku_id = $this->input->post('buku_id', true);
		//$tanggal_pengembalian = $this->input->post('tanggal_pengembalian', true);
		//$keterangan = $this->input->post('keterangan', true);


		$siswa = $this->db->get_where('siswa',['qrcode_data' => $siswa_id])->row_array();
		$buku = $this->db->get_where('buku',['qrcode_data' => $buku_id])->row_array();

		//$data['siswa'] = $siswa["nama"];
		//$data["buku"] = $buku['judul'];

		$pinjam = $this->db->get_where('peminjaman',['siswa_id' => $siswa['id'], 'buku_id' => $buku['id']]);
		

		if($pinjam->num_rows() <= 0 ){
	
  	 $tgl = date("Y-m-d");
  	// echo date('Y-m-d', strtotime($tgl. ' + 5 days'));
  
		$data = [
					'siswa_id' => $siswa['id'],
					'buku_id' => $buku['id'],
					'tanggal_pinjam' => time(),
					'tanggal_pengembalian' => strtotime($tgl. ' + 5 days'),
					'keterangan' => 'Pinjam'

				];

			 $this->db->insert('peminjaman',$data);
				
					// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Peminjaman Buku Berhasil Ditambahkan
				</div>');
				redirect('Peminjaman');			 

			}else{


				// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 				Data Peminjaman Sudah Ada/Memiliki Buku Tersebut 
				</div>');
				redirect('Peminjaman/tambah');

			}
		
}
}

public function namaSiswa(){

	  $siswa_id = $this->input->post('siswa_id', true);
	 
	 	$siswa = $this->db->get_where('siswa',['qrcode_data' => $siswa_id])->row_array();
		
    $data['siswa'] = $siswa["nama"];
			echo json_encode($data);

}


public function judulBuku(){

	$buku_id = $this->input->post('buku_id', true);

	$buku = $this->db->get_where('buku',['qrcode_data' => $buku_id])->row_array();
  $data["buku"] = $buku['judul'];
	echo json_encode($data);

		
}







public function editPinjam($idPinjam)
{

		$email = $this->session->userdata('email');
		$data['user'] = $this->db->get_where('user',['email' => $email])->row_array();
		$data['title'] = 'Edit Data Pinjam Buku';

		$data['siswa'] = $this->db->get('siswa')->result_array();
		$data['buku'] = $this->db->get('buku')->result_array();


		
		$data['peminjaman'] = $this->db->get_where('peminjaman',['id'=> $idPinjam])->row_array();

		$this->form_validation->set_rules('siswa_id','Siswa','required|trim');
		$this->form_validation->set_rules('buku_id','Buku','required|trim');
		
		$this->form_validation->set_rules('tanggal_pengembalian','Pengembalian','required|trim');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');


		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('perpustakaan/editpinjam', $data);
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
					$this->db->where('id', $idPinjam);
					$this->db->update('peminjaman');



			// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Data Peminjaman Buku Berhasil di Ubah!
				</div>');
				redirect('Peminjaman');


	}


}



public function kembali($id)
{
		
		$result = $this->db->get_where('peminjaman',['id' => $id])->row_array();

		$data = [

			'siswa_id' => $result['siswa_id'],
			'buku_id' => $result['buku_id'],
			'tanggal_pinjam'=> $result['tanggal_pinjam'],
			'tanggal_pengembalian' => $result['tanggal_pengembalian'],
			'keterangan'=> $result['keterangan']

		];

		$query = $this->db->get_where('peminjaman', $data);



		if( $query->num_rows() > 0 ){
		
		$this->db->delete('peminjaman',$data);
		$this->db->insert('pengembalian', [

				'siswa_id' => $result['siswa_id'],
				'buku_id' => $result['buku_id'],
				'tanggal_pinjam'=> $result['tanggal_pinjam'],
				'tanggal_pengembalian' => time(),
				'keterangan'=> 'Buku Sudah diKembalikan'

		]);

			
		}


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Buku Sudah diKembalikan!
				</div>');
				redirect('peminjaman/index');

}



// public function untuk_buttonnya(){

//      $tgl = date("Y-m-d");

//      $query = "SELECT COUNT(`tanggal_pengembalian`) AS `jumlah_total` 
//      FROM `peminjaman` 
//      "AND" (`tanggal_pengembalian` < '$tgl' "OR" `tanggal_pengembalian` = '$tgl' 

//     	 "OR" DATEDIFF(`tanggal_pengembalian`,'$tgl') = 3 

//      	 "OR" DATEDIFF(`tanggal_pengembalian`,'$tgl') = 2

//      	 "OR" DATEDIFF(`tanggal_pengembalian`,'$tgl') = 1)";

//      $result = $this->db->query($query)->row_array();
//      echo json_encode($result);
// }


public function untuk_isinya(){
	
 		$tgl = date("Y-m-d");
    $query = "SELECT DATEDIFF(FROM_UNIXTIME(`tanggal_pengembalian`), '$tgl') AS `interval_tgl`,`siswa`.`nama`,				`buku`.`judul`
               FROM `peminjaman`
               INNER JOIN `siswa` ON `peminjaman`.`siswa_id` = `siswa`.`id` 
               INNER JOIN `buku` ON `peminjaman`.`buku_id` = `buku`.`id` ";
                    
                    $periksa = $this->db->query($query)->result_array();

                    $no = 1;

                    foreach($periksa as $pr){
                      if($pr['interval_tgl'] == 1){
                        echo "<div style = 'padding:5px' style='width:50px'><span class='glyphicon glyphicon-info-sign'></span> Member <a style='color:red'>".$pr['nama']."</a>, Besok adalah batas pengembalian buku -> </div><a style='color:blue'>".$pr['judul']."</a>";
                      }elseif($pr['interval_tgl'] == 2){
                         echo "<div style = 'padding:5px' style='width:50px'><span class='glyphicon glyphicon-info-sign'></span> Member <a style='color:red'>".$pr['nama']."</a>, Batas Pengembalian Buku Tinggal 2 Hari -></div><a style='color:blue'>".$pr['judul']."</a>";
                      }elseif ($pr['interval_tgl'] == 3) {
                          echo "<div style = 'padding:5px' style='width:50px'><span class='glyphicon glyphicon-info-sign'></span> Member <a style='color:red'>".$pr['nama']."</a>, Batas Pengembalian Buku Tinggal 3 Hari -></div><a style='color:blue'>".$pr['judul']."</a>";
                      }elseif($pr['interval_tgl'] == 0){
                        echo "<div style = 'padding:5px' style='width:50px'><span class='glyphicon glyphicon-info-sign'></span> Member <a style='color:red'>".$pr['nama']."</a>, Hari Ini Batas Pengembalian Buku -></div><a style='color:blue'>".$pr['judul']."</a>";
                      }elseif ($pr['interval_tgl'] < 0) {
                         echo "<div style = 'padding:5px' style='width:50px'><span class='glyphicon glyphicon-info-sign'></span> Member <a style='color:red'>".$pr['nama']."</a>, Telah Melewati Batas Pengembalian Buku -></div><a style='color:blue'>".$pr['judul']."</a>";
                      }else{
                       
                      }
                      $no++;
                    }
                   
}


public function pdfPinjam()
{

	require 'dompdf/vendor/autoload.php';
	
	$data['title'] = "Reporting Pinjam Buku";

	$this->load->model('Menu_model','menu');

	$data['total_rows'] = $this->menu->hitungPinjam();

	  $query = "SELECT `peminjaman`.*,`siswa`.`nama`,`buku`.`judul` 

				 		   FROM `peminjaman`

							 INNER JOIN `siswa` ON `peminjaman`.`siswa_id` = `siswa`.`id`

						   INNER JOIN `buku` ON `peminjaman`.`buku_id` = `buku`.`id`
				 		 	 ORDER BY `peminjaman`.`id` ASC

					 	";

		$data['peminjaman'] =	$this->db->query($query)->result_array();

	$this->load->view('pdf/pdfPinjam', $data);

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
		$dompdf->stream('laporan_data_pinjam_buku.pdf', array('Attachment' => 0));

}


}