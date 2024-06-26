<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Income_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAllIncome()
    {
        $query = $this->db->select_sum('harga')->get('tb_rekamedis');
        return $query->row()->harga;
    }

    public function getAllIncomeLembang()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        $id_klinik = 2;

        $whereCondition = array(
            'YEAR(date)' => $currentYear,
            'MONTH(date)' => $currentMonth,
            'id_klinik' => $id_klinik
        );

        $query = $this->db->select_sum('harga')
                    ->where($whereCondition)
                    ->get('rekamedis_view');
        
        return $query->row()->harga;
    }
    public function getAllIncomeCibadak()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        $id_klinik = 1;

        $whereCondition = array(
            'YEAR(date)' => $currentYear,
            'MONTH(date)' => $currentMonth,
            'id_klinik' => $id_klinik
        );

        $query = $this->db->select_sum('harga')
                    ->where($whereCondition)
                    ->get('rekamedis_view');
        
        return $query->row()->harga;
    }
    public function getAllIncomeBojongsoang()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        $id_klinik = 3;

        $whereCondition = array(
            'YEAR(date)' => $currentYear,
            'MONTH(date)' => $currentMonth,
            'id_klinik' => $id_klinik
        );

        $query = $this->db->select_sum('harga')
                    ->where($whereCondition)
                    ->get('rekamedis_view');
        
        return $query->row()->harga;
    }

    public function getIncomeChart()
    {
        return $this->db->get('rekamedis_view')->result(); 
    }

    public function getMonthlyIncome()
    {
        $this->db->select('YEAR(date) as year, MONTH(date) as month, SUM(harga) as total_income');
        $this->db->from('rekamedis_view');  // Assuming 'tb_income' is your income table
        $this->db->group_by(['year', 'month']);
        $this->db->order_by('year', 'month');
        $query = $this->db->get();

        $result = [];
        foreach ($query->result() as $row) {
            $result[] = [
                'year' => $row->year,
                'month' => $row->month,
                'total_income' => $row->total_income
            ];
        }
        return $result;
    }
}
