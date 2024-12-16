<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_barang extends CI_Model 
{


	public function getBarangDb($limit, $start, $keyword = null){

		if($keyword){	

		$query = "SELECT * 

				 FROM `barang`

				  WHERE 
				  
				  barang.nama_barang like '%$keyword%' or 
				  barang.stok like '%$keyword%' or
				  barang.qrcode_data like '%$keyword%'

				  ORDER BY `barang`.`id` ASC ";


		} elseif (!$keyword){

			$query = "SELECT * FROM `barang` 
			 ORDER BY `barang`.`id` ASC
			 limit $limit offset $start ";
			
		}



		  return $this->db->query($query)->result_array();		

	}



	public function hitungBarang()
	{

		return $this->db->get('barang')->num_rows();

	}



	//  mencari qrcode data barang
	public function get_data($qrcode_date="")
	{
		$this->db->select('*')
					->from('barang');

		if(!empty($qrcode_data)){
			$this->db->where('qrcode_data', $qrcode_data);
		}

		$result = $this->db->get();
		return $result->result_array();


	}


	public function save_data_barang()
		{
			$nama_barang = $this->input->post('nama_barang');
			$modal = $this->input->post('modal');
			$harga_jual = $this->input->post('harga_jual');
			$stok = $this->input->post('stok');


			$qrcode_data = $this->input->post('qrcode_data');

				if(!$qrcode_data){
					$qrcode_data = $this->_generate_data_qrcode();

				}else{

				    $qrcode_data = $this->input->post('qrcode_data');

				}
			

			$tgl = date("Y-m-d");

			

		
		if($modal >= $harga_jual){
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 				Harga Modal Lebih Besar Dari Harga Jual, Tambah Barang Gagal!
				</div>');
		redirect('Barang/index');

      
        }else{


        	$data = [ 
				      'nama_barang'=> htmlspecialchars($nama_barang, true),
				 	  'gambar'=> 'default.jpg',
				 	  'modal' => htmlspecialchars($modal,true),
				 	  'harga_jual' => htmlspecialchars($harga_jual, true),
				  	  'stok' => htmlspecialchars($stok, true),
					  
					  'qrcode_path' => $this->_generate_qrcode($nama_barang, $qrcode_data),
					  'qrcode_data' => $qrcode_data,
					  'date' => $tgl

			];

			$this->db->insert('barang',$data);
		}



		}


		// generate qrcode data barang

		public function _generate_data_qrcode()
		{
			$this->load->helper('string');
			$code = strtoupper(random_string('alnum', 6));
			$cek_data = $this->get_data($code);
			if(!empty($cek_data)){
				$code = substr_replace($code, count($cek_data)+1, 5);
			}
			return $code;

		}

		// akhir qrcode data barang


	// generate qrcode path barang
	public function _generate_qrcode($nama_barang, $data_code)
	{

		

		$directory = "./assets/img/qrcode-barang";
		$file_name = str_replace(" ","", strtolower($nama_barang)).rand(pow(10, 2), pow(10, 3));


		if(!is_dir($directory)){

			mkdir($directory, 0777, TRUE);
		}

		$config['cacheable'] = true;
		$config['quality']	= true;
		$config['size']	= '1024';
		$config['black'] = array(224, 255, 255);
		$config['white'] = array(70, 130, 180);

		$this->ciqrcode->initialize($config);

		$image_name = $file_name.'.png';


		$params['data'] = $data_code;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = $directory.'/'.$image_name;

		$this->ciqrcode->generate($params);

		return $image_name;


	}
	 //akhir qrcode path barang


public function getGambarBarang($id,$getGambar)
	{
	

		$this->db->set('gambar', $getGambar);
		$this->db->where('id', $id);
		$this->db->update('barang');
	}

	public function getBarang($id)
	{
		
		
		$nama_barang = $this->input->post('nama_barang', true);
		$modal = $this->input->post('modal',true);
		$harga_jual = $this->input->post('harga_jual',true);
		$stok = $this->input->post('stok', true);
		$tgl = date("Y-m-d");


		if($modal >= $harga_jual){
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 				Harga Modal Lebih Besar Dari Harga Jual, Edit Barang Gagal!
				</div>');
		redirect('Barang/editBarang/'. $id);

      
        }else{

		$this->db->set('nama_barang',$nama_barang);
		$this->db->set('modal', $modal);
		$this->db->set('harga_jual',$harga_jual);
		$this->db->set('stok', $stok);
		$this->db->set('date', $tgl);
		$this->db->where('id', $id);
		$this->db->update('barang');
		}

		
		
	}





	public function save_data_transaksi($idPembeli)
		{

			

			$barang = $this->db->get_where('barang',['qrcode_data' => $this->input->post('barang_id')])->row_array();

			$barang_id = $barang['id'];

			$qty = $this->input->post('qty');
			$jumlah = $this->session->userdata('jumlah');
			
			date_default_timezone_set('Asia/Jakarta');
			$tgl = date("Y-m-d H:i:s");
		
			$transaksi = [ 
					  'pembeli_id'=> $idPembeli,
				      'barang_id'=> htmlspecialchars($barang_id, true),
				  	   'qty' => htmlspecialchars($qty, true),
				  	   'jumlah' => htmlspecialchars($jumlah, true),
				  	   'date' => $tgl				  	   
					];
			

			$stokawal = $barang['stok'];

			$kurangstok = $stokawal - $qty;
			

			
			#logic jika jumlah qty melebihi stok barang
			if ($qty <= $stokawal ) {

			$this->db->insert('transaksi',$transaksi);

			
			$this->db->set('stok', $kurangstok);
			$this->db->where('id', $barang_id);
			$this->db->update('barang');

			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 				Qty Melebihi Jumlah Stok
				</div>');

				redirect('Transaksi/tambahTransaksi/'.$idPembeli);
			}


		}


	public function tableJoinTransaksi($idPembeli)
	{
			
		

			$query = "SELECT `transaksi`.*,`barang`.`nama_barang`,`modal`,`harga_jual`,`pembeli`.`pembeli` 

				  FROM `transaksi`

			  	  INNER JOIN `barang` ON `transaksi`.`barang_id` = `barang`.`id`
			  	  INNER JOIN `pembeli` ON `transaksi`.`pembeli_id` = `pembeli`.`id`

			  	  WHERE `transaksi`.`pembeli_id` = $idPembeli

				";

					

		return $this->db->query($query)->result_array();


	}


	public function tableJoinEditTransaksi($idTransaksi)
	{
			
		

			$query = "SELECT `transaksi`.*,`barang`.`nama_barang`,`pembeli`.`pembeli`

				  FROM `transaksi`

			  	  INNER JOIN `barang` ON `transaksi`.`barang_id` = `barang`.`id`
			  	  INNER JOIN `pembeli` ON `transaksi`.`pembeli_id` = `pembeli`.`id`
			  	 

			  	  WHERE `transaksi`.`id` = $idTransaksi

				";

					

		return $this->db->query($query)->row_array();


	}



	public function save_data_pembeli()
		{

			$pembeli = $this->input->post('pembeli');
			
			 $tgl = date("Y-m-d");
			
			$pembeli = [ 
					  'pembeli'=> htmlspecialchars($pembeli, true),
				      'date'=> strtotime($tgl)
				  	   
					];

			
			$this->db->insert('pembeli',$pembeli);

		}


public function getPembeliDb($limit, $start, $keyword = null){

		$keywords = strtotime($keyword);

		if($keywords){	

		$query = "SELECT * 

				 FROM `pembeli`

				  WHERE 
				  
				  pembeli.date like '%$keywords%'  
				  

				  ORDER BY `pembeli`.`id` ASC ";


		} elseif (!$keywords){

			$query = "SELECT * FROM `pembeli` 


			 ORDER BY `pembeli`.`id` ASC
			 
			 limit $limit offset $start ";
			
		}



		  return $this->db->query($query)->result_array();		

	}


	public function hitungPembeli()
	{

		return $this->db->get('pembeli')->num_rows();

	}

	public function hitungTransaksi($idPembeli)
	{


		return $this->db->get_where('transaksi',['pembeli_id' => $idPembeli])->num_rows();

	}


	public function editPembeli($idPembeli)
	{
		$pembeli = $this->input->post('pembeli',true);
		$date = $this->input->post('date', true);



		$data = [
					'pembeli' => htmlspecialchars($pembeli),
					'date' => strtotime($date)


				];


		$this->db->set($data);
		
		$this->db->where('id',$idPembeli);
		$this->db->update('pembeli');


	}


	public function editTransaksi($idTransaksi)
	{

		$post = $this->input->post('barang_id');
		$barang = $this->db->get_where('barang',['qrcode_data' => $post])->row_array();



		$barang_id = $barang['id'];
		$qty = $this->input->post('qty', true);

		$this->db->set('barang_id', htmlspecialchars($barang_id));
		$this->db->set('qty', htmlspecialchars($qty));
		$this->db->where('id', $idTransaksi);
		$this->db->update('transaksi');

	}




	public function tableJoinHistory($keyword = null)
	{
			
		if($keyword){

		$query = "SELECT `transaksi`.*,`barang`.`nama_barang`,`modal`,`harga_jual`,`pembeli`.`pembeli` 

				  FROM `transaksi`

			  	  INNER JOIN `barang` ON `transaksi`.`barang_id` = `barang`.`id`
			  	  INNER JOIN `pembeli` ON `transaksi`.`pembeli_id` = `pembeli`.`id`
 

			  	  WHERE 
				  
				 transaksi.date like '%$keyword%'
				 
			  	 ORDER BY `transaksi`.`date` ASC
			  	  
			  	 

				";


				} elseif(!$keyword){
				
					$query = "SELECT `transaksi`.*,`barang`.`nama_barang`,`modal`,`harga_jual`,`pembeli`.`pembeli` 

				  FROM `transaksi`

			  	  INNER JOIN `barang` ON `transaksi`.`barang_id` = `barang`.`id`
			  	  INNER JOIN `pembeli` ON `transaksi`.`pembeli_id` = `pembeli`.`id`



			  	   ORDER BY `transaksi`.`date` ASC
			  	  


				";		
		}


					

		return $this->db->query($query)->result_array();


	}



}
