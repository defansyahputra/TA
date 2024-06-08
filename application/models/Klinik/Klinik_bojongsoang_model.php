<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Klinik_bojongsoang_model extends CI_Model
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

    public function getAllIncomeBojongsoang()
    {
        $id_klinik = 3;

        $query = $this->db->select_sum('harga')
            ->where('id_klinik', $id_klinik)
            ->get('rekamedis_view');

        return $query->row()->harga;
    }

    public function getMonthlyIncome()
    {
        $id_klinik = 3;

        $this->db->select('YEAR(date) as year, MONTH(date) as month, SUM(harga) as total_income');
        $this->db->from('rekamedis_view');
        $this->db->group_by(['year', 'month']);
        $this->db->order_by('year', 'month');
        $this->db->where('id_klinik', $id_klinik);
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
