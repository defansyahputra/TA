<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinik_Bojongsoang extends CI_Controller
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

            $this->data['link_active'] = 'Income';

            //buat permission
            if (!$this->tank_auth->permit($this->data['link_active'])) {
                redirect('Income');
            }

            $this->load->model("Showmenu_model");
            $this->data['ShowMenu'] = $this->Showmenu_model->getShowMenu();

            $OpenShowMenu = $this->Showmenu_model->getOpenShowMenu($this->data);

            $this->data['openMenu'] = $this->Showmenu_model->getDataOpenMenu($OpenShowMenu->id_menu_parent);

            $this->load->model("Menu_model");
            $this->load->model("Klinik/Klinik_bojongsoang_model");
            $this->load->helper("rupiah");
        }
    }

    public function index()
    {

        $this->data['title'] = 'Income';

        $this->data['breadcrumbs'] = [];

        $this->data['breadcrumbs'][] = [
            'active' => FALSE,
            'text' => 'Income',
            'class' => 'breadcrumb-item pe-3 text-gray-400',
            'href' => site_url('Income')
        ];

        $this->data['TotalIncome'] = $this->Klinik_bojongsoang_model->getAllIncome();
        $this->data['TotalIncomeBojongsoang'] = $this->Klinik_bojongsoang_model->getAllIncomeBojongsoang();

        $this->load->view('component/header', $this->data);
        $this->load->view('component/sidebar', $this->data);
        $this->load->view('component/navbar', $this->data);
        $this->load->view('Income/klinik/klinik-bojongsoang', $this->data);
        $this->load->view('component/footer', $this->data);
    }

    public function chartData()
    {
        $data = $this->Klinik_bojongsoang_model->getMonthlyIncome();
        echo json_encode($data);
    }

    public function getTotalIncomeByDateRange() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');
        $category = $this->input->get('category');

        $totalIncome = $this->Klinik_bojongsoang_model->getTotalIncomeByDateRangeAndCategory($startDate, $endDate, $category);

        echo json_encode($totalIncome);
    }
}
