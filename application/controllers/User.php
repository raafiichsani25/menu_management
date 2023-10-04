<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
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

		$data['title'] = 'My Profile';
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');

	}


	public function edit()
	{

		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Edit Profile';
		
		$this->form_validation->set_rules('name','Name','required|trim');

		if($this->form_validation->run() == false){

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/edit', $data);
		$this->load->view('templates/footer');

	}else{

		$name = $this->input->post('name');
		$email = $this->input->post('email');


		// cek jika ada gambar yang diupload
		$upload_image = $_FILES['image']['name'];

		if($upload_image){
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']		= '2000';
			$config['upload_path'] 	='./assets/img/profile';

			$this->load->library('upload', $config);


			if($this->upload->do_upload('image')){

				$old_image = $data['user']['image'];
				if($old_image != 'default.jpg'){
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}

				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);

			}else{
				echo $this->upload->display_errors();

			}
		}


		$this->db->set('name', $name);
		$this->db->where('email', $email);
		$this->db->update('user');


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Your Profile has been updated!
				</div>');
				redirect('user');

	}


	}


	public function changepassword()
	{

		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Change Password';


		
		$this->form_validation->set_rules('current_password','Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1','New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2','Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');



		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/changepassword', $data);
		$this->load->view('templates/footer');
	}else{

		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password1');

		if(!password_verify($current_password, $data['user']['password'])){ 

			// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 				Wrong Current Password!
				</div>');
				redirect('user/changepassword');
		}else{

			if($current_password == $new_password){
				// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 				New password cannot be the same as current password!
				</div>');
				redirect('user/changepassword');

			}else{

				// password sudah benar
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

				$this->db->set('password',$password_hash);
				$this->db->where('email', $this->session->userdata['email']);
				$this->db->update('user');


				// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Password Changed!
				</div>');
				redirect('user/changepassword');

			}
		}

	}


	}

}