<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
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

            $this->data['link_active'] = 'Pasien';

            //buat permission
            if (!$this->tank_auth->permit($this->data['link_active'])) {
                redirect('Pasien');
            }

            $this->load->model("Showmenu_model");
            $this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

            $OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

            $this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

            $this->load->model("Menu_model");
            $this->load->model("Pasien_model");
            $this->load->model("Usersmanagement_model");
        }
    }

    public function index()
    {
        $this->data['title'] = 'Pasien';

        $this->data['breadcrumbs'] = [];

        $this->data['breadcrumbs'][] = [
            'active' => FALSE,
            'text' => 'Pasien',
            'class' => 'breadcrumb-item pe-3 text-gray-400',
            'href' => site_url('Pasien')
        ];

        $this->data['list_klinik'] = $this->Pasien_model->getAllKlinik();
        $this->data['listpasien'] = $this->Pasien_model->getAllPasien();

        $this->load->view('component/header', $this->data);
        $this->load->view('component/sidebar', $this->data);
        $this->load->view('component/navbar', $this->data);
        $this->load->view('pasien/views', $this->data);
        $this->load->view('component/footer');
    }

    public function rekammedis($id)
    {
        $this->form_validation->set_rules('kategori_tindakan', 'Kategori Tindakan', 'required');
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'id_kategori_tindakan' => decrypt_url($this->input->post('kategori_tindakan')),
				'id_tindakan' => $this->input->post('tindakan'),
				'harga' => $this->input->post('harga'),
			);

			$this->Tambah_tindakan_model->addTindakan($data);
			redirect('Pasien');
		} else {
			$this->data['selected_kategori_tindakan'] = $this->input->post('kategori_tindakan');
			$this->data['selected_tindakan'] = $this->input->post('tindakan');
			$this->data['harga'] = $this->input->post('harga');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['action'] = site_url('Pasien/rekammedis/' . $id);
            $this->data['url'] = site_url('Pasien');
            $this->data['title'] = "Rekam Medis";
            
            $this->data['title'] = 'Rekam Medis';

            $this->data['breadcrumbs'] = [];

            $this->data['breadcrumbs'][] = [
                'active' => FALSE,
                'text' => 'Rekam Medis',
                'class' => 'breadcrumb-item pe-3 text-gray-400',
                'href' => site_url('Pasien')
            ];

            $pasien = $this->Pasien_model->getPasien($id);
    
            $this->data['name'] = $pasien->name;
    
            $this->data['list_kategori_tindakan'] = $this->Pasien_model->getAllKategori();
            $this->data['list_tindakan'] = $this->Pasien_model->getAllTindakan();
    
            $this->load->view('component/header', $this->data);
            $this->load->view('component/sidebar', $this->data);
            $this->load->view('component/navbar', $this->data);
            $this->load->view('pasien/rekammedis', $this->data);
            $this->load->view('component/footer');
		}

    }
}
