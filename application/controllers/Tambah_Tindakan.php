<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah_Tindakan extends CI_Controller
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

			$this->data['link_active'] = 'Tambah_Tindakan';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Tambah_Tindakan');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Tambah_tindakan_model");
		}
	}
 
	public function index()
	{
		$this->data['title'] = 'Tambah Tindakan';

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Tambah Tindakan',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Tambah_Tindakan')
		];

        $this->data['listtindakan'] = $this->Tambah_tindakan_model->getAllTindakan();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('tambah_tindakan/views', $this->data);
		$this->load->view('component/footer', $this->data);
	}

    public function add()
    {
        $this->form_validation->set_rules('kategori_tindakan', 'Kategori Tindakan', 'required');
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'id_kategori_tindakan' => decrypt_url($this->input->post('kategori_tindakan')),
				'tindakan' => $this->input->post('tindakan'),
				'harga' => $this->input->post('harga'),
			);

			$this->Tambah_tindakan_model->addTindakan($data);
			redirect('Tambah_Tindakan');
		} else {
			$this->data['selected_kategori_tindakan'] = $this->input->post('kategori_tindakan');
			$this->data['tindakan'] = $this->input->post('tindakan');
			$this->data['harga'] = $this->input->post('harga');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Tambah_Tindakan/add');
			$this->data['url'] = site_url('Tambah_Tindakan');
			$this->data['title'] = "Pengaturan Tindakan";

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

			$this->data['list_kategori_tindakan'] = $this->Tambah_tindakan_model->getAllKategoriTindakan();

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('tambah_tindakan/form', $this->data);
			$this->load->view('component/footer');
		}
    }

	public function edit($id_tindakan)
    {
        $this->form_validation->set_rules('kategori_tindakan', 'Kategori tindakan', 'required');
        $this->form_validation->set_rules('tindakan', 'tindakan', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
			$value_tindakan_update = $this->Tambah_tindakan_model->getTindakan($id_tindakan);

			$data = array(
				'id_kategori_tindakan' => decrypt_url($this->input->post('kategori_tindakan')),
				'tindakan' => $this->input->post('tindakan'),
				'harga' => $this->input->post('harga')
			);

			$result = $this->Tambah_tindakan_model->EditTindakan(($id_tindakan), $data);

			if ($result) {
				$this->session->set_flashdata('msg', 'Anda berhasil menyunting data produk');

				redirect('Tambah_Tindakan');
			}
		} else {
			$this->data['selected_kategori_tindakan'] = $this->input->post('kategori_tindakan');
			$this->data['tindakan'] = $this->input->post('tindakan');
			$this->data['harga'] = $this->input->post('harga');

			$this->data['list_kategori_tindakan'] = $this->Tambah_tindakan_model->getAllKategoriTindakan();

			$value_tindakan = $this->Tambah_tindakan_model->getTindakan($id_tindakan);

			$this->data['id_tindakan'] = $id_tindakan;
			$this->data['selected_kategori_tindakan'] = $value_tindakan->id_kategori_tindakan;
			$this->data['tindakan'] = $value_tindakan->tindakan;
			$this->data['harga'] = $value_tindakan->harga;

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Tambah_Tindakan/edit/' . $id_tindakan);
			$this->data['url'] = site_url('Tambah_Tindakan');
			$this->data['title'] = "tindakan";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Kelola tindakan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'tindakan',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('produk')
			];

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('tambah_tindakan/edit', $this->data);
			$this->load->view('component/footer');
		}
    }



    public function delete($id_tindakan)
    {
        $condition['id_tindakan'] = $id_tindakan;
		$this->Tambah_tindakan_model->deleteTindakan($condition);
		redirect('Tambah_Tindakan');
    }
} 
