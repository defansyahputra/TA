<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		$this->load->helper('rupiah');


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

			$this->data['link_active'] = 'Reservasi';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Reservasi');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Menu_model");
			$this->load->model("Reservasi_model");
		}
	}

	public function index()
	{
		$this->form_validation->set_rules('klinik', 'Klinik', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

		if ($this->form_validation->run() == TRUE) {
            $data = array (
				'id_pasien' => $this->data['user_id'],
				'id_klinik' => decrypt_url($this->input->post('klinik')),
				'tanggal' => $this->input->post('tanggal'),
				'jam' => $this->input->post('jam')
			);

            $this->Reservasi_model->addAppointment($data);

            redirect('Reservasi');
        } else {
            $this->data['selected_klinik'] = $this->input->post('klinik');
            $this->data['tanggal'] = $this->input->post('tanggal');
            $this->data['jam'] = $this->input->post('jam');

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['action'] = site_url('Reservasi');
            $this->data['url'] = site_url('Reservasi');
            $this->data['title'] = "Reservasi Jadwal";
            
            $this->data['title'] = 'Reservasi Jadwal';

            $this->data['breadcrumbs'] = [];

            $this->data['breadcrumbs'][] = [
                'active' => FALSE,
                'text' => 'Reservasi Jadwal',
                'class' => 'breadcrumb-item pe-3 text-gray-400',
                'href' => site_url('Reservasi')
            ];

			$this->data['list_klinik'] = $this->Reservasi_model->getAllKlinik();
			$this->data['list_reservasi'] = $this->Reservasi_model->getAllReservasi();
			
			$this->data['keterangan_cibadak'] = $this->Reservasi_model->getKetCibadak();
			$this->data['keterangan_lembang'] = $this->Reservasi_model->getKetLembang();
			$this->data['keterangan_bojongsoang'] = $this->Reservasi_model->getKetBojongsoang();
    
            $this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('reservasi/views', $this->data);
			$this->load->view('component/footer', $this->data);
		}
	}
}