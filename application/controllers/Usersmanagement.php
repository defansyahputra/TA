<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usersmanagement extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
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

			$this->data['link_active'] = 'Usersmanagement';

			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Usersmanagement');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Usersmanagement_model");
		}
	}

	function index()
	{
		$this->data['title'] = "Pengaturan Pengguna";

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengaturan / ',
			'class' => 'breadcrumb-item pe-3',
			'href' => ''
		];

		$this->data['breadcrumbs'][] = [
			'active' => TRUE,
			'text' => 'Pengaturan Pengguna',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Usermanagement')
		];

		$this->data['listuser'] = $this->Usersmanagement_model->getAllUser();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('usersmanagement/views', $this->data);
		$this->load->view('component/footer');
	}

	function add()
	{
		$this->data['title'] = "Pengaturan Pengguna";

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengaturan / ',
			'class' => 'breadcrumb-item pe-3',
			'href' => ''
		];

		$this->data['breadcrumbs'][] = [
			'active' => TRUE,
			'text' => 'Pengaturan Pengguna',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Usermanagement')
		];

		$use_username = $this->config->item('use_username', 'tank_auth');
		if ($use_username) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[' . $this->config->item('username_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('username_max_length', 'tank_auth') . ']|callback__check_username_blacklist|callback__check_username_exists');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('nohp', 'No Hp', 'required'); 
		$this->form_validation->set_rules('klinik', 'Klinik', 'required'); 
		$this->form_validation->set_rules('kategori_pasien', 'Kategori Pasien', 'required'); 
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
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
				$this->form_validation->set_value('nohp'),
				$this->form_validation->set_value('klinik'),
				$this->form_validation->set_value('kategori_pasien'),
				$this->form_validation->set_value('tanggal_lahir'),
				$this->form_validation->set_value('jenis_kelamin'),
				$this->form_validation->set_value('alamat'),
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
		$this->data['list_klinik'] = $this->Usersmanagement_model->getAllKlinik();
		$this->data['use_username'] = $use_username;

		$this->data['action'] = site_url('Usersmanagement/add');
		$this->data['url'] = site_url('Usersmanagement');

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('usersmanagement/form_register', $this->data);
		$this->load->view('component/footer');
		// }
	}

	function delete($id)
	{
		$condition['id'] = $id;
		$this->Usersmanagement_model->deleteUser($condition);

		redirect('Pasien');
	}
	
	function banned($id)
	{
		$condition['id'] = $id;

		$data = array(
			'banned' => '1'
		);

		$this->Usersmanagement_model->updateUser($data, $condition);
		redirect('Usersmanagement');
	}

	function unbanned($id)
	{
		$condition['id'] = $id;

		$data = array(
			'banned' => '0'
		);

		$this->Usersmanagement_model->updateUser($data, $condition);
		redirect('Usersmanagement');
	}

	function activate($user_id)
	{
		// Activate user
		if ($this->tank_auth->activate_user_manual($user_id)) { // success
			redirect('Usersmanagement');
		} else { // fail
			redirect('Usersmanagement');
		}
	}

	function change_role($id)
	{
		$this->data['title'] = "Pengaturan Pengguna";

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengaturan / ',
			'class' => 'breadcrumb-item pe-3',
			'href' => ''
		];

		$this->data['breadcrumbs'][] = [
			'active' => TRUE,
			'text' => 'Pengaturan Pengguna',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Usermanagement')
		];

		foreach ($this->tank_auth->get_roles($id) as $val) {
			$this->data['role_id_change'] = $val['role_id'];
		}

		$this->form_validation->set_rules('role_id', 'Hak Akses', 'required');

		if ($this->form_validation->run() == TRUE) {
			$this->tank_auth->change_role(intval($id), intval($this->data['role_id_change']), intval($this->input->post('role_id')));

			redirect('Usersmanagement');
		} else {

			if ($this->input->post()) {
				$this->data['role_id_change'] = $this->input->post('role_id');
			}

			$this->data['listRoles'] = $this->tank_auth->get_list_role();

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Usersmanagement/change_role/' . $id);
			$this->data['url'] = site_url('Usersmanagement');

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('usersmanagement/form_role', $this->data);
			$this->load->view('component/footer');
		}
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param string
	 * @param string
	 * @param array
	 * @return    void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');

		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_' . $type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/' . $type . '-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/' . $type . '-txt', $data, TRUE));
		$this->email->send();
	}

	function _check_username_blacklist($str)
	{
		$blacklist = $this->config->item('username_blacklist', 'tank_auth');
		$prepend = $this->config->item('username_blacklist_prepend', 'tank_auth');
		$exceptions = $this->config->item('username_exceptions', 'tank_auth');

		// Generate complete list of blacklisted names
		$full_blacklist = $blacklist;
		foreach ($blacklist as $val) {
			foreach ($prepend as $v) {
				$full_blacklist[] = $v . $val;
			}
		}

		// Remove exceptions
		foreach ($full_blacklist as $key => $name) {
			foreach ($exceptions as $exc) {
				if ($exc == $name) {
					unset($full_blacklist[$key]);
					break;
				}
			}
		}

		$valid = TRUE;
		foreach ($full_blacklist as $val) {
			if ($str == $val) {
				$this->form_validation->set_message('_check_username_blacklist', 'That username cannot be used.');
				$valid = FALSE;
				break;
			}
		}

		return $valid;
	}

	function _check_username_exists($str)
	{
		$this->load->database();
		$query = $this->db->query("SELECT COUNT(*) count FROM {$this->config->item('db_table_prefix', 'tank_auth')}users WHERE username=? LIMIT 1", array($str));
		$row = $query->row();

		if ($row->count) {
			$this->form_validation->set_message('_check_username_exists', 'That username already exists');
			return FALSE;
		}

		return TRUE;
	}
}