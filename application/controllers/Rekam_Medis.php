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

			$this->data['link_active'] = 'Rekam_Medis';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Rekam_Medis');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Menu_model");
			$this->load->model("Rekam_medis_model");
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

        $this->data['list_pasien'] = $this->Rekam_medis_model->getAllPasien();
        $this->data['list_klinik'] = $this->Rekam_medis_model->getAllKlinik();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('rekam_medis/views', $this->data);
		$this->load->view('component/footer', $this->data); 
	}

	public function getPasienByKlinik()
    {
        $id_klinik = $this->input->post('id_klinik');
        if ($id_klinik) {
            $patients = $this->Rekam_medis_model->getPasienByKlinik($id_klinik);
            echo json_encode($patients);
        } else {
            echo json_encode([]);
        }
    }
}
