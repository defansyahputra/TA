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
        $id_klinik = 2;

        $query = $this->db->select_sum('harga')
                        ->where('id_klinik', $id_klinik)
                        ->get('rekamedis_view');
        
        return $query->row()->harga;
    }
    public function getAllIncomeCibadak()
    {
        $id_klinik = 1;

        $query = $this->db->select_sum('harga')
                        ->where('id_klinik', $id_klinik)
                        ->get('rekamedis_view');
        
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

    public function getIncomeChart()
    {
        return $this->db->get('rekamedis_view')->result();
    }
}
