<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment extends CI_Controller
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

			$this->data['link_active'] = 'Appointment';

			//buat permission
			if (!$this->tank_auth->permit($this->data['link_active'])) {
				redirect('Appointment');
			}

			$this->load->model("Showmenu_model");
			$this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

			$OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

			$this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

			$this->load->model("Menu_model");
			$this->load->model("Appointment_model");
		}
	}

	public function index()
	{
        $this->data['title'] = 'Reservasi Jadwal';

        $this->data['breadcrumbs'] = [];

        $this->data['breadcrumbs'][] = [
            'active' => FALSE,
            'text' => 'Reservasi Jadwal',
            'class' => 'breadcrumb-item pe-3 text-gray-400',
            'href' => site_url('Reservasi')
        ];

        $this->data['list_appointment'] = $this->Appointment_model->getAllAppointment(); 
		$this->data['list_klinik'] = $this->Appointment_model->getAllKlinik();

        $this->load->view('component/header', $this->data);
        $this->load->view('component/sidebar', $this->data);
        $this->load->view('component/navbar', $this->data);
        $this->load->view('reservasi/appointment', $this->data);
        $this->load->view('component/footer', $this->data);
		
	}

    public function delete($id_reservasi)
    {
        $condition['id_reservasi'] = $id_reservasi;
		$this->Appointment_model->deleteAppointment($condition);
		redirect('Appointment');
    }

	public function updateStatus($id_reservasi)
    {
        $data = ['status' => 1];  // Set status to 1

        // Perform update operation and check if it was successful
        if ($this->Appointment_model->updateAppointment($id_reservasi, $data)) {
            $this->session->set_flashdata('message', 'Appointment status updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update appointment status.');
        }

        // Redirect to appointments list
        redirect('Appointment');
    }

	public function jadwal()
	{
		$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Appointment / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Atur Jadwal',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Appointment')
			];

			$this->data['list_jadwal'] = $this->Appointment_model->getAllJadwal();

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('reservasi/data_jadwal', $this->data);
			$this->load->view('component/footer', $this->data);
	}

	public function addJadwal()
	{
		$this->form_validation->set_rules('klinik', 'Klinik', 'required');
		$this->form_validation->set_rules('jadwal', 'Jadwal', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'klinik_id' => decrypt_url($this->input->post('klinik')),
				'jadwal' => $this->input->post('jadwal'),
			);

			$this->Appointment_model->addJadwal($data);
			redirect('Appointment');
		} else {
			$this->data['selected_klinik'] = $this->input->post('klinik');
			$this->data['jadwal'] = $this->input->post('jadwal');

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Appointment/addJadwal');
			$this->data['url'] = site_url('Appointment');
			$this->data['title'] = "Atur Jadwal";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Appointment / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Atur Jadwal',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Appointment')
			];

			$this->data['list_klinik'] = $this->Appointment_model->getAllKlinik();

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('reservasi/form_jadwal', $this->data);
			$this->load->view('component/footer', $this->data);
		}
	}

	public function updateJadwal($id_jadwal)
	{
		$this->form_validation->set_rules('klinik', 'Klinik', 'required');
		$this->form_validation->set_rules('jadwal', 'Jadwal', 'required');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'klinik_id' => decrypt_url($this->input->post('klinik')),
				'jadwal' => $this->input->post('jadwal'),
			);

			$condition['id_jadwal'] = $id_jadwal;
			$this->Appointment_model->updateJadwal($data, $condition);
			redirect('Appointment/jadwal');
		} else {
			$jadwal = $this->Appointment_model->getJadwal($id_jadwal);

			$this->data['selected_klinik'] = $jadwal->klinik_id;
			$this->data['jadwal'] = $jadwal->jadwal;

			if ($this->input->post()) {
				$this->data['klinik_id'] = $this->input->post('klinik');
				$this->data['jadwal'] = $this->input->post('jadwal');
			}

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['action'] = site_url('Appointment/updateJadwal/' .$id_jadwal);
			$this->data['url'] = site_url('Appointment');
			$this->data['title'] = "Atur Jadwal";

			$this->data['breadcrumbs'] = [];

			$this->data['breadcrumbs'][] = [
				'active' => FALSE,
				'text' => 'Appointment / ',
				'class' => 'breadcrumb-item pe-3',
				'href' => ''
			];

			$this->data['breadcrumbs'][] = [
				'active' => TRUE,
				'text' => 'Atur Jadwal',
				'class' => 'breadcrumb-item pe-3 text-gray-400',
				'href' => site_url('Appointment')
			];

			$this->data['list_klinik'] = $this->Appointment_model->getAllKlinik();

			$this->load->view('component/header', $this->data);
			$this->load->view('component/sidebar', $this->data);
			$this->load->view('component/navbar', $this->data);
			$this->load->view('reservasi/form_jadwal', $this->data);
			$this->load->view('component/footer', $this->data);
		}
	}

	public function deleteJadwal($id_jadwal)
	{
		$condition['id_jadwal'] = $id_jadwal;
		$this->Appointment_model->deleteJadwal($condition);
		redirect('Appointment/jadwal');
	}
}