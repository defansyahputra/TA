<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // public function getAllPendapatan()
    // {
    //     $query = $this->db->select_sum('sell_price_total')->get('tb_pesanan');
    //     return $query->row()->sell_price_total;
    // }

    // public function getAllPiutang()
    // {
    //     $query = $this->db->select_sum('unpaid')->get('tb_pesanan');
    //     return $query->row()->unpaid;
    // }

    public function getAllHutang()
    {
        $this->db->select_sum('harga_barang');
        $this->db->where_not_in('status', ['paid']);
        // $query = $this->db->get('tb_pembelian');
        // return $query->row()->harga_barang;
    }
}
