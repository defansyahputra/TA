<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Web_List extends CI_Controller
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

			$this->data['link_active'] = 'user-web-list';

			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Pegawai');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("User_web_list_model");
		}
	}

	function index()
	{
		$this->data['title'] = "Daftar Pengguna Web";

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengguna Web',
			'class' => 'breadcrumb-item pe-3 text-white',
			'href' => ''
		];

		$this->data['breadcrumbs'][] = [
			'active' => TRUE,
			'text' => 'Daftar Pengguna Web',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('user-web-list')
		];

		$this->data['listuser'] = $this->User_web_list_model->getAllUser();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('user_web/view', $this->data);
		$this->load->view('component/footer');
	}

	function activate($user_id)
	{
		// Activate user
		if ($this->tank_auth->activate_user_manual($user_id)) { // success
			redirect('Pegawai');
		} else { // fail
			redirect('Pegawai');
		}
	}

	function delete($id)
	{
		$condition['id'] = $id;
		$this->User_web_list_model->deleteUser($condition);
		redirect('Pegawai');
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
