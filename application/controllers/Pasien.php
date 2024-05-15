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

    public function add()
    {
        $this->form_validation->set_rules('klinik', 'Klinik', 'required');
        $this->form_validation->set_rules('kategori_pasien', 'Kategori Pasien', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nohp', 'No Hp', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'id_klinik' => decrypt_url($this->input->post('klinik')),
				'nama' => $this->input->post('nama'),
				'kategori_pasien' => $this->input->post('kategori_pasien'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			);

			$this->Pasien_model->addPasien($data);
			redirect('Pasien');
		} else {
			$this->data['selected_klinik'] = $this->input->post('klinik');
			$this->data['nama'] = $this->input->post('nama');
			$this->data['kategori_pasien'] = $this->input->post('kategori_pasien');
			$this->data['alamat'] = $this->input->post('alamat');
			$this->data['nohp'] = $this->input->post('nohp');
			$this->data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
			$this->data['tanggal_lahir'] = $this->input->post('tanggal_lahir');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Pasien/add');
			$this->data['url'] = site_url('Pasien');
			$this->data['title'] = "Pasien";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pasien',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Pasien')
			];

            $this->data['list_klinik'] = $this->Pasien_model->getAllKlinik();

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('pasien/form', $this->data);
			$this->load->view('component/footer', $this->data);
		}
    }
}
