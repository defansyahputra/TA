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
            $this->load->helper("rupiah");
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
        $this->data['list_pasien'] = $this->Pasien_model->getAllPasien();

        $this->load->view('component/header', $this->data);
        $this->load->view('component/sidebar', $this->data);
        $this->load->view('component/navbar', $this->data);
        $this->load->view('pasien/views', $this->data);
        $this->load->view('component/footer');
    }

    public function rekammedis($id_pasien)
    {
        $this->form_validation->set_rules('name', 'Pasien', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('object', 'Object', 'required');
        $this->form_validation->set_rules('plan', 'Plan', 'required');
        $this->form_validation->set_rules('kategori_tindakan[]', 'Kategori Tindakan', 'required');
        $this->form_validation->set_rules('tindakan[]', 'Tindakan', 'required');
        $this->form_validation->set_rules('gigi[]', 'Gigi', 'required');
        $this->form_validation->set_rules('harga[]', 'Harga', 'required');

		if ($this->form_validation->run() == TRUE) {
            $id_pasien_decrypted = decrypt_url($this->input->post('name'));
            $subject = $this->input->post('subject');
            $object = $this->input->post('object');
            $plan = $this->input->post('plan');

            $kategori_tindakan = $this->input->post('kategori_tindakan');
            $tindakan = $this->input->post('tindakan');
            $gigi = $this->input->post('gigi');
            $harga = $this->input->post('harga');

            $data_to_insert = [];

            for ($key = 1; $key <= count($kategori_tindakan); $key++) {
                $data_to_insert[] = [
                    'id_pasien' => $id_pasien_decrypted,
                    'subject' => $subject,
                    'object' => $object,
                    'plan' => $plan,
                    'id_kategori_tindakan' => $kategori_tindakan[$key],
                    'id_tindakan' => $tindakan[$key],
                    'gigi' => $gigi[$key],
                    'harga' => $harga[$key]
                ];
            }

            $this->Pasien_model->addRekammedis($data_to_insert);

            redirect('Pasien');
        } else {
            $this->data['name'] = $this->input->post('id_pasien');
            $this->data['subject'] = $this->input->post('subject');
            $this->data['object'] = $this->input->post('object');
            $this->data['plan'] = $this->input->post('plan');
            $this->data['selected_kategori_tindakan'] = $this->input->post('kategori_tindakan');
            $this->data['selected_tindakan'] = $this->input->post('tindakan');
            $this->data['gigi'] = $this->input->post('gigi');
            $this->data['harga'] = $this->input->post('harga');


            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['action'] = site_url('Pasien/rekammedis/' . $id_pasien);
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
    
            $this->data['list_kategori_tindakan'] = $this->Pasien_model->getAllKategori();
            $this->data['list_tindakan'] = $this->Pasien_model->getAllTindakan();
            $this->data['list_pasien'] = $this->Pasien_model->getPasien($id_pasien);
    
            $this->load->view('component/header', $this->data);
            $this->load->view('component/sidebar', $this->data);
            $this->load->view('component/navbar', $this->data);
            $this->load->view('pasien/rekammedis', $this->data);
            $this->load->view('component/footer'); 
		}
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

    public function getPasienByKlinik()
    {
        $id_klinik = $this->input->post('id_klinik');
        if ($id_klinik) {
            $patients = $this->Pasien_model->getPasienByKlinik($id_klinik);
            echo json_encode($patients);
        } else {
            echo json_encode([]);
        }
    }

    public function detail($id_pasien)
    {
        $this->data['title'] = 'Detail Rekammedis';

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Detail Rekam Medis',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Pasien')
		];

        $rekam_medis = $this->Pasien_model->getDetailRekammedis($id_pasien);
        $this->data['rekam_medis'] = $rekam_medis;

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('pasien/detail', $this->data);
		$this->load->view('component/footer', $this->data);
    }
}
