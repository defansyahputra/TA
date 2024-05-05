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

        $this->data['listuser'] = $this->Usersmanagement_model->getAllUser();

        $this->load->view('component/header', $this->data);
        $this->load->view('component/sidebar', $this->data);
        $this->load->view('component/navbar', $this->data);
        $this->load->view('pasien/views', $this->data);
        $this->load->view('component/footer');
    }

    // public function RekamMedis($id)
    // {
    //     $data_pasien = $this->Pasien_model->getDataPasien($id);

    //     $this->data['name'] = $data_pasien->name;
    //     $this->data['tanggal_lahir'] = $data_pasien->tanggal_lahir;
    //     $this->data['alamat'] = $data_pasien->alamat;
    //     $this->data['nohp'] = $data_pasien->nohp;
    //     $this->data['gender'] = $data_pasien->gender;

    //     $this->data['title'] = 'Pasien';

    //     $this->data['listuser'] = $this->Pasien_model->getAllUser();

    //     $this->form_validation->set_rules('subjective', 'Subjective', 'required');
	// 	$this->form_validation->set_rules('assesment', 'Assesment', 'required');
	// 	$this->form_validation->set_rules('objective', 'Objective', 'required');
	// 	$this->form_validation->set_rules('plan', 'Plan');

    //     if ($this->form_validation->run() == TRUE) {
	// 		$custom = array(
	// 			'subjective' => $this->input->post('subjective'),
	// 			'assesment' => $this->input->post('assesment'),
	// 			'objective' => $this->input->post('objective'),
	// 			'plan' => $this->input->post('plan'),
	// 		);

    //         $condition['id_rekamedis'] = $id_rekamedis;

	// 		$this->Pasien_model->addRekamMedis($custom, $condition);

	// 		redirect('Pasien');
	// 	} else {
	// 		$this->data['subjective'] = $this->input->post('subjective');
	// 		$this->data['assesment'] = $this->input->post('assesment');
	// 		$this->data['objective'] = $this->input->post('objective');
	// 		$this->data['plan'] = $this->input->post('plan');

	// 		$this->data['listdatarekammedis'] = $this->Pasien_model->getAllDataRekamMedis();

	// 		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	// 		$this->data['action'] = site_url('Pasien/RekamMedis');
	// 		$this->data['url'] = site_url('Pasien');
	// 		$this->data['title'] = "Pasien";
	
	// 		$this->data['breadcrumbs'] = [];
	
	// 		$this->data['breadcrumbs'][] = [
	// 			'active' => FALSE,
	// 			'text' => 'Pasien / ',
	// 			'class' => 'breadcrumb-item pe-3',
	// 			'href' => ''
	// 		];

	// 		$this->load->view('component/header', $this->data);
    //         $this->load->view('component/sidebar', $this->data);
    //         $this->load->view('component/navbar', $this->data);
    //         $this->load->view('pasien/form', $this->data);
    //         $this->load->view('pasien/form', $this->data);
    //         $this->load->view('component/footer', $this->data);
	// 	} 
    // }

    function RekamMedis($id)
	{
		$this->data['title'] = "Pasien";

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pasien / ',
			'class' => 'breadcrumb-item pe-3',
			'href' => ''
		];

		$this->data['breadcrumbs'][] = [
			'active' => TRUE,
			'text' => 'Rekam Medis',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Pasien')
		];

		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('nohp', 'No Hp', 'required');
		$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');

		if ($this->form_validation->run() == TRUE) {

			$data = [
				'name' => $this->input->post('name'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'gender' => $this->input->post('gender')
			];

			$pasien = $this->Pasien_model->getPasien($id);

			$custom = [
				'subjective' => $this->input->post('subjective'),
				'objective' => $this->input->post('objective'),
				'assesment' => $this->input->post('assesment'),
				'plan' => $this->input->post('plan')
			];

			$condition['id'] = $id;

			$this->Pasien_model->updatePasienProfile($custom, $condition);

			redirect('Pasien');
		} else {
			$this->data['name'] = $this->input->post('name');
			$this->data['tanggal_lahir'] = $this->input->post('tanggal_lahir');
			$this->data['alamat'] = $this->input->post('alamat');
			$this->data['nohp'] = $this->input->post('nohp');
			$this->data['gender'] = $this->input->post('gender');

			$pasien = $this->Pasien_model->getPasien($id);

			$this->data['data_name'] = $pasien->name;
			$this->data['data_tanggal_lahir'] = $pasien->tanggal_lahir;
			$this->data['data_alamat'] = $pasien->alamat;
			$this->data['data_nohp'] = $pasien->nohp;
			$this->data['data_gender'] = $pasien->gender;

            $this->addRekamMedis();

			$this->data['action'] = site_url('Pasien/RekamMedis/' . $id);
			$this->data['url'] = site_url('Pasien');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('pasien/form', $this->data);
			$this->load->view('component/footer');
		}
	}

    public function addRekamMedis()
    {
        $this->form_validation->set_rules('subjective', 'Subjective', 'required');
		$this->form_validation->set_rules('objective', 'Objective', 'required');
		$this->form_validation->set_rules('assesment', 'Assesment', 'required');
		$this->form_validation->set_rules('plan', 'Plan');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'subjective' => $this->input->post('subjective'),
				'objective' => $this->input->post('objective'),
				'assesment' => $this->input->post('assesment'),
				'plan' => $this->input->post('plan')
			);

			$this->Pasien_model->addRekamMedis($data);
			redirect('Pasien');
		} else {
			$this->data['subjective'] = $this->input->post('subjective');
			$this->data['objective'] = $this->input->post('objective');
			$this->data['assesment'] = $this->input->post('assesment');
			$this->data['plan'] = $this->input->post('plan');
		}
    }


    function add()
    {
        $this->data['title'] = "tambah Pasien";

        $use_username = $this->config->item('use_username', 'tank_auth');
        if ($use_username) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[' . $this->config->item('username_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('username_max_length', 'tank_auth') . ']|callback__check_username_blacklist|callback__check_username_exists');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

        // Check for additional fields
        $registration_fields = (bool)$this->config->item('registration_fields', 'tank_auth') ? $this->config->item('registration_fields', 'tank_auth') : array();
        if ($registration_fields) {
            foreach ($registration_fields as $val) {
                $this->data['registration_fields'][] = $val;
                list($name, $label, $rules, $type) = $val;
                $this->form_validation->set_rules($name, $label, $rules);

                // Check if you need to query a db
                if ($type == 'dropdown') {
                    $selection = $val[4];

                    if (is_string($val[4])) {
                        $default = isset($val[5]) ? $val[5] : NULL;
                        preg_match('/\w+(?=\.)/', $selection, $dbname);
                        preg_match_all('/(?<=\.)\w+/', $selection, $fields);
                        $fields = $fields[0];

                        // Create the dropdown field
                        //$this->data['dropdown_name'] = $name;
                        $this->data['dropdown_items'][$name] = $this->tank_auth->create_regdb_dropdown($dbname, $fields);
                        $this->data['dropdown_items_default'][$name] = $default;
                        $this->data['db_dropdowns'][] = $name;
                    } else {
                        $default = isset($val[5]) ? $val[5] : NULL;
                        $this->data['dropdown_simple'][$name] = $selection;
                        $this->data['dropdown_simple_default'][$name] = $default;
                    }
                }
            }
        }

        $data['errors'] = array();

        $email_activation = false;

        $config['upload_path'] = './assets/media/profiles';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 15000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = uniqid();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() || $this->form_validation->run() && $this->upload->do_upload('foto')) {
            // validation ok
            $foto = $this->upload->data();
            $custom['foto'] = $foto["file_name"];

            // Custom registration fields
            $registration_fields = (bool)$this->config->item('registration_fields', 'tank_auth') ? $this->config->item('registration_fields', 'tank_auth') : array();
            if ($registration_fields) {
                // $datatypes = $this->tank_auth->get_profile_datatypes();
                foreach ($this->config->item('registration_fields', 'tank_auth') as $val) {
                    $name = $val[0];
                    $value = $this->form_validation->set_value($name);
                    $custom[$name] = $value;
                }

                // Remove all NULL values so MySQL will use the default value
                foreach ($custom as $key => $val) {
                    if (is_null($val)) unset($custom[$key]);
                }

                $custom = serialize($custom);
            } else {
                $custom = '';
            }

            // Create the user here
            if (!is_null($data = $this->tank_auth->create_user(
                $use_username ? $this->form_validation->set_value('username') : '',
                $this->form_validation->set_value('email'),
                $this->form_validation->set_value('password'),
                $email_activation,
                $custom
            ))) {                                    // success

                $this->data['site_name'] = $this->config->item('website_name', 'tank_auth');

                if ($email_activation) {                                    // send "activate" email
                    $this->data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                    $this->_send_email('activate', $this->data['email'], $data);

                    unset($this->data['password']); // Clear password (just for any case)

                } else {
                    if ($this->config->item('email_account_details', 'tank_auth')) {    // send "welcome" email

                        $this->_send_email('welcome', $this->data['email'], $data);
                    }
                    unset($this->data['password']); // Clear password (just for any case)
                }

                redirect('Pasien');
            } else {
                $errors = $this->tank_auth->get_error_message();

                foreach ($errors as $k => $v) $this->data['errors'][$k] = $this->lang->line($v);
            }
        }
        // else {

        // $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        // $this->data['debug'] = $this->tank_auth->debug('14');
        $this->data['use_username'] = $use_username;

        $this->data['action'] = site_url('Pasien/add');
        $this->data['url'] = site_url('Pasien');

        $this->load->view('component/header', $this->data);
        $this->load->view('component/sidebar', $this->data);
        $this->load->view('component/navbar', $this->data);
        $this->load->view('usersmanagement/form_register', $this->data);
        $this->load->view('component/footer');
        // }
    }
}
