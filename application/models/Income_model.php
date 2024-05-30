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
}
