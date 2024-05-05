<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_Tindakan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$this->data['dataUser'] = $this->session->userdata('data_ldap');

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

			$this->data['link_active'] = 'Pengaturan_Tindakan';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Pengaturan_Tindakan');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Kategori_tindakan_model");
		}
	}
 
	public function index()
	{
		$this->data['title'] = 'Pengaturan Tindakan';

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengaturan Tindakan',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Pengaturan_Tindakan')
		];

        $this->data['listkategori'] = $this->Kategori_tindakan_model->getAllKategori();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('pengaturan_tindakan/views', $this->data);
		$this->load->view('component/footer', $this->data);
	}

    public function add()
    {
        $this->form_validation->set_rules('kategori_tindakan', 'Kategori Tindakan', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'kategori_tindakan' => $this->input->post('kategori_tindakan'),
			);

			$this->Kategori_tindakan_model->addKategori($data);
			redirect('Pengaturan_Tindakan');
		} else {
			$this->data['kategori_tindakan'] = $this->input->post('kategori_tindakan');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Pengaturan_Tindakan/add');
			$this->data['url'] = site_url('Pengaturan_Tindakan');
			$this->data['title'] = "Pengaturan Kategori";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Kategori',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Pengaturan_Tindakan')
			];

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('pengaturan_tindakan/form', $this->data);
			$this->load->view('component/footer');
		}
    }

    public function edit ($id_kategori_tindakan)
    {
        $this->form_validation->set_rules('kategori_tindakan', 'Kategori Tindakan', 'required');


		if ($this->form_validation->run() == TRUE) {

			$data = array(
				'kategori_tindakan' => $this->input->post('kategori_tindakan'),
			);
			$condition['id_kategori_tindakan'] = $id_kategori_tindakan;
			$this->Kategori_tindakan_model->EditKategori($data, $condition);
			redirect('Pengaturan_Tindakan');
		} else {
			$kategori_tindakan = $this->Kategori_tindakan_model->getKategori($id_kategori_tindakan);

			$this->data['kategori_tindakan'] = $kategori_tindakan->kategori_tindakan;
			if ($this->input->post()) {
				$this->data['kategori_tindakan'] = $this->input->post('kategori_tindakan');
			}

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Pengaturan_Tindakan/edit/' . $id_kategori_tindakan);
			$this->data['url'] = site_url('Pengaturan_Tindakan');
			$this->data['title'] = "Pengaturan katergori";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Kategori Tindakan',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Pengaturan_Tindakan')
			];

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('pengaturan_tindakan/edit', $this->data);
			$this->load->view('component/footer');
		}
    }

    public function delete($id_kategori_tindakan)
    {
        $condition['id_kategori_tindakan'] = $id_kategori_tindakan;
		$this->Kategori_tindakan_model->deleteKategori($condition);
		redirect('Pengaturan_Tindakan');
    }
}
