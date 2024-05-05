<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library(array('tank_auth',"Ldap_tools"));

		$this->lang->load('tank_auth');
	}

	function index()
	{
		redirect('Auth/login');
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{
		if ($this->tank_auth->is_logged_in()) {
			// logged in
			redirect($this->config->item('login-success', 'tank_auth'));
		} elseif ($this->tank_auth->is_logged_in(FALSE)) {
			// logged in, not activated
			redirect('Auth/send_again');
		} else {
			$this->data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') and $this->config->item('use_username', 'tank_auth'));
			$this->data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('login', 'Login', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if (
				$this->config->item('login_count_attempts', 'tank_auth') and
				($login = $this->input->post('login'))
			) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}


			$this->data['errors'] = array();

			if ($this->form_validation->run() == TRUE) {

				set_cookie('status', 'loggedin', '3600');

				// validation ok
				$this->load->model('Ldap_model');

				$USERNAME = $this->form_validation->set_value('login');
				$PASSWORD = $this->form_validation->set_value('password');

				$hasil = $this->ldap_tools->validate_user($USERNAME, $PASSWORD);

				if ($hasil) {
					$get_ldap = $this->tank_auth->get_user_ldap($this->form_validation->set_value('login'), $this->form_validation->set_value('password'));

					if (!$get_ldap) {
						$get_username_user = $this->tank_auth->get_username_ldap($this->form_validation->set_value('login'));

						if ($get_username_user > 0) {
							$this->tank_auth->change_password_ldap($this->form_validation->set_value('login'), $this->form_validation->set_value('password'));
						} else {
							$custom['name'] = $this->form_validation->set_value('login');
							$custom = serialize($custom);
							$email_activation = FALSE;

							if (!is_null($data = $this->tank_auth->create_user(
								$this->data['login_by_username'] ? $this->form_validation->set_value('login') : '',
								$this->form_validation->set_value('login') . '@gmail.com',
								$this->form_validation->set_value('password'),
								$email_activation,
								$custom
							))) {
								// success
								$this->data['site_name'] = $this->config->item('website_name', 'tank_auth');

								if ($email_activation) {
									// send "activate" email
									$this->data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

									$this->_send_email('activate', $this->data['email'], $data);

									unset($this->data['password']); // Clear password (just for any case)

								} else {
									if ($this->config->item('email_account_details', 'tank_auth')) {
										// send "welcome" email
										$this->_send_email('welcome', $this->data['email'], $data);
									}
									unset($this->data['password']); // Clear password (just for any case)
								}
								// $this->tank_auth->notice('registration-success');
							} else {
								$errors = $this->tank_auth->get_error_message();
								foreach ($errors as $k => $v) $this->data['errors'][$k] = $this->lang->line($v);
							}
						}
					}
				}

				// validation ok
				if ($this->tank_auth->login(
					$this->form_validation->set_value('login'),
					$this->form_validation->set_value('password'),
					$this->form_validation->set_value('remember'),
					$this->data['login_by_username'],
					$this->data['login_by_email']
				)) {
					// success
					// Approved or not
					if ($this->tank_auth->is_approved()) {
						$USERNAME = $this->form_validation->set_value('login');
						$PASSWORD = $this->form_validation->set_value('password');

						$hasil = $this->ldap_tools->validate_user($USERNAME, $PASSWORD);
						
						if ($hasil) {
							$getUser = $this->Ldap_model->take_users($USERNAME);

							$this->session->set_userdata('data_ldap', $getUser);
						}

						$this->data['dataUser'] = $this->session->userdata('data_ldap');

						$this->data['user_id'] = $this->tank_auth->get_user_id();

						$profile = $this->tank_auth->get_user_profile($this->data['user_id']);

						$this->data['profile_name'] = $profile['name'];

						$this->session->set_flashdata('message', 'Selamat datang <b> ' . $this->data['profile_name'] . '</b> di Aplikasi Manajemen Sistem PT-Tornado');

						redirect($this->config->item('login-success', 'tank_auth'));
					} else {
						$this->tank_auth->logout();
						$this->tank_auth->notice('acct-unapproved');
					}
				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {                                // banned user

						$this->tank_auth->notice('user-banned');
					} elseif (isset($errors['not_activated'])) {                // not activated user

						redirect('auth/send_again');
					} else {                                                    // fail
						foreach ($errors as $k => $v) $this->data['errors'][$k] = $this->lang->line($v);
					}
				}
			}


			$this->load->view('auth/login_form', $this->data);
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		delete_cookie('status');
		delete_cookie('cookie_name');

		$this->tank_auth->logout();
		$redirect = $this->config->item('logout-success', 'tank_auth');

		if ($redirect === FALSE) {
			$this->tank_auth->notice('logout-success');
		} else {
			redirect($redirect);
		}
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{
		if ($this->tank_auth->is_logged_in()) {                                    // logged in
			redirect($this->config->item('register_redirect', 'tank_auth'));
		} elseif ($this->tank_auth->is_logged_in(FALSE)) {                        // logged in, not activated
			redirect('Auth/send_again');
		} elseif (!$this->config->item('allow_registration', 'tank_auth')) {    // registration is off
			$this->tank_auth->notice('registration-disabled');
		} else {
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
					$data['registration_fields'][] = $val;
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
							//$data['dropdown_name'] = $name;
							$data['dropdown_items'][$name] = $this->tank_auth->create_regdb_dropdown($dbname, $fields);
							$data['dropdown_items_default'][$name] = $default;
							$data['db_dropdowns'][] = $name;
						} else {
							$default = isset($val[5]) ? $val[5] : NULL;
							$data['dropdown_simple'][$name] = $selection;
							$data['dropdown_simple_default'][$name] = $default;
						}
					}
				}
			}
			$data['errors'] = array();

			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if ($this->form_validation->run()) {
				// validation ok
				// Custom registration fields
				$registration_fields = (bool)$this->config->item('registration_fields', 'tank_auth') ? $this->config->item('registration_fields', 'tank_auth') : array();
				if ($registration_fields) {
					//$datatypes = $this->tank_auth->get_profile_datatypes();
					foreach ($this->config->item('registration_fields', 'tank_auth') as $val) {
						$name = $val[0];
						$value = $this->form_validation->set_value($name);
						$custom[$name] = $value;
					}

					//Remove all NULL values so MySQL will use the default value
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

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					if ($email_activation) {                                    // send "activate" email
						$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

						$this->_send_email('activate', $data['email'], $data);

						unset($data['password']); // Clear password (just for any case)

					} else {
						if ($this->config->item('email_account_details', 'tank_auth')) {    // send "welcome" email

							$this->_send_email('welcome', $data['email'], $data);
						}
						unset($data['password']); // Clear password (just for any case)
					}

//					$this->tank_auth->notice('registration-success');
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
				}
			}

		

			//$data['debug'] = $this->tank_auth->debug('14');

			$data['use_username'] = $use_username;

			$this->load->view('auth/register_form', $data);
		}
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {                            // not logged in or activated
			redirect('Auth/login');
		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {                                // validation ok
				if (!is_null($data = $this->tank_auth->change_email(
					$this->form_validation->set_value('email')
				))) {            // success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);
					$this->tank_auth->notice('activation-sent', $data);
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
				}
			}

			$data['logout_link'] = site_url() . 'auth/logout';
			$this->load->view('auth/send_again_form', $data);
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		if (!$this->uri->segment(4)) redirect('/auth/login');

		$user_id = $this->uri->segment(3);
		$new_email_key = $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {        // success
			$this->tank_auth->logout();
			$this->tank_auth->notice('activation-complete');
		} else {                                                                // fail
			$this->tank_auth->notice('activation-failed');
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {                                    // logged in
			redirect('');
		} elseif ($this->tank_auth->is_logged_in(FALSE)) {                        // logged in, not activated
			redirect('Auth/send_again');
		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required');

			$data['errors'] = array();

			if ($this->form_validation->run()) {                                // validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
					$this->form_validation->set_value('login')
				))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					$this->tank_auth->notice('password-sent');
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/forgot_password_form', $data);
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id = $this->uri->segment(3);
		$new_pass_key = $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {                                // validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
				$user_id,
				$new_pass_key,
				$this->form_validation->set_value('new_password')
			))) {    // success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->tank_auth->notice('password-reset');
			} else {                                                        // fail
				$this->tank_auth->notice('password-failed');
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->tank_auth->notice('password-failed');
			}
		}
		$this->load->view('auth/reset_password_form', $data);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {                                // not logged in or not activated
			redirect('Auth/login');
		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');

			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {                                // validation ok
				if ($this->tank_auth->change_password(
					$this->form_validation->set_value('old_password'),
					$this->form_validation->set_value('new_password')
				)) {    // success
					$this->tank_auth->notice('password-changed');
				} else {                                                        // fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->data['title'] = "Change Password";

			$this->data['user_id'] = $this->tank_auth->get_user_id();
			$this->data['username'] = $this->tank_auth->get_username();

			$profile = $this->tank_auth->get_user_profile($this->data['user_id']);

			$this->data['profile_name'] = $profile['name'];
			$this->data['profile_foto'] = $profile['foto'];

			foreach ($this->tank_auth->get_roles($this->data['user_id']) as $val) {
				$this->data['role_id'] = $val['role_id'];
				$this->data['role'] = $val['role'];
				$this->data['full_name_role'] = $val['full'];
			}

			$this->data['link_active'] = 'change_password';

			$this->load->model("showmenu_model");
			$this->data['ShowMenu'] = $this->showmenu_model->getShowMenu();

			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text' => 'Change Password',
				'class' => 'fa fa-dashboard',
				'class_active' => 'class="active"',
				'href' => site_url('auth/change_password')
			);


			$this->load->view('shared/header', $this->data);
			$this->load->view('shared/nav', $this->data);
			$this->load->view('shared/nav_left', $this->data);
			$this->load->view('auth/change_password_form', $data);
			$this->load->view('shared/footer', $this->data);
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {                                // not logged in or not activated
			redirect('Auth/login');
		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {                                // validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
					$this->form_validation->set_value('email'),
					$this->form_validation->set_value('password')
				))) {            // success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->tank_auth->notice('email-sent', $data);
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_email_form', $data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id = $this->uri->segment(3);
		$new_email_key = $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {    // success
			$this->tank_auth->logout();
			$this->tank_auth->notice('email-activated');
		} else {                                                                // fail
			$this->tank_auth->notice('email-failed');
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {                                // not logged in or not activated
			redirect('Auth/login');
		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			$data['errors'] = array();

			if ($this->form_validation->run()) {                                // validation ok
				if ($this->tank_auth->delete_user(
					$this->form_validation->set_value('password')
				)) {        // success

					$this->tank_auth->notice('user-deleted');
				} else {                                                        // fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/unregister_form', $data);
		}
	}

	/**
	 * Show info message
	 *
	 * @param string
	 * @return    void
	 */
	/*
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('Auth');
	}
	*/

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

		$config['website_name'] = 'KII ' . date('Y') . ' - Notifikasi';
		$config['webmaster_email'] = 'khuzen999@gmail.com';
		$config['no_reply_email'] = 'no-reply@gmail.com';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.inti.co.id';
		$config['smtp_user'] = 'kii.2021';
		$config['smtp_pass'] = '1Nt1.2022!';
		$config['smtp_port'] = '25';
		$config['newline'] = "\r\n";

		$this->email->initialize($config);

		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_' . $type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/' . $type . '-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/' . $type . '-txt', $data, TRUE));

		$this->email->send();

		echo $this->email->print_debugger();
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
