<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model 
{

	public function getSubMenu()
	{
	
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`

				FROM `user_sub_menu` JOIN `user_menu`
				ON `user_sub_menu`.`menu_id` = `user_menu`.`id`

		";

		return $this->db->query($query)->result_array();


	}

// qrcode data siswa
	public function get_data($qrcode_date="")
	{
		$this->db->select('*')
					->from('siswa');

		if(!empty($qrcode_data)){
			$this->db->where('qrcode_data', $qrcode_data);
		}

		$result = $this->db->get();
		return $result->result_array();


	}

	public function save_data()
	{
		$nama = $this->input->post('nama');
		$nis = $this->input->post('nis');

		$qrcode_data = $this->_generate_data_qrcode();

		$data = [ 
			      'nama'=> htmlspecialchars($nama, true),
			 	  'foto'=> 'default.jpg',
			  	   'nis' => htmlspecialchars($nis, true),

				 	'qrcode_path' => $this->_generate_qrcode($nama, $qrcode_data),

				  	'qrcode_data' => $qrcode_data

		];

		$this->db->insert('siswa',$data);



	}

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

	// akhir qrcode data

// generate qrcode path siswa
public function _generate_qrcode($nama, $data_code)
{

	

	$directory = "./assets/img/qrcode";
	$file_name = str_replace(" ","", strtolower($nama)).rand(pow(10, 2), pow(10, 3));


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
 //akhir qrcode path siswa 



	public function getFotoSiswa($id,$getFoto)
	{
	

		$this->db->set('foto', $getFoto);
		$this->db->where('id', $id);
		$this->db->update('siswa');
	}

	public function getSiswa($id)
	{
		
		
		$nama = $this->input->post('nama', true);
		$nis = $this->input->post('nis', true);

		
		$this->db->set('nama',$nama);
		$this->db->set('nis', $nis);
		$this->db->where('id', $id);
		$this->db->update('siswa');
	}

	public function getSiswaDb($limit, $start, $keyword = null){

		if($keyword){	

		$query = "SELECT * 

				 FROM `siswa`

				  WHERE 
				  
				  siswa.nama like '%$keyword%' or 
				  siswa.nis like '%$keyword%' or
				  siswa.qrcode_data like '%$keyword%'

				  ORDER BY `siswa`.`id` ASC ";


		} elseif (!$keyword){

			$query = "SELECT * FROM `siswa` 
			 ORDER BY `siswa`.`id` ASC
			 limit $limit offset $start ";
			
		}



		  return $this->db->query($query)->result_array();		

	}

	public function getBukuDb($limit, $start, $keyword = null){

		if($keyword){	

		$query = "SELECT * 

				 FROM `buku`

				  WHERE 
				  
				  buku.kode like '%$keyword%' or 
				  buku.judul like '%$keyword%' or
				  buku.penulis like '%$keyword%' or
				  buku.penerbit like '%$keyword%' or
				  buku.tahun like '%$keyword%' or
				  buku.qrcode_data like '%$keyword%'

				  ORDER BY `buku`.`id` ASC ";


		} elseif (!$keyword){

			$query = "SELECT * FROM `buku`
				 ORDER BY `buku`.`id` ASC 
				 limit $limit offset $start ";
		}


		  return $this->db->query($query)->result_array();		

	}


	public function getPeminjaman($limit, $start, $keyword = null)
	{
		if($keyword){	
				
			$query = "SELECT `peminjaman`.*,`siswa`.`nama`,`buku`.`judul` 

				  FROM `peminjaman`

			  	  INNER JOIN `siswa` ON `peminjaman`.`siswa_id` = `siswa`.`id`

				  INNER JOIN `buku` ON `peminjaman`.`buku_id` = `buku`.`id`
				  WHERE 
				  
				  siswa.nama like '%$keyword%' or 
				  siswa.qrcode_data like '%$keyword%' or
				  buku.judul like '%$keyword%' or 
				  buku.qrcode_data like '%$keyword%' 
				  

				  ORDER BY `peminjaman`.`id` ASC


				  limit $limit offset $start


				";
					
			} elseif(!$keyword){
				$query = "SELECT `peminjaman`.*,`siswa`.`nama`,`buku`.`judul` 

				 		  FROM `peminjaman`

			  			  INNER JOIN `siswa` ON `peminjaman`.`siswa_id` = `siswa`.`id`

						  INNER JOIN `buku` ON `peminjaman`.`buku_id` = `buku`.`id`
				 		  ORDER BY `peminjaman`.`id` ASC


				          limit $limit offset $start


				";


		
		}


		return $this->db->query($query)->result_array();

		

	}




	public function getPengembalian($limit, $start, $keyword = null)
	{

		if($keyword){	
				
			$query = "SELECT `pengembalian`.*,`siswa`.`nama`,`buku`.`judul` 

				  FROM `pengembalian`

			  	  INNER JOIN `siswa` ON `pengembalian`.`siswa_id` = `siswa`.`id`

				  INNER JOIN `buku` ON `pengembalian`.`buku_id` = `buku`.`id`
				  WHERE 
				  
				  siswa.nama like '%$keyword%' or 
				  siswa.qrcode_data like '%$keyword%' or
				  buku.judul like '%$keyword%' or 
				  buku.qrcode_data like '%$keyword%' 
				  

				  ORDER BY `pengembalian`.`id` ASC


				  limit $limit offset $start


				";

	} elseif(!$keyword){
		$query = "SELECT `pengembalian`.*,`siswa`.`nama`,`buku`.`judul` 

				FROM `pengembalian`

			  	 INNER JOIN `siswa` ON `pengembalian`.`siswa_id` = `siswa`.`id`

				 INNER JOIN `buku` ON `pengembalian`.`buku_id` = `buku`.`id`

				ORDER BY `pengembalian`.`id` ASC

				LIMIT $limit offset $start


		";

	}

		return $this->db->query($query)->result_array();


	}






public function hitungSiswa()
	{

		return $this->db->get('siswa')->num_rows();

	}

	public function hitungBuku()
	{
		return $this->db->get('buku')->num_rows();
	}
	

	public function hitungPinjam()
	{

		return $this->db->get('peminjaman')->num_rows();

	}


	public function hitungKembali()
	{

		return $this->db->get('pengembalian')->num_rows();

	}








	public function get_data_buku($qrcode_date="")
	{
		$this->db->select('*')
					->from('buku');

		if(!empty($qrcode_data)){
			$this->db->where('qrcode_data', $qrcode_data);
		}

		$result = $this->db->get();
		return $result->result_array();


	}


	public function save_data_buku()
	{

		$kode = $this->input->post('kode', true);
		$judul = $this->input->post('judul', true);
		$penulis = $this->input->post('penulis', true);
		$penerbit = $this->input->post('penerbit', true);
		$tahun = $this->input->post('tahun', true);

		$qrcode_data = $this->_generate_data_qrcode_buku();

		$data = [ 

			      	'kode'=> htmlspecialchars($kode),
					'judul'=> htmlspecialchars($judul),
			 		 'gambar'=> 'default.jpg',
			  		 'penulis'=> htmlspecialchars($penulis),
			  		 'penerbit'=> htmlspecialchars($penerbit),
			  	 	'tahun'=> htmlspecialchars($tahun),

				 	'qrcode_path' => $this->_generate_qrcode_buku($judul, $qrcode_data),

				  	'qrcode_data' => $qrcode_data

		];

		$this->db->insert('buku',$data);



	}

	public function _generate_data_qrcode_buku()
	{
		$this->load->helper('string');
		$code = strtoupper(random_string('alnum', 6));
		$cek_data = $this->get_data_buku($code);
		if(!empty($cek_data)){
			$code = substr_replace($code, count($cek_data)+1, 5);
		}
		return $code;

	}

	

	public function _generate_qrcode_buku($judul, $data_code)
{

	

	$directory = "./assets/img/qrcodebuku";
	$file_name = str_replace(" ","", strtolower($judul)).rand(pow(10, 2), pow(10, 3));


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




}


