<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
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

		$data['title'] = 'Menu Management';

		$data['menu'] = $this->db->get('user_menu')->result_array();
		
		$this->form_validation->set_rules('menu','Menu', 'required');

		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/index', $data);
		$this->load->view('templates/footer');

	}else{

		$menu = $this->input->post('menu');
		$this->db->insert('user_menu', ['menu' => $menu ]);

		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				New Menu Added!
				</div>');
				redirect('menu');

	}

	}


public function subMenu()
{

		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Submenu Management';

		$this->load->model('Menu_model', 'menu');
		
		$data['subMenu'] = $this->menu->getSubMenu();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title','Title', 'required');
		$this->form_validation->set_rules('menu_id','Menu', 'required');
		$this->form_validation->set_rules('url','Url', 'required');
		$this->form_validation->set_rules('icon','Icon', 'required');
		

		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/submenu', $data);
		$this->load->view('templates/footer');

	}else{

		$data = [

				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
		];

		$this->db->insert('user_sub_menu', $data);

		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				New Sub Menu Added!
				</div>');
				redirect('menu/submenu');

	}

}


public function deleteMenu($menuId)
{

	

	$this->db->delete('user_menu',['id' => $menuId]);
 	
 	// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Menu Delete!
				</div>');
				redirect('menu');


}

public function deleteSubMenu($menuId)
{


	$this->db->delete('user_sub_menu', ['id'=> $menuId]);

	// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				SubMenu Delete Success!
				</div>');
				redirect('menu/submenu');

}


public function editMenu($menuId)
	{

		$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Edit Menu';

		$data['menuId'] = $this->db->get_where('user_menu',['id'=> $menuId])->row_array();
		
		$this->form_validation->set_rules('menu','Menu','required|trim');

		if($this->form_validation->run() == false){

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/editmenu', $data);
		$this->load->view('templates/footer');

	}else{

		$id = $this->input->post('id', true);
		$menu = $this->input->post('menu', true);
		

		$this->db->set('menu', $menu);
		$this->db->where('id', $id);
		$this->db->update('user_menu');


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Your menu has been updated!
				</div>');
				redirect('menu/index');

	}
}


public function editSubMenu($menuId)
{

$email = $this->session->userdata('email');

		$data['user'] = $this->db->get_where('user', ['email' => $email])->row_array(); 

		$data['title'] = 'Edit SubMenu';

		$data['smId'] = $this->db->get_where('user_sub_menu',['id'=> $menuId])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$data['menu_id'] = $this->db->get_where('user_menu',['id' => $data['smId']['menu_id'] ])->row_array();
		
		$this->form_validation->set_rules('title','Title','required|trim');

		if($this->form_validation->run() == false){

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/editsubmenu', $data);
		$this->load->view('templates/footer');

	}else{



		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$menu_id = $this->input->post('menu_id');
		$url = $this->input->post('url');
		$icon = $this->input->post('icon');
		$is_active = $this->input->post('is_active');
		

		$this->db->set('title', $title);
		$this->db->set('menu_id', $menu_id);
		$this->db->set('url', $url);
		$this->db->set('icon', $icon);
		$this->db->set('is_active', $is_active);
		$this->db->where('id', $id);
		$this->db->update('user_sub_menu');


		// flashdata message
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
 				Your submenu has been updated!
				</div>');
				redirect('menu/subMenu');

	}


}


}