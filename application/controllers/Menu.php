<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$this->data['user_id'] = $this->tank_auth->get_user_id();
			$this->data['username'] = $this->tank_auth->get_username();
			$this->data['email'] = $this->tank_auth->get_email();

			$profile = $this->tank_auth->get_user_profile($this->data['user_id']);

			$this->data['profile_name'] = $profile['name'];
			$this->data['profile_foto'] = $profile['foto'];

			foreach ($this->tank_auth->get_roles($this->data['user_id']) as $val) {
				$this->data['role_id'] = $val['role_id'];
				$this->data['role'] = $val['role'];
				$this->data['full_name_role'] = $val['full'];
			}

			$this->data['link_active'] = 'Menu';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Dashboard');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Menu_model");
		}
	}

	public function index()
	{
		$this->data['title'] = "Pengaturan Menu";

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengaturan / ',
			'class' => 'breadcrumb-item pe-3',
			'href' => ''
		];

		$this->data['breadcrumbs'][] = [
			'active' => TRUE,
			'text' => 'Pengaturan Menu',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Menu')
		];

		$this->data['listMenu'] = $this->Menu_model->getAllMenuwithjoin();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('menu/views', $this->data);
		$this->load->view('component/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('sort', 'Urutan Menu', 'required');

		if ($this->form_validation->run() == TRUE) {

			$data = array(
				'id_menu_parent' => $this->input->post('id_menu_parent'),
				'nama_menu' => $this->input->post('nama_menu'),
				'icon' => $this->input->post('icon'),
				'kategori' => $this->input->post('kategori'),
				'href' => $this->input->post('href'),
				'status' => $this->input->post('status'),
				'sort' => $this->input->post('sort')
			);

			$this->Menu_model->addMenu($data);

			redirect('Menu');
		} else {
			$this->data['id_menu_parent'] = $this->input->post('id_menu_parent');
			$this->data['nama_menu'] = $this->input->post('nama_menu');
			$this->data['icon'] = $this->input->post('icon');
			$this->data['kategori'] = $this->input->post('kategori');
			$this->data['href'] = $this->input->post('href');
			$this->data['status'] = $this->input->post('status');
			$this->data['sort'] = $this->input->post('sort');

			$this->data['listMenu'] = $this->Menu_model->getAllMenu();

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Menu/add');
			$this->data['url'] = site_url('Menu');
			$this->data['title'] = "Pengaturan Menu";
	
			$this->data['breadcrumbs'] = [];
	
			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];
	
			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Menu',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Menu')
			];

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('menu/form', $this->data);
			$this->load->view('component/footer');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('sort', 'Urutan Menu', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'id_menu_parent' => $this->input->post('id_menu_parent'),
				'nama_menu' => $this->input->post('nama_menu'),
				'icon' => $this->input->post('icon'),
				'kategori' => $this->input->post('kategori'),
				'href' => $this->input->post('href'),
				'status' => $this->input->post('status'),
				'sort' => $this->input->post('sort')
			);
			$condition['id_menu'] = $id;

			$this->Menu_model->updateMenu($data, $condition);

			redirect('Menu');
		} else {
			$this->data['id_menu_parent'] = $this->input->post('id_menu_parent');
			$this->data['nama_menu'] = $this->input->post('nama_menu');
			$this->data['icon'] = $this->input->post('icon');
			$this->data['kategori'] = $this->input->post('kategori');
			$this->data['href'] = $this->input->post('href');
			$this->data['status'] = $this->input->post('status');
			$this->data['sort'] = $this->input->post('sort');

			$this->data['listMenu'] = $this->Menu_model->getAllMenu();

			$menu = $this->Menu_model->getMenu($id);

			$this->data['id_menu_parent'] = $menu->id_menu_parent;
			$this->data['nama_menu'] = $menu->nama_menu;
			$this->data['icon'] = $menu->icon;
			$this->data['kategori'] = $menu->kategori;
			$this->data['href'] = $menu->href;
			$this->data['status'] = $menu->status;
			$this->data['sort'] = $menu->sort;

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Menu/update/' . $id);
			$this->data['url'] = site_url('Menu');
			$this->data['title'] = "Pengaturan Menu";
	
			$this->data['breadcrumbs'] = [];
	
			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];
	
			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Menu',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Menu')
			];

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('menu/form', $this->data);
			$this->load->view('component/footer');
		}
	}

	public function delete($id)
	{
		$condition['id_menu'] = $id;

		$this->Menu_model->deleteMenu($condition);

		redirect('Menu');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
