<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_Klinik extends CI_Controller
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

			$this->data['link_active'] = 'Pengaturan_Klinik';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Pengaturan_Klinik');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Pengaturan_klinik_model");
		}
	}
 
	public function index()
	{
		$this->data['title'] = 'Pengaturan Klinik';

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengaturan Klinik',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Pengaturan_Klinik')
		];

        $this->data['listklinik'] = $this->Pengaturan_klinik_model->getAllKlinik();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('pengaturan_klinik/views', $this->data);
		$this->load->view('component/footer', $this->data);
	}

    public function add()
    {
        $this->form_validation->set_rules('nama', 'Nama Klinik', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Klinik', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
			);

			$this->Pengaturan_klinik_model->addKlinik($data);
			redirect('Pengaturan_Klinik');
		} else {
			$this->data['nama'] = $this->input->post('nama');
			$this->data['alamat'] = $this->input->post('alamat');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Pengaturan_Klinik/add');
			$this->data['url'] = site_url('Pengaturan_Klinik');
			$this->data['title'] = "Pengaturan Klinik";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Klinik',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Pengaturan_Klinik')
			];

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('pengaturan_klinik/form', $this->data);
			$this->load->view('component/footer');
		}
    }

    public function edit ($id_klinik)
    {
        $this->form_validation->set_rules('nama', 'Nama Klinik', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Klinik', 'required');


		if ($this->form_validation->run() == TRUE) {

			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
			);
			$condition['id_klinik'] = $id_klinik;
			$this->Pengaturan_klinik_model->EditKlinik($data, $condition);
			redirect('Pengaturan_Klinik');
		} else {
			$klinik = $this->Pengaturan_klinik_model->getKlinik($id_klinik);

			$this->data['nama'] = $klinik->nama;
			$this->data['alamat'] = $klinik->alamat;
            
			if ($this->input->post()) {
				$this->data['nama'] = $this->input->post('nama');
				$this->data['alamat'] = $this->input->post('alamat');
			}

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Pengaturan_Klinik/edit/' . $id_klinik);
			$this->data['url'] = site_url('Pengaturan_Klinik');
			$this->data['title'] = "Pengaturan Klinik";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Klinik',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Pengaturan_Klinik')
			];

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('pengaturan_klinik/edit', $this->data);
			$this->load->view('component/footer');
		}
    }

    public function delete($id_klinik)
    {
        $condition['id_klinik'] = $id_klinik;
		$this->Pengaturan_klinik_model->deleteKlinik($condition);
		redirect('Pengaturan_Klinik');
    }
}

