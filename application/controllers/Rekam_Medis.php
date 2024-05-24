<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekam_Medis extends CI_Controller
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

			$this->data['link_active'] = 'Pegawai';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Pegawai');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Menu_model");
			$this->load->model("Pasien_model");
		}
	}
 
	public function index()
	{
		$this->data['title'] = 'Rekam Medis';

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Rekam Medis',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Rekam_Medis')
		];

		$this->data['list_kategori_tindakan'] = $this->Pasien_model->getAllKategori();
        $this->data['list_tindakan'] = $this->Pasien_model->getAllTindakan();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('rekam_medis/views', $this->data);
		$this->load->view('component/footer', $this->data);
	}

	public function get_tindakan()
    {
        $getTindakan = $this->Pasien_model->getDetailTindakan(decrypt_url($this->input->post('id_kategori_tindakan')));

        $tindakan_arr = array();
        foreach ($getTindakan as $tindakan) {
            $id_tindakan = $tindakan->id_tindakan;
            $tindakan = $tindakan->tindakan;

            $tindakan_arr[] = array("id_tindakan" => encrypt_url($id_tindakan), "tindakan" => $tindakan);
        }

        echo json_encode($tindakan_arr);
    }
}
