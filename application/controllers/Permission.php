<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends CI_Controller
{
	public function __construct()
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

			$this->data['link_active'] = 'Permission';

			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Dashboard');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Permission_model");
		}
	}

	public function index()
	{
		$this->data['title'] = "Pengaturan Modul";

		$this->data['breadcrumbs'] = [];

		$this->data['breadcrumbs'][] = [
			'active' => FALSE,
			'text' => 'Pengaturan / ',
			'class' => 'breadcrumb-item pe-3',
			'href' => ''
		];

		$this->data['breadcrumbs'][] = [
			'active' => TRUE,
			'text' => 'Pengaturan Modul',
			'class' => 'breadcrumb-item pe-3 text-gray-400',
			'href' => site_url('Permission')
		];

		$this->data['listPermission'] = $this->Permission_model->getAllPermission();

		$this->load->view('component/header', $this->data);
		$this->load->view('component/sidebar', $this->data);
		$this->load->view('component/navbar', $this->data);
		$this->load->view('permission/views', $this->data);
		$this->load->view('component/footer', $this->data);
	}

	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('description', 'Permission', 'required');
		$this->form_validation->set_rules('permission', 'Controller', 'required');

		if ($this->form_validation->run() == TRUE) {

			$data = array(
				'description' => $this->input->post('description'),
				'permission' => $this->input->post('permission')
			);

			$this->Permission_model->addPermission($data);

			redirect('Permission');
		} else {
			$this->data['description'] = $this->input->post('description');
			$this->data['permission'] = $this->input->post('permission');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Permission/add');
			$this->data['url'] = site_url('Permission');
			$this->data['title'] = "Pengaturan Modul";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Modul',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Permission')
			];

			$this->data['listPermission'] = $this->Permission_model->getAllPermission();

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('permission/form', $this->data);
			$this->load->view('component/footer', $this->data);
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('description', 'Permission', 'required');
		$this->form_validation->set_rules('permission', 'Controller', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'description' => $this->input->post('description'),
				'permission' => $this->input->post('permission')
			);
			$condition['permission_id'] = $id;

			$this->Permission_model->updatePermission($data, $condition);

			redirect('Permission');
		} else {
			$this->data['description'] = $this->input->post('description');
			$this->data['permission'] = $this->input->post('permission');

			$permission = $this->Permission_model->getPermission($id);

			$this->data['description'] = $permission->description;
			$this->data['permission'] = $permission->permission;

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Permission/update/' . $id);
			$this->data['url'] = site_url('Permission');
			$this->data['title'] = "Pengaturan Modul";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Pengaturan / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Pengaturan Modul',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Permission')
			];

			$this->data['listPermission'] = $this->Permission_model->getAllPermission();

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('permission/form', $this->data);
			$this->load->view('component/footer', $this->data);
		}
	}

	public function delete($id)
	{
		$condition['permission_id'] = $id;

		$this->Permission_model->deletePermission($condition);

		redirect('Permission');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
